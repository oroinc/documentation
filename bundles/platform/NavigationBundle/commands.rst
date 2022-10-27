.. _bundle-docs-platform-navigation-bundle-commands:

CLI Commands (NavigationBundle)
===============================

oro:navigation:history:clear
----------------------------

The oro:navigation:history:clear command clears old navigation history.

.. code-block:: none

    php bin/console oro:navigation:history:clear

The --interval option can be used to override the default time interval (1 day) past which a navigation history item is considered old. It accepts any relative date/time format recognized by PHP (see |Supported Date and Time Formats|):

.. code-block:: none

    php bin/console oro:navigation:history:clear --interval=<relative-date>

.. code-block:: none

    php bin/console oro:navigation:history:clear --interval="15 minutes"

.. code-block:: none

    php bin/console oro:navigation:history:clear --interval="3 days"

oro:navigation:menu:reset
-------------------------

The oro:navigation:menu:reset command resets all menu updates.

.. code-block:: none

   php bin/console oro:navigation:menu:reset

The --user option can be used to reset menu updates for a specific user:

.. code-block:: none

   php bin/console oro:navigation:menu:reset --user=<user-email>

The --menu option can be used to reset only a specific menu:

.. code-block:: none

   php bin/console oro:navigation:menu:reset --menu=<menu-name>

Both options can be combined to further limit the scope being reset.

.. code-block:: none

   php bin/console oro:navigation:menu:reset --user=<user-email> --menu=<menu-name>

.. include:: /include/include-links-dev.rst
   :start-after: begin