.. _configuration--commerce--marketplace--seller-organization:

Configure Marketplace Settings per Organization
===============================================

.. hint:: This section is part of the :ref:`OroMarketplace Concept Guide <concept-guide-oro-marketplace>` that provides a general understanding of the marketplace features and concepts.

In OroMarketplace, you can enable seller registration (global organization only) and allow sellers to create products in their organization(s).

.. note::
    You can also configure marketplace settings :ref:`globally <configuration--commerce--marketplace--seller-global>`.

To configure marketplace settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.

3. Select **Commerce > Marketplace > General** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/user_management/org_configuration/marketplace/marketplace-products-org-config.png
   :alt: Marketplace configuration page on the organization level

4. In the **Products** section, enable or disable the ability for the sellers to create products in their (seller) organization. This option is enabled by default.

5. In the **Seller Registration** section:

   * Select the **Enable Seller Registration** checkbox to activate the ability for sellers to register with your marketplace online.

   .. important:: This option can be ebabled only in the organization settings of the global organization.

   When registration is enabled, you can select the owner of the seller's request and select the :ref:`consents <user-guide--consents>` to be displayed in the Seller Registration form in the storefront website. Enabling this option also adds the :ref:`Seller Registration workflow <system--workflows--seller-registration-flow>` to the list of workflows under **System > Workflows**.

.. image:: /user/img/concept-guides/marketplace/seller-registration.png
   :alt: Seller Registration button in the storefront

6. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin