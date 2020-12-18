.. _web-api--batch-api:

Batch API
=========

The Batch API provides a way to create or update a list of entities of the same type via one API request.

For detailed information how this API works see :ref:`update_list <update-list-action>`,
:ref:`batch_update <batch-update-action>` and :ref:`batch_update_item <batch-update-item-action>` actions.

.. _web-api--batch-api--enable:

Enable Batch API for Entity
---------------------------

By default, Batch API is disabled for all API resources. To enable it for an API resource,
the :ref:`update_list <update-list-action>` action should be enabled for this resource.
This can be done via ``actions`` section for an entity in `Resources/config/oro/api.yml`.

Example:

.. code-block:: yaml
    :linenos:

    api:
        entities:
            Oro\Bundle\UserBundle\Entity\User:
                actions:
                    update_list: true

.. _web-api--batch-api--config:

Batch API Configuration
-----------------------

All configuration options related to Batch API are grouped in ``batch_api`` section of ApiBundle configuration:

.. code-block:: yaml
    :linenos:

    oro_api:
        batch_api:

            # The default maximum number of entities that can be saved in a chunk. The default value is 100.
            chunk_size: 100

            # The maximum number of entities of a specific type that can be saved in a chunk.
            chunk_size_per_entity:
                Oro\Bundle\UserBundle\Entity\User: 10 # example

            # The default maximum number of included entities that can be saved in a chunk. The default value is 50.
            included_data_chunk_size: 50

            # The maximum number of included entities that can be saved in a chunk for a specific primary entity type.
            included_data_chunk_size_per_entity:
                Oro\Bundle\UserBundle\Entity\User: 20 # example

Parameters ``chunk_size_per_entity`` and ``included_data_chunk_size_per_entity`` can be used to tuning of
an API engine to have maximum performance.

To get maximum performance in requests with included entities, the value of the ``included_data_chunk_size_per_entity``
parameter can be changed to the medium number of related entities that will be set to one primary entity when processing
the request.

.. _web-api--batch-api--async-operation-config:

Asynchronous Batch Operations Cleanup Configuration
---------------------------------------------------

Obsolete asynchronous batch operations are removed once a day by a cron job.

The default configuration of this cron job is illustrated below:

.. code-block:: yaml
    :linenos:

    oro_api:
        batch_api:
            async_operation:

                # The number of days async operations are stored in the system.
                lifetime: 30

                # The maximum number of seconds that the cron job can spend in one run.
                cleanup_process_timeout: 3600 # 1 hour

.. _web-api--batch-api--storage-config:

Storage Configuration
---------------------

The |KnpGaufretteBundle| is used to configure storages for source data files of Batch API requests and
all files that are created when processing asynchronous batch operations (e.g. chunk files, error files, etc.).

Here is the default configuration of these storages:

.. code-block:: yaml
    :linenos:

    knp_gaufrette:
        adapters:
            api:
                doctrine_dbal:
                    connection_name: batch
                    table: oro_api_async_data
                    columns:
                        key: name
                        content: content
                        mtime: updated_at
                        checksum: checksum
        filesystems:
            # a storage for source data files
            api_source_data:
                adapter: private
                alias: api_source_data_filesystem
            # a storage for files created when processing asynchronous batch operations
            api:
                adapter: api
                alias: api_filesystem

To change the adapter configuration the `Resources/config/oro/app.yml` in any bundle or `config/config.yml`
of your application can be used.
The following example shows how to reconfigure this adapter to use a local filesystem:

.. code-block:: yaml
    :linenos:

    knp_gaufrette:
        adapters:
            api:
                local:
                    directory: '%kernel.project_dir%/var/api_files'

More examples can be found in |KnpGaufretteBundle documentation|.


.. include:: /include/include-links-dev.rst
   :start-after: begin
