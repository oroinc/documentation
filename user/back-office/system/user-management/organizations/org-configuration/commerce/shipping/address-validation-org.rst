.. _organization-commerce--configuration--shipping--address-validation:

Configure Address Validation Settings per Organization
======================================================

.. note:: The Address Validation feature can be configured on the :ref:`global <sys--conf--commerce--shipping--address-validation>`, organization, and :ref:`website <website-commerce--configuration--shipping--address-validation>` levels.

The Address Validation feature ensures that user-entered shipping or billing addresses are accurate, recognized by the shipping service, and can be used for precise shipping cost estimation.

When a customer or admin user enters a new address, the system validates it through an external address validation service (UPS or FedEx) and provides suggestions if needed. If the entered address is valid, no changes are required, and no popup is triggered. If the service suggests corrections, the user is asked to choose an address:

* **1 to 3 suggestions**: Each is displayed as a radio button, with the first *suggested address* selected by default. The changes are highlighted in the storefront and underlined in the back-office.

.. image:: /user/img/system/config_commerce/shipping/address-validation-2-suggestions.png
   :alt: Address Validation popup dialog with 2 suggestions to the entered address in the storefront and back-office

* **More than 3 suggestions**: The original address and a *suggested address* radio button are displayed, while all suggested addresses appear in a dropdown. The first suggested address is pre-selected. The changes are highlighted in the storefront and underlined in the back-office.

.. image:: /user/img/system/config_commerce/shipping/address-validation-suggestions-dropdown.png
   :alt: Address Validation popup dialog with suggestions to the entered address appear in a dropdown in the storefront and back-office

* **Update or save an adjusted shipping or billing address**: Users also have the possibility to update or save an adjusted address. In the validation popup, alongside address suggestions, the **Update Address** or **Save Address** options may be available. **Update Address** allows the system to automatically apply the corrected address throughout the system where it is used. **Save Address** allows to save the adjusted address as a new address in the system.

.. image:: /user/img/system/config_commerce/shipping/address-validation-suggestions-save-address.png
   :alt: Address Validation popup dialog with the Update Address or Save Address options available alongside address suggestions


Prerequisites
-------------

Before you enable the address validation feature, ensure that you have properly configured either :ref:`UPS <doc--integrations--ups>` or :ref:`FedEx <doc--integrations--fedex>` shipping integration for your application.

Configuration
-------------

To enable the address validation feature per specific organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Shipping > Address Validation** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/shipping/address-validation-default-org.png
      :alt: Organization-level address validation configuration settings


4. Under the **General** section, select a shipping service whose databases will be used to verify the entered shipping or billing addresses in real-time (clear the *Use System* checkbox to configure the settings per organization).

5. Save the settings for additional options to appear.

6. Under the **Storefront** section, select the places where address validation should be triggered in the storefront, such as under **My Account > Address Book** menu when adding or modifying a billing or shipping address, or during checkout. By default, the system validates only shipping addresses.

   .. image:: /user/img/system/config_commerce/shipping/address-validation-storefront-global.png
      :alt: Global address validation configuration with additional storefront options

7. Under the **Back-Office** section, select the places where address validation should be triggered in the back-office, such as:

   * under the **Customers** menu when adding or modifying a billing or shipping address for a customer or customer user
   * under **Sales > Orders** when adding or modifying a billing or shipping address for the order receiver
   * under **Sales > Quotes** when adding or modifying a shipping address for the quote receiver

By default, the system validates only shipping addresses.

   .. image:: /user/img/system/config_commerce/shipping/address-validation-back-office-global.png
      :alt: Global address validation configuration with additional back-office options


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin