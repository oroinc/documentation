.. _dev--extend--how-to-publish-extension-on-the-marketplace:
.. _dev-cookbook-framework-how-to-add-extension-to-marketplace:

Add an Extension to Oro Extensions Store
========================================

The |Oro Extensions Store| is the place where developers can publish their extensions and customers can obtain them.

There are two types of extensions in the Oro Extensions Store: free and paid. Free extensions are distributed directly
from the Oro Extensions Store, whereas paid extensions must be purchased from the publisher’s website.

Package Preparation
-------------------

Before you add an extension to the Oro Extensions Store, prepare the package and upload it to a repository.

You can publish paid extensions anywhere. Their publishers are fully responsible for packaging, distribution,
and payment processing.

You can publish free extensions on any publicly available git repository (GitHub, BitBucket, etc.).
We strongly recommend publishing all releases with tags – this lets our packagist application
pick up release notes, version history, and the contents of the ``readme.md`` file.

Every package must contain a ``composer.json`` file in the root catalogue. This file must contain
information about the application, its author, and distribution license, as shown below:

.. code-block:: json


    {
        "name": "oro/crm-application",
        "description": "The OroCRM distribution",
        "homepage": "https://github.com/orocrm/crm-application.git",
        "license": "OSL-3.0"
    }

We only accept extensions under OSL-3 or MIT licenses.


Adding an Extension
-------------------

To add an extension, you must be logged in to the Oro Extensions Store website. You can reach the Add Extension page
via the user menu in the top right corner or via the link on the My Marketplace page.

First, choose an extension type: paid or free.
Free extensions also require the repository URL. Then click Next to proceed to the second step.


Paid Extensions
---------------

For paid extensions the following information must be specified.

**Extension Name** – a name of the extension as it will appear in the Extensions Store.

**Web URL** – a user will be navigated to this URL when they click Get Extension button on the application view
in the Extensions Store. Usually this is an extension page on publisher’s website.

**Price** – the price of the extension in US dollars. Note that we do not process any payments
in the Extensions Store and the publisher is fully responsible for keeping the price up to date.

.. note::

    If you want to charge your customers in currency other than USD, please
    write about it in the Pricing Info (see below) and care to update the
    price along with exchange rate fluctuations to avoid customer confusion.

**Pricing Info** – any additional information about pricing of the extension you want to provide.
This field is optional.

**Short Description** – a short overview of the extension that will appear on its page in the Extensions Store.
This is also an optional field.

**Choose default image** – you may add up to 8 images to your extension and choose the default one
that will appear along to its name in the Extensions Store and on the extension page. The images must be
in JPEG, PNG, or GIF formats, up to 1MB in size.

**Category selection** – each extension must belong to at least one product
(e.g., OroCRM, OroCommerce, or OroPlatform) and belong to at least one category. If you do not see a proper category
to put your extension in, you can request for creation of a new one in the form on the right.

**Description, Release Notes, and Previous Versions** – These fields are optional and are supposed
to contain more detailed information about the application and its releases.


Free Extensions
---------------

If you create the extension package according to our specification,
our Packagist application automatically processes most extension information attributes
and takes them from GitHub. You can still edit them if you want.
Here is the list of fields and their sources:

* **Extension Key** – taken from name in the composer.json file
* **Short Description** – taken from description
* **Description** – taken from the contents of readme.md on GitHub
* **Release Notes** – taken from GitHub Release Notes (if tags are used)
* **Previous Versions** – taken from version history on GitHub (if tags are used)

This means you only have to specify the *Extension Name*, choose a *default image*,
and specify *categories*.

After you publish the application, it appears on the My Marketplace page in Pending status.
The status changes shortly after our administrator reviews the extension and allows it into the Oro Extensions Store.
Admin review is necessary only for the initial publication; all subsequent changes
are published immediately without admin approval.


.. include:: /include/include-links-dev.rst
   :start-after: begin
