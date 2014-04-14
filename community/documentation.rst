Writing Documentation
=====================

Although an Open Source Project allows developers to gain insight into all execution flows, and actual implementation
can be analyzed and profiled by looking at the source code, it might not be enough to explain the implementation high-level
vision, all use cases and the thought behind the architecture. We strongly believe that proper documentation along side
with the source-code can help with adoption and raise the quality of implementations as well as save time for developers
learning the platform. We are asking our community to help in the effort of documenting the Oro Platform and making it a
stronger open-source project.


Documentation Format
--------------------

The Oro documentation uses `reStructuredText`_ markup language and `Sphinx`_ generator for web publishing.
You can find more information about the syntax on the Sphinx website by reading `reStructuredText Primer`_.

Documentation Source
--------------------

In order to start contributing to the Oro documentation please `fork`_ platform-docs repository:

.. code-block:: text

    https://github.com/orocrm/platform-docs

Clone the repository:

.. code-block:: bash

    $ git clone git://github.com/YOURUSERNAME/platform-docs.git

And create a branch:

.. code-block:: bash

    $ git checkout -b my_improvement_or_feature

Do all your changes directly in this branch and push changes to GitHub. After
this you can simply submit a `pull request`_  to us and your changes will
be reviewed and included into the next documentation release.

.. _reStructuredText:        http://docutils.sourceforge.net/rst.html
.. _Sphinx:                  http://sphinx-doc.org/
.. _reStructuredText Primer: http://sphinx-doc.org/rest.html
.. _`fork`:                  https://help.github.com/articles/fork-a-repo
.. _`pull request`:          https://help.github.com/articles/using-pull-requests
