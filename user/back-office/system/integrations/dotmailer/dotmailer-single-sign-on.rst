:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-dotmailer-single-sign-on:

Configure Single Sign-on
========================

|Single sign-on| allows to enter dotmailer account from within your OroCRM and OroCommerce applications.

To be able to use single sign-on:

1. Obtain a Client ID and a Client Secret Keys from your dotmailer manager.
2. Enter these credentials during integration configuration (see the :ref:`Configure dotmailer Integration guide <user-guide-dotmailer-configuration>`).
3. The requested call back URL should be as follows: ``https://{your domain}/dotmailer/oauth/callback``.
4. Navigate to **Marketing > dotmailer > Email Studio** and select the integration you wish to connect to.
5. Click **Connect** to perform OAuth authorization.

Once the connection is established, you will be able to see your dotmailer account dashboard within Email Studio in Oro application.

With the help of single sign-on, there will be no need of logging into dotmailer account every time and it will be possible to access it straight from the Oro application.


Related articles
----------------

- :ref:`dotmailer Overview <user-guide-dotmailer-overview>`
- :ref:`dotmailer Configuration <user-guide-dotmailer-configuration>`
- :ref:`Manage dotmailer Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Sending Email Campaign via dotmailer <user-guide-dotmailer-campaign>`
- :ref:`dotmailer Integration Settings <admin-configuration-dotmailer-integration-settings>`

.. include:: /include/include-links.rst
   :start-after: begin
