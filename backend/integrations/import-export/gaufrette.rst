.. _dev-integrations-import-export-gaufrette:

Gaufrette
=========

The ImportExport bundle uses |Gaufrette| for the file storage.
The Gaufrette configuration is stored in `Resources/config/oro/app.yml`.

Gaufrette Configuration for a Local Filesystem
----------------------------------------------

This configuration allows to use local filesystem for the importing and exporting. It is applicable if all the consumers run on the same server.

**Example**

.. code-block:: php
   :linenos:

    knp_gaufrette:
        adapters:
            importexport:
                local:
                    directory: '%kernel.project_dir%/var/import_export'
        filesystems:
            importexport:
                adapter:    importexport
                alias:      importexport_filesystem


The importing, exporting, and temporary files are stored in the cache directory of the project.

Gaufrette Configuration for Amazon S3 Storage
---------------------------------------------

This configuration allows to use Amazon S3 cloud service for the importing and exporting. It is applicable if consumers run on different servers.

**Example**

.. code-block:: php
   :linenos:

    services:
        aws_s3.client:
            class: AmazonS3
            arguments:
                -
                    key: {your amazon s3 key}
                    secret: {your amazon s3 secret}

    knp_gaufrette:
        adapters:
            importexport:
                amazon_s3:
                    amazon_s3_id: aws_s3.client
                    bucket_name: {your bucket name}
                    options:
                        directory: 'import_export'
                        create: true
                        region: {your amazon s3 bucket region}


.. hint::
    See also the |official Gaufrette documentation|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

