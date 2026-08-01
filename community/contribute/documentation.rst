.. _documentation-standards:

Contribute to Documentation
===========================

You are welcome to contribute to the documentation.

The documentation source files are maintained in the |dedicated github repository|.

This guide explains the documentation contribution workflow. Detailed guidance on contributing to and writing documentation is available in the following files located in the root of the ``documentation`` directory of the repository:

* |CONTRIBUTING.md| --- Documentation repository structure, contribution workflow, file naming conventions, and documentation organization.
* |STYLE-GUIDE.md| --- Writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
* |RST-SYNTAX.md| --- reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.
* |BUILD.md| --- Docker and local builds, multi-version and Markdown output, and a fast syntax check of individual files.

Before You Begin
----------------

The use of the documentation is subject to the |CC-BY-NC-SA 4.0| license.

Sign the |Contributor License Agreement| (CLA) before you submit a pull request. The CLA must be signed for any code or documentation changes to be accepted.

Before making changes, review the guidance in |CONTRIBUTING.md|, |STYLE-GUIDE.md|, |RST-SYNTAX.md|, and |BUILD.md|.

Fork Documentation Project
--------------------------

If you are making a small change, use the **Edit this file** button in the GitHub UI. It creates a fork of the |Oro documentation| repository and lets you create and submit a pull request with your modifications once you are done editing.

For large volumes of updates, fixes, and enhancements, use the following process:

#. |Fork| the documentation repository.

#. |Clone| your forked repository.

#. Update your local copy of the documentation following the guidance in |CONTRIBUTING.md|, |STYLE-GUIDE.md|, and |RST-SYNTAX.md|.

#. Build and test the documentation before submitting a pull request to make sure you have not introduced any layout or formatting issues.

   - Set up a local build environment by installing |Docker|.
   - Run the following command to generate the documentation in ``./_build/html`` and create a Docker image:

     .. code-block:: bash

        docker bake --load

     .. hint::

        This command builds the branch you are working on, which is what you need to check your changes.

     See |BUILD.md| for local builds without Docker, a fast syntax check of individual files, and the options used to build the whole documentation website.

Submit Documentation Updates
----------------------------

When your changes are ready, create a pull request in the |Oro documentation| repository with changes from your forked repository. See :ref:`Code Version Control <code-version-control>` for more information on using the repository.

If your pull request contains more than one commit, keep the history linear and give each commit a clear, descriptive message that explains what it changes. Rebase your branch on the base branch instead of merging the base branch into it, and squash intermediate commits such as "fix" or "review comments" into the commit they belong to.

After documentation review, your changes will be merged into the Oro documentation and published on the documentation website.


.. admonition:: Business Tip

   Looking for more information on the difference between B2C and |B2B eCommerce|? Our in-depth guide covers this and more.


**See Also**

* :ref:`Version Control <code-version-control>`

* :ref:`Code Style <doc--community--code-style>`

* :ref:`Set Up a Development Environment <doc--dev-env-best-practices>`

* :ref:`Contribute to Translations <doc--community--ui-translations>`

* :ref:`Report an Issue <doc--community--issue-report>`

* :ref:`Report a Security Issue <reporting-security-issues>`

* :ref:`Contact Community <doc--community--contact-community>`

* :ref:`Release Process <doc--community--release>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin