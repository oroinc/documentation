.. _code-version-control:

Code Version Control
====================

.. contents:: :local:
    :depth: 3

The following is a set of conventions about code version control that strives to provide the best way to communicate
enough context about every committed code change to fellow developers. These code version control conventions should be used in all Oro projects, except for the projects that adopted some other conventions.


Git and Tools
-------------

`Git <https://git-scm.com/>`_ is the official version control system used for the majority of the Oro projects. It allows for easy distribution of the source code and keeps each change under version control.

`GitHub <https://github.com/>`_ is our main collaborative development tool, so if you do not have an account yet, please `sign up <https://github.com/join>`_.

There is a number of tools to manage git repositories, for instance:

- CLI git tools
- PhpStorm Git Integration plugin
- SourceTree
- SmartGit, to name a few


Submit a Pull Request
---------------------

The best way to contribute a bug fix or enhancement is to submit a pull request to the `OroCommerce <http://github.com/orocommerce/application>`_ repository on GitHub.

Before you submit your pull request consider the following guidelines:

* Search GitHub for an open or closed pull request that relates to your submission. You do not want to duplicate effort.
* Please sign our :ref:`Contributor License Agreement <contributing--cla>` (CLA) before submitting pull requests. The CLA must be signed for any code or documentation changes to be accepted.

Add a Commit Message
--------------------

The merge commit message contains the message from the author of the changes. This can help understand what the changes were about and the reasoning behind the changes. Therefore, commit messages should include a list of performed actions or changes in the code:

<Commit summary>

- <action 1>
- <action 2>
- <action 3>
- ...

See Also
--------

:ref:`Code Style <doc--community--code-style>`

:ref:`Set Up a Development Environment <doc--dev-env-best-practices>`

:ref:`Contribute to Translations <doc--community--ui-translations>`

:ref:`Contribute to Documentation <documentation-standards>`

:ref:`Report an Issue <doc--community--issue-report>`

:ref:`Report a Security Issue <reporting-security-issues>`

:ref:`Contact Community <doc--community--contact-community>`

:ref:`Release Process <doc--community--release>`