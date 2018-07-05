.. _user-guide--customer-groups:

Customer Groups
===============

.. contents:: :local:

In the Customer Group section, you can organize customers into groups and share the price lists, payment and tax-related settings between several customers.

.. image:: /user_guide/img/customers/customer_groups/CustomerGroups.png
   :class: with-border

.. _user-guide--customer-groups--create:

Create a Customer Group
-----------------------

.. note::
    See a short demo on `how to create customer groups in OroCommerce <https://www.oroinc.com/orocommerce/media-library/create-customer-groups>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/DbyVljBIHbA" frameborder="0" allowfullscreen></iframe>

To create a new customer group:

#. Navigate to **Customers > Customer Groups** in the main menu.

#. Click **Create Customer Group**.

   The following page opens:

   .. image:: /user_guide/img/customers/customer_groups/CustomerGroupsCreate.png
      :class: with-border

#. Fill in the customer **Name**.

#. Select **Tax Code** that will label the customer group taxation schema.

#. In the *Additional* section, select a Payment term to be used as a payment option available to the customer users during on the checkout.

#. In the *Customers* section, check the customers to add them to the customer group. 

#. In the **Price Lists** section as described in the `pricelist management <./customer-groups/pricelist>`_ section.

#. Click **Save** in the top right corner of the page.

A new Customer Group is created.

View and Filter Customer Groups
-------------------------------

To view all Customer Groups, navigate to **Customers > Customer Groups** in the main menu.


.. image:: /user_guide/img/customers/customer_groups/CustomerGroups.png
   :class: with-border


You can perform the following actions with every item in the Customers list:
   
  * `View a Customer Group details <view>`_: Click on the item to open its details page. Alternatively, hover over the |IcMore| **More Options** menu to the right of the item and click the |IcView| to open its details page.

 * `Edit a Customer Group details <edit>`_: Hover over the |IcMore| **More Options** menu to the right of the item and click the |IcEdit| to start editing its details.

.. _user-guide--customers--customer-groups--pricelist:

Manage Price Lists for a Customer Group
---------------------------------------

To configure the price list priority and controlled merge for the customer group:

#. Navigate to **Customers > Customer Groups** in the main menu.

#. Find the necessary Customer Group in the list, hover over the |IcMore| **More Options** menu in the line and click the |IcEdit| to start editing the customer group details.

#. In the **Price Lists** section, you can build an aggregated price list for every website you have configured in OroCommerce. Use tabs to switch between the websites, e.g. Default, US, Australia, etc. in the example below.

   .. image:: /user_guide/img/customers/customer_groups/CustomerGroupsPrices.png
      :class: with-border

   To form an aggregated price list:

     #) Set up the fallback option to provide the price source if the price is not available in the directly configured price lists.

     #) Select the price list to enable it for the customer group.

        .. note:: You can add more than one price list:

                  * Click **+ Add Price List**.
                  * Select the additional price list from the list.
                  * Set the numeric priority. OroCommerce searches for the product price in the higher priority price lists first.
                  * Enable price lists merge, if necessary. When the merge is enabled, the unit prices may be merged from the lower priority price lists, when they are missing in the higher priority ones.

#. Click **Save** once you are happy with the price list set up.


.. include:: /img/buttons/include_images.rst
   :start-after: begin


