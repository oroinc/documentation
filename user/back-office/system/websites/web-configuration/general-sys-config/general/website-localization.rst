:oro_documentation_types: OroCommerce

.. _sys--websites--sysconfig--general-setup--localization:

Configure Localization Settings per Website
===========================================

To define the custom localization options for the particular website:

1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/localization_configuration_website.png

4. Clear the **Use Organization** check box to change the default options, and provide new values.

5. Select one or multiple enabled localizations for the website from the list to support the translation of the storefront UI elements to the target language.

6. Select the default localization for the storefront of the website.

7. Enable the **Automatically Switch Localization Based on URL** option to automatically switch the customer user's initial localization to the target localization of the URL page they visit (available since OroCommerce v4.2.14). This way, if a German-localized storefront user visits a French-localized URL, the user's localization will automatically be changed to the French localization matching the URL.

8. Click **Save** to the save the settings.

.. include:: /include/include-images.rst
   :start-after: begin