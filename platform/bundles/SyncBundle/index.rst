.. _bundle-docs-platform-sync-bundle:

OroSyncBundle
=============

OroSyncBundle uses GosWebSocketBundle to enable real-time websocket notifications between an Oro application server and users' browsers.

Out-of-the-box, OroSyncBundle triggers flash notifications about the outdated content if several users try to edit the same entity record simultaneously. It also sends flash notifications to all application site visitors once a developer turns on the system maintenance mode by a console's CLI tool.

Related Documentation
---------------------

* `Usage and Logging Levels <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SyncBundle#orosyncbundle>`__
* `Regular and Secure Connections Configuration <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Resources/doc/configuration.md#configuration>`__
* `Websocket Client <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Resources/doc/client.md#client>`__
* `Topics and Handlers <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Resources/doc/topics-handlers.md#topics-and-handlers>`__
* `Authentication <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Resources/doc/authentication.md>`__
* `Content Outdating Notifications (Frontend and Backend Implementation <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Resources/doc/content-outdating.md>`__
* `Origin Checking <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SyncBundle/Resources/doc/origin-checking.md>`__
* `Mediator Handlers <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SyncBundle/Resources/doc/mediator-handlers.md>`__