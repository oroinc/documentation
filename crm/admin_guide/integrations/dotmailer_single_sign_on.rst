.. _user-guide-dotmailer-single-sign-on:

Configure Single Sign-on
========================

`Single sign-on <https://developer.dotmailer.com/docs/using-oauth-20-with-dotmailer>`__ allows to enter dotmailer account from within OroCRM.

To be able to use single sign-on:

 1. Obtain a Client ID and a Client Secret Keys from your dotmailer manager.
 2. Enter these credentials during integration configuration (see the :ref:`Configure dotmailer Integration guide <user-guide-dotmailer-configuration>`).
 3. The requested call back URL should be as follows: https:// {your domain}/dotmailer/oauth/callback.
 4. Navigate to **Marketing>dotmailer>Email Studio** and select the integration you wish to connect to.
 5. Click :guilabel:`Connect` to perform OAuth authorization.

Once the connection is established, you will be able to see your dotmailer account dashboard within Email Studio in OroCRM.

With the help of single sign-on, there will be no need of logging into dotmailer account every time and it will be possible to access it straight from the OroCRM application.

|

.. image:: ../img/dotmailer_email_campaign/sign_on.png

|

Related articles
----------------

- :ref:`Dotmailer Overview <user-guide-dotmailer-overview>`
- :ref:`Dotmailer Configuration <user-guide-dotmailer-configuration>`
- :ref:`Manage Dotmailer Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Sending Email Campaign via Dotmailer <user-guide-dotmailer-campaign>`
- :ref:`Dotmailer Integration Settings <admin-configuration-dotmailer-integration-settings>`
