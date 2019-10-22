Report Issues
=============

.. contents:: :local:
   :depth: 1

Report an Issue
---------------

.. _doc--community--issue-report:

We are using GitHub as a bug tracker. If you find a bug in the source code or a mistake in the documentation, you can help us by submitting an issue to our GitHub repository.

Before you submit your issue search on GitHub, make sure that the same issue hasn't already been reported.

* |OroPlatform issue tracker|
* |OroCommerce issue tracker|
* |OroCRM issue tracker|

.. caution::

    **Reporting security issues**

    Responsible disclosure is the industry best practice, and we ask you to use :ref:`this procedure <reporting-security-issues>` to report security issues. Please never post security issues publicly!

Best Practice
~~~~~~~~~~~~~

Providing the following information will increase the chances of your issue being dealt with quickly:

* Clear summary of an issue in its title.
* Unambiguous set of steps describing how to reproduce the issue.
* Details about your environment:
    * Version of the product (is it master? the latest stable version?)
    * Extensions you have installed and customizations, if any
    * Server operating system (Windows, Ubuntu, CentOS, RHEL, Fedora, other Linux) version and bitness (32-bit, 64-bit)
    * PHP version
    * Database (MySQL, PostgreSQL) version
    * Web-server (Apache, Nginx) version and how PHP is set up (as a module, or PHP-FPM)
    * Client operating system (Windows, Linux, MacOS, iOS, Android) version
    * Client browser and version
* A screenshot or multiple screenshots of the user interface
* Relevant excerpts from the web-server and application log files.

Example of a Well Defined Issue
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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

.. _reporting-security-issues:

Report a Security Issue
-----------------------

We appreciate your concern
~~~~~~~~~~~~~~~~~~~~~~~~~~

We recognize how important it is to help protect your privacy and security. As a company, not only do we have a vested interest in maintaining the trust you place in us and our products, but also a deep desire to see the Internet remain as safe as possible for us all.

So, needless to say, we take security issues very seriously.

Spotting major security issues
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you believe you have discovered a vulnerability in OroPlatform, OroCRM or OroCommerce or have a security incident to report, please contact our dedicated email support security@oroinc.com

When properly notified of legitimate issues, we will do our best to acknowledge your emailed report, assign resources to investigate the issue and fix potential problems as quickly as possible.

Responsible disclosure
~~~~~~~~~~~~~~~~~~~~~~

Responsible disclosure is the industry best practice, and we recommend it as a procedure to anyone researching security vulnerabilities. It allows individuals to notify companies of any security threats before going public with the information. This gives software vendors like us a chance to resolve the problem before the criminally-minded become aware of it.

We will not disclose security issues until our internal investigation is finished, but we will work with you to ensure we fully understand the issue. Once the issue is resolved, we will post a security update along with a thanks and credit for the discovery. We ask for your patience while we make sure all users of our products are protected.

Report a Translation Issue
--------------------------

.. begin_report_translation_issue

In order to report a translation-related issue, please use the |contact| link in the **Owner** section on the |OroCommerce project| in Crowdin.

Please do not hesitate to contact us from Crowdin if:

* Your translation has been marked as approved for over one day but has not appeared in the Oro application

* Your translation is still not approved after more than seven days of review.

* You would like to help proofread a target language.

* You have any other questions and issues related to translations that are not covered in Oro documentation and the Crowdin tutorial.

.. finish_report_translation_issue

.. _report-doc-issue:

Report a Documentation Issue
----------------------------

To report an issue in the Oro documentation, file a suggestion for improvement, or share your feedback, please, send an email to `doc@oroinc.com <mailto:doc@oroinc.com>`_.

.. note:: You are welcome to contribute to the Oro documentation. See more information :ref:`here <documentation-standards>`.

.. include:: /include/include-links.rst
   :start-after: begin