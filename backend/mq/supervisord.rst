Supervisord
===========

As described earlier, consumers can interrupt message processing for many
reasons, and in every case you must re-run the interrupted consumer. To keep
the ``oro:message-queue:consume`` command running, we recommend delegating
this responsibility to |Supervisord|.

With the following program configuration, supervisord runs four simultaneous
instances of the ``oro:message-queue:consume`` command and relaunches any
instance that dies for any reason.

.. code-block:: ini


    [program:oro_message_consumer]
    command=/path/to/bin/console --env=prod --no-debug oro:message-queue:consume
    process_name=%(program_name)s_%(process_num)02d
    numprocs=4
    autostart=true
    autorestart=true
    startsecs=0
    user=apache
    redirect_stderr=true


.. include:: /include/include-links-dev.rst
   :start-after: begin