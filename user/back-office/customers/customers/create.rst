:oro_documentation_types: OroCommerce

.. _user-guide--customers--customers--create:

Create a Customer
=================

.. note::
    See a short demo on |how to create customers in OroCommerce|, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/iLphaHiU8YY" frameborder="0" allowfullscreen></iframe>

To create a new customer:

#. Navigate to **Customers > Customers** in the main menu.

#. Click **Create Customer**.

   .. image:: /user/img/customers/customers/CustomersCreate.png
      :alt: An empty form is displayed when creating a new customer

#. Optionally, select an existing :ref:`account <user-guide-accounts>` to help track sales actions and metrics for the customer that is a member of the bigger customer organization. When it remains empty, the new account is created for the new customer automatically.

#. Fill in the customer **Name**.

#. Optionally, add a customer to a customer group if you already have a group with the settings and configuration that fits the new customer.

#. If you are adding a subsidiary of the existing customer, select **Parent Customer**.

#. Assign a sales representative who will be assisting customer users.

#. Select **Tax Code** to label the customer group taxation schema.

#. Add a billing and shipping address as described in :ref:`the address book <user-guide--getting-started--address-book>` section.

#. In the **Additional** section, select a Payment term to be used as a payment option available to the customer users during the checkout.

#. In the **Price Lists** section, add pricelists and prioritize them as described in the :ref:`Price List Management for a Customer Group <user-guide--customers--customer-groups--pricelist>` section.

#. When OroCommerce is deployed with InfinitePay payments support, the customer's VAT Id shall be captured for their creditworthiness verification. VAT Id should be valid, and the billing address should match the one provided for the VAT registration. These are prerequisites to enable payments via :ref:`InfinitePay <user-guide--payment--prerequisites--infinitepay>` for the customer users.

#. Click **Save** in the top right.

.. note:: Keep in mind that customers with at least one successful registered checkout cannot be deleted from the system.

   .. image:: /user/img/customers/customers/unable_to_delete_customers.png
      :alt: A note appears when deleting a customer warning that no entities can be deleted

.. include:: /include/include-links-user.rst
   :start-after: begin

