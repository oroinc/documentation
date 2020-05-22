Loading Demo Data
-----------------

To load demo data during installation, run the ``oro:install`` command with the ``--sample-data=y`` option.

To load demo data after installation, run:

.. code-block:: bash

    $ php bin/console oro:migration:data:load --fixtures-type=demo --env=prod

.. tip::
    You can use the ``--dry-run`` option to first check which fixtures will be loaded:

    .. code-block:: bash

        $ php bin/console oro:migration:data:load --dry-run --fixtures-type=demo --env=prod
