Contributing to Oro Source Code
===============================

We'd love for you to contribute to a free OroCommerce Community Edition open source code and related documentation. The following guidelines and recommendations help synchronize the community actions and provide a blueprint for seamless and non-intrusive collaboration.

Code Version Control
--------------------

The following is a set of conventions about code version control that strives to provide the best way to communicate enough context about every committed code change to fellow developers.
These code version control conventions should be used in all Oro projects, except for the projects that adopted some other conventions.

Git and Tools
^^^^^^^^^^^^^

`Git <https://git-scm.com/>`_ is the official version control system used for the majority of the Oro projects. It allows for easy distribution of the source code and keeps each change under version control.

`GitHub <https://github.com/>`_ is our main collaborative development tool, so if you do not have an account yet, please `sign up <https://github.com/join>`_.

There is a number of tools to manage git repositories, for instance:

- CLI git tools 
- PhpStorm Git Integration plugin
- SourceTree. 
- SmartGit, to name a few.


Code Style
----------

Code style is a set of conventions about how to write code. It is introduced for easier understanding of the large codebase by the wide-spread Oro community.

The following code styles are used in all Oro projects, except for projects based on the frameworks, libraries or CMS where other conventions have been adopted.

PHP Code Style
^^^^^^^^^^^^^^

**Standard**

PSR-2 is considered a code standard of the PHP code style.

**Default line break separator**


Default line break separator is LF (\n) - Unix and OS X style.
  
  .. note:: To eliminate issues with this requirement, it is recommended to configure IDE and always use appropriate line break separator. How to configure this in PHPStorm could be found `here <https://www.jetbrains.com/help/phpstorm/2016.3/configuring-line-separators.html>`_

**DocBlock**

Use `PHPDoc <https://en.wikipedia.org/wiki/PHPDoc>`_ approach to commenting your code. 

**Class DocBlock**

It is **required** to add or update a DocBlock for every class you modify or produce. Include any information that helps clarify non-obvious behavior or conditions.

**Method DocBlock**

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
        * 
        */

**Property DocBlock**

It is **required** to add or update a DocBlock for every property you produce or use in a new way. Include any information that helps clarify non-obvious behavior, conditions, or possible values.

.. note:: Description should briefly reflect the property purpose and data type. Avoid description that just duplicates the property name.

**DocBlock Sample**

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

**\@deprecated usage**


Elements that will be removed in future version of the product must be marked as @deprecated.

Comment with deprecation details is **optional**.

The following is an example of @deprecated usage:

.. code-block:: php

    class ResultRecord
    {
        /**
        * @deprecated deprecated since version 2.0
        */
        private $valueContainers = [];
 
        //....
    }
  
 
    /**
     * @deprecated
     */
    class ResultRecord
    {
        //....
    {

**\@todo usage**


@todo should be used for changes that are planned for the future (e.g. *The method may be enhanced to handle more granular data validation*).

.. note:: @todo provide clear description

**Do not import classes from root namespace**

Classes from the root namespace should not be imported.

Import internal PHP classes example:

.. code-block:: php

    // incorrect
    use DateTime;
    $date = new DateTime();
 
    // correct
    $date = new \DateTime();

**PHP code style continuous control**

PHP code style is controlled by the  `PHP CodeSniffer tool <https://github.com/squizlabs/PHP_CodeSniffer>`_ installed on the continuous integration server according to the rules defined `in the ruleset.xml file <https://github.com/orocrm/webinar-application/blob/master/ruleset.xml>`_.

It is highly recommended for the developers to configure appropriate code style inspections in the IDE or run these inspections manually before merge changes to the master branch to prevent failing of the build that checks code standards.

 .. note:: Information on how to enable PHP CodeSniffer inspection with the custom set of rules in the PHPStorm can be found `here, in PHPStorm documentation <https://www.jetbrains.com/help/phpstorm/2016.3/using-php-code-sniffer-tool.html>`_.

**PHP mess detector**

To automatically control code, the quality detector is used, in addition to code style detector tool. `PHP Mess Detector (PHPMD) <http://phpmd.org/>`_, is a tool which can check PHP source code for potential problems. It can detect possible bugs, sub-optimal code, unused parameters, and helps to follow `SOLID <https://en.wikipedia.org/wiki/SOLID_%28object-oriented_design%29>`_ principles. In addition to these, PHPMD contains several rules that check for code complexity and can tell if the code could be refactored to improve future maintenance efforts.

**Cyclomatic complexity**

.. note:: On the Oro projects, cyclomatic complexity MUST NOT exceed the limit of 15.

Cyclomatic complexity is determined by the number of decision points in a method plus one for the method entry. The decision points are 'if', 'while', 'for', and 'case labels' (see `PHPMD <https://phpmd.org/rules/codesize.html>`_). The testing strategy is to test each linearly independent path through the program; in this case, the number of test cases will equal the cyclomatic complexity of the program (see `basis path testing <http://users.csc.calpoly.edu/~jdalbey/206/Lectures/BasisPathTutorial/index.html>`_).

There are many good reasons to limit cyclomatic complexity. Overly complex modules are more prone to error, harder to understand, test and modify. Deliberately limiting complexity at all stages of software development, for example as a departmental standard, helps avoid the pitfalls associated with high complexity software. But there were occasional reasons for going beyond the agreed-upon limit. For example, Thomas McCabe originally recommended exempting modules consisting of single multi-way decision (“switch” or “case”) statements from the complexity limit. And suggested the most effective policy: “For each module, either limit cyclomatic complexity to 10 (as discussed earlier, an organization can substitute a similar number), or provide a written explanation of why the limit was exceeded.” (see `Structured Testing: A Testing Methodology Using the Cyclomatic Complexity Metric <http://www.mccabe.com/pdf/mccabe-nist235r.pdf>`_).

Cyclomatic complexity limits suggestions are the following: 

- PHP: 1-4 is low complexity, 5-7 indicates moderate complexity, 8-10 is high complexity, and 11+ is very high complexity (see `PHPMD <https://phpmd.org/rules/codesize.html>`_).
- `Java <http://www.javaworld.com/article/2074995/dealing-cyclomatic-complexity-in-java-code.html>`_ 1–10 to be considered a Normal application, 11–20 Moderate application, 21–50 Risky application, more than 50 Unstable application (also see `here, by GMetrics <http://gmetrics.sourceforge.net/gmetrics-CyclomaticComplexityMetric.html>`_).
- .Net: 1 to 10 a simple program, without very much risk; 11 to 20 a more complex program, moderate risk; 21 to 50 a complex, high risk program; > 50 an un-testable `program <https://www.codeproject.com/articles/11719/cyclomatic-code-complexity-analysis-for-microsoft>`_ (very high risk). 
- Microsoft recommendation is to warn when Cyclomatic complexity is more than 25 (`CA1502 <https://msdn.microsoft.com/en-us/library/ms182212.aspx>`_).
- `McCabe <http://www.mccabe.com/pdf/mccabe-nist235r.pdf>`_ originally proposed the limit of 10 since it has significant supporting evidence, but limits as high as 15 have been used successfully as well.

**NPath complexity**

.. important:: The recommended limit of the NPath complexity is 200 (the default `PHPMD <https://phpmd.org/rules/codesize.html>`_ limit).

The NPath metric computes the number of possible execution paths through a function, meaning how many “paths” there are in the flow of your code in the function. It is similar to the cyclomatic complexity but it also takes into account the nesting of conditional statements and multi-part boolean expressions. So, you should avoid long functions with a lot of (nested) if/else statements.

**\@SuppressWarnings**

It is allowed to use suppress warnings annotations in the following cases ONLY:

1. @SuppressWarnings(PHPMD) in the code that was automatically generated by a third-party tool or library (example: EwsBundle/Ews).
2. @SuppressWarnings(PHPMD.ExcessiveMethodLength) for the dataProvider in the PHPUnit tests in the install schema or data migrations.
3. @SuppressWarnings(PHPMD.TooManyMethods) for the PHPUnit test case classes in the install schema or data migrations.
4. @SuppressWarnings(PHPMD.CouplingBetweenObjects) in the install schema or data migrations.
5. @SuppressWarnings(PHPMD.CyclomaticComplexity) for methods consisting of single multi-way decision (“switch” or “case”) statements, when the explanation on why the limit was exceeded is provided in the nearby comment.
6. all @SuppressWarnings if there are plans to remove these warnings with appropriate @todo comment and ticket.

In all other cases, usage of the @SuppressWarnings MUST NOT be used.

**php-cs-fixer usage**

In order to reduce development time and automate part of the code preparation related to the code style fixes, it is suggested to use `PHP Coding Standard Fixer <http://cs.sensiolabs.org/>`_ (or in the `GitHub repository <https://github.com/FriendsOfPHP/PHP-CS-Fixer>`_) - automated tool that fixes most code style issues in the code.

JavaScript Code Style
^^^^^^^^^^^^^^^^^^^^^

**Standard**

`Google JavaScript Style Guide <https://google.github.io/styleguide/javascriptguide.xml>`_ is considered as code standard of the JavaScript code style.

**JavaScript code style continuous control**

In Oro projects, JavaScript code style is controlled by the `JSCS <http://jscs.info/>`_ and `JSHint <http://jshint.com/>`_ tools configured according to the rules defined in the project repository in `.jshintrc <https://github.com/orocrm/platform/blob/master/build/.jshintrc>`_ and `.jscsrc <https://github.com/orocrm/platform/blob/master/build/.jscsrc>`_).

It is highly recommended to configure appropriate code style inspections in the IDE or run these inspections manually before committing the changes and merging it to the project repository.

.. important:: JavaScript code style checker in PHPStorm could be enabled in "Languages & Frameworks>JavaScript>Code Quality Tools>JSCS/JSHint" and select to use configuration from .jscsrc/.jshintrc accordingly. For JSCS define path to installed node and path to jscs (it is {{your_project_root}}/node_modules/jscs). For JSHint select the version that is defined in package.json (in root folder of project).

To run the check manually from the command line:

- Install required js-modules

.. code-block:: none

    npm install

(package.json file is added to each dev-repo to root folder)

- Execute the following command to run JSCS check:

.. code-block:: none

    node_modules/.bin/jscs src/*/src/*/Bundle/*Bundle/Resources/public/js/** src/*/src/*/Bundle/*Bundle/Tests/JS/** --config=.jscsrc 

- Execute the following command to run JSHint check:

.. code-block:: none

    node_modules/.bin/jshint src/*/src/*/Bundle/*Bundle/Resources/public/js/** src/*/src/*/Bundle/*Bundle/Tests/JS/** --config=.jshintrc 

.NET Code Style
^^^^^^^^^^^^^^^

.NET code MUST follow the Microsoft Managed Recommended Rules. This code style is controlled on the continuous integration with `StyleCop <https://stylecop.codeplex.com/>`_.

CSS and HTML Code Style
^^^^^^^^^^^^^^^^^^^^^^^
There are no defined code styles for the CSS and HTML.

It is recommended to use same code style that is used in `Bootstrap <http://getbootstrap.com/>`_.

Submitting a Pull Request
-------------------------

The best way to contribute a bug fix or enhancement is to submit a `pull request`_ to the `OroCommerce <http://github.com/orocommerce/application>`_ repository on Github.

Before you submit your pull request consider the following guidelines:

* Search GitHub for an open or closed Pull Request that relates to your submission. You don't want to duplicate effort.
* Please sign our `Contributor License Agreement`_ before submitting pull requests. The CLA must be signed for any code or documentation changes to be accepted.

Commit Message
^^^^^^^^^^^^^^

The merge commit message contains the message from the author of the changes. This can help understand what the changes were about and the reasoning behind the changes. Therefore, commit messages should include a list of performed actions or changes in the code:

<Commit summary>

- <action 1>
- <action 2>
- ...

Signing a Contributor License Agreement
---------------------------------------

Although signing the `Contributor License Agreement`_ is a prerequisite for accepting your pull request, you only need to do it once. So, if you've done this for any of our open source projects, you're good to go with all of them. If you are submitting a pull request for the first time, our friendly *orocla* robot will automatically add a reminder to your pull request.

.. _pull request:   https://help.github.com/articles/using-pull-requests
.. _Contributor License Agreement: http://www.orocrm.com/contributor-license-agreement
