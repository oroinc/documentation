.. _frontend--pnpm-package-manager:

PNPM Package Manager
====================

PNPM is a faster and more reliable alternative to NPM, designed to improve build performance and prevent dependency mismatch issues.

.. note:: To enforce the use of PNPM across the OroCommerce application, the `package.json` file already includes a preinstall script to enforce the use of PNPM:

   .. code-block:: json

      "scripts": {
        "preinstall": "npx only-allow pnpm"
      }

Getting Started
---------------

To begin using PNPM, follow |the official PNPM installation guide|.

For most JavaScript developers, the quickest setup method is to run the following command:

.. code-block:: bash

   npm install -g pnpm

Working with PNPM
-----------------

Install dependencies using PNPM

.. code-block:: bash

   pnpm install


.. note:: If you previously used NPM, make sure to delete the existing `node_modules` directory from the root of your application.

.. important::
    PNPM creates a **non-flat** (isolated) `node_modules` structure using symlinks, exposing only explicitly declared dependencies. This improves build speed and avoids bugs caused by undeclared packages.

    For example, if package **A** imports package **B**: `import something from 'B';`, but **B** is not listed in **A**'s dependencies in `package.json`, the code will fail, even if **B** is present in the repo(`node_modules` folder). The package *B* must be explicitly declared in **A**'s package.json:

    .. code-block:: json

        {
            "name": "A",
            "dependencies": {"B": "1.0.0"}
        }

Add a new package

.. code-block:: bash

    pnpm add some-new-package


Common Issues When Migrating from `NPM` to `PNPM`
-------------------------------------------------

Lockfile Conflicts
^^^^^^^^^^^^^^^^^^

When confusion or errors related to package-lock.json and pnpm-lock.yaml.

Clean the project and reinstall.

.. code-block:: bash

    rm package-lock.json
    rm -rf node_modules
    pnpm install


Missing Dependencies Due to Hoisting Differences
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When modules that previously worked under `NPM` now result `in module not found` errors, add missing dependencies explicitly:

.. code-block:: bash

    pnpm add <package-name>


Local Package Changes Not Reflected
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When updating to workspace packages are not recognized in other parts of the monorepo, run the following command:

.. code-block:: bash

    pnpm install
    pnpm -r build


PhpStorm Saved Script Setup Stop Working
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When predefined scripts in PhpStorm (used for building front-end assets) no longer work after switching to `PNPM`, update or recreate your `Run Configuration` to use PNPM as shown bellow:

.. image:: /img/frontend/pnpm-package-manager/phpstorm-pnpm-config.png
    :alt: PNPM config for PHPStorm

.. include:: /include/include-links-dev.rst
   :start-after: begin
