.. _dev-cookbook-framework-how-to-add-extension-to-marketplace:

How to Add an Extension to the OroPlatform Marketplace
======================================================

`OroPlatform Marketplace`_ is the place where developers can publish their extensions for the OroPlatform application
and the customers can download them.

There are two types of extensions in the OroCRM Marketplace: free and paid. Free extensions are distributed directly
from the Marketplace, whereas paid extensions must be purchased from the publisher’s website.

Package Preparation
-------------------

Before you add an extension to the Marketplace, you have to prepare the package and upload it to a repository.

Paid extensions can be published anywhere. Their publishers are fully responsible for proper packaging, distribution
and payment processing.

All free extensions can be published on any publicly available git repository (GitHub, BitBucket, etc.).

We strongly recommend to publish all releases with tags – this will allow `our packagist application`_
to pick up release notes, version history and contents of the ``readme.md`` file.

Every package must contain a ``composer.json`` file in the root catalogue. This file in turn must contain
information about the application, its author and distribution license, as shown in the example below:

.. code-block:: json
    :linenos:

    {
        "name": "oro/crm-application",
        "description": "The OroCRM distribution",
        "homepage": "https://github.com/oroinc/crm-application.git",
        "license": "OSL-3.0"
    }

We only accept extensions under OSL-3 or MIT licenses.

.. _our packagist application: http://packagist.oroinc.com/


Adding an Extension
-------------------

To be able to add an extension you have to be logged in to tho OroCRM Marketplace website. The Add Extension page
can be reached via the user menu in the top right corner of the page or via link on the My Marketplace page.

The first thing you have to do is choose the extension type: paid or free.

Free extensions also require the repository URL. Click **Next** to proceed to the second step of adding an extension.


Paid Extensions
---------------

For paid extensions the following information must be specified:

* **Extension Name** –-- The name of the extension to be displayed in the Marketplace.

* **Web URL** -- The user will be navigated to this URL when he clicks **Get Extension** on the application view page in the Marketplace. Usually this is an extension page on the publisher’s website.

* **Price** --- The price of the extension in US dollars. Note that we do not process any payments in the Marketplace and the publisher is fully responsible for keeping the price up to date.

.. note::

    If you want to charge your customers in a currency other than USD, please
    write about it in the Pricing Info (see below) and make sure you update the
    price along with exchange rate fluctuations to avoid customer confusion.

**Pricing Info** –-- Any additional information about the pricing of the extension.
This field is optional.

**Short Description** –-- A short overview of the extension that will appear on its page in the Marketplace.
This field is optional.

**Choose default image** –-- You can add up to 8 images to your extension and choose the default one
that will appear next to its name in the Marketplace and on the extension page. The images must be
in JPEG, PNG, or GIF formats and up to 1MB in size.

**Marketplace and Category selection** –-- Every extension must belong to at least one marketplace
(e.g. OroCRM or OroPlatform) and one category. If there is no suitable category for your extension, 
request to create a new one in a form on the right.

**Description, Release Notes, and Previous Versions** –-- These fields are optional and are designed
to contain more detailed information about the application and its releases.

Free Extensions
---------------

If an extension package has been properly created according to our specification,
most of extension information attributes will be automatically processed
by our Packagist application and taken from GitHub, although you will still be able to edit them, if necessary.

Here is the list of fields and their sources:

* **Extension Key** – taken from name in the composer.json file
* **Short Description** – taken from description
* **Description** – taken from the contents of readme.md on GitHub
* **Release Notes** – taken from GitHub Release Notes (if tags are used)
* **Previous Versions** – taken from version history on GitHub (if tags are used)

This means that you will only have to specify the *Extension Name*, choose the *default image*,
and specify *marketplaces and categories*.

Once you publish the application, it will appear on *My Marketplace* page in *Pending* status.

The status will change once our administrator reviews the extension and approves it for the Marketplace.

.. note:: Note that admin review is necessary only for the first publication. All subsequent changes
    will not require admin approval and will be published immediately.

References
----------

* `OroPlatform Marketplace`_
* `Oro Packagist`_

.. _OroPlatform Marketplace: https://platform-marketplace.orocrm.com/
.. _Oro Packagist: http://packagist.oroinc.com/

