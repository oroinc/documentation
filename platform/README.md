# OroPlatform Documentation

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](./LICENSE) license.

## Build Documentation in Local Environment

In Oro solutions, documentation uses [reStructuredText](http://docutils.sourceforge.net/rst.html) format and
could be built with [Sphinx](http://sphinx-doc.org/):

1. [Install pip](https://pip.pypa.io/en/stable/installing/).
2. Install [Sphinx with Extensions for PHP and Symfony](https://github.com/fabpot/sphinx-php) using the following command:
   `pip install --upgrade -q -r requirements.txt`
3. Run `make html` in documentation folder. Ensure that `conf.py` (documentation build configuration file) is there.


Documentation will be available in `_build/html` folder.
