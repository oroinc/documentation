.. _documentation-standards:

Documentation Style Guide
==========================

.. contents:: :local:
    :depth: 3

We use `reStructuredText`_ markup language to write the documentation and `Sphinx`_ generator to prepare it for the web publication at http://www.oroinc.com/doc/orocrm. You can find more information about the syntax on the Sphinx website by reading `reStructuredText Primer`_. The most important information is provided in the sections below.

Documentation source files are maintained in the dedicated `github repository <https://github.com/orocrm/documentation>`_.

If you are willing to contribute - you are totally welcome. The information below should help you understand the documentation structure and topic organization, useful rst directives and a simple workflow that helps quickly publish a new topic.

.. important:: Before submitting your documentation changes in a pull request, please sign our `Contributor License Agreement`_ (CLA). The CLA must be signed for any code or documentation changes to be accepted.

.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement



Fork Documentation Project
--------------------------

If you're just making a small change, you can use the :guilabel:`Edit this file` button directly in the GitHub UI. It will automatically create a fork of our documentation repository and allow for the creation and submission of a new pull request with your modifications once you are done editing:

* `OroPlatform and OroCRM documentation <https://github.com/orocrm/documentation>`_
* `OroCommerce documentation <https://github.com/orocommerce/documentation>`_

For large volume of  updates, fixes, and enhancements please use the following process: 

#. `Fork <https://help.github.com/articles/fork-a-repo>`_ a documentation repository.

#. `Clone <https://help.github.com/articles/cloning-a-repository/>`_ the forked repository.

#. Update your local copy of documentation (see `Update Documentation`_ for more information on the process and formatting).

#. Build and test the documentation before submitting a pull request to be sure you haven't accidentally introduced any layout or formatting issues.

  .. note::

   To build Sphinx documentation, set up a local Sphinx build environment:

      * Install `Sphinx`_.        
      * Install the required Sphinx extensions: ``git submodule update --init``.

   To test your changes before you commit them, run ``make html`` and check the generated documentation in the ``_build`` directory.

.. _reStructuredText:        http://docutils.sourceforge.net/rst.html
.. _Sphinx:                  http://sphinx-doc.org/

Update Documentation
--------------------

This section is intended to provide you with the basic information of simple text formatting using reStructuredText (reST) markup language. Just enough to update and create new documentation files in OroCRM documentation.

For more information, please refer to the sphinx's `reStructuredText Primer`_ and to the `Quick reStructuredText <http://docutils.sourceforge.net/docs/user/rst/quickref.html>`_ by `docutils <http://docutils.sourceforge.net>`_.

The most complete information is available in the `reStructureText specificaion <http://docutils.sourceforge.net/docs/ref/rst/restructuredtext.html>`_.

.. _reStructuredText Primer: http://sphinx-doc.org/rest.html

Documentation Structure and Topic Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In OroCRM, documentation is organized into the tree hierarchy of sections using toctree directive in the index.rst. Sections of the same level reside in the same folder which simplifies navigation and sibling reference.

Sample file structure:

.. code-block:: none

    + user-guide:
        + img:
            - Demo.png
        - topic-1.rst
        - topic-2.rst
        - topic-3.rst
        - index.rst
    + admin-guide:
        - index.rst
        + integration
            - email.rst
            - LDAP.rst
    + img:
        - Architecture.png
    - index.rst
      
Basic Rst Syntax
^^^^^^^^^^^^^^^^

Headings
~~~~~~~~

Use the following markup for the headings to split your topic into sections, subsections, and more granular bits:

Use an underline with =, -, ^, ~, " to mark up the sections.

.. code-block:: none

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

|

.. image:: ./img/contributing/write.png

|

Preserve the same level of indentation for all lines of the paragraph. More information is available `here <http://docutils.sourceforge.net/docs/ref/rst/restructuredtext.html#paragraphs>`_.

Inline Markup
~~~~~~~~~~~~~

Surround the text with one asterisk (\*) for *italic* text, with two asterisks (\*\*) for **bold** text, and with double back quotes (\`\`) for ``Preformatted`` text. to use these symbols in the text without affecting the text style, escape them with the backslash (\\).

Bulleted List
~~~~~~~~~~~~~

To form a bullet list, start the line with \*, +, or \- followed by whitespace:

.. code-block:: none

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

Auto enumerated List
~~~~~~~~~~~~~~~~~~~~

.. code-block:: none

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

.. code-block:: none

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


File Naming Conventions
^^^^^^^^^^^^^^^^^^^^^^^

Please follow the recommendations below when naming the new documenation file:

* Use a topic-based approach (e.g. assign_user_management_permissions_to_the_organization.rst).

* Use lowercase letters and Arabic numbers only.

* Replace whitespace symbols with underscores (e.g. file_naming_onventions.rst).

* Avoid special symbols (/,$,#, etc).

* Save the file with .rst extension

Add a New Topic
^^^^^^^^^^^^^^^

1. Create topic contents using Restructured Text format and save it following the `File Naming Conventions`_.

2. To link a topic to the global documentation table of contents:

    a) Identify the best location for the reference to your new topic in the documentation structure.
    b) Move the newly created file to the selected folder. 
    c) Append the relative document name (without the rst extension) to the toctree definition in the potential parent topic. 

For example, when we create a new topic with additional information about price list management in the *additional_pricelist_management_info.rst* file. To include it into the document structure at the **user-guide/pricing** level, we'll update the *index.rst* file in the *user-guide/pricing* directory like in the following example:

**Before:**

.. code-block:: none

    .. toctree::
       :maxdepth: 1

       price_attributes

       price_list_management

**After:**

.. code-block:: none

    .. toctree::
       :maxdepth: 1

       price_attributes

       price_list_management

       additional_pricelist_management_info

.. tip::
   If your are adding more than one topic and your new topics cover the same domain, consider grouping them into a folder. For better navigation, it is recommended to create a dedicated index.rst file with an overview and references to the topics in the new folder (using \.\. toctree:: directive). To attach your newly created group of topics into the general structure, add the reference to the index.rst to the appropriate loaction in the documetnation hierarchy (e.g. *documentation-structure-and-topic-organization.rst* and *file-naming-conventions.rst* may be saved to the *user-guide/writing* folder, may be added to the toctree of the dedicated *user-guide/writing/index.rst*. Finally, *user-guide/writing/index.rst* may be added into the *user-guide/index.rst* toctree to attach the newly created files into the global documentation structure).



.. _pull request:   https://help.github.com/articles/using-pull-requests
.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement
.. _reStructuredText:        http://docutils.sourceforge.net/rst.html
.. _reStructuredText Primer: http://sphinx-doc.org/rest.html
.. _Sphinx:                  http://sphinx-doc.org/
