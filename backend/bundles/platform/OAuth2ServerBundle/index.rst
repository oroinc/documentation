:oro_show_local_toc: true

.. _bundle-docs-platform-oauth2-server-bundle:

.. index::
    single: OAuth; OAuth Server

OroOAuth2ServerBundle
=====================

OroOAuth2ServerBundle provides OAuth 2.0 authorization and resource server capabilities implemented
on top of |thephpleague/oauth2-server| library.

Currently, Client Credentials and Password grants are implemented.

See |OAuth 2.0 Server Client Credentials Grant| and |OAuth 2.0 Client Credentials Grant| for details of the
Client Credentials grant.

See |OAuth 2.0 Server Resource Owner Password Credentials Grant| and |OAuth 2.0 Password Grant| for details on the
Password grant.

.. _bundle-docs-platform-oauth2-server-bundle--configuration:

Configuration
-------------

The default configuration of OroOAuth2ServerBundle is illustrated below:

.. code:: yaml

    oro_oauth2_server:
        authorization_server:

            # The lifetime in seconds of the access token.
            access_token_lifetime: 3600 # 1 hour

            # The lifetime in seconds of the refresh token.
            refresh_token_lifetime: 18144000 # 30 days

            # Determines if refresh token grant is enabled.
            enable_refresh_token: true

            # The full path to the private key file that is used to sign JWT tokens.
            private_key: '%kernel.project_dir%/var/oauth_private.key'

            # The string that is used to encrypt refresh token and authorization token payload.
            # How to generate an encryption key: https://oauth2.thephpleague.com/installation/#string-password
            encryption_key: '%secret%'

            # The configuration of CORS requests
            cors:
                # The amount of seconds the user agent is allowed to cache CORS preflight requests
                preflight_max_age: 600

                # The list of origins that are allowed to send CORS requests
                allow_origins: [] # Example: ['https://foo.com', 'https://bar.com']

        resource_server:

            # The full path to the public key file that is used to verify JWT tokens.
            public_key: '%kernel.project_dir%/var/oauth_public.key'

.. note:: To use OAuth 2.0 authorization, generate the private and public keys and place them into locations specified in the `authorization_server / private_key` and `resource_server / public_key` options. See |Generating public and private keys| for details on how to generate the keys.

.. _bundle-docs-platform-oauth2-server-bundle--manage-applications:

Manage OAuth Applications
-------------------------

See :ref:`Manage OAuth Applications <oauth-applications>` and :ref:`Manage Storefront OAuth Applications <storefront-oauth-app>`.

.. _bundle-docs-platform-oauth2-server-bundle--create-app-via-data-fixtures:

Create OAuth Application via Data Fixtures
------------------------------------------

The OAuth applications can be added using data fixtures. For example:

.. code:: php

    <?php

    namespace Oro\Bundle\OAuth2ServerBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Oro\Bundle\OAuth2ServerBundle\Entity\Client;
    use Oro\Bundle\OAuth2ServerBundle\Entity\Manager\ClientManager;
    use Oro\Bundle\OrganizationBundle\Entity\Organization;
    use Symfony\Component\DependencyInjection\ContainerAwareInterface;
    use Symfony\Component\DependencyInjection\ContainerAwareTrait;

    class LoadOAuthApplication extends AbstractFixture implements ContainerAwareInterface
    {
        use ContainerAwareTrait;

        /**
         * {@inheritdoc}
         */
        public function load(ObjectManager $manager)
        {
            $client = new Client();
            $client->setOrganization($manager->getRepository(Organization::class)->getFirst());
            $client->setName('My Application');
            $client->setGrants(['password']);
            $client->setIdentifier('my_client_id');
            $client->setPlainSecret('my_client_secret');

            $this->container->get(ClientManager::class)->updateClient($client, false);

            $manager->persist($client);
            $manager->flush();
        }
    }

To load data fixtures, use either `oro:migration:data:load` or `oro:platform:update` command.

.. _bundle-docs-platform-oauth2-server-bundle--rest-api:

Using OAuth Authorization in REST API
-------------------------------------

See :ref:`OAuth Authentication in API <web-services-api--authentication--oauth>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
