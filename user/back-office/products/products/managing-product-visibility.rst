:oro_documentation_types: OroCommerce

.. _products--product-visibility:

Manage Product Visibility
=========================

.. begin

While a product on a website can be either ``visible`` or ``hidden`` for a customer, the way OroCommerce evaluates the product visibility might seem tricky.

.. note:: An administrator must have permission to view a customer, customer groups, and websites to access the settings described in this section.

Whether the product is shown to the customer on the OroCommerce website depends on the following configuration:

* `Visibility on a Website`_: Is the product visible to the customer (or customer group) on the website? Multiple websites with different visibility configured help split the content and settings for different target customer locations.
* `Visibility to a Customer Group`_: Is the product/category visible to the group of customers in the storefront? Customers can be grouped based on authentication options or the type of business that the customers are in.
* `Visibility to a Customer`_: Is the product/category visible in the storefront to the user's organization or business unit (customer)?

Additionally, there are default visibility settings that may be easily inherited in the above configuration:

* `System Configuration`_ (system-wide)
* `Visibility to All`_ (per product/category).

**Visibility Options**

Generally, these are the available visibility settings:

* *visible* -- Show the product in the catalog on the website.
* *hidden* -- Hide the product from the catalog on the website.
* *config* -- Inherit the visibility defined in the `System Configuration`_ for users of all accounts.
* *product* -- Use the option selected in the `Visibility to All`_ section for the product.
* *category* -- Use the option selected in the `Visibility to All`_ section for the product's category.
* *parent* -- Use the option selected in the `Visibility to All`_ section for the parent master catalog category.
* *customer group* -- Use the option selected in the `Visibility to a Customer Group`_ that the customer is in.

**Visibility Priorities**

 * The website visibility can be configured individually for each website. The visibility configured for a particular website has priority over the default website visibility.

 * The product visibility has priority over the category visibility. If the product is visible, but the category is hidden, the product is still visible.

 * The category visibility has a higher priority than the parent category.

 * The customer group visibility overrides visibility for a customer within the same website.

**Visibility per Website Table**

The following table summarizes visibility options per website:


.. image:: /user/img/products/products/product_visibility/product_visibility.png
   :alt: A table that summarizes visibility options per website

The following schema illustrates all possible fallbacks where the solid lines define the fallbacks set by default.

.. image:: /user/img/products/products/product_visibility/product_visibility_fallbacks.png
   :alt: A schema that illustrates all possible fallbacks

.. note:: Keep in mind that the *config* visibility type sets system-wide visibility for products and categories for existing customers.


Navigation to Visibility Settings
---------------------------------

**In Product**: Navigate to **Products > Products** in the main menu, select a product to customize its visibility, click **More actions** and then **Manage Visibility** on the top right (product menu).

.. image:: /user/img/products/products/product_visibility/ProductManageVisibility.png
   :alt: Navigating to the visibility settings from the product's details page

**In Category**: Navigate to **Products > Master Catalog** in the main menu, select a category on the left, and scroll to the **Visibility** section.

.. image:: /user/img/products/products/product_visibility/CategoryVisibility.png
   :alt: Navigating to the visibility settings from the master catalog category's page

**In System Configuration**: Navigate to **System > Configuration** in the main menu. Select **Commerce > Customer > Visibility** on the left.

.. image:: /user/img/products/products/product_visibility/ConfigVisibility.png
   :alt: Navigating to the visibility settings from the system configuration page

Default Settings
----------------

.. _products--product-visibility--system-configuration:

System Configuration
^^^^^^^^^^^^^^^^^^^^

You can define system-wide visibility for products and categories for existing customers. This setting applies whenever visibility is set to 'config'.

Products and categories are visible by default. To change this, navigate to **System > Configuration > Commerce > Customer > Visibility** in the main menu, clear the **Use default** checkbox, and toggle the options (*hidden*/*shown*).

.. image:: /user/img/products/products/product_visibility/ConfigVisibilityOptions.png
   :alt: View the global visibility settings for products and categories under the system configuration page

Visibility to All
^^^^^^^^^^^^^^^^^

The default visibility for a product or category is configured on the product's **Manage visibility** page and in the **Visibility** section of the category details.

.. image:: /user/img/products/products/product_visibility/ProductVisibilityPage.png
   :alt: View the product Visibility to All settings

The possible options are:

* *(parent) category* -- Inherit configuration from the parent category. It means that the current product visibility settings equal the value defined for the **Visibility to All** field of the parent category.
* *config* -- Inherit settings from the `System Configuration`_.
* *hidden*
* *visible*

These values may be later inherited or enforced for customers and customer groups (For this, their visibility must be set to 'product' or 'category').

Direct Settings
---------------

Visibility to a Customer Group
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can control if the product or category is shown to the customers who are members of a particular customer group. Use one of the following options:

* *product* -- Inherit configuration from the product.
* *category* -- Inherit configuration from the parent category. It means that the current product visibility settings equal the value defined for the **Visibility to Customer Groups** field of the parent category.
* *hidden*
* *visible*

By default, a new customer group inherits the default product visibility from the product or category (depending on where the configuration happens).

.. image:: /user/img/products/products/product_visibility/VisibilityToCustomerGroupsOptions.png
   :alt: View the product Visibility to Customer Groups settings

Visibility to a Customer
^^^^^^^^^^^^^^^^^^^^^^^^

Visibility to the customer supports the same options as `Visibility to a Customer Group`_ and can also inherit the configuration of a customer group (by default).

.. image:: /user/img/products/products/product_visibility/VisibilityToCustomersOptions.png
   :alt: View the product Visibility to Customers settings

Visibility on a Website
^^^^^^^^^^^^^^^^^^^^^^^

You can define whether each product should be visible on a particular website. This might be necessary when a product, for example, requires a special government permit in a particular country. A seller might hide it on the country's local website until the paperwork is complete.

You can switch between websites on the product visibility page and apply the necessary changes.

.. image:: /user/img/products/products/product_visibility/WebsiteProdVisibility.png
   :alt: View the product visibility settings applied individually per website

For new websites, the following default settings apply:

* *Visibility to all* inherits visibility configuration of the product's category.
* *Visibility to customer group* inherits visibility configuration at the product level.
* *Visibility to customer* inherits settings for the customer group.