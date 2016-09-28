# Oro Documentation

Oro documentation explains how to develop business application in easy and extendable way.
The use of the documentation is subject to the [CC-BY-NC-SA 4.0](./LICENSE) license.

Documentation is published at https://www.orocrm.com/documentation

## Documentation Structure

### [The Oro Book](https://www.orocrm.com/documentation/index/current/book)

Overview of Platform architecture, design and key features.
This section will help to understand better platform design and technical details.

### [The Oro Cookbook](https://www.orocrm.com/documentation/index/current/cookbook)

Developer guidance to specific features and implementations, collection of "How to" articles that allow
to achieve result in quick and right way without going deep into technical details.

### [User Guide](https://www.orocrm.com/documentation/index/current/user-guide)

End user oriented documentation that explains how to administer and configure platform features.

### [Community Guide](https://www.orocrm.com/documentation/index/current/community)

Learn about our development process and how you can contribute to the Oro Platform.

## Build Documentation in Local Environment

In Oro solutions, documentation uses [reStructuredText](http://docutils.sourceforge.net/rst.html) format and
could be built with [Sphinx](http://sphinx-doc.org/):

1. [Install pip](https://pip.pypa.io/en/stable/installing/).
2. Install [Sphinx with Extensions for PHP and Symfony](https://github.com/fabpot/sphinx-php) using the following command:
`pip install sphinx~=1.3.0 git+https://github.com/fabpot/sphinx-php.git`.
3. Run `make html` in documentation folder. Ensure that `conf.py` (documentation build configuration file) is there.

Documentation will be available in `_build/html` folder.
