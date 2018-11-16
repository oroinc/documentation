
.. _silent-installation:

.. begin_silent_installation_via_console

Silent Installation
===================

For silent installation, use -n (no interaction) and -q (silence the output messages) parameters, and set the required parameters value, like in the example below. Replace items in bold with the information specific to your deployment.

.. code-block:: bash

	php -dxcache.cacher=0 bin/console oro:install
	        --application-url=**<URL that is configured as an entry point for Oro application>**
	        --env=prod
	        --user-name=**admin**
	        --user-email=**admin@example.com**
	        --user-firstname=**John**
	        --user-lastname=**Doe**
	        --user-password=**admin**
	        --sample-data=**y**
	        --organization-name="**Acme, Inc**"
	        --timeout=10000

.. note:: Use *--sample-data=y* only for learning purposes, test deployments and pre-production deployments. In this mode, OroPlatform is populated with sample data that help you unlock all the features so that you can quickly test the system after re-configuration or customization.

.. note:: The installation process terminates with the warning if the environment does not meet any of the system requirements. You can try relaunching installation after you fix the reported issue(s).

If any problem occurs, you can see the details in ``var/logs/oro_install.log`` file.

.. hint:: Normally, the installation process is terminated if it detects an already-existing installation.

.. hint:: After the installation finished remember to run ``php bin/console oro:api:doc:cache:clear`` to warm-up the API documentation cache. This process may take several minutes.

.. finish_silent_installation_via_console
