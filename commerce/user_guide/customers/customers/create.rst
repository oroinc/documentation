.. _user-guide--customers--customers--create:

.. begin

Create a Customer
~~~~~~~~~~~~~~~~~

.. note::
    See a short demo on `how to create customers in OroCommerce <https://www.orocommerce.com/media-library/create-customer-record>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/iLphaHiU8YY" frameborder="0" allowfullscreen></iframe>

To create a new customer:

#. Navigate to **Customers > Customers** in the main menu.

#. Click **Create Customer**.

   The following page opens:

   .. image:: /user_guide/img/customers/customers/CustomersCreate.png
      :class: with-border

#. *Optionally*, select an existing `account <https://www.orocrm.com/documentation/current/user-guide/customer-management/common-features-accounts>`_ to help tracking sales actions and metrics for the customer that is a member of bigger customer organization. When remains empty, the new account is created for the new customer automatically.

#. Fill in the customer **Name**.
   
#. Optionally, add a customer to a customer group if you already have a group with the settings and configuration that fits the new customer.

#. If you are adding a subsidiary of the existing customer, select Parent Customer.

#. Assign a sales representative who will be assisting customer users.

#. Select **Tax Code** that will label the customer group taxation schema.

#. Add a billing and shipping address as described in `the address book <./../getting-started/common-actions/manage-address-book>`_ section.

#. In the *Additional* section, select a Payment term to be used as a payment option available to the customer users during on the checkout.

#. In the **Price Lists** section, add pricelists and prioritize them as described in `Price List Management for a Customer Group <./customer-groups/pricelist>`_ section.

#. When OroCommerce is deployed with InfinitePay payments support, the customer's VAT Id shall be captured for their credit worthiness verification. VAT Id should be valid and the billing address should match the one provided for the VAT registration. These are prere   uisites to enable payments via :ref:`InfinitePay <user-guide--payment--prerequisites--infinitepay>` for the customer users.

#. Click **Save** in the top right right corner of the page.

A new customer is created.

.. stop
