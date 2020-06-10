.. _dev--extend--how-to-publish-extension-on-the-marketplace:
.. _dev-cookbook-framework-how-to-add-extension-to-marketplace:

.. index::
    single: Marketplace; Add an Extension

Add an Extension to Oro Marketplace
===================================

The |Oro Marketplace| is the place where developers can publish their extensions and customers can obtain them.

There are two types of extensions in the Oro Marketplace: free and paid. Free extensions are distributed directly
from the Marketplace, whereas paid extensions must be purchased from the publisher’s website.

Package Preparation
-------------------

Before you add an extension to the Marketplace you have to prepare the package and upload it to some repository.

Paid extensions can be published anywhere. Their publishers are fully responsible for proper packaging, distribution
and payment processing.

All free extensions can be published on any publicly available git repository (GitHub, BitBucket, etc.).
We strongly recommend to publish all releases with tags – this will allow our packagist application
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


Adding an Extension
-------------------

To be able to add an extension you have to be logged in to tho OroCRM Marketplace website. The Add Extension page
can be reached via the user menu in the top right corner of the page or via link on the My Marketplace page.

First thing you have to do is to choose an extension type: paid or free.
Free extensions also require the repository URL. Then click Next to proceed to the second step of adding an extension.


Paid Extensions
---------------

For paid extensions the following information must be specified.

**Extension Name** – Name of the extension as it will appear in the Marketplace.

**Web URL** – the user will be navigated to this URL when he clicks Get Extension button on the application view
in the Marketplace. Usually this is an extension page on publisher’s website.

**Price** – the price of the extension in US dollars. Note that we do not process any payments
in the Marketplace and the publisher is fully responsible for keeping the price up to date.

.. note::

    If you want to charge your customers in currency other than USD, please
    write about it in the Pricing Info (see below) and care to update the
    price along with exchange rate fluctuations to avoid customer confusion.

**Pricing Info** – any additional information about pricing of the extension you want to provide.
This field is optional.

**Short Description** – a short overview of the extension that will appear on its page in the Marketplace.
This is also an optional field.

**Choose default image** – you may add up to 8 images to your extension and choose the default one
that will appear along to its name in the Marketplace and on the extension page. The images must be
in JPEG, PNG, or GIF formats, up to 1MB in size.

**Marketplace and Category selection** – each extension must belong to at least one marketplace
(e.g. OroCRM or OroPlatform), and belong to at least one category. If you do not see a proper category
to put your extension in, you can request for creation of a new one in the form on the right.

**Description, Release Notes, and Previous Versions** – These fields are optional and are supposed
to contain more detailed information about the application and its releases.


Free Extensions
---------------

If an extension package has been properly created according to our specification,
most of extension information attributes will be automatically processed
by our Packagist application and taken from GitHub, though you will still be able to edit them if you want to.
Here is the list of fields and their sources:

* **Extension Key** – taken from name in the composer.json file
* **Short Description** – taken from description
* **Description** – taken from the contents of readme.md on GitHub
* **Release Notes** – taken from GitHub Release Notes (if tags are used)
* **Previous Versions** – taken from version history on GitHub (if tags are used)

This means you will only have to specify the *Extension Name*, choose a *default image*,
and specify *marketplaces and categories*.

After you have published the application it will appear on the My Marketplace page in Pending status.
The status will be changed shortly after our administrator reviews the extension and allows it to the Marketplace.
Note that admin review is necessary only for the initial publication; all subsequent changes
will not require admin approbation and will be published immediately.


.. include:: /include/include-links-dev.rst
   :start-after: begin
