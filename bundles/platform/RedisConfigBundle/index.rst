:oro_show_local_toc: false

.. _bundle-docs-platform-redis-bundle:

OroRedisConfigBundle
====================

|OroRedisConfigBundle| provides configuration enhancements for Oro applications to enable usage of |Redis| for caching.

The bundle enables developers to set Redis parameters in the application configuration YAML files and after that automatically enables and configures Redis caching services for different types of application caches (Doctrine cache, file cache, wsse_nonces cache, etc.) based on these parameters.

.. admonition:: Business Tip

   Are you keeping an eye on the growing digital commerce trend? Find out how you can connect your buyers and sellers with a |B2B marketplace platform|.

Resources
---------

  * :ref:`Configure Redis Servers <bundle-docs-platform-redis-bundle--configure-servers>`
  * :ref:`Configure Application to Use Redis <bundle-docs-platform-redis-bundle--configuration>`
  * |Predis Documentation|
  * |Redis Sentinel Documentation|
  * |Redis Cluster Tutorial|


.. toctree::
   :hidden:
   :titlesonly:

   configure-redis-servers
   configuration


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-cloud.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin