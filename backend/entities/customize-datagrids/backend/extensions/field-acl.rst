.. _customize-datagrids-extensions-acl:

Field ACL Extension
===================

|Field ACL extension| allows checking access to grid columns. Currently, it is implemented only for the ORM datasource.

To enable field ACL protection for a column, use the ``field_acl`` section in a datagrid declaration:

.. code-block:: none

   fields_acl:                     #section name
       columns:
            name:                  #column name
               data_name: a.name   #the path to a field in which ACL should be used to protect the column


Please note that only fields from the root entity of a datagrid's ORM query are now supported.

.. include:: /include/include-links-dev.rst
   :start-after: begin
