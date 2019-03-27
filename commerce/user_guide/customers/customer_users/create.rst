Create a Customer User
~~~~~~~~~~~~~~~~~~~~~~

To create a new customer:

#. Navigate to **Customers > Customer Users** in the main menu.

#. Click **Create Customer User**.

   The following page opens:

   .. image:: /user_guide/img/customers/customer_users/CustomerUsersCreate.png
      :class: with-border

#. Select the **Enabled** check box to enable the user to log into the system and to do their work within it upon creation.

#. Fill in customer **Name** and other personal information.

#. Select a customer this user represents.

#. If you are adding a subsidiary of the existing customer, select a parent customer.

#. Assign a sales representative who will be assisting this customer user. By default, the customer sales representative applies to the customer user.

#. Select the **Generate Password** and **Send Welcome Email** check boxes.

#. Select the website the customer user will be redirected to upon the login. See :ref:`Managing Websites <user-guide--system-websites>` for more information.

#. Select a **Preferred Localization** for the customer user. This field is displayed if more than one :ref:`localization <sys--config--sysconfig--general-setup--localization>` is enabled for any of the websites of the current organization. If you change the website for the customer user, you will need to select a new preferred localization.

#. Add billing and shipping address as described in `:ref: the Address Book section <user-guide--getting-started--address-book>`.

#. In the **Roles** section, select the roles that should apply to the customer user. When several roles are selected, granted permissions are accumulated from all the assigned roles. See :ref:`Managing Customer User Roles <user-guide--customers--customer-user-roles>` for more information.

   .. important:: At least one role must be assigned if the **Enabled** check box is selected. Disabled customer users can be saved without roles, but you will need to assign roles to the them later before enabling.

#. Click **Save** on the top right of the page.

The new customer user is created.

.. stop
