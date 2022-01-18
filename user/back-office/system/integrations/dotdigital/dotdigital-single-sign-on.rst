:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _user-guide-dotmailer-single-sign-on:

Configure Dotdigital Single Sign-on in the Back-Office
======================================================

|Single sign-on| allows to enter Dotdigital account from within your OroCRM and OroCommerce applications.

To be able to use single sign-on:

1. Obtain a Client ID and a Client Secret Keys from your Dotdigital manager.
2. Enter these credentials during integration configuration (see the :ref:`Configure Dotdigital Integration guide <user-guide-dotmailer-configuration>`).
3. The requested call back URL should be as follows: ``https://{your domain}/dotdigital/oauth/callback``.
4. Navigate to **Marketing > dotdigital > Email Studio** and select the integration you wish to connect to.
5. Click **Connect** to perform OAuth authorization.

Once the connection is established, you will be able to see your Dotdigital account dashboard within Email Studio in Oro application.

With the help of single sign-on, there will be no need of logging into Dotdigital account every time and it will be possible to access it straight from the Oro application.


**Related Articles**

- :ref:`Dotdigital Overview <user-guide-dotmailer-overview>`
- :ref:`Dotdigital Configuration <user-guide-dotmailer-configuration>`
- :ref:`Manage Dotdigital Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Sending Email Campaign via Dotdigital <user-guide-dotmailer-campaign>`
- :ref:`Dotdigital Integration Settings <admin-configuration-dotmailer-integration-settings>`

.. include:: /include/include-links-user.rst
   :start-after: begin
