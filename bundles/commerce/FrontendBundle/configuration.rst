Frontend Sessions and Debug Routes
==================================

Frontend Session
----------------

This bundle provides a possibility to configure different session cookie parameters (such as name, path and lifetime) for the storefront and management console. Use ``session`` section for this:

.. code-block:: yaml
   :linenos:

    oro_frontend:
        session:
            name: OROSFID
            cookie_lifetime: 900

The full list of storefront session options is:

* `name`
* `cookie_lifetime`
* `cookie_path`
* `gc_maxlifetime`
* `gc_probability`
* `gc_divisor`

See |Symfony Framework Configuration Reference| for detailed information about each option.

Debug Routes
------------

Debug routes allows to turn off on fly routes generation, it can slightly boost performance on slow hardware configurations and also makes app more stable on Windows. If ``kernel.debug`` is set to `false` value of debug routes is ignored. To turn off routes generation set option ``debug_routes`` to ``false`` in config.yml file:

.. code-block:: yaml
   :linenos:

    oro_frontend:
        debug_routes: false

If you turned off routes generation, you must do it manually by executing following command:

.. code-block:: php
   :linenos:

    php bin/console fos:js-routing:dump


.. include:: /include/include-links-dev.rst
   :start-after: begin