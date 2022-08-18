:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-hangouts-org:
.. _organization-google-settings:

Configure Google Settings per Organization
==========================================

.. warning:: Google has retired Google Hangouts and associated services, and this integration is no longer supported.

.. note::

    Google Hangouts are configured :ref:`globally <user-guide-hangouts>` and per organization,

    Google Tag Manager is configured :ref:`globally <system-configuration-integrations-google>`, per organization, and :ref:`website <website-google-settings>`.

To configure Google Tag Manager and Hangouts settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > Google Settings** in the menu to the left.
4. In the **Google Tag Manager Settings** section:

    * Clear the **Use System** checkbox.
    * For the **Google Tag Manager** Integration filed, select the :ref:`GTM integration <gtm-ga-4-integration>` you have configured for the application. Click **Save** to display an additional option.
    * For **Data Collection For**, select the Google Analytics type (Universal, GA4, or both) that connects to your GTM account to enable data mapping.

5. In the **Google Hangouts** section, provide the following details:

   * **Enable For Emails** --- Check the box to enable Google Hangouts for emails.
   * **Enable For Phones** --- Check the box to enable Google Hangouts for phones.

By default, **Enable For Emails** and **Enable For Phones** are enabled.

6. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin