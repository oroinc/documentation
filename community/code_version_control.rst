.. _code-version-control:

Code Version Control
====================

The following is a set of conventions about code version control that strives to provide the best way to communicate enough context about every committed code change to fellow developers.


Git and Tools
-------------

`Git <https://git-scm.com/>`_ is the official version control system used for the majority of the Oro projects. It allows for easy distribution of the source code and keeps each change under version control.

`GitHub <https://github.com/>`_ is our main collaborative development tool, so if you do not have an account yet, please `sign up <https://github.com/join>`_.

There is a number of tools to manage git repositories, for instance:

- CLI git tools 
- PhpStorm Git Integration plugin
- SourceTree. 
- SmartGit, to name a few.
  

Pull Request
-------------

The best way to contribute a bug fix or enhancement is to submit a `pull request`_ to `OroCRM <http://github.com/orocrm/>`_. 

Before you submit your pull request consider the following guidelines:

* Search GitHub for an open or closed Pull Request that relates to your submission. You don't want to duplicate effort.
* Please sign our `Contributor License Agreement`_ (CLA) before submitting pull requests. The CLA must be signed for any code or documentation changes to be accepted.

.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement

Commit message
---------------

The merge commit message contains the message from the author of the changes. This can help understand what the changes were about and the reasoning behind the changes. Therefore, commit messages should include a list of performed actions or changes in the code:

<Commit summary>

- <action 1>
- <action 2>
- ...
