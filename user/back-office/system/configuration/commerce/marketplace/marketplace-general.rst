:oro_documentation_types: OroMarketplace

.. _configuration--commerce--marketplace--seller-global:

Configure Global Seller Name and Registration Settings
======================================================

.. hint:: This section is part of the :ref:`OroMarketplace Concept Guide <concept-guide-oro-marketplace>` that provides a general understanding of the marketplace features and concepts.

In OroMarketplace, you can configure to display the name of the seller (organization) in the storefront product listings, product details, shopping lists, and on order pages. In addition, you can enable sellers to register with your marketplace and select the consents to be displayed in the Seller Registration form in the storefront.

.. note::
    You can also configure marketplace settings :ref:`per organization <configuration--commerce--marketplace--seller-organization>`.

To configure marketplace settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Marketplace > General** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Seller Name** section:

   a) Clear the **Use Default** checkbox.
   b) Select the **Enable Display Seller Name** checkbox to show the seller's name on the storefront website.

.. image:: /user/img/concept-guides/marketplace/seller-name.png
   :alt: Seller's name enabled and displayed in the storefront

4. In the **Seller Registration** section:

   a) Clear the **Use Default** checkbox.
   b) Select the **Enable Seller Registration** checkbox to activate the ability for sellers to register with your marketplace online.
   c) When registration is enabled, you can select the owner of the seller's request and select the :ref:`consents <user-guide--consents>` to be displayed in the Seller Registration form on the storefront website. Enabling this option also adds the :ref:`Seller Registration workflow <system--workflows--seller-registration-flow>` to the list of workflows under **System > Workflows**.

.. image:: /user/img/concept-guides/marketplace/seller-registration.png
   :alt: Seller Registration button in the storefront

5. Click **Save Settings**.