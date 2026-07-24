.. _backend-session-storage:

Session Storage
===============

By default, the Oro application is configured to store |sessions| in files. If multiple servers serve your application, you must use a database to make sessions work across different servers. The recommended database
for best performance is |Redis|. See :ref:`Configure Redis Servers <bundle-docs-platform-redis-bundle--configure-servers>`
for more details.

Session Locking Impact on Application Availability
--------------------------------------------------

The Oro application requires shared session storage in any distributed environment (more than one web node). By default, |session data is locked| to prevent race conditions and ensure data consistency.

This works well for consecutive requests (classic web browsing), but causes problems when multiple parallel requests run within the same session. A common B2B case is real-time price and inventory checks against a back-end ERP, which may respond slowly. To keep these checks from blocking the interface, they typically run in parallel over AJAX.

In production, this can critically affect availability: each parallel request hits the session lock and queues behind the others. With many concurrent users generating dozens of such requests, ERP performance directly limits Oro availability --- and a slow ERP can overflow the request queue.

There are a few options to overcome availability issues for this kind of scenario:

* **snc_redis.session.locking** parameter can be set to **false** to disable session lock. This approach is not recommended as it may cause session data race condition.

* Use stateless endpoint without session initialization. Such an approach has a significant downside as it will allow accessing data without authentication stored in the session.

* Close the session before accessing any 3rd party system (recommended approach):

  .. code-block:: php

      public function myAction(Request $request)
      {
          $session = $request->getSession();
          if (null !== $session && $session->isStarted()) {
              $session->save();
          }

          // do controller work here
      }


.. include:: /include/include-links-dev.rst
   :start-after: begin