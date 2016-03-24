.. _contributing-to-oroplatform-orocommerce-orocrm:

***************************************************
Contributing to OroPlatform, OroCommerce and OroCRM
***************************************************

We'd love for you to contribute to our source code and documentation to make our products even better than they are today!
Here are the guidelines we'd like you to follow:

Submitting a Question
=====================

If you have questions about how to use, configure, extend or customize OroPlatform, OroCommerce or OroCRM, please direct these to our community forums :

* `OroPlatform community forum <http://www.orocrm.com/forums/forum/oro-platform>`_
* `OroCommerce community forum <http://www.orocommerce.com/forums/forum/orocommerce>`_
* `OroCRM community forum <http://www.orocrm.com/forums/forum/orocrm>`_

Submitting an Issue
===================

We are using GitHub as a bug tracker. If you find a bug in the source code or a mistake in the documentation,
you can help us by submitting an issue to our GitHub repository.

Before you submit your issue search on GitHub, maybe the same issue has already been reported.

* `OroPlatform issue tracker <https://github.com/orocrm/platform/issues?q=>`_
* `OroCommerce issue tracker <https://github.com/orocommerce/orocommerce/issues?q=>`_
* `OroCRM issue tracker <https://github.com/orocrm/crm/issues?q=>`_

.. caution::

    **Reporting security issues**

    Responsible disclosure is the industry best practice, and we ask you to use the following procedure to report security issues - :ref:`reporting-security-issues`. Please never post security issues publicly!

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

Here is an example of a well defined issue: https://github.com/orocrm/platform/issues/410

Submitting a Pull Request
=========================

The best way to contribute a bug fix is to submit a `pull request`_.

Before you submit your pull request consider the following guidelines:

* Search GitHub for an open or closed Pull Request that relates to your submission. You don't want to duplicate effort.
* Please sign our `Contributor License Agreement`_ (CLA) before submitting pull requests. The CLA must be signed for any code or documentation changes to be accepted.

Improving Documentation
=======================

We use `reStructuredText`_ markup language to write the documentation and `Sphinx`_ generator to prepare it for the web publication at http://www.orocrm.com/documentation. You can find more information about the syntax on the Sphinx website by reading `reStructuredText Primer`_.

If you're just making a small change, you can use the "Edit this file" button directly in the GitHub UI. It will automatically create a fork of our documentation repository and allow for the creation and submission of a new pull request with your modifications once you are done editing:

* `OroPlatform and OroCRM documentation <https://github.com/orocrm/documentation>`_
* `OroCommerce documentation <https://github.com/orocommerce/documentation>`_

For large fixes, please `fork <https://help.github.com/articles/fork-a-repo>`_ a documentation repository, `clone <https://help.github.com/articles/cloning-a-repository/>`_ it, build and test the documentation before submitting the pull request to be sure you haven't accidentally introduced any layout or formatting issues. To test your changes before you commit them, you have to set up a Sphinx environment locally:

* Install `Sphinx`_;
* Install the required Sphinx extensions: ``git submodule update --init``;
* Run ``make html`` and check the generated documentation in the ``_build`` directory.

Signing a Contributor License Agreement
=======================================

In order to accept your pull request, we need you to sign the `Contributor License Agreement`_ (CLA). You only need to do this once, so if you've done this for any of our open source projects, you're good to go with all of them. If you are submitting a pull request for the first time, our friendly *orocla* robot will automatically add a reminder to your pull request.

.. _pull request:   https://help.github.com/articles/using-pull-requests
.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement
.. _reStructuredText:        http://docutils.sourceforge.net/rst.html
.. _reStructuredText Primer: http://sphinx-doc.org/rest.html
.. _Sphinx:                  http://sphinx-doc.org/
