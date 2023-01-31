.. _bundle-docs-platform-navigation-bundle-menu-updates:

Menu Updates
============

OroNavigationBundle introduces a mechanism called Menu Updates that allows creating and modifying menu items in different scopes using back-office UI.

The architecture of this mechanism consists of the following:

1. Entity class ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate`` to store the changes made to menu items.
2. Menu builder ``Oro\Bundle\NavigationBundle\Menu\MenuUpdateBuilder`` that applies menu updates for the current scope.
3. Menu updates provider ``Oro\Bundle\NavigationBundle\Provider\MenuUpdateProvider`` that provides menu updates for the current scope.
4. Menu update applier ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\MenuUpdateApplier`` that applies each menu update.
5. Menu-update-to-menu-item propagator ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator`` that propagates the data stored in a MenuUpdate into the corresponding menu item.


Menu Update Scopes
------------------

Oro applications enable you to configure back-office menus in 3 :ref:`scopes <dev-scopes>`: global, organization, and user. For user documentation, see :ref:`Edit back-office menus <doc--menu-config-levels>`.

Menu Update Types
-----------------

Depending on how menus were created, there are three types of updates:

* `system`
* `custom`
* `synthetic`

The item menu affected by the menu update is additionally marked with an extra option indicating the type of the update, so the system / custom / synthetic concept can be applied not only to the menu update, but also the menu item.

System Type
^^^^^^^^^^^

This menu update is aimed at modifying a menu item initially created by the application via `navigation.yml` or a menu builder. Menu update is treated as `system` if both `custom` and `synthetic` fields are set to `false`.
A `system` menu update is created when a user either submits the form of an already existing menu item, moves the menu item, or toggles the menu item display using Show / Hide buttons in the back-office menu management UI.
The menu update of the `system` type cannot modify a non-existing menu item and should not create a new one, so if the target menu item from which the menu update was initially created is missing, then the corresponding changes enclosed in the menu update become lost.

Custom Type
^^^^^^^^^^^

This menu update aims to create a new menu item or modify one if it is already created by a custom menu update in the parent scope. Menu items affected by these menu updates are marked with the ``Oro\Bundle\NavigationBundle\Entity\MenuUpdateInterface::IS_CUSTOM`` extra option. The menu update is treated as `custom` if the `custom` field is set to `true`.
A `custom` menu update is created when a user hits the "Create Menu Item" button and submits the form in the back-office menu management UI.

Synthetic Type
^^^^^^^^^^^^^^

This menu update modifies or creates a new menu item if it does not already exist. Menu items affected by these menu updates are marked with the ``Oro\Bundle\NavigationBundle\Entity\MenuUpdateInterface::IS_SYNTHETIC`` extra option. Menu update is treated as `synthetic` if the `synthetic` field is set to `true`.
A `synthetic` menu update is created when a user either submits the form, moves the menu item, or toggles the menu item display of an already existing menu item that can become `synthetic` in the back-office menu management UI. The ability of a menu item to produce a `synthetic` menu update can be controlled by a propagator, which is a class that implements the ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface`` interface. This type is not used out-of-the-box in OroPlatform.

Unlike the `system` menu update, the `synthetic` one can create a new menu item if the target one is missing, and in contrast to the `custom` menu update, the `synthetic` one can be created only from a `system` menu item (e.g., by moving the menu item or toggling the menu item display using Show / Hide buttons in the back-office menu management UI).

Menu Update Builder
-------------------

``Oro\Bundle\NavigationBundle\Menu\MenuUpdateBuilder`` menu builder collects all menu updates for the current scope from the ``Oro\Bundle\NavigationBundle\Provider\MenuUpdateProvider`` provider and applies them to a menu using ``Menu Update Applier``.

After all menu updates are applied, the menu builder dispatches the ``Oro\Bundle\NavigationBundle\Event\MenuUpdatesApplyAfterEvent`` event with the context object ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\Model\MenuUpdateApplierContext`` with applied menu updates and changes made to the menu.

Menu Update Applier
-------------------

``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\MenuUpdateApplier`` is responsible for applying a specific Menu Update to menu: create, update or move a specific menu item. The responsibility of applying other data (e.g. title, description, etc.) is delegated to the propagator  ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator``.

``MenuUpdateApplier`` stores the following details of the menu update in context object ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\Model\MenuUpdateApplierContext``:

1. Created menu items.
2. Updated menu items.
3. Lost menu items: menu items created by a system menu update, but the target system menu items do not exist anymore.
4. Orphaned menu items: menu items without a parent menu item (parent menu item does not exist).

.. note:: Orphaned menu items are placed into the menu root by ``Oro\Bundle\NavigationBundle\Menu\OrphanItemsBuilder`` at the end of the menu builders chain.

.. note:: Lost menu items are removed from the menu by ``Oro\Bundle\NavigationBundle\Menu\LostItemsBuilder`` at the end of the menu builders chain.

Menu Update to Menu Item Propagator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The propagator is represented by a composite class ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator`` that calls inner propagators:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\BasicPropagator``: fills the menu item label, URI,  display (shown/hidden), link attributes.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\ExtrasPropagator``: fills the menu item extras with fields that are not represented in the menu item explicitly.

.. note:: You can create your own menu-update-to-menu-item propagator by creating a class implementing ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\MenuUpdateToMenuItemPropagatorInterface`` and registering it as a service with tag ``oro_navigation.menu_update.propagator.to_menu_item``.

Menu Update Manager
-------------------

``Oro\Bundle\NavigationBundle\Manager\MenuUpdateManager`` is responsible for CRUD operations on ``MenuUpdate`` entities. The responsibility of creating a Menu Update is delegated to the factory ``Oro\Bundle\NavigationBundle\MenuUpdate\Factory\MenuUpdateFactory`` and propagator ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\CompositePropagator``.

There are additional managers responsible for other operations on ``MenuUpdate`` entities:

1. ``Oro\Bundle\NavigationBundle\Manager\MenuUpdateMoveManager`` is responsible for moving menu items.
2. ``Oro\Bundle\NavigationBundle\Manager\MenuUpdateDisplayManager`` is responsible for toggling the display state (shown/hidden).

Menu Item to Menu Update Propagator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The propagator is responsible for taking menu item data and copying it to the ``MenuUpdate`` entity. It is represented by a composite class ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\CompositePropagator`` that calls inner propagators:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\BasicPropagator``: fills parentKey, display state (shown/hidden), URI.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\TitlePropagator``
3. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\DescriptionPropagator``
4. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\ExtrasPropagator``: fills ``Menu Update`` fields with data found in extras options of the menu item.

.. note:: You can create your own menu-item-to-menu-update propagator by creating a class implementing ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface`` and registering it as a service with tag ``oro_navigation.menu_update.propagator.to_menu_update``.

In order not to store in the menu update the data not explicitly seen and approved by a user (by submitting the menu item form), menu-item-to-menu-update propagators are called according to the specified strategy:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface::STRATEGY_FULL``: used for propagating the menu update to show in the form in the back-office menu management UI.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface::STRATEGY_BASIC``: used for propagating the menu update when a menu item is moved or its display state is toggled in the back-office menu management UI.


.. include:: /include/include-links-dev.rst
   :start-after: begin
