Welcome to Oro Documentation
============================

Find everything you need to use and develop your Oro business application.

.. code-block:: php
    :linenos:

    <?php
     namespace ACME\Bundle\FastShippingBundle;

     use ACME\Bundle\FastShippingBundle\DependencyInjection\FastShippingExtension;
     use Symfony\Component\HttpKernel\Bundle\Bundle;
     class ACMEFastShippingBundle extends Bundle
     {
         /**
          * {@inheritDoc}
          */
         public function getContainerExtension()
         {
              if (!$this->extension) {
                  $this->extension = new FastShippingExtension();
              }
              return $this->extension;
         }
     }

Explore comprehensive knowledge base and learn OroCommerce, OroCRM and OroPlatform features and architecture.

.. toctree::
   :hidden:
   :includehidden:
   :titlesonly:
   :maxdepth: 6

   user_doc/index
