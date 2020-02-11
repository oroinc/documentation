.. _composer-js-dependencies:

Managing NPM dependencies with Composer
=======================================

Minimum Requirements
--------------------

The following software is required for `composer` to install JS dependencies:

 - |Node.js|, version 12 or higher
 - |NPM|, version 6 or higher

.. hint:: For instructions on how to install **Node.js**, navigate to the |Node.js official website|.

General Information
-------------------

|NPM| packages represent JS dependencies of the application. NPM packages are recursively collected from `composer.json` files of all application dependencies. During `composer install` (either `update` or `require`) they are passed to NPM utility, which handles further installation.

.. hint:: For more information on NPM, see |NPM documentation|.

Workflow
--------

Initial Install of Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

During the `composer install` command composer runs the `Oro\Bundle\InstallerBundle\Composer\ScriptHandler::installAssets` post-install command, which recursively collects NPM packages from `composer.json` files of all application dependencies. Collected NPM packages are passed to `npm install` which handles further installation:

* creates `package.json` and `package-lock.json` files
* fetches NPM packages and puts them into `node_modules/` directory
* copies installed packages from the `node_modules/` directory to the `%symfony-web-dir%/bundles/npmassets/` directory

.. hint:: The generated `package.json` file is a technical file which should not be changed manually and is ignored by Git.

An example of `composer.json` containing NPM dependencies in the `extra.npm` section:

.. code-block:: json
   :linenos:

	{
		"name": "oro/calendar-bundle",

		"_comment": "skipped part of file",

		"extra": {
			"npm": {
				"fullcalendar": "3.4.0"
			},
		}
	}

Application Install When Lock Files Already Exist
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If `package-lock.json` already exists, post-install command `Oro\Bundle\InstallerBundle\Composer\ScriptHandler::installAssets` does the following:

 - runs `npm ci` which looks into the lock file, fetches NPM packages, and puts them into `node_modules/` directory
 - copies installed packages from the `node_modules/` directory into the `%symfony-web-dir%/bundles/npmassets/` directory

Adding New NPM Dependencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^

 - Add the NPM package name and version constraint to the `extra.npm` section of composer.json, e.g `"fullcalendar": "3.4.0"`
 - Delete `composer.lock` and the `package-lock.json` files
 - Run `composer install`

.. include:: /include/include-links-dev.rst
   :start-after: begin
