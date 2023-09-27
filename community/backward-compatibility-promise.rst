:title: Our Backward Compatibility Promise

.. meta::
   :description: Oro application backward compatibility promise

.. _doc--community--backward-compatibility:

Our Backward Compatibility Promise
==================================

Code Compatibility Promise
--------------------------

In compliance with our :ref:`Release Process <doc--community--release>` and to ensure seamless upgrades, we promise the following:

1. MAJOR and MINOR releases MAY introduce backward-incompatible changes. MAJOR, MINOR, and PATCH are SemVer terms that describe release versions (e.g., 2.1.4), where 2 is a MAJOR, 1 is a MINOR, and 4 is a PATCH release (MAJOR.MINOR.PATCH).
2. Internal implementation and some parts of the logic MAY be changed even in PATCH releases, however, they should preserve the external interface following the instructions provided below.
3. At the same time, backward-incompatible changes (marked as "No" in the table below) in the PATCH release SHOULD NOT replace the existing logic. Instead, they SHOULD be marked as deprecated, and a new implementation should be added instead.

Code Covered
------------

This BC promise applies to all PHP code except for:

- PHPUnit tests (located in ``*/Tests/Unit/``)
- Behat tests (located in ``*/Tests/Behat/``)
- Functional tests (located in ``*/Tests/Functional/``)
- Other code related to tests (located in ``*/Test/``)
- Bundles with the testing framework extensions and demo data definitions ``*/Bundle/TestFrameworkBundle/``, ``*/Bundle/TestFrameworkCRMBundle/``, ``*/Bundle/DemoDataBundle/``, ``*/Bundle/DemoDataCommerceCRMBundle/``
- An enterprise package with additional OroCRM demo data ``oro/crm-pro-demo-data-bundle``

BC Exceptions
-------------

Backward compatibility can be ignored in security bug fixes or critical bugs. In this case, all the incompatible changes are described in the CHANGELOG.md in a corresponding package.

Using Code
----------

**Changing Interfaces**

This table specifies the changes you are allowed to do when working on interfaces:

+-------------------------------------------------------------+-------------------+
| Type of Change                                              | Change Allowed    |
+=============================================================+===================+
| *Add an interface*                                          | *Yes*             |
+-------------------------------------------------------------+-------------------+
| *Remove an interface*                                       | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a method*                                              | *No*              |
+-------------------------------------------------------------+-------------------+
| *Remove a method*                                           | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add an argument to a method*                               | *No*              |
+-------------------------------------------------------------+-------------------+
| **Methods**                                                 |                   |
+-------------------------------------------------------------+-------------------+
| *Change an argument name*                                   | *Yes*             |
+-------------------------------------------------------------+-------------------+
| *Remove an argument*                                        | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a type hint to an argument*                            | *No*              |
+-------------------------------------------------------------+-------------------+
| *Remove a type hint of an argument*                         | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a default value to an argument*                        | *No*              |
+-------------------------------------------------------------+-------------------+
| *Remove a default value of an argument*                     | *No*              |
+-------------------------------------------------------------+-------------------+
| *Change an argument default value*                          | *No*              |
+-------------------------------------------------------------+-------------------+

**Changing Classes**

This table specifies the changes you are allowed to do when working on classes:

+--------------------------------------------------------------+-------------------+
| Type of Change                                               | Change Allowed    |
+==============================================================+===================+
| *Remove the class entirely*                                  | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add a class*                                                | *Yes*             |
+--------------------------------------------------------------+-------------------+
| **Public Properties**                                        |                   |
+--------------------------------------------------------------+-------------------+
| *Remove public property*                                     | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add public property*                                        | *Yes*             |
+--------------------------------------------------------------+-------------------+
| **Protected Properties**                                     |                   |
+--------------------------------------------------------------+-------------------+
| *Remove protected property*                                  | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add protected property*                                     | *Yes*             |
+--------------------------------------------------------------+-------------------+
| **Private Properties**                                       |                   |
+--------------------------------------------------------------+-------------------+
| *Add private property*                                       | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove private property*                                    | *Yes*             |
+--------------------------------------------------------------+-------------------+
| **Constructors**                                             |                   |
+--------------------------------------------------------------+-------------------+
| *New public constructor (does not match supertype)*          | *No*              |
+--------------------------------------------------------------+-------------------+
| *New protected constructor (does not match supertype)*       | *No*              |
+--------------------------------------------------------------+-------------------+
| **Public Methods**                                           |                   |
+--------------------------------------------------------------+-------------------+
| *Remove a public method*                                     | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add an argument*                                            | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove an argument*                                         | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add a public method*                                        | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change an argument name*                                    | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add a type hint to an argument*                             | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove a type hint of an argument*                          | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add a default value to an argument*                         | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove a default value of an argument*                      | *No*              |
+--------------------------------------------------------------+-------------------+
| *Change a default value of an argument*                      | *No*              |
+--------------------------------------------------------------+-------------------+
| **Protected Methods**                                        |                   |
+--------------------------------------------------------------+-------------------+
| *Remove a protected method*                                  | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add an argument*                                            | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove an argument*                                         | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add a protected method*                                     | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change an argument name*                                    | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add a type hint to an argument*                             | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove a type hint of an argument*                          | *No*              |
+--------------------------------------------------------------+-------------------+
| *Add a default value to an argument*                         | *No*              |
+--------------------------------------------------------------+-------------------+
| *Remove a default value of an argument*                      | *No*              |
+--------------------------------------------------------------+-------------------+
| *Change a default value of an argument*                      | *No*              |
+--------------------------------------------------------------+-------------------+
| **Private Methods**                                          |                   |
+--------------------------------------------------------------+-------------------+
| *Add a private method*                                       | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove a private method*                                    | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add an argument*                                            | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove an argument*                                         | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change an argument name*                                    | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add a type hint to an argument*                             | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove a type hint of an argument*                          | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add a default value to an argument*                         | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove a default value of an argument*                      | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change a default value of an argument*                      | *Yes*             |
+--------------------------------------------------------------+-------------------+
| **Final classes**                                            |                   |
+--------------------------------------------------------------+-------------------+
| *Add a public method*                                        | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add a protected method*                                     | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Add an argument to a protected method*                      | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Remove a protected method*                                  | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change a public method implementation*                      | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change a protected method implementation*                   | *Yes*             |
+--------------------------------------------------------------+-------------------+
| *Change a private method implementation*                     | *Yes*             |
+--------------------------------------------------------------+-------------------+

**Changing Traits**

This table specifies the changes you are allowed to do when working on traits:

+--------------------------------------------------------------------+-------------------+
| Type of Change                                                     | Change Allowed    |
+====================================================================+===================+
| *Remove a trait entirely*                                          | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a trait*                                                      | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove a public method*                                           | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a public method*                                              | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove a protected method*                                        | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a protected method*                                           | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove protected property*                                        | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add protected property*                                           | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Add private property*                                             | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove private property*                                          | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a private method*                                             | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove a private method*                                          | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add an argument to a public method*                               | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add an argument to a protected method*                            | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add an argument to a private method*                              | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add public property*                                              | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Change a public method implementation*                            | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Change a protected method implementation*                         | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Change a private method implementation*                           | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Change an argument name of (public, protected, private)*          | *Yes*             |
+--------------------------------------------------------------------+-------------------+
| *Remove an argument of (public, protected, private)*               | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a type hint of an argument (public, protected, private)*      | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Remove a type hint of an argument (public, protected, private)*   | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Add a default argument value (public, protected, private)*        | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Remove a default argument value (public, protected, private)*     | *No*              |
+--------------------------------------------------------------------+-------------------+
| *Change a default argument value (public, protected, private)*     | *No*              |
+--------------------------------------------------------------------+-------------------+

**Changing Functions**

This table specifies the changes you are allowed to do when working on functions:

+-------------------------------------------------------------+-------------------+
| Type of Change                                              | Change Allowed    |
+=============================================================+===================+
| *Remove a function*                                         | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a new argument*                                        | *No*              |
+-------------------------------------------------------------+-------------------+
| *Remove an argument*                                        | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a function*                                            | *No*              |
+-------------------------------------------------------------+-------------------+
| *Change a function implementation*                          | *Yes*             |
+-------------------------------------------------------------+-------------------+
| *Remove an argument type*                                   | *No*              |
+-------------------------------------------------------------+-------------------+
| *Add a default value to an argument*                        | *No*              |
+-------------------------------------------------------------+-------------------+
| *Remove a default value of an argument*                     | *No*              |
+-------------------------------------------------------------+-------------------+
| *Change a default value of an argument*                     | *No*              |
+-------------------------------------------------------------+-------------------+


.. include:: /include/include-links-dev.rst
   :start-after: begin
