.. _bundle-docs-platform-ui-bundle-error-handler:

Error Handler
=============

The **Error Handler** provides a unified way to display errors across the application.
It supports different error output formats depending on the environment (`prod` or `dev`) and helps ensure that errors are visible either in the UI, the console, or both.

How to Use It
-------------

To use the Error Handler in your component, import `oroui/js/error`:

.. code-block:: javascript

    define(function(require) {
        'use strict';

        var error = require('oroui/js/error');

        /* Another code */
    });

After importing, you can use its various methods to display errors.

showError
^^^^^^^^^

**Options:**

* `context`: {Object|Error}
* `errorMessage`: {String|null} *(optional)*

**Description:**

Displays an error in **both** the UI Flash Message and the browser Console.

showErrorInUI
^^^^^^^^^^^^^

**Options:**

* `context`: {Object|Error|String}

**Description:**

Shows an error **only** in the UI Flash Message.

If `context` is an Error object:

- In `prod`, the user sees a concise message.
- In `dev`, additional debugging details may also be shown.

showErrorInConsole
^^^^^^^^^^^^^^^^^^

**Options:**

* `context`: {Object|Error}

**Description:**

Logs the error **only** in the Console.

showFlashError
^^^^^^^^^^^^^^

**Options:**

* `message`: {String}

**Description:**

Displays a simple error Flash Message in the UI.

Default Options
---------------

The Error Handler provides default values, which can be overridden when calling the `error` module.

message
^^^^^^^

* **Type:** {String}
* **Default:** `'There was an error performing the requested operation. Please try again or contact us for assistance.'`

**Description:**

Defines the default error message shown to the user.

loginRoute
^^^^^^^^^^

* **Type:** {String}
* **Default:** `'oro_user_security_login'`

**Description:**

Specifies the redirect URL used when an XHR request returns a `401 Unauthorized` response.

Error Handler and `$.ajax()` Errors
-----------------------------------

By default, the Error Handler intercepts and displays all standard errors raised by `$.ajax()`.
Developers can customize or disable this behavior via the `errorHandlerMessage` option in AJAX settings.

errorHandlerMessage
^^^^^^^^^^^^^^^^^^^

* **Type:** {Boolean|String|Function}
* **Default:** `true`

Examples:

Disable AJAX Error Flash Message:

.. code-block:: javascript

   $.ajax({
       url: 'test',
       errorHandlerMessage: false
   });

Set a custom message:

.. code-block:: javascript

   $.ajax({
       url: 'test',
       errorHandlerMessage: "Custom Error Message"
   });

Use a callback function:

.. code-block:: javascript

   $.ajax({
       url: 'test',
       errorHandlerMessage: function(event, xhr, settings) {
           // Suppress error if it's 404 response
           return xhr.status !== 404;
       }
   });
