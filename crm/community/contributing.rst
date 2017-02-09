.. _contributing:

Contributing to OroPlatform and OroCRM
======================================

.. contents:: :local:
    :depth: 3

We would love for you to contribute to our source code and documentation to make our products even better than they are today! The following guidelines and recommendations help synchronize the community actions and provide a blueprint for seamless and non-intrusive collaboration.


Submitting a Question
---------------------

If you have questions about how to use, configure, extend or customize OroPlatform, OroCommerce or OroCRM, please direct these to our community forums:

* `OroPlatform community forum <http://www.orocrm.com/forums/forum/oro-platform>`_
* `OroCommerce community forum <http://www.orocommerce.com/forums/forum/orocommerce>`_
* `OroCRM community forum <http://www.orocrm.com/forums/forum/orocrm>`_

Submitting a Bug
----------------

We are using GitHub as a bug tracker. If you find a bug in the source code or a mistake in the documentation,
you can help us by submitting an issue to our GitHub repository.

Before Submitting a Bug
^^^^^^^^^^^^^^^^^^^^^^^
Before you submit your issue search on GitHub, check whether the same issue has already been reported.

* `OroPlatform issue tracker <https://github.com/orocrm/platform/issues?q=>`_
* `OroCommerce issue tracker <https://github.com/orocommerce/orocommerce/issues?q=>`_
* `OroCRM issue tracker <https://github.com/orocrm/crm/issues?q=>`_

.. caution::
    To report security issues, we kindly ask you to follow the steps, described in the :ref:`Reporting Security Issues section <reporting-security-issues>`. **Please, never post security issues publicly!**

Basic Rules
^^^^^^^^^^^

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
* A screenshot or multiple screenshots of the user interface
* Relevant excerpts from the web-server and application log files.

Example of a well defined issue
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**Title**: "Inconsistent display of address fields when adding address to the Contact".

**Description**: While adding a new address to the contact, some fields in the new address form become mandatory, while all the fields are optional in the initial address form.

**Steps to reproduce**: 

  - Navigate to *Customers>Contacts*, select any Contact and click *Edit* grid action icon.
  - Proceed to *Addresses* section of Contact Information page and click *+Add* button.
  - A new form will emerge, compare the initial form and the new one.
  
**Expected Result**: The new form should be the same as the initial one.

**Actual Result**: Country, street, city and Zip/Postal Code fields are mandatory in the new form.

**Environment**: OroCRM 1.10.8, Win10 64x, FireFox 50.1.0

**Screenshot**:

|

.. image:: ./img/contributing/contacts.jpg

|


Signing a Contributor License Agreement
---------------------------------------

In order to accept your pull request, we need you to sign the `Contributor License Agreement`_ (CLA). You only need to do this once, so if you've done this for any of our open source projects, you're good to go with all of them. If you are submitting a pull request for the first time, our friendly *orocla* robot will automatically add a reminder to your pull request.

.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement

Code Version Control
--------------------

The following is a set of conventions about code version control that strives to provide the best way to communicate enough context about every committed code change to fellow developers.
These code version control conventions should be used in all Oro projects, except for the projects that adopted some other conventions.

Git and Tools
^^^^^^^^^^^^^

`Git <https://git-scm.com/>`_ is the official version control system used for the majority of the Oro projects. It allows for easy distribution of the source code and keeps each change under version control.

`GitHub <https://github.com/>`_ is our main collaborative development tool, so if you do not have an account yet, please `sign up <https://github.com/join>`_.

There is a number of tools to manage git repositories, for instance:

- CLI git tools 
- PhpStorm Git Integration plugin
- SourceTree. 
- SmartGit, to name a few.
  

Pull Request
^^^^^^^^^^^^

The best way to contribute a bug fix or enhancement is to submit a `pull request`_ to `OroCRM <http://github.com/orocrm/>`_. 

Before you submit your pull request consider the following guidelines:

* Search GitHub for an open or closed Pull Request that relates to your submission. You don't want to duplicate effort.
* Please sign our `Contributor License Agreement`_ (CLA) before submitting pull requests. The CLA must be signed for any code or documentation changes to be accepted.

.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement

Commit message
^^^^^^^^^^^^^^

The merge commit message contains the message from the author of the changes. This can help understand what the changes were about and the reasoning behind the changes. Therefore, commit messages should include a list of performed actions or changes in the code:

<Commit summary>

- <action 1>
- <action 2>
- ...
