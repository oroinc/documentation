:title: Our Backward Compatibility Promise

.. meta::
   :description: Oro application backward compatibility promise

.. _doc--community--backward-compatibility:

Our Backward Compatibility Promise
==================================

Code Compatibility Promise
--------------------------

In compliance with our :ref:`Release Process <doc--community--release>` and to ensure clear expectations, we use a
**MAJOR.MINOR.PATCH** versioning scheme. While this format resembles Semantic Versioning, it does **not** follow
SemVer's strict backward-compatibility guarantees between **MINOR** versions.

In Oro products, the MAJOR version reflects the Symfony LTS version used by that release line. A non-changing MAJOR
version indicates only that the underlying major Symfony version remains the same - it does *not* guarantee API or
behavioral stability within Oro code from one **MINOR** version to the next.

As a result:

* **Both MAJOR and MINOR releases may introduce backward-incompatible changes** in Oro code.
* System requirements may also change between MINOR versions, including updates to the minimally supported
  versions of PHP, PostgreSQL, and other required components.
* Third-party dependencies used by the Oro application may be upgraded or replaced in MINOR releases. Such
  updates may include major-version changes or library substitutions, in both PHP and JavaScript, and may introduce
  breaking changes.

..

* **PATCH releases are expected to remain fully backward compatible.** A breaking change would only be considered for a
  PATCH release if it were absolutely required to remediate a critical security issue and no viable non-breaking
  alternative existed. Any such exceptions are extremely rare and will be documented in the CHANGELOG, release notes,
  and release announcements.

Code Covered
------------

This BC promise applies to all PHP code except for:

- PHPUnit tests (located in ``*/Tests/Unit/``)
- Behat tests (located in ``*/Tests/Behat/``)
- Functional tests (located in ``*/Tests/Functional/``)
- Other code related to tests (located in ``*/Test/``)
- Bundles with the testing framework extensions and demo data definitions ``*/Bundle/TestFrameworkBundle/``, ``*/Bundle/TestFrameworkCRMBundle/``, ``*/Bundle/DemoDataBundle/``, ``*/Bundle/DemoDataCommerceCRMBundle/``
- An enterprise package with additional OroCRM demo data ``oro/crm-pro-demo-data-bundle``

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
