:oro_show_local_toc: false

.. _bundle-docs-platform-test-framework-bundle:

OroTestFrameworkBundle
======================

OroTestFrameworkBundle uses Mink, Behat, Karma, Jasmin and other testing tools to provide the testing framework for all Oro application components. Its main functions:

* Provides the test framework functionality (SOAP/REST client, Custom TestCases, PageObjects for Selenium etc)
* Contains the main entry point for the JS UnitTest runner
* Provides the Behat extension
* Adds additional Doctrine DBAL events

Related Documentation
---------------------

* :ref:`JavaScript UnitTests <dev-doc-frontend-javascript-unit-tests>`
* :ref:`Oro Behat Extension <behat-tests>`
* :ref:`Additional Doctrine Events <bundle-docs-platform-test-framework-doctrine-events>`


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. toctree::
   :hidden:

   doctrine-events