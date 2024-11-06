.. _user-guide--customer-groups:

Manage Customer Groups in the Back-Office
=========================================

.. hint:: This section is part of the :ref:`Customer Management <concept-guide-customers>` topic that provides a general understanding of accounts, contacts, customers and customer hierarchy available in Oro applications.

In the Customer Group section, you can organize customers into groups and share the price lists, payment and tax-related settings between several customers.

On a customer group details page, you can:

* |IcConfig| **Edit Storefront Menu**
* |IcConfig| **Configure** customer group settings.
* |IcEdit| **Edit** customer group details.
* |IcDelete| **Delete** existing customer groups.
* **Add a note**
* **Create a new customer**. Alternatively, use a quick action button under the **Customers** menu to create a new customer directly from the customer group page. The form for data input can be displayed in a new browser tab, a popup dialog window, or replace the current page, :ref:`depending on its system configuration <doc-configuration-display-settings-quick-actions>`.

.. image:: /user/img/customers/customer_groups/quick-buttons-customer-group.png
   :alt: Displaying the quick action buttons on the customer group view page

.. _user-guide--customer-groups--create:

Create a Customer Group
-----------------------

.. note::
    See a short demo on |how to create customer groups in OroCommerce|, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/DbyVljBIHbA" frameborder="0" allowfullscreen></iframe>

To create a new customer group:

#. Navigate to **Customers > Customer Groups** in the main menu.

#. Click **Create Customer Group**.

#. Fill in the customer **Name**.

#. Select **Tax Code** that will label the customer group taxation schema.

#. In the **Additional** section, select a Payment term to be used as a payment option available to the customer users during the checkout.

#. In the **Customers** section, check the customers to add them to the customer group.

#. In the **Price Lists** section, add the price lists and configure the fallback option, as described in the :ref:`Price List Management for a Customer Group <user-guide--customers--customer-groups--pricelist>` section.

#. Click **Save** in the top right corner.

.. _user-guide--customers--customer-groups--pricelist:

Manage Price Lists for a Customer Group
---------------------------------------

To configure the price list priority and controlled merge for the customer group:

#. Navigate to **Customers > Customer Groups** in the main menu.

#. Find the necessary customer group in the list, hover over the |IcMore| **More Options** menu in the line and click  |IcEdit| to start editing the customer group details.

#. In the **Price Lists** section, you can build an aggregated price list for every website you have configured in OroCommerce. Use tabs to switch between the websites, e.g., Default, US, Australia, etc. in the example below.

   .. image:: /user/img/customers/customer_groups/CustomerGroupsPrices.png
      :alt: Choose a price list for the selected website

   To form an aggregated price list:

     #) Set up the fallback option to provide the price source if the price is not available in the directly configured price lists.

     #) Select the price list to enable it for the customer group.

        .. note:: You can add more than one price list:

                  * Click **+ Add Price List**.
                  * Select the additional price list from the list.
                  * Set the numeric priority. OroCommerce searches for the product price in the higher priority price lists first.
                  * Enable price lists merge, if necessary. When the merge is enabled, the unit prices may be merged from the lower priority price lists, when they are missing in the higher priority ones.

#. Click **Save** once you are happy with the price list set up.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1

   customer-group-price-lists
   customer-group-all-products-menus
   customer-group-frontend-menus
   customer-group-configuration/index
