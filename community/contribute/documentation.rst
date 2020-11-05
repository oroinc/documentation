.. _documentation-standards:

Contribute to Documentation
===========================

We use |reStructuredText| markup language to write the documentation and |Sphinx| generator to prepare it for the web publication at ``https://doc.oroinc.com/``. You can find more information about the syntax on the Sphinx website by reading |reStructuredText Primer|. The most important information is provided in the sections below.

Documentation source files are maintained in the |dedicated github repository|.

If you are willing to contribute --- you are totally welcome. The information below should help you understand the documentation structure and topic organization, useful rst directives and a simple workflow that helps quickly publish a new topic.

Before You Begin
----------------

The use of the documentation is subject to the |CC-BY-NC-SA 4.0| license.

Before submitting your documentation changes in a pull request, please sign our |Contributor License Agreement| (CLA). The CLA must be signed for any code or documentation changes to be accepted.


Fork Documentation Project
--------------------------

If you are just making a small change, you can use the **Edit this file** button directly in the GitHub UI. It will automatically create a fork of our |OroPlatform,OroCRM and OroCommerce documentation| repository and allow for the creation and submission of a new pull request with your modifications once you are done editing.

For large volume of  updates, fixes, and enhancements please use the following process: 

#. |Fork| a documentation repository.

#. |Clone| the forked repository.

#. Update your local copy of documentation (see `Update Documentation`_ for more information on the process and formatting).

#. Build and test the documentation before submitting a pull request to be sure you haven't accidentally introduced any layout or formatting issues.

  .. note::

   To build documentation, set up a local Sphinx build environment:

      * |Install PHPStorm| as the recommended IDE. Although PHPStorm is recommended, it is not the required IDE for Oro application development. If you use a different IDE, skip this step.
      * Install |pip|.
      * Install |Sphinx with Extensions for PHP and Symfony|.

   To test your changes before you commit them, run ``make html`` in the documentation folder. Ensure that ``conf.py`` (documentation build configuration file) is there. Check the generated documentation in the ``_build/html`` directory.

Update Documentation
--------------------

This section is intended to provide you with the basic information of simple text formatting using reStructuredText (reST) markup language. Just enough to update and create new documentation files in Oro documentation.

For more information, please refer to the sphinx's |reStructuredText Primer| and to the |Quick reStructuredText| by |docutils|.

The most complete information is available in the |reStructureText specifications|.

Documentation Structure and Topic Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The documentation is organized into the tree hierarchy of sections using toctree directive in the index.rst. Sections
of the same level reside in the same folder which simplifies navigation and sibling reference.

Sample file structure:

.. code-block:: none
    :linenos:

    + user:
        - index.rst
        + back-office
            - topic-1.rst
            - topic-2.rst
            - topic-3.rst
            - index.rst
        + storefront
        + img
            - create_accounts.png
            - lead_statistics.png

    + backend:
        - index.rst
        + integration
            - email.rst
            - LDAP.rst
        + api
            -firewall-listeners.rst
            -request-types.rst

    - index.rst

Basic Rst Syntax
^^^^^^^^^^^^^^^^

Headings
~~~~~~~~

Use the following markup for the headings to split your topic into sections, subsections, and more granular bits:

Use an underline with =, -, ^, ~, " to mark up the sections.

.. code-block:: none
    :linenos:

    Section 1
    =========

    Section 1.1
    -----------

    Section 1.1.1
    ^^^^^^^^^^^^^

    Section 1.1.1.1
    ~~~~~~~~~~~~~~~

    Paragraph Title
    """""""""""""""

Preview:

.. image:: /img/community/write.png

Preserve the same level of indentation for all lines of the paragraph. More information is available |here|.

Inline Markup
~~~~~~~~~~~~~

Surround the text with one asterisk (\*) for *italic* text, with two asterisks (\*\*) for **bold** text, and with double back quotes (\`\`) for ``Preformatted`` text. to use these symbols in the text without affecting the text style, escape them with the backslash (\\).

Bulleted List
~~~~~~~~~~~~~

To form a bullet list, start the line with \*, +, or \- followed by whitespace:

.. code-block:: none
    :linenos:

    * Item A
    * Item B

        - Item C
        - Item D
          
            + Item E
            + Item F

Preview:

* Item A
* Item B

    - Item C
    - Item D
          
            + Item E
            + Item F

Numbered List
~~~~~~~~~~~~~

To form a numbered list, start the line with Arabic numerals (1,2,3), upper- or lowercase alphabet letters (A,B,C, or a,b,c), upper- or lowercase Roman numerals (I, II, III, or i, ii, iii). You can automatically enumerate the list by starting the lines with a hash sign (\#).

Simple numbered list:

.. code-block:: none
    :linenos:

    1. Item A
    2. Item B

         a) Item C
         b) Item D

              i. Item E
              ii. Item F


Preview:

1. Item A
2. Item B

         a) Item C
         b) Item D

              i. Item E
              ii. Item F

Auto Enumerated List
~~~~~~~~~~~~~~~~~~~~

.. code-block:: none
    :linenos:

    1. Item A
    #. Item B

         a) Item C
         #) Item D

              i. Item E
              #. Item F

Preview:

1. Item A
#. Item B

         a) Item C
         #) Item D

              i. Item E
              #. Item F


Text Blocks
~~~~~~~~~~~

Attention Block
"""""""""""""""

Syntax in Rst: `\.\. attention:: The message text.`

Preview:

.. attention:: The message text.

Caution Block
"""""""""""""

Syntax in Rst: `\.\. caution:: The caution message.`

Preview:

.. caution:: The caution message.

Warning Block
"""""""""""""

Syntax in Rst: `\.\. warning:: The warning message.`

Preview:

.. warning:: The warning message.

Hint Block
""""""""""

Syntax in Rst: `\.\. hint:: The hint message.`

Preview:

.. hint:: The hint message.

Note Block
""""""""""

Syntax in Rst: `\.\. note:: The note message.`

Preview:

.. note:: The note message.

Tip Block
"""""""""

Syntax in Rst: `\.\. tip:: The tip message.`

Preview:

.. tip:: The tip message.

Important Block
"""""""""""""""

Syntax in Rst: `\.\. important:: The important message.`

Preview:

.. important:: The important message.


Tables
~~~~~~

**Option 1**

.. code-block:: none
    :linenos:

    +------------+------------+-----------+
    | Header 1   | Header 2   | Header 3  |
    +============+============+===========+
    | Cell 1.1   | Cell 1.2   | Cell 1.3  |
    +------------+------------+-----------+
    | Cell 2.1   | Cell 2.2   | Cell 2.3  |
    +------------+------------+-----------+

Preview:

+------------+------------+-----------+
| Header 1   | Header 2   | Header 3  |
+============+============+===========+
| Cell 1.1   | Cell 1.2   | Cell 1.3  |
+------------+------------+-----------+
| Cell 2.1   | Cell 2.2   | Cell 2.3  |
+------------+------------+-----------+


**Option 2**

.. code-block:: none
    :linenos:

    .. csv-table::
       :header: "**OroCRM Field**","**Outlook Field**"
       :widths: 20, 20

       "Subject","Subject"
       "Priority","Priority"
       "Due Date","Due Date"

Preview

    .. csv-table::
       :header: "**OroCRM Field**","**Outlook Field**"
       :widths: 20, 20

       "Subject","Subject"
       "Priority","Priority"
       "Due Date","Due Date"


File Naming Conventions
^^^^^^^^^^^^^^^^^^^^^^^

Please follow the recommendations below when naming the new documentation file:

* Use a topic-based approach (e.g., user-management-permissions-organization.rst).

* Use lowercase letters and Arabic numbers only.

* All source .rst files with more than one word in their name must be separated with a dash (-), not an underscore, to be able to form correct html links on the website (e.g., file-naming-conventions.rst).

* Avoid special symbols (/,$,#, etc).

* Save the file with .rst extension

Add a New Topic
^^^^^^^^^^^^^^^

1. Create topic contents using Restructured Text format and save it following the `File Naming Conventions`_.

2. All headers in Oro documentation must be capitalized, except for articles (a, the) unless it is the first word in the header and short prepositions (at, or, on, etc.).

3. Strive for consistency in all headers. Whenever possible, start headers with the same part of speech (nouns, verbs, etc.). This means that, for instance, if 4 of your 5 subheaders begin with a verb, make sure than the fifth header starts with a verb, too.

4. To link a topic to the global documentation table of contents:

    a) Identify the best location for the reference to your new topic in the documentation structure.
    b) Move the newly created file to the selected folder. 
    c) Append the relative document name (without the rst extension) to the toctree definition in the potential parent topic. 

For example, when we create a new topic with additional information about price list management in the *additional-pricelist-management-info.rst* file. To include it into the document structure at the **user/back-office/sales/price-lists** level, we'll update the *index.rst* file in the *user/back-office/sales/price-lists* directory like in the following example:

**Before:**

.. code-block:: none
    :linenos:

    .. toctree::
       :maxdepth: 1

       price-attributes

       price-list-management

**After:**

.. code-block:: none
    :linenos:

    .. toctree::
       :maxdepth: 1

       price-attributes

       price-list-management

       additional-pricelist-management-info

.. tip::

   If you are adding more than one topic and your new topics cover the same domain, consider grouping them into a folder.

   For better navigation, it is recommended to create a dedicated index.rst file with an overview and references to the topics in the new folder (using \.\. toctree:: directive).

   To attach your newly created group of topics into the general structure, add the reference to the index.rst file to the appropriate location in the documentation hierarchy.

   For instance, *documentation-structure-and-topic-organization.rst* and *file-naming-conventions.rst* can be saved to the *community/contribute* folder, can be added to the toctree of the dedicated *community/contribute/index.rst*.

   Finally, *community/contribute/index.rst* can be added into the *community/index.rst* toctree to attach the newly created files into the global documentation structure.

Internal and External Links
---------------------------

Internal Links
^^^^^^^^^^^^^^

**Example 1**

RST format supports referencing across documentation. To refer to any section of the documentation, you need to create an anchor (label) at the top of this section and refer to it explicitly.

Note the punctuation characters when linking to a certain file, section, or website. Otherwise, the documentation will not be built.

This way is quite useful as it works even if files get renamed.

.. code-block:: none
    :linenos:

    .. _anchor-name:

    Quotes
    ======

    See the :ref:`Quotes <anchor-name>` section for more details.


**Example 2**

To create a link to a header in the same file:

.. code-block:: none
    :linenos:

    ...

    Section About the Elephants
    ===========================

    Here goes detailed information about the elephants.

    Section About the Mice
    ======================

    We have no info about the mice at the moment, but you can entertain yourself with some reading in `Section About the Elephants`_.

External Links
^^^^^^^^^^^^^^

At Oro, we avoid formatting external links in typical RST manner (e.g., `GitHub <https://github.com/>`_), as this does not allow links to open in a new tab.  Therefore, the rule for adding external links is as follows:

* Put the word/phrase that will serve as a link in vertical bars

  .. code-block:: none
      :linenos:

      |GDPR portal|

* Add the following link to the bottom of your documentation page:

  .. code-block:: none
      :linenos:

      .. include:: /include/include-links.rst
         :start-after: begin

* In the include-links.rst file, embed the link into html with the target="_blank" parameter into the required documentation component section (Cloud Documentation, Dev Documentation, User Documentation):

  .. code-block:: none
      :linenos:

      .. |GDPR portal| raw:: html

         <a href="https://www.eugdpr.org/" target="_blank">GDPR portal</a>


Submit Documentation Updates
----------------------------

Once you are ready, create a pull request in the |Oro documentation| repository with changes from your forked repository. See :ref:`Code Version Control <code-version-control>` for more information on using repository.

After documentation review, your changes will be merged to the Oro documentation and will be published on the Oro website.


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