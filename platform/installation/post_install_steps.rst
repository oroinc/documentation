Important Post-Install Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

After the installation has finished, please, perform the following mandatory post-install steps:

* In console, run ``php app/console oro:api:doc:cache:clear``
    to prepare the API documentation cache. This process may take several minutes.
* Start one or more MessageQueue consumers using the following command:

  .. code-block:: text
      :linenos:

     <OroCommerce installation directory>/app/console oro:message-queue:consume --env=prod

  .. note::

     OroCommerce uses the `MessageQueueComponent`_ and `MessageQueueBundle`_ to asynchronously run maintenance tasks in the background.

.. _`MessageQueueBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/MessageQueueBundle
.. _`MessageQueueComponent`: https://github.com/orocrm/platform/tree/master/src/Oro/Component/MessageQueue

* Ensure that the MessageQueue entry point is called on a reasonably frequent schedule (for example, every minute) through the OroCommerce cron service using the following command:

   .. code-block:: text

      <OroCommerce installation directory>/app/console oro:cron --env=prod
