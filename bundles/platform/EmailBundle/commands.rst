
CLI Commands (EmailBundle)
==========================

oro:email:update-associations
-----------------------------

To update email associations, use the following command:

.. code-block:: none

   php bin/console oro:email:update-associations

oro:email:generate-md5
----------------------

To generate and print MD5 hashes for email template contents from oro_email_template table, use the command below. These hashes can be used in email migrations.

.. code-block:: none

   php bin/console oro:email:generate-md5