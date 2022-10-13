Mode Extension
==============

This extension provides the ability to work with the grid in different modes. There are two supported modes:

- **server** (default) - all manipulations with data are performed on the backend side; the grid receives data via AJAX requests.
- **client** - all manipulations with data are performed on the frontend side; no AJAX requests required. The client mode does not currently support filters.

Configuration example
---------------------

This grid will be rendered and processed in the client mode:

.. code-block:: none

    account-account-user-grid:
        options:
            mode: client
        ...
