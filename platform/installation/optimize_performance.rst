:orphan:

Performance Optimization
~~~~~~~~~~~~~~~~~~~~~~~~

.. begin_performance_optimization


PHP-FPM
^^^^^^^

PHP-FPM (FastCGI Process Manager) is an alternative PHP FastCGI implementation adjusted for better handling of the heavy workload.

The recommended configuration of the PHP-FPM is provided below.

.. code-block:: ini
    :linenos:

            [www]
            listen = 127.0.0.1:9000
            ; or
            ; listen = /var/run/php5-fpm.sock

            listen.allowed_clients = 127.0.0.1

            pm = dynamic
            pm.max_children = 128
            pm.start_servers = 8
            pm.min_spare_servers = 4
            pm.max_spare_servers = 8
            pm.max_requests = 512

            catch_workers_output = yes

.. note:: Make sure that Nginx ``fastcgi_pass`` and PHP-FPM ``listen`` options are aligned.

Optimize Runtime Compilation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Use an OpCache bytecode engine to cache bytecode representation of the PHP code and save time on the repetitive runtime compilation.

Please install Opcache php-extention and configure it in the following way:

.. code-block:: text

   zend_extension=opcache.so
   opcache.enable=1
   opcache.memory_consumption=256
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=11000
   opcache.fast_shutdown=1
   opcache.load_comments=1
   opcache.save_comments=1

.. note:: The opcache.load_comments and opcache.save_comments parameters are enabled by default and should remain so for Oro application operation. Please do not disable them.
