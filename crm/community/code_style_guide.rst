.. _code-standards:


Code Style Guide
================

.. contents:: :local:
    :depth: 4

Code style
----------

Code style is a set of conventions about how to write code, and if you wish to contribute code to Oro, the code styles should be observed. Below, we are outlining the code styles used in all Oro projects. This is done to help the wide-spread Oro community improve readability and maintenance of the large codebase. 

Since Oro projects are based on Symfony framework, it is recommended to follow its `standards <http://symfony.com/doc/current/contributing/index.html>`__ unless they contradict the guidelines outlined further in this guide.


PHP Code Style
^^^^^^^^^^^^^^
Standard
~~~~~~~~

`PSR-2 <http://www.php-fig.org/psr/psr-2/>`_ is considered a code standard of the PHP code style.

Default line break separator
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Default line break separator is LF (\n) - Unix and OS X style.
  
  .. note:: To eliminate issues with this requirement, it is recommended to configure IDE and always use appropriate line break separator. How to configure this in PHPStorm could be found `here <https://www.jetbrains.com/help/phpstorm/2016.3/configuring-line-separators.html>`_.

DocBlock
~~~~~~~~

Use `PHPDoc <https://en.wikipedia.org/wiki/PHPDoc>`_ approach to commenting your code. 

Class DocBlock
""""""""""""""

It is **required** to add or update a DocBlock for every class you modify or produce. Include any information that helps clarify non-obvious behavior or conditions.

Method DocBlock
"""""""""""""""

It is **required** to add or update a DocBlock for every method you modify or produce. Include the following information:

* Any information that helps clarify non-obvious behavior or conditions.

  .. note:: Description should briefly reflect the purpose and responsibility of a method. Avoid description that just duplicates the method name.

* The list of parameters, their types and descriptions (@param), and, if the method returns any value, the type and description in the @return annotation.

   For example:

   .. code-block:: php

        /**
        * The method returns status of product inventory.
        *
        * Supported values are In Stock, Out of Stock, and Discontinued.
        *
        * @param string $SKU The product SKU (unique product id).
        * 
        * @return string The inventory status of the product found by SKU.
        */

Property DocBlock
"""""""""""""""""

It is **required** to add or update a DocBlock for every property you produce or use in a new way. Include any information that helps clarify non-obvious behavior, conditions, or possible values.

.. note:: Description should briefly reflect the property purpose and data type. Avoid description that just duplicates the property name.

An example of correct DocBlock usage:

.. code-block:: php

    namespace Oro\Bundle\DataGridBundle\Datasource;
 
    use Doctrine\Common\Inflector\Inflector;
 
    use Symfony\Component\PropertyAccess\PropertyAccess;
 
    class ResultRecord implements ResultRecordInterface
    {
       /**
        * List of containers that are used in some specific way
        *
        * @var array
        */
       private $valueContainers = [];
 
        /**
         * @var array
         */
        private $entities = [];
 
        /** @var string */
        private $value = "";
 
        /**
         * @param array $containers
         */
        public function __construct($containers)
        {
            // ...
        }
 
        /**
         * Get value of property by name
         *
         * @param  string $name
         * @return string
         */
        public function getValue($name)
        {
            // ...
            return $value
        }
 
        /**
         * @return object|null
         */
        public function getRootEntity()
        {
            // ...
            return $entity
        }
    }

@deprecated usage
~~~~~~~~~~~~~~~~~

Please do not modify the existing @deprecated attributes, and do not use the code marked as @deprecated.

@todo usage
~~~~~~~~~~~

@todo is used for changes that are planned for the future by Oro developers. Please, do not modify the existing @todo attributes and do no use code marked as @todo. 

PHP code style continuous control
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

PHP code style is controlled by the  `PHP CodeSniffer tool <https://github.com/squizlabs/PHP_CodeSniffer>`_ installed on the continuous integration server according to the rules defined `in the ruleset.xml file <https://github.com/orocrm/platform/blob/master/build/phpcs.xml>`_.

Please, configure appropriate code style inspections in the IDE or run these inspections manually before creating a pull request to prevent application build from failing.


 .. note:: Information on how to enable PHP CodeSniffer inspection with the custom set of rules in the PHPStorm can be found `in PHPStorm documentation <https://www.jetbrains.com/help/phpstorm/2016.3/using-php-code-sniffer-tool.html>`_.


Php-cs-fixer usage
~~~~~~~~~~~~~~~~~~

It is recommended to use `PHP Coding Standard Fixer <http://cs.sensiolabs.org/>`_ (or on the `GitHub <https://github.com/FriendsOfPHP/PHP-CS-Fixer>`_) to keep code free from the style issues.

PHP Code Size Control
~~~~~~~~~~~~~~~~~~~~~

PHP code size is controlled by the `PHP Mess detector tool <https://phpmd.org/rules/codesize.html>`_. A ruleset for "phpmd" is located in `phmd.xml <https://github.com/orocrm/platform/blob/master/build/phpmd.xml>`_ file.

Cyclomatic complexity
"""""""""""""""""""""

.. note::  On the Oro projects, cyclomatic complexity must not exceed the limit of 15.

Cyclomatic complexity is determined by the number of decision points in a method plus one for the method entry. The decision points are 'if', 'while', 'for', and 'case labels' (see `PHPMD <https://phpmd.org/rules/codesize.html>`_). The testing strategy is to test each linearly independent path through the program; in this case, the number of test cases will equal the cyclomatic complexity of the program (see `basis path testing <http://users.csc.calpoly.edu/~jdalbey/206/Lectures/BasisPathTutorial/index.html>`_).



NPath complexity
"""""""""""""""""

.. note::  The recommended limit of the NPath complexity is 200 (the default `PHPMD <https://phpmd.org/rules/codesize.html>`_ limit).

The NPath metric computes the number of possible execution paths through a function, meaning how many “paths” there are in the flow of your code in the function. It is similar to the cyclomatic complexity but it also takes into account the nesting of conditional statements and multi-part boolean expressions. So, you should avoid long functions with a lot of (nested) if/else statements.

@SuppressWarnings
~~~~~~~~~~~~~~~~~

It is allowed to use suppress warnings annotations only in the following cases:


1. @SuppressWarnings(PHPMD.ExcessiveMethodLength) for the dataProvider in the PHPUnit tests in the install schema or data migrations.
2. @SuppressWarnings(PHPMD.TooManyMethods) for the PHPUnit test case classes in the install schema or data migrations.
3. @SuppressWarnings(PHPMD.CouplingBetweenObjects) in the install schema or data migrations.


In all other cases, usage of the @SuppressWarnings should not be used.

JavaScript Code Style
^^^^^^^^^^^^^^^^^^^^^

Standard
~~~~~~~~

`Google JavaScript Style Guide <https://google.github.io/styleguide/javascriptguide.xml>`_ is considered as code standard of the JavaScript code style.

JavaScript code style continuous control
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In Oro projects, JavaScript code style is controlled by the `JSCS <http://jscs.info/>`_ and `JSHint <http://jshint.com/>`_ tools configured according to the rules defined in the project repository in `.jshintrc <https://github.com/orocrm/platform/blob/master/build/.jshintrc>`_ and `.jscsrc <https://github.com/orocrm/platform/blob/master/build/.jscsrc>`_).

.. note::  JavaScript code style checker in PHPStorm could be enabled in "Languages & Frameworks>JavaScript>Code Quality Tools>JSCS/JSHint" and select to use configuration from .jscsrc/.jshintrc accordingly. For JSCS define path to installed node and path to jscs (it is {{your_project_root}}/vendor/oro/platform/build/node_modules/jscs). For JSHint select the version that is defined in package.json (in vendor/oro/platform/build folder of project).

To run the check manually from the command line:

- Install the required js-modules (from the project root folder).

.. code-block:: none

    npm install --prefix ./vendor/oro/platform/build/

- Execute the following command to run JSCS check:

.. code-block:: none

 ./vendor/oro/platform/build/node_modules/.bin/jscs src/*/src/*/Bundle/*Bundle/Resources/public/js/** src/*/src/*/Bundle/*Bundle/Tests/JS/** --config=./vendor/oro/platform/build/.jscsrc

- Execute the following command to run JSHint check:

.. code-block:: none

    ./vendor/oro/platform/build/node_modules/.bin/jshint src/*/src/*/Bundle/*Bundle/Resources/public/js/** src/*/src/*/Bundle/*Bundle/Tests/JS/** --config=./vendor/oro/platform/build/.jshintrc


CSS and HTML Code Style
^^^^^^^^^^^^^^^^^^^^^^^
There are no defined code styles for the CSS and HTML.

It is recommended to use same code style that is used in `Bootstrap <http://getbootstrap.com/>`_.


