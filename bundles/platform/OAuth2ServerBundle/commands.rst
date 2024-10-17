.. _bundle-docs-platform-oauth2-server-bundle-commands:

CLI Commands (OAuth2ServerBundle)
==================================

oro:oauth-server:generate-keys
-------------------------------

Generates private and public RSA keys required for proper work of the OAuth2 server. The generated keys are put into the project directory as `var/oauth_private.key` and `var/oauth_public.key`, unless other paths are specified in the bundle configuration.

.. warning::  In order to ensure the generated keys could be used locally - they have permissions wider than needed - `0644`. For production deployment, ensure that only the web server has read and write permissions for the private key.

.. code-block:: bash

   php bin/console oro:oauth-server:generate-keys

.. note:: You can customize the permissions being assigned to RSA keys via ``setPrivateKeyPermission`` setter in ``\Oro\Bundle\OAuth2ServerBundle\Command\GenerateKeysCommand``.

oro:cron:oauth-server:cleanup
-----------------------------

Removes outdated OAuth 2.0 access tokens, refresh tokens and auth codes. It also removes OAuth 2.0 applications that belong to removed users. Runs daily at midnight via cron.

.. code-block:: bash

   php bin/console oro:cron:oauth-server:cleanup

oro:cron:oauth-server:check-keys-permissions
--------------------------------------------

Checks if OAuth 2.0 private key permissions are secure and creates an `alert notification <dev-integrations-notification-alerts>` if private key can be accessed by someone except an owner. Runs daily at midnight via cron.

.. code-block:: bash

   php bin/console oro:cron:oauth-server:check-keys-permissions
