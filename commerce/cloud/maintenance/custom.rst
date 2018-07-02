Custom Commands
~~~~~~~~~~~~~~~

In case of you need to run an application command not covered by the maintenance tool, run it via the www-data user, for example:

.. code-block:: none
    :linenos:

    sudo -u www-data php app/console --env=prod oro:user:list

The application source code is accessible directly from maintenance node via the */mnt/ocom/app/www* path.
