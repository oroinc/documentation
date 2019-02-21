Assets
======

+-----------+----------------+
| Filename  | ``assets.yml`` |
+-----------+----------------+
| Root Node | ``assets``     |
+-----------+----------------+

The ``assets.yml`` file can be used to define CSS file groups. The listed files will be
automatically merged and optimized for web presentation.

The following example creates two groups (``first_group`` and ``second_group``) each of them
containing three CSS files:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/assets.yml
    assets:
        css:
            first_group:
                - 'First/Assets/Path/To/Css/first.css'
                - 'First/Assets/Path/To/Css/second.css'
                - 'First/Assets/Path/To/Css/third.css'
            second_group:
                - 'Second/Assets/Path/To/Css/first.css'
                - 'Second/Assets/Path/To/Css/second.css'
                - 'Second/Assets/Path/To/Css/third.css'

By default, when you install the application's assets using the ``assets:install`` command, all
CSS files from all groups and all bundles will be merged and optimized.

For debugging purposes compression of CSS files of certain groups can be disabled with the
``css_debug`` option:

.. code-block:: yaml
    :linenos:

    oro_assetic:
        css_debug:
            - first_group

.. tip::

    You can use the ``oro:assetic:groups`` command to get a list of all available groups.
