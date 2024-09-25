.. _orocloud-maintenance-work-with-media:

How to Work with Media
======================

Media
-----

List
^^^^

To list files from the `public` database, use:

.. code-block:: none

    $ orocloud-cli media:list public

    +-------------------------+--------------+--------+---------------------+
    | Filename                | Content Type | Size   | Upload Date         |
    +-------------------------+--------------+--------+---------------------+
    | js/translation/en.json  | text/html    | 241527 | 2024-08-14 14:27:47 |
    | js/frontend_routes.json | text/plain   | 52678  | 2024-08-14 14:27:12 |
    | js/admin_routes.json    | text/plain   | 350168 | 2024-08-14 14:27:12 |
    +-------------------------+--------------+--------+---------------------+

Use the `--filter` option to filter the listed files by pattern:

.. code-block:: none

    $ orocloud-cli media:list public --filter=en.json -vvv

    +------------------------+--------------+--------+---------------------+
    | Filename               | Content Type | Size   | Upload Date         |
    +------------------------+--------------+--------+---------------------+
    | js/translation/en.json | text/html    | 241527 | 2024-08-14 14:27:47 |
    +------------------------+--------------+--------+---------------------+

Download
^^^^^^^^

Downloads media content from a source database to the `/mnt/orocloud-cli/downloads` folder.

To download a file from the `private` database, use:

.. code-block:: none

    orocloud-cli media:download private --file=attachments/61b0871967033945666770.jpeg

To download all files, use:

.. code-block:: none

    orocloud-cli media:download private

Dump
^^^^

Downloads media content from a source database to the `/mnt/orocloud-cli/dumps/{{database}}.zip` file.

.. code-block:: none

    orocloud-cli media:dump private


Upload
^^^^^^

Sometimes, you may need to upload media files related to custom CMS page(s) or products to a specific ``public`` directory.
This can be done with the ``media:upload`` command that allows to upload media files, e.g.,
``svg | ttf | woff | woff2 | jpg | jpeg | jp2 | jxr | webp | gif | png | ico | css | scss | pdf | rtf | js | xml | mp4``
to the ``uploads`` gridFS database from the /mnt/orocloud-cli/uploads folder.

.. code-block:: none

    orocloud-cli media:upload uploads

    All you have to do is confirm the action [Yes]:
    [y] Yes
    [n] No
    > y


    9/9 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%  1 sec/1 sec  16.0 MiB

    +----------------------------------------+
    | Uploaded files                         |
    +----------------------------------------+
    | attachments/66b1f09ca9af6234172081.jpg |
    | attachments/66b1f09cb19a7408802074.jpg |
    | attachments/66b1f09cb9a9a723386097.jpg |
    | attachments/66b1f09cc50be357675883.jpg |
    | attachments/66b1f09ccfc76575805183.jpg |
    | attachments/66b1f09cd9240876250360.jpg |
    | attachments/66b1f09c2d8b0977861940.jpg |
    | attachments/66b1f09c7ca4f265968643.jpg |
    | attachments/66b1f09c88508119644185.jpg |
    +----------------------------------------+
                                                                                                                            
    [OK] Files were uploaded.                                                                                              
               
Import
^^^^^^

To upload media files and product images, use SFTP. It helps connect to the OroCommerce instance and transfer large amounts of data. 
To get SFTP access to your OroCloud instance, read the :ref:`related documentation <sftp-access>` and create a ticket in the support portal.

Alternatively, use the `orocloud-cli media:import` command to prepare files from /mnt/orocloud-cli/imports.

.. note:: Command will wipe previously imported files from temporary storage before uploading new ones.

.. code-block:: none

    $ orocloud-cli media:import

    All you have to do is confirm the action [Yes]:
    [y] Yes
    [n] No
    > y


    9/9 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100% < 1 sec/< 1 sec 16.0 MiB

    +----------------------------------------+
    | Uploaded files                         |
    +----------------------------------------+
    | attachments/66b1f09ca9af6234172081.jpg |
    | attachments/66b1f09cb19a7408802074.jpg |
    | attachments/66b1f09cb9a9a723386097.jpg |
    | attachments/66b1f09cc50be357675883.jpg |
    | attachments/66b1f09ccfc76575805183.jpg |
    | attachments/66b1f09cd9240876250360.jpg |
    | attachments/66b1f09c2d8b0977861940.jpg |
    | attachments/66b1f09c7ca4f265968643.jpg |
    | attachments/66b1f09c88508119644185.jpg |
    +----------------------------------------+

                                                                                                                            
    [OK] Files were uploaded.                                                                                              

Delete
^^^^^^

Deletes media content from a source database.

To delete a file from the `uploads` database, use:

.. code-block:: none

    orocloud-cli media:delete uploads --file=attachments/61b0871967033945666770.jpeg

To delete all files, use:

.. code-block:: none

    orocloud-cli media:delete uploads

