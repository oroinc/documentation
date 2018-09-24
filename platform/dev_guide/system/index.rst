.. _dev-guide-system:

System Components
=================

The System Components topic describes the following OroPlatform features that are responsible for the interaction between Oro
application and its system components (operational and external):

* :doc:`/dev_guide/system/websockets/index` - enables real-time communication between Oro application server and users browsers to provide smooth user experiense
* :doc:`/dev_guide/system/cron_jobs/index` - enables regular time-based background jobs
* :doc:`/dev_guide/system/message_queue/index` - enables robust loosely coupled communication between system components to allow performing the heavy or high important jobs asynchroniously or in the background mode.
* :doc:`/dev_guide/system/file_storage/index` - enables filesystem abstraction layer
* :doc:`/dev_guide/system/logging/index` - tools that allows to control and recover the application in abnornal situations.

.. toctree::
   :hidden:
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   websockets/index
   cron_jobs/index
   message_queue/index
   file_storage/index
   logging/index
