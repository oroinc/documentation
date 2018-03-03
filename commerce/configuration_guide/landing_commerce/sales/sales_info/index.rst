.. _sys--conf--commerce--sales--contacts:

Configure Sales Representative Information
==========================================


To provide customers with the contact information of their primary assigned sales representative, enable the display of the sales rep contact information in the Oro application storefront :ref:`footer links <frontstore-guide--navigation-footer>`.

Contact information can be configured on four levels: globally, per organization, per website, per user. Website settings override organization, organization settings override system and user settings may (sometimes) override all other settings, depending on configuration. In these cases, either customer owner or customer user owner may be used as a :ref:`user settings <sys--conf--commerce--sales--contacts-user>` source.

Based on the level where configuration has taken place, settings can fall back to other levels following the pattern below:

* User settings can fall back either to system or organization settings.
* Website settings can fall back to the system settings.
* Organization settings can fall back to the system settings.

.. image:: /configuration_guide/img/configuration/sales/contacts/FallBackOptions.png


However:

* When **Use System** check box is enabled, system settings override website or organization.
* When **Use Organization** check box is enabled, organization settings override system.

With this in mind, we will have a look at how sales representative information is configured at each level.


.. contents:: :local:
   :depth: 2

Configure Sales Rep Information Globally
----------------------------------------

.. include:: /configuration_guide/landing_commerce/sales/sales_info/sales_info_global.rst
   :start-after: begin_body
   :end-before: finish_body

Configure Sales Rep Information per Organization
------------------------------------------------

.. include:: /configuration_guide/landing_commerce/sales/sales_info/sales_info_organization.rst
  :start-after: begin
  :end-before: finish

Configure Sales Rep Information per Website
-------------------------------------------

.. include:: /configuration_guide/landing_commerce/sales/sales_info/sales_info_website.rst
  :start-after: begin
  :end-before: finish

Configure Sales Rep Information per User
----------------------------------------

.. include:: /configuration_guide/landing_commerce/sales/sales_info/sales_info_user.rst
  :start-after: begin
  :end-before: finish

.. _sys--conf--commerce--sales--contacts--sample:

Configuration Sample 
--------------------

The following configuration example is provided for illustration.

As an administrator, you were asked to set up the ability for a customer sales representative John Doe to provide contact information for non-authenticated and logged in customer users. 

To set up information for non-authenticated visitors:

1. Navigate to **System > Configuration > Commerce > Sales > Contacts**.
2. In the Display list, select **Customer User Owner**.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Enable **Allow User Configuration** check box, and select all three available user options from the list.

4. In **Guest Contact** text field, provide text for non-authenticated users, e.g.:
   
   *Please login to get your sales rep
   information, or contact sales@acme.com*

   .. image:: /configuration_guide/img/configuration/sales/contacts/UseCase1.png

5. Save the settings.

   This information should become available on the website for non-authenticated users.

   .. image:: /configuration_guide/img/configuration/sales/contacts/FrontSalesRepInfoNonAuth.png

To set information for logged in users, you need to make sure that in the system configuration, the settings allow John Doe as a customer user owner to enter his contact information manually in his user configuration.
   
This would allow John Doe to:

1. Navigate to **My User > My Configuration > Commerce > Sales > Contacts**. 
2. Select **Enter Manually** in the **Customer Visible Contact Info** field.
3. Provide contact details in **Enter Contact Info**, e.g.
   
   *John Doe, ACME 
   (800) 555-0100
   (800) 555-0199
   john.doe@example.com*


   .. image:: /configuration_guide/img/configuration/sales/contacts/UseCase2.png

4. Click **Save Settings**

The information should become available on the website.

.. image:: /configuration_guide/img/configuration/sales/contacts/FrontSalesRepInfoLoggedIn.png

.. toctree::
   :hidden:

   sales_info_global
   sales_info_organization
   sales_info_website
   sales_info_user
   available_user_options
   display_details
   

.. include:: /user_guide/include_images.rst
   :start-after: begin
