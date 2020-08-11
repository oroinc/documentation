.. _web-api--headers:

Headers
=======

For some types of the REST API requests, you can retrieve an additional information like the total number of records, the number of affected records, etc. To do this, use the ``X-Include`` request header. The value of this header should contain keys separated by a semicolon (;).

The following example shows how to get the total number of accounts:

.. code-block:: bash

    curl "http://orocrm.loc/index_dev.php/api/accounts?page=1&limit=2" -v --header="X-Include:totalCount" --header="X-WSSE:..."

The corresponding response:

::

    < HTTP/1.1 200 OK
    ...
    < X-Include-Total-Count: 67
    ...

.. hint:: To generate a WSSE header, run: ``php bin/console oro:wsse:generate-header YOUR_API_KEY``.

.. _existing-x-include-keys:

Existing X-Include Keys
-----------------------

The following table describes all existing *keys* for ``X-Include`` header.

.. csv-table::
   :header: "Request Type","X-Include key","Response Header","Description"
   :widths: 15, 15, 20, 20

   "all","noHateoas","--","Removes all HATEOAS related links from the response."
   "get a list of entities","totalCount","X-Include-Total-Count","Returns the total number of entities. It is calculated based on input filters."
   "delete a list of entities","totalCount","X-Include-Total-Count","Returns the total number of entities. It is calculated based on input filters."
   "delete a list of entities","deletedCount","X-Include-Deleted-Count","Returns the number of deleted entities"

Add New X-Include Key
---------------------

To add a custom key to the ``X-Include`` header:

1. Create a processor to handle your key:

    .. code-block:: php

        <?php

        namespace Oro\Bundle\ApiBundle\Processor\DeleteList;

        use Oro\Component\ChainProcessor\ContextInterface;
        use Oro\Component\ChainProcessor\ProcessorInterface;
        use Oro\Bundle\ApiBundle\Processor\Context;

        /**
         * Calculates and sets the total number of deleted records to "X-Include-Deleted-Count" response header,
         * in case it was requested by "X-Include: deletedCount" request header.
         */
        class SetDeletedCountHeader implements ProcessorInterface
        {
            const RESPONSE_HEADER_NAME = 'X-Include-Deleted-Count';
            const REQUEST_HEADER_VALUE = 'deletedCount';

            /**
             * {@inheritdoc}
             */
            public function process(ContextInterface $context)
            {
                /** @var DeleteListContext $context */

                if ($context->getResponseHeaders()->has(self::RESPONSE_HEADER_NAME)) {
                    // the deleted records count header is already set
                    return;
                }

                $xInclude = $context->getRequestHeaders()->get(Context::INCLUDE_HEADER);
                if (empty($xInclude) || !in_array(self::REQUEST_HEADER_VALUE, $xInclude, true)) {
                    // the deleted records count is not requested
                    return;
                }

                $result = $context->getResult();
                if (null !== $result && is_array($result)) {
                    $context->getResponseHeaders()->set(self::RESPONSE_HEADER_NAME, count($result));
                }
            }
        }

    .. code-block:: yaml

            oro_api.delete_list.set_deleted_count_header:
                class: Oro\Bundle\ApiBundle\Processor\DeleteList\SetDeletedCountHeader
                tags:
                    - { name: oro.api.processor, action: delete_list, group: delete_data, priority: -10 }

2. Create a processor to remove your response header when an error occurs:

.. code-block:: php

    <?php

    namespace Oro\Bundle\ApiBundle\Processor\DeleteList;

    use Oro\Component\ChainProcessor\ContextInterface;
    use Oro\Component\ChainProcessor\ProcessorInterface;

    /**
     * Removes the "X-Include-Deleted-Count" response header if any error occurs.
     */
    class RemoveDeletedCountHeader implements ProcessorInterface
    {
        /**
         * {@inheritdoc}
         */
        public function process(ContextInterface $context)
        {
            /** @var DeleteListContext $context */

            if ($context->hasErrors()
                && $context->getResponseHeaders()->has(SetDeletedCountHeader::RESPONSE_HEADER_NAME)
            ) {
                $context->getResponseHeaders()->remove(SetDeletedCountHeader::RESPONSE_HEADER_NAME);
            }
        }
    }

.. code-block:: yaml

        oro_api.delete_list.remove_deleted_count_header:
            class: Oro\Bundle\ApiBundle\Processor\DeleteList\RemoveDeletedCountHeader
            tags:
                - { name: oro.api.processor, action: delete_list, group: normalize_result, priority: 100 }
