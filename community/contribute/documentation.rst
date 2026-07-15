.. _documentation-standards:

Contribute to Documentation
===========================

Documentation source files are maintained in the |dedicated github repository|.

You are welcome to contribute to the documentation.

This guide explains the documentation contribution workflow. Detailed guidance on contributing to and writing documentation is available in the following files located in the root of the ``documentation`` directory of the repository:

* |CONTRIBUTING.md| --- Documentation repository structure, contribution workflow, file naming conventions, and documentation organization.
* |STYLE-GUIDE.md| --- Writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
* |RST-SYNTAX.md| --- reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.

Before You Begin
----------------

The use of the documentation is subject to the |CC-BY-NC-SA 4.0| license.

Before submitting your documentation changes in a pull request, please sign our |Contributor License Agreement| (CLA). The CLA must be signed for any code or documentation changes to be accepted.

Before making changes, review the guidance in |CONTRIBUTING.md|, |STYLE-GUIDE.md|, and |RST-SYNTAX.md|.

Fork Documentation Project
--------------------------

If you are just making a small change, you can use the **Edit this file** button directly in the GitHub UI. It will automatically create a fork of our |Oro documentation| repository and allow for the creation and submission of a new pull request with your modifications once you are done editing.

For large volumes of updates, fixes, and enhancements, please use the following process:

#. |Fork| the documentation repository.

#. |Clone| your forked repository.

#. Update your local copy of the documentation following the guidance in |CONTRIBUTING.md|, |STYLE-GUIDE.md|, and |RST-SYNTAX.md|.

#. Build and test the documentation before submitting a pull request to be sure you have not accidentally introduced any layout or formatting issues.

   - Set up a local build environment by installing |Docker|.
   - Run the following command to generate the documentation in ``./_build/html`` and create a Docker image:

     .. code-block:: bash

        docker bake --load

     .. hint::

        By default, this command builds only the current branch. To build documentation as it appears on the website, including version selection in the index, set the appropriate variables ``MAINTENANCE_BRANCHES=5.1|6.0|6.1|7.0|master``. To generate the documentation in **Markdown** format instead of HTML, set the ``BUILDER="markdown"`` variable.

Submit Documentation Updates
----------------------------

Once you are ready, create a pull request in the |Oro documentation| repository with changes from your forked repository. See :ref:`Code Version Control <code-version-control>` for more information on using the repository.

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