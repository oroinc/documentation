:title: OroCommerce Field Sales App Configuration and Installation

.. meta::
   :description: Instructions for the backend developers on how to set up and configure the OroCommerce Field Sales App

.. _dev-guide-field-sales-app-setup:

OroCommerce Field Sales Application Setup and Configuration
===========================================================

.. note:: Please |contact our support team| to learn more about the Field Sales Application and its implementation.

This guide outlines steps required to set up the OroCommerce :ref:`Field Sales application <concept-guide--field-sales-app>` in a development environment. The Field Sales application is a headless Progressive Web Application (PWA) built with React and powered by OroCommerce backend APIs. It is designed to help sales representatives operate in offline or low-connectivity environments by offering capabilities such as order entry, visit tracking, and digital catalog browsing.

System Requirements
-------------------

Two components are required to run the Field Sales application: an instance of the OroCommerce Enterprise application and the Field Sales application itself. You must ensure that your environment meets the system requirements for both components.

.. hint:: If you are not installing the |Sales Frontend Extension| on your OroCommerce instance and prefer to use an already prepared OroCommerce instance (e.g., hosted on Oro Cloud), you can skip the section about the OroCommerce Enterprise system requirements.

Field Sales Application System Requirements
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* Node.js is version 24 or higher
* PNPM is version 9 or higher
* You have received access and cloned the |Field Sales application| source code from GitHub. Once you have the application in place, proceed with one of the installation options described below.

  .. hint:: This repository contains the React-based frontend application that connects to your OroCommerce backend API either locally or remotely, depending on your setup. Please contact our support team to request access.

OroCommerce Enterprise System Requirements
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The list of the system requirements for OroCommerce Enterprise application can be found :ref:`on the system requirements page <system-requirements>`.

Installation
------------

The process includes preparing the OroCommerce Enterprise instance and installing the Field Sales application. If you already have a running instance (such as one hosted in Oro Cloud), you can skip the preparation step for OroCommerce Enterprise.

Prepare OroCommerce Enterprise Instance
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. hint:: If you have not yet set up a local OroCommerce Enterprise instance, please follow the steps outlined in the :ref:`Installation Guide <install-for-dev>`.

Install |Sales Frontend Extension| to your OroCommerce Enterprise instance. Use this approach if you have permission to install additional backend packages to the OroCommerce instance:

1. While being in the root directory of your OroCommerce Enterprise instance, use composer to add the package code:

.. code-block:: php

   composer require oro/sales-frontend --prefer-dist --update-no-dev

2. Next, remove old cache:

.. code-block:: shell

    rm -rf var/cache/prod

3. Perform the application upgrade to make the OroCommerce Enterprise application aware of the newly installed extension:

.. code-block:: php

   php bin/console oro:platform:update  --env=prod --force

4. Configure the OroSalesFrontendBundle by adding the following to your `config/config.yml` file:

.. code-block:: yaml

    # config/config.yml

    oro_sales_frontend:
        app_base_urls:
            - '/sales-frontend' # Default URL for the Field Sales application in case it is installed under a subpath of your OroCommerce instance
            - 'https://field-sales.dev.loc' # Example URL for the Field Sales application
            - 'http://localhost:5173' # Default Vite development server URL

This configuration allows the OroSalesFrontendBundle to automatically set up the |CORS| and |CSP| headers, enabling the Field Sales application to communicate with the OroCommerce backend API.

.. hint:: You can find more information on the possible configuration options in the :ref:`OroSalesFrontendBundle configuration <bundle-docs-commerce-sales-frontend-bundle-configuration>`.

5. Clear the cache:

.. code-block:: php

   php bin/console cache:clear --env=prod

.. hint:: For more information on installing extensions from the Oro Extensions Store, see :ref:`Installing an Extension <cookbook-extensions-composer>`.

Install the Field Sales Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configuration
~~~~~~~~~~~~~

Create a file named `.env.development.local` in the root directory of the Field Sales application worktree.

.. note:: The `.env.development.local` file is used for local development. For production builds, create `.env.production.local` file with equivalent values for your instance.

.. code-block:: shell

   cp .env .env.development.local

If you run you OroCommerce Enterprise instance locally and the Field Sales application is installed under a subpath of the OroCommerce Enterprise public directory (e.g., `/sales-frontend`), it should include the following content:

.. code-block:: none

    BUILD_DIR="dist"
    VITE_BASE_URL=""
    VITE_BASE_API_URL="/admin/api/"
    VITE_LOGIN_URL="/admin/sales-frontend/user/login"
    VITE_LOGOUT_URL="/admin/sales-frontend/user/logout"
    VITE_CHECK_TOKEN_URL="/admin/sales-frontend/oauth2/check-token"
    VITE_REFRESH_TOKEN_URL="/admin/sales-frontend/oauth2/refresh-token"

If you OroCommerce instance runs on a separate domain or hosted in the Oro Cloud, specify the absolute URLs for the OroCommerce Enterprise instance:

.. code-block:: none

    BUILD_DIR="dist"
    VITE_BASE_URL=""
    VITE_BASE_API_URL="https://orocommerce.dev.loc/admin/api/"
    VITE_LOGIN_URL="https://orocommerce.dev.loc/admin/sales-frontend/user/login"
    VITE_LOGOUT_URL="https://orocommerce.dev.loc/admin/sales-frontend/user/logout"
    VITE_CHECK_TOKEN_URL="https://orocommerce.dev.loc/admin/sales-frontend/oauth2/check-token"
    VITE_REFRESH_TOKEN_URL="https://orocommerce.dev.loc/admin/sales-frontend/oauth2/refresh-token"

Here, `https://orocommerce.dev.loc` is the URL of the OroCommerce Enterprise instance you want the Field Sales application to connect to.

You can find more information on the available environment variables in the :ref:`Field Sales application configuration reference <dev-guide-field-sales-app-configuration-reference>`.

Installation and Operation
~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Install the dependencies using pnpm while in the root directory of the Field Sales application:

.. code-block:: shell

   pnpm install

2. Build the application using:

.. code-block:: shell

   pnpm run build --mode=development

This will build the application source code in the specified `BUILD_DIR` (default is `dist`). Make sure you have the web server configured to serve the files from this directory.

If you want to run the application for development or debugging purposes, or if you do not have the appropriate web server set up, you can use the Vite development server:

.. code-block:: shell

    pnpm run dev

This command will start the Vite development server, which offers features like hot module replacement (HMR) and other development tools. You do not need to configure a web server to serve the application files, as Vite will take care of that during development.

.. include:: /include/include-links-dev.rst
    :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1

   configuration
