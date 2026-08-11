.. _backend-session-storage:

Session Storage
===============

By default, the Oro application stores |sessions| in files. When more than one server serves your application, you must use a shared database so sessions work across servers. |Redis| is the recommended database for best performance. See :ref:`Configure Redis Servers <bundle-docs-platform-redis-bundle--configure-servers>` for details.

Session Locking Impact on Application Availability
--------------------------------------------------

The Oro application requires shared session storage in any distributed environment (more than one web node). By default, |session data is locked| to prevent race conditions and ensure data consistency.

This works well for consecutive requests (classic web browsing), but causes problems when multiple parallel requests run within the same session. A common B2B case is real-time price and inventory checks against a back-end ERP, which may respond slowly. To keep these checks from blocking the interface, they typically run in parallel over AJAX.

In production, this can critically affect availability: each parallel request hits the session lock and queues behind the others. With many concurrent users generating dozens of such requests, ERP performance directly limits Oro availability --- and a slow ERP can overflow the request queue.

You can overcome these availability issues in a few ways:

* Use a stateless endpoint without session initialization. This has a significant downside: it allows access to data without the authentication stored in the session.

* Close the session before accessing any third-party system (recommended approach):

  .. code-block:: php

      public function myAction(Request $request)
      {
          $session = $request->getSession();
          if ($session->isStarted()) {
              $session->save();
          }

          // do controller work here
      }


.. include:: /include/include-links-dev.rst
   :start-after: begin
