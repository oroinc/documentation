Mode Extension
==============

This extensions provides the ability to work with the grid in different modes. There are two supported modes:

- **server** (default) - all manipulations with data are performed on backend side, the grid receives data via AJAX requests.
- **client** - all manipulations with data are performed on the frontend side, no AJAX requests required. *Note:* Filters are not currently supported by the client mode.

Configuration example
---------------------

This grid will be rendered and processed in the client mode:

.. code::

    account-account-user-grid:
        options:
            mode: client
        ...

