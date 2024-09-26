.. _system--website--configuration--commerce--customers--interactions:


Configure Interactions Settings per Website
===========================================

Interactions can be configured :ref:`globally <configuration--guide--commerce--configuration--interactions>`, :ref:`per organization <sys--conf--commerce--customer--interactions-organization>`, and per website.

The Interactions settings allow you to interact with your customer users, providing the option to display the *Contact Us* form in the storefront, and manage user consents, ensuring a smooth and compliant user experience.

To configure the interactions settings per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Customer > Interactions** in the menu on the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/ContactUsWeb.png


.. _admin--guide--commerce--configuration--customers--consents--enable--website:

Enable Consents Settings per Website
------------------------------------

You can enable consents per website if :ref:`consents have been enabled globally <admin--guide--commerce--configuration--customers--consents--enable--globally>`.

1. Clear the **Use Organization** checkbox under the **Enabled User Consents** field.
2. Click **Add Consent** and select the consent from the list.

   Alternatively, click on the hamburger menu and select the consent from its list.

3. If more than one consent is added to the **Enabled Consents** list, you can drag and drop them to set the order in which these consents will be displayed in the storefront.

   .. note:: Keep in mind that on the website level you can add only those consents that have been created on the global level. You cannot create new consents on the website level.

4. To delete a consent from the list of enabled consents, click **x** next to it.
5. Click **Save Settings** on the top right.

.. _sys--conf--commerce--customer--contact-request-website:

Configure Contact Requests Settings per Website
-----------------------------------------------

To enable or disable the display of the **Contact Us** form in the storefront per website:

1. Clear the **Use Organization** checkbox to adjust the settings set on the organization level.
2. In **Contact Requests**, toggle the **Allow Contact Requests** checkbox to enable or disable the **Contact Us** form in the storefront.
3. If the form is disabled, you can still use the :ref:`Contact Us widget <user-guide--landing-pages-create>` in your web catalog pages.
4. Click **Save Settings**.


**Related Topics**

* :ref:`Data Protection and Consent Management <user-guide--consents>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Enable Consents Globally <admin--guide--commerce--configuration--customers--consents--enable--globally>`



.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin
