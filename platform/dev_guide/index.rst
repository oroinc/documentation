.. _dev-guide:

Developer Guide
===============

The Developer Guide is targeted at full-stack PHP developers and contains information about Oro applications architecture and guidance on customization and extension of the existing features in Oro applications.

The guide groups reference information on all OroPlatform features, describing and illustrating them in the following area-specific categories:

* :ref:`Development Practice <dev-guide-development-practice>`:

* :ref:`Application Framework <dev-guide-application-web-framework>`: Describes the functionality, which determines the application structure and how different application segments interact with each other.

* :ref:`Translations and Localization <dev-translation>`: Describes the ways of translating content (text) in Oro applications.

* :ref:`System Components <dev-guide-system>`: Describes components that ensure interaction between a PHP application and external systems (file system, databases, etc.)
   * :doc:`/dev_guide/system/websockets/index`
   * :doc:`/dev_guide/system/cron_jobs/index`
   * :doc:`/dev_guide/system/message_queue/index`

.. * Entity Management:
.. * Entity Features:
.. * Integrations:
.. * User Management:
.. * Localizations:
.. * Admin UI:

.. * :ref:`Front UI <dev-guide-front-ui>`: Describes components on which are built a Front UI of the OroPlatform derivative applications.
   * :ref:`Layouts <dev-guide-layouts>`: The system for building theamable front public UI (like storefronts) in OroPlatform based applications.

If you have searched for an answer with no luck, we can help you with your technical issues via our community slack channel and forums:

* `OroPlatform Forums <https://oroinc.com/oroplatform/forums>`_
* `Oro Community Slack Channel <https://orocommunity.slack.com/>`_

.. toctree::
   :titlesonly:
   :hidden:
   :maxdepth: 2

   dev_practice/index
   web_framework/index
   system/index
   translations/index

..    application/index
..    entity_management/index
..    entity_features/index
..    integrations/index
..    user_management/index
..    localizations/index
..    ui/index
