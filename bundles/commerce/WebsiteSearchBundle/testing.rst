Testing
=======

.. hint:: See the :ref:`Search Index <search_index_overview>` documentation to get a more high-level understanding of the search index concept in the Oro application.

Trait |WebsiteSearchExtensionTrait| contains methods which help reindex data in test if required.

Example of usage:

.. code-block:: php


    /**
     * @dbIsolationPerTest
     */
    class ReindexRequiredTest extends FrontendWebTestCase
    {
        use WebsiteSearchExtensionTrait;

         /** {@inheritdoc} */
            protected function setUp(): void
            {
                ...

                $this->reindexProductData(); // if we need re-index product data in every test
            }

            public function testExampleReindexData()
            {
                $this->reindexProductData(); // if we need re-index product data in specific test
                ...
            }
    }


.. include:: /include/include-links-dev.rst
   :start-after: begin
