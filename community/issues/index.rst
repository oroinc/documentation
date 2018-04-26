.. _doc--community--issue-report:

Report an Issue
===============

We are using GitHub as a bug tracker. If you find a bug in the source code or a mistake in the documentation,
you can help us by submitting an issue to our GitHub repository.

Before Reporting an Issue
-------------------------

Before you submit your issue search on GitHub, check whether the same issue has already been reported.

* `OroPlatform issue tracker <https://github.com/orocrm/platform/issues?q=>`_
* `OroCommerce issue tracker <https://github.com/orocommerce/orocommerce/issues?q=>`_
* `OroCRM issue tracker <https://github.com/orocrm/crm/issues?q=>`_

.. caution:: To report security issues, we kindly ask you to follow the steps, described in the :ref:`Reporting Security Issues section <reporting-security-issues>`. **Please, never post security issues publicly!**

Basic Rules
-----------

Providing the following information will increase the chances of your issue being dealt with quickly:

* Clear summary of an issue in its title.
* Unambiguous set of steps describing how to reproduce the issue.
* Details about your environment:

    * Version of the product (is it master? the latest stable version?)
    * Extensions you have installed and customizations if you made any
    * Server operating system (Windows, Ubuntu, CentOS, RHEL, Fedora, other Linux) version and bitness (32-bit, 64-bit)
    * PHP version
    * Database (MySQL, PostgreSQL) version
    * Web-server (Apache, Nginx) version and how PHP is set up (as a module, or PHP-FPM)
    * Client operating system (Windows, Linux, MacOS, iOS, Android) version
    * Client browser and version

* A screenshot or multiple screenshots of the user interface.
* Relevant excerpts from the web-server and application log files.

Example of a Well Defined Issue
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Title**: Inconsistent display of address fields when adding address to the contact.

**Description**: While adding a new address to the contact, some fields in the new address form become mandatory, while all the fields are optional in the initial address form.

**Steps to reproduce**:

  - Navigate to **Customers > Contacts** in the main menu.
  - Choose any contact and open its edit page.
  - Proceed to **Addresses** section and click **+Add** button.
  - A new form will emerge. Compare the initial form and the new one.

**Expected Result**: The new form should be the same as the initial one.

**Actual Result**: Country, street, city and zip/postal code fields are mandatory in the new form.

**Environment**: OroCRM 1.10.8, Win10 64x, FireFox 50.1.0

**Screenshot**:

.. image:: /community/img/contributing/contacts.jpg

.. toctree::
   :maxdepth: 1
   :hidden:

   issue_security_report