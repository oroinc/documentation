.. _access-control-lists-categories:

Access Control List Categories
==============================

+-----------+------------------------+
| Filename  | ``acl_categories.yml`` |
+-----------+------------------------+
| Root Node | acl_categories         |
+-----------+------------------------+
| Options   | * `label`_             |
|           | * `tab`_               |
|           | * `priority`_          |
|           | * `visible`_           |
+-----------+------------------------+

The ``acl_categories.yml`` file is used to configure ACL categories for the :ref:`role management UI <user-guide-user-management-permissions-roles--actions>`.

An example of the configuration file:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/acl_categories.yml

    acl_categories:
        some_category:
            label: acme.demo.privilege.category.some_category.label
            tab: true
            priority: 10

``label``
---------

**type**: ``string``

A translation key of a human-readable name of a category.

``tab``
-------

**type**: ``boolean`` (**default**: ``false``)

Indicates whether a category should be represented as a tab.

``priority``
------------

**type**: ``integer`` (**default**: ``0``)

This option can be used to control the order in which categories are shown.
Categories with a smaller priority number are shown first.

``visible``
-----------

**type**: ``boolean`` (**default**: ``true``)

Indicates whether a category is visible or not.
