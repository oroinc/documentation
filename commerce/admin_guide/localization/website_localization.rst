.. _sys--websites--sysconfig--general-setup--localization:

Customize Localization Settings per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

To define the custom localization options for a particular website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page is displayed:

   .. image:: /admin_guide/img/localization/localization_configuration_website.png
      :alt: Localization configuration options per website

4. In the **Localization Settings**, provide:

   * **Default Localization** --- The default language of the management console and storefront UI for the current website. The list of available languages depends on the localizations added to the **Enabled Localizations** list on the global level.
   * **Enabled Localizations** --- The list of localizations is generated automatically based on the data preconfigured in the **System > Localization > Localizations** menu.

     All supported localizations added to this list are displayed in the language switcher in the storefront.

     .. image:: /admin_guide/img/localization/language_switcher_storefront.png
        :alt: Language switcher in the storefront

     In addition, they determine the languages available for the email notifications. If there is an email template for the supported language, the users who have selected that specific language on the storefront, receive localized notifications.

     .. image:: /admin_guide/img/localization/language_tabs_email_template.png
        :alt: Language tabs in email templates


.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin