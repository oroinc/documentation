.. _doc--dev-env-best-practices:

Set Up a Development Environment
================================

Developers who write a code for Oro applications occasionally face challenges regarding the local development environment and usually successfully overcome them. This article describes best practices in setting up a development environment and recommendations on how to avoid the most common issues. All of the described best practices are mere recommendations, however, they can speed up the development process and make it more convenient.

Hardware Best Practices
-----------------------

Hard disk
^^^^^^^^^

Use a solid-state drive (SSD). An Oro application uses lots of files (vendors, cache), so good read speed accelerates page loadings while good write speed helps warm up and clear cache faster.

RAM
^^^^

Make sure that you have enough RAM for your environment. An Oro application creates numerous processes (web server, cron, consumers) and may use external services (DB, search index, message queue), each of which might consume significant amount of memory.

For example, the Enterprise version of the Oro application with several thousand entities, Elasticsearch search index, RabbitMQ and 4 consumers requires between 2GB and 4GB of RAM. When there is not enough memory and an OS uses swap, the application may encounter performance issues and a developer has to wait longer than usual.

Software Best Practices
-----------------------

File System
^^^^^^^^^^^^

One of the ways to increase development speed is to make sure that all of the required files are stored in RAM instead of the disk drive. You can move DB files, search index storage, application files, application cache, etc. there.

In UNIX-based operating systems, you can use |ramfs| or |tmpfs| to create virtual RAM partitions. In Windows, you can use special software to create a RAM disk.

Containers
^^^^^^^^^^

If you prefer to develop an application in a container-based environment, remember that the code should not be stored on virtual file systems with low read/write speed as by default an Oro application performs a significant amount of requests to the file system.

If you are using Docker or Vagrant, check the |default configuration for these containers|.

IDE
^^^^

Ensure that your IDE supports autocomplete, quick search, quick navigation, code generation, code formatting, and other useful features. For example, |PhpStorm| with  |Symfony plugin| and |Oro plugin| provides one of the best experiences.

Debugger
^^^^^^^^

Integrate a debugging tool into your IDE to be able to set breakpoints in a code, see watches and go over a stack trace in real time. See |how to set up integration between PhpStorm and xDebug|.

Code Style
^^^^^^^^^^

Unified code style improves code readability and helps avoid simple mistakes and typos. You can use |PHP Code Sniffer|, |PHP Mess Detector|, |PHP Copy/Paste Detector|, |PHP CS Fixer| , and other similar tools. PhpStorm supports  |integration with PHP Code Sniffer| |and PHP Mess Detector|. See the |standard Oro configuration| for these tools.

Tips and Tricks
---------------

Excluded Directories in PhpStorm
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, PhpStorm performs re-indexation of all files in a project. However, some files, like cache storage and copies of assets, are not usually required during development. To speed up the re-indexation, mark that are not required as excluded, and PhpStorm will not reindex them.

To mark directory as excluded, right-click it in the project panel and select **Mark Directory as > Excluded**.

Here is a list of directories that can be excluded by default:

* var/cache
* public/bundles

Testing in PhpStorm
^^^^^^^^^^^^^^^^^^^

If you write tests for your code, integrate |PhpUnit with PhpStorm| and use it |for actual testing|.

You can also set the default configuration for the PhpUnit test runner (path to phpunit.xml, the working directory, etc.). Then you can just right-click a test file and select **Run <file>** to run all tests from the file.

Symfony Debug Toolbar
^^^^^^^^^^^^^^^^^^^^^

Oro applications are built on top of the Symfony framework which provides the |debug toolbar| with lots of useful information, like request data, session variables, DB queries, layout data, etc. Feel free to use all this information during development, or even |add your own sections| to the toolbar.

**See Also**

* :ref:`Version Control <code-version-control>`

* :ref:`Code Style <doc--community--code-style>`

* :ref:`Contribute to Translations <doc--community--ui-translations>`

* :ref:`Contribute to Documentation <documentation-standards>`

* :ref:`Report an Issue <doc--community--issue-report>`

* :ref:`Report a Security Issue <reporting-security-issues>`

* :ref:`Contact Community <doc--community--contact-community>`

* :ref:`Release Process <doc--community--release>`

.. include:: /include/include-links.rst
   :start-after: begin