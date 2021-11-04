:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-integrations-google:

Configure Global Google Settings
================================

All Oro application editions support the integration with Google. With its help, you can configure Google single sign-on to enable users with the same Google account email address and OroCRM/Commerce primary email address to log in only once in a session. Additionally, you can configure OAuth2 with Google for email synchronization, set up Google Hangouts calls, and configure Google Tag Manager settings.

.. note::

    * Google integration settings can be configured globally,

    * Google Hangouts are configured globally and :ref:`per organization <user-guide-hangouts-org>`,

    * Google Tag Manager is configured globally, :ref:`per organization <user-guide-hangouts-org>`, and :ref:`website <website-google-settings>`.

To configure Google settings on the system level:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Google Settings**.

.. image:: /user/img/system/config_system/google_settings_new.jpg
   :alt: Global Google settings

Click the relevant topic below to start configuring the required setting:

* :ref:`Configure Google Integration Settings <system-configuration-integrations-google>`
* :ref:`Configure Google Single Sign On <user-guide-google-single-sign-on>`
* :ref:`Set Up Voice and Video Calls via Hangouts <user-guide-hangouts>`
* :ref:`Configure Google Tag Manager Integration <gtm-integration>`


.. include:: /include/include-links-user.rst
   :start-after: begin


.. toctree::
   :hidden:

   Google Integration <google-integration>
   Google Single Sign On <google-single-sign-on>
   Google Hangouts <hangouts>


