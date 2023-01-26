.. _bundle-docs-platform-navigation-bundle-menu-updates:

Menu Updates
============

OroNavigationBundle introduces the mechanism called Menu Updates that gives the ability to create and modify menu items in different scopes using back-office UI.
The architecture of this mechanism consists of:

1. ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate`` entities that store the changes of menus.
2. ``Oro\Bundle\NavigationBundle\Menu\MenuUpdateBuilder`` menu builder that applies menu updates for the current scope.
3. ``Oro\Bundle\NavigationBundle\Provider\MenuUpdateProvider`` that provides menu updates for the current scope.
4. ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\MenuUpdateApplier`` that applies each menu update.
5. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator`` that propagates the data stored in a MenuUpdate into the corresponding menu item.


Menu Update Scopes
------------------

Oro applications enable you to configure back-office menus in 3 :ref:`scopes <dev-scopes>`: global, organization and user. You can find user documentation at :ref:`Edit back-office menus <doc--menu-config-levels>`.

Menu Update Types
-----------------

There are several types of menu update that can be distinguished depending on the way it is created:

* `system`
* `custom`
* `synthetic`

To simplify the understanding, the menu item affected by a menu update fairly shares its type, as it is marked with corresponding extra option, so it also can be `system`, `custom` or `synthetic`.

System Type
^^^^^^^^^^^

Such menu update is aimed to modify a menu item that is initially created by application via `navigation.yml` or by a menu builder. Menu update is treated as `system` if it both `custom` and `synthetic` fields are set to `false`.
A `system` menu update is created when a user either submits the form of already existing menu item, moves the menu item or toggles the menu item display using Show / Hide buttons in the back-office menu management UI.
Soundly, the menu update of `system` type cannot modify a non-existing menu item and should not create a new one, so if the target menu item from which the menu update initially created is missing, then the corresponding changes enclosed in the menu update become lost.

Custom Type
^^^^^^^^^^^

Such menu update is aimed to create a new menu item or modify one if it is already created by a custom menu update in the parent scope. Menu items affected by these menu updates are marked with ``Oro\Bundle\NavigationBundle\Entity\MenuUpdateInterface::IS_CUSTOM`` extra option. Menu update is treated as `custom` if `custom` field is set to `true`.
A `custom` menu update is created when a user hits "Create Menu Item" buttons and submits the form in the back-office menu management UI.

Synthetic Type
^^^^^^^^^^^^^^

Such menu update is aimed to modify or create a new menu item one if it does not already exist. Menu items affected by these menu updates are marked with ``Oro\Bundle\NavigationBundle\Entity\MenuUpdateInterface::IS_SYNTHETIC`` extra option. Menu update is treated as `synthetic` if `synthetic` field is set to `true`.
A `synthetic` menu update is created when a user either submits the form, moves the menu item or toggles the menu item display of already existing menu item that can become `synthetic` in the back-office menu management UI. The ability of a menu item to produce `synthetic` menu update can be controlled by a propagator - the class implementing ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface`` interface. This type is not used out-of-the-box in ORO Platform.

The difference from the `system` menu update is that `synthetic` one can create a new menu item if the target one is missing. The difference from the `custom` menu update is that `synthetic` one can be created only from a `system` menu item, e.g. by moving the menu item or toggling the menu item display using Show / Hide buttons in the back-office menu management UI.

Menu Update Builder
-------------------

``Oro\Bundle\NavigationBundle\Menu\MenuUpdateBuilder`` menu builder collects all menu updates for the current scope from ``Oro\Bundle\NavigationBundle\Provider\MenuUpdateProvider`` provider and applies them to menu using ``Menu Update Applier``.

After all menu updates are applied the menu builder dispatches the event ``Oro\Bundle\NavigationBundle\Event\MenuUpdatesApplyAfterEvent`` containing context object ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\Model\MenuUpdateApplierContext`` with applied menu updates and changes made to menu.

Menu Update Applier
-------------------

``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\MenuUpdateApplier`` is responsible for applying a specific Menu Update to menu: create, update or move specific menu item. The responsibility of applying other data (e.g. title, description, etc.) is delegated to the propagator -  ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator``.

``MenuUpdateApplier`` stores in the context object ``Oro\Bundle\NavigationBundle\MenuUpdate\Applier\Model\MenuUpdateApplierContext`` the menu update apply details:

1. Created menu items.
2. Updated menu items.
3. Lost menu items: menu items created by a system menu update, but the target system menu items does not exist anymore.
4. Orphaned menu items: menu items without a parent menu item (parent menu item does not exist).

.. note:: Orphaned menu items are placed into menu root by ``Oro\Bundle\NavigationBundle\Menu\OrphanItemsBuilder`` at the end of menu builders chain.

.. note:: Lost menu items are removed from menu by ``Oro\Bundle\NavigationBundle\Menu\LostItemsBuilder`` at the end of menu builders chain.

Menu Update to Menu Item Propagator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The propagator is represented by a composite class ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\CompositePropagator`` that calls inner propagators:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\BasicPropagator``: fills the menu item label, URI,  display (shown/hidden), link attributes.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\ExtrasPropagator``: fills the menu item extras with fields that are not represented in the menu item explicitly.

.. note:: You can create your own menu-update-to-menu-item propagator by creating a class implementing ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuItem\MenuUpdateToMenuItemPropagatorInterface`` and registering it as a service with tag ``oro_navigation.menu_update.propagator.to_menu_item``.

Menu Update Manager
-------------------

``Oro\Bundle\NavigationBundle\Manager\MenuUpdateManager`` is responsible for CRUD operations on ``MenuUpdate`` entities. The responsibility of creating a Menu Update is delegated to the factory - ``Oro\Bundle\NavigationBundle\MenuUpdate\Factory\MenuUpdateFactory`` and propagator - ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\CompositePropagator``.

The are additional managers responsible for other operations on ``MenuUpdate`` entities:

1. ``Oro\Bundle\NavigationBundle\Manager\MenuUpdateMoveManager``: responsible for moving menu items.
2. ``Oro\Bundle\NavigationBundle\Manager\MenuUpdateDisplayManager``: responsible for toggling the display state (shown/hidden).

Menu Item to Menu Update Propagator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The propagator is responsible for taking menu item data and copy it to the ``MenuUpdate`` entity. It is represented by a composite class ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\CompositePropagator`` that calls inner propagators:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\BasicPropagator``: fills parentKey, display state (shown/hidden), URI.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\TitlePropagator``
3. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\DescriptionPropagator``
4. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\ExtrasPropagator``: fills ``Menu Update`` fields with data found in extras options of the menu item.

.. note:: You can create your own menu-item-to-menu-update propagator by creating a class implementing ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface`` and registering it as a service with tag ``oro_navigation.menu_update.propagator.to_menu_update``.

In order not to store in the menu update the data not explicitly seen and approved by user (by submitting the menu item form), menu-item-to-menu-update propagators are called according to the specified strategy:

1. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface::STRATEGY_FULL``: used for propagating the menu update to show in the form in the back-office menu management UI.
2. ``Oro\Bundle\NavigationBundle\MenuUpdate\Propagator\ToMenuUpdate\MenuItemToMenuUpdatePropagatorInterface::STRATEGY_BASIC``: used for propagating the menu update when menu item is moved or it display state is toggled the back-office menu management UI.


.. include:: /include/include-links-dev.rst
   :start-after: begin
