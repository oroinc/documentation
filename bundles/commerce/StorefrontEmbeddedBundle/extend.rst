:title: Customize Embedded Fragments with OroStorefrontEmbeddedBundle

.. meta::
   :description: Customize OroCommerce embedded fragments with the resolve and response events, the fragment services,
                 and the JavaScript fragment view options

.. _bundle-docs-commerce-storefront-embedded-bundle--extend:

Customize Embedded Fragments
============================

OroStorefrontEmbeddedBundle provides events, services, and JavaScript options to customize the existing fragments. To
add a fragment, see
:ref:`Create an Embedded Fragment <bundle-docs-commerce-storefront-embedded-bundle--embedded-fragment>`.

.. _bundle-docs-commerce-storefront-embedded-bundle--extend--blocks-route-parameters:

Change the Blocks and Route Parameters
--------------------------------------

The bundle dispatches the ``Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResolveEvent`` event before it
creates the URL of the target page. For the place of this event in the request flow, see
:ref:`Fragment Request <bundle-docs-commerce-storefront-embedded-bundle--fragment-request>`.

The event has the following rules:

* The block list starts with the ``layout_block_ids`` of the fragment. Change it with ``addBlockId()`` or
  ``setBlockIds()``. After the event, the block list replaces any ``layout_block_ids`` route parameter.
* An empty block list causes a ``\LogicException``. Without block IDs, the target page would render in full.
* For a fragment request, the ``EmbeddedFragmentResolveEvent::CONTEXT_REQUEST`` context value is the ``Request``
  object. For other callers of the URL resolver, it is ``null`` unless the caller puts a ``Request`` object into the
  context.
* The route parameters go to the router without a filter. For a fragment request, the bundle removes only the query
  parameters whose names start with ``_``. Filter untrusted input before you pass it to ``setRouteParameters()``.

The following listener adds a block and a route parameter to the ``embedded_my_page`` fragment of a fragment request:

.. code-block:: php

   <?php

   declare(strict_types=1);

   namespace Acme\Bundle\DemoBundle\EventListener;

   use Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResolveEvent;
   use Symfony\Component\HttpFoundation\Request;

   class EmbeddedMyPageFragmentListener
   {
       public function onFragmentResolve(EmbeddedFragmentResolveEvent $event): void
       {
           if ($event->getFragmentName() !== 'embedded_my_page') {
               return;
           }

           $request = $event->getContextValue(EmbeddedFragmentResolveEvent::CONTEXT_REQUEST);
           if (!$request instanceof Request) {
               return;
           }

           $event->addBlockId('my_page_sidebar');

           $routeParameters = $event->getRouteParameters();
           $routeParameters['view'] = 'compact';
           $event->setRouteParameters($routeParameters);
       }
   }

Register the listener in the ``Resources/config/services.yml`` file of your bundle:

.. code-block:: yaml

   services:
       acme_demo.event_listener.embedded_my_page_fragment:
           class: Acme\Bundle\DemoBundle\EventListener\EmbeddedMyPageFragmentListener
           tags:
               - name: kernel.event_listener
                 event: Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResolveEvent
                 method: onFragmentResolve

Change the Response Content
---------------------------

The ``Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResponseEvent`` event contains the decoded JSON body as
an array. The bundle dispatches the event for all request methods. For the dispatch conditions and the default keys,
see :ref:`Fragment Response <bundle-docs-commerce-storefront-embedded-bundle--fragment-response>`.

The event does not contain the ``Response`` object. To change the status code or the headers, listen to
``kernel.response`` and use the ``oro_storefront_embedded.request.embedded_request_checker`` service.

The ``oro_storefront_embedded.event_listener.embedded_fragment_*`` listeners of this event set the default keys. They
have the default priority ``0``. The priority of your listener controls which values it sees:

* A negative priority --- Your listener runs after the default listeners. Use it to change or remove a default key.
* Priority ``0`` --- The service registration order decides if your listener runs before or after the default
  listeners. Use it only for keys that the default listeners do not set.
* A positive priority --- Your listener runs before the default listeners. The default listeners can replace your
  values for their keys.

.. warning::

   If the content cannot be encoded as JSON, the bundle keeps the original body and logs an error. For example,
   ``NAN``, ``INF``, and invalid UTF-8 strings cannot be encoded. In this case, the flash messages of the request are
   lost, because the bundle already removed them from the session. Set only values that can be encoded as JSON.

The following listener adds a key and changes the title of a GET response:

.. code-block:: php

   <?php

   declare(strict_types=1);

   namespace Acme\Bundle\DemoBundle\EventListener;

   use Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResponseEvent;
   use Symfony\Component\HttpFoundation\Request;

   class EmbeddedMyPageResponseListener
   {
       public function onFragmentResponse(EmbeddedFragmentResponseEvent $event): void
       {
           if ($event->getFragmentName() !== 'embedded_my_page') {
               return;
           }

           $event->setContentValue('viewMode', 'compact');

           $request = $event->getContextValue(EmbeddedFragmentResponseEvent::CONTEXT_REQUEST);
           if (!$request instanceof Request || !$request->isMethod(Request::METHOD_GET)) {
               return;
           }

           $title = $event->getContentValue('title');
           if (\is_string($title) && $title !== '') {
               $event->setContentValue('title', $title . ' - My Page');
           }
       }
   }

Register the listener with a negative priority, so that it runs after the listener that sets the plain title:

.. code-block:: yaml

   services:
       acme_demo.event_listener.embedded_my_page_response:
           class: Acme\Bundle\DemoBundle\EventListener\EmbeddedMyPageResponseListener
           tags:
               - name: kernel.event_listener
                 event: Oro\Bundle\StorefrontEmbeddedBundle\Event\EmbeddedFragmentResponseEvent
                 method: onFragmentResponse
                 priority: -10

Use the Fragment Services
-------------------------

The bundle provides the following services:

* ``oro_storefront_embedded.request.embedded_fragment_registry`` --- Reads the fragment definitions. ``hasFragment()``
  checks if a fragment exists. ``getRouteName()`` and ``getLayoutBlockIds()`` throw ``\InvalidArgumentException`` for
  an unknown fragment.
* ``oro_storefront_embedded.request.embedded_fragment_url_resolver`` ---
  ``resolveFragmentUrl($fragmentName, $routeParameters = [], $context = [])`` creates the URL of the target page. It
  also works outside a fragment request. It dispatches ``EmbeddedFragmentResolveEvent`` with ``$context``. It throws
  ``NotFoundHttpException``, ``BadRequestHttpException``, or ``\LogicException``.
* ``oro_storefront_embedded.request.embedded_request_checker`` --- ``isEmbeddedRequest()``,
  ``isEmbeddedFragmentRequest()``, ``getEmbeddedFragmentName()``, and ``isEmbeddedRequestReload()``. If you pass no
  request, each method checks the main request. Use this service instead of reading the request headers or attributes.
  ``isEmbeddedRequest()`` and ``isEmbeddedFragmentRequest()`` check the request terms of
  :ref:`How It Works <bundle-docs-commerce-storefront-embedded-bundle--how-it-works>`. ``isEmbeddedRequestReload()``
  checks only the ``X-Oro-Hash-Navigation`` header.

Skip Links in a Fragment
------------------------

The ``skipRouting`` option of the ``orostorefrontembedded/js/embedded/embedded-fragment-view`` JavaScript module is a
CSS selector of the links that the runtime does not handle. The default is ``.noscript``. For how the runtime handles
the other links, see :ref:`JavaScript Runtime <bundle-docs-commerce-storefront-embedded-bundle--javascript-runtime>`.

To change the option, add it to the ``Resources/views/layouts/<theme>/config/jsmodules.yml`` file of your bundle, where
``<theme>`` is the name of your theme:

.. code-block:: yaml

   configs:
       orostorefrontembedded/js/embedded/embedded-fragment-view:
           skipRouting: '.noscript, .acme-external-link'

.. include:: /include/include-links-dev.rst
   :start-after: begin
