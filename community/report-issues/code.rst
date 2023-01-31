.. _doc--community--issue-report:

Report a Source Code Issue
==========================

We are using GitHub as a bug tracker. If you find a bug in the source code or a mistake in the documentation, you can help us by submitting an issue to our GitHub repository.

Before you submit your issue search on GitHub, make sure that the same issue has not already been reported.

* |OroPlatform issue tracker|
* |OroCommerce issue tracker|
* |OroCRM issue tracker|

.. caution::

    **Reporting security issues**

    Responsible disclosure is the industry best practice, and we ask you to use :ref:`this procedure <reporting-security-issues>` to report security issues. Please never post security issues publicly!

Best Practice
-------------

Providing the following information will increase the chances of your issue being dealt with quickly:

* Clear summary of an issue in its title.
* Unambiguous set of steps describing how to reproduce the issue.
* Details about your environment:
    * Version of the product (is it master? the latest stable version?)
    * Extensions you have installed and customizations, if any
    * Server operating system (Windows, Ubuntu, Oracle Linux, RHEL, Fedora, other Linux) version and bitness (32-bit, 64-bit)
    * PHP version
    * Database (PostgreSQL) version
    * Web-server (Apache, Nginx) version and how PHP is set up (as a module, or PHP-FPM)
    * Client operating system (Windows, Linux, MacOS, iOS, Android) version
    * Client browser and version
* A screenshot or multiple screenshots of the user interface
* Relevant excerpts from the web-server and application log files.

Example of a Well Defined Issue
-------------------------------

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

.. image:: /img/community/contacts.jpg

.. include:: /include/include-links-dev.rst
   :start-after: begin