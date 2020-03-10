.. _dev-doc-frontend-storefront-customization-replace-placeholders:

How to Replace Placeholder Images for Products in the Storefront
================================================================


The following article describes how to replace placeholder images in your custom OroCommerce application.

This topic assumes that you have previously created a custom application, a bundle, and a storefront theme, as described in the :ref:`Storefront Customization <storefront_customization_guide>` topic.

.. note:: This tutorial is suitable for both cases, when you have created your own custom storefront theme, and when you need to change an out-of-the-box one. However, creating your own theme is recommended as it enables to manage your storefront appearance easily.

Replace a Placeholder
---------------------

1. Place a new storefront placeholder image into your bundle`s public assets folder (e.g.,  ``Resources/public/{your_theme_id}/product/no_image.png``):

    - Resources/public/default/product/no_image.png

2. Specify the main placeholder image in your :ref:`theme configuration file <dev-doc-frontend-layouts-theming-definition>`:

   .. code-block:: yaml
      :linenos:

      // src/AppBundle/Resources/views/layouts/{your_theme_id}/theme.yml
      image_placeholders:
        product: '@AppBundle/Resources/public/default/product/no_image.png'
        category: '@AppBundle/Resources/public/default/product/no_image.png'

   or if files are in the same bundle with theme.yml

   .. code-block:: yaml
      :linenos:

      // src/AppBundle/Resources/views/layouts/{your_theme_id}/theme.yml
      image_placeholders:
        product: '/bundles/app/default/product/no_image.png'
        category: '/bundles/app/default/product/no_image.png'

4. Rebuild the assets:

   Clear the cache to reload the Yaml configuration files:

   .. code-block:: bash

      php bin/console clear:cache

   Publish images to the public web folder:

   .. code-block:: bash

      php bin/console assets:install --symlink

   Generate new image dimensions:

   .. code-block:: bash

      php bin/console product:image:resize-all


.. note:: It is also possible to replace a placeholder from the back-office under System > Configuration > Commerce > Design > Theme. Keep in mind that the changes in the back-office will prevail overriding the changes described above in this article. For more details on how to replace a placeholder in the back-office, follow the :ref:`theme configuration topic <configuration--commerce--design--theme>`:
