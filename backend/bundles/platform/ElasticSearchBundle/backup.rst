ElasticSearch Indexes Backup
============================

This article explains how to create backups of Elasticsearch indexes, restore and delete them using the standard features of the Elasticsearch engine.

Elasticsearch supports the creation of backups (*snapshots* in the Elasticsearch terminology) for the whole cluster or for the selected indexes only. There is also a way to customize the places where these backups are stored (*repositories* in the Elasticsearch terminology). Check the |Modules Snapshot topic| in the official documentation for more details.

Repositories
------------

1. Register a new repository to store your snapshots. The most common repository type is *file system* (FS) and this type will be used for demonstration.

   Set up the directory where the snapshots will be stored in the Elasticsearch configuration (it is usually stored in the `elasticsearch.yml` file):

   .. code-block:: yaml

      path.repo: /mnt/backups

   Then you need to restart Elasticsearch engine to apply this change. Please make sure that Elasticsearch user has permissions to read and write to this location.

2. Restart the Elasticsearch engine to apply this change. Make sure that the Elasticsearch user has permissions to read and write to this location.

3. Proceed to creating a file system repository:

   .. code-block:: none

      curl -X PUT "localhost:9200/_snapshot/oro" -H 'Content-Type: application/json' -d '{ "type": "fs", "settings": { "location": "oro_backups" } }'

   The example above illustrates that all snapshots created in this repository will in fact be stored in the `/mnt/backups/oro_backups` directory.

4. To check the list of snapshots inside the repository, run:

   .. code-block:: yaml

      curl -X GET "localhost:9200/_snapshot/oro?pretty"

5. To delete the repository when it is no longer required, unregister it by running:

   .. code-block:: yaml

      curl -X DELETE "localhost:9200/_snapshot/oro"

Snapshots
---------

Once the repository is ready, you can create a snapshot inside it.

1. To back up all indexes from your cluster, run the command below. Keep in mind that it may take a while to finish.

   .. code-block:: yaml

      curl -X PUT "localhost:9200/_snapshot/oro/snapshot_1?wait_for_completion=true"

2. Validate the content of `/mnt/backups/oro_backups`, it should contain the new files. You can also ask Elasticsearch for the information about a specific snapshot:

   .. code-block:: yaml

      curl -X GET "localhost:9200/_snapshot/oro/snapshot_1?pretty"

   This command produces a list of indexes, the backup start / end time, and other useful information.

3. To restore the state of the cluster from this snapshot, call the following command (this may require some time to finish):
      
   .. code-block:: yaml

      curl -X POST "localhost:9200/_snapshot/oro/snapshot_1/_restore"

4. To remove a snapshot, run:

   .. code-block:: yaml

      curl -X DELETE "localhost:9200/_snapshot/oro/snapshot_1"

.. include:: /include/include-links-dev.rst
   :start-after: begin