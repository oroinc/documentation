:oro_documentation_types: OroCRM, OroCommerce

.. _system-configuration-integrations-google:
.. _admin-configuration-integrations-google-gmail-oauth:

Configure Google Integration Settings in the Back-Office
========================================================

To configure Google integration-related settings in the back-office:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Google Settings**.

.. image:: /user/img/system/config_system/google-integration-settings.png
   :alt: Global Google Integration settings

3. Before you begin, check out the |instructions on obtaining credentials on the Google side|. Make sure that your Oro domain is included into `Authorized JavaScript origins` and `Authorized redirect URIs`.

4. In the **Google Integration Settings** section, provide the following details:

    * **Client ID** --- The Client ID generated in the API console.
    * **Client Secret** --- The Client Secret generated in the API console.
    * **Google API Key** --- The API Key generated in the API console. Provide a valid |Google API key| to activate maps for addresses in the system.
    * **Redirect URI** --- **READ-ONLY** field, the value is auto-generated and should be added to the **Authorized Redirect URIs** configuration as described in the :ref:`Configure Google Single Sign-On <user-guide-google-single-sign-on>` section (Configure Consent Form > step 7).

5. In the **OAuth 2.0 for email sync** section, check **Enable** to activate synchronization with emails. Please, make sure that Gmail API is enabled in |Google Developers Console|.

6. In the **Google Tag Manager Settings** section, clear the **Use Default** checkbox and select a :ref:`Google Tag Manager Integration <gtm-ga-4-integration>` from the list to configure it for the application and enable data mapping.

.. note:: You can enable cross-domain tracking to be able to track user interactions across multiple domains using a single GA4 property. See the |Implement Cross-Domain Measurement| article on the Google website for more information.

**Related Topics**

* :ref:`Configure Global Google Settings <admin-configuration-integrations-google>`
* :ref:`Configure Google Single Sign On <user-guide-google-single-sign-on>`
* :ref:`Configure Google Tag Manager Integration <gtm-ga-4-integration>`

.. include:: /include/include-links-user.rst
   :start-after: begin
