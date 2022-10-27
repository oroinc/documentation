.. _backend-session-storage:

Session Storage
===============

By default, the Oro application is configured to store |sessions| in files. If multiple servers serve your application, you must use a database to make sessions work across different servers. The recommended database
for best performance is |Redis|. See :ref:`Configure Redis Servers <bundle-docs-platform-redis-bundle--configure-servers>`
for more details.

Session Locking Impact on Application Availability
--------------------------------------------------

The Oro application needs to use shared session storage in any distributed environment (more than one web node). |Redis| is one of the best-supported options with high performance. By default, |session data is locked| to avoid race conditions, and |SncRedisBundle|, used in Oro to store sessions in Redis, is not an exception.

Such behavior works fine for consecutive requests flow (classic web browsing) but creates many issues for the scenarios where multiple parallel requests are executed within the same session. In the B2B world, a widespread use case is to run real-time price and inventory checks of the products against a back-end ERP application, and in many cases, ERP may respond slowly. To minimize the impact of ERP response time on user experience, such requests are typically executed in parallel using AJAX. This solution can have a critical impact on application availability in production because requests will be hitting session lock and will be queued. In case of multiple concurrent users on the website generating dozens of such AJAX requests, ERP availability and performance will directly impact Oro application availability. In case of slow ERP response, it will cause requests queue overflow.

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