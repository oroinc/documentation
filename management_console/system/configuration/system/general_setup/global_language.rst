.. _sys--config--sysconfig--general-setup--language-settings:

Language Settings
=================

.. begin 1

In the system configuration, you can set up the language of the UI elements to be displayed in the management console and the supported languages for the email notifications for the users. If there is an email template for the supported language, the users who have selected that specific language on the storefront, receive localized notifications.

.. hint:: Language settings are available on three levels: globally, :ref:`per organization <sys--config--sysconfig--general-setup--language-settings--organization>`, and :ref:`per user <user-language-settings>`.

To define the default system language and supported languages for email notifications:

1. Navigate to the language settings:

   a) Click **System > Configuration** in the main menu.
   #) In the **System Configuration** menu to the left, expand **General Setup** and click **Language Settings**.

      .. note::
           For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.


      .. image:: /img/system/config_system/language_configuration_global.png

2. Select one or multiple supported languages from the list that can be used for translation of the Oro application management console content (e.g. email notifications). Make sure to enable the corresponding languages in the **System > Localization > Languages** menu to make them available in the list. Refer to the :ref:`Languages <localization--languages>` section for more details.

3. Clear the **Use Default** check box and select the default language for the UI elements displayed in the management console.

4. Click **Save Settings** to save the settings.


.. include:: /img/buttons/include_images.rst
    :start-after: begin