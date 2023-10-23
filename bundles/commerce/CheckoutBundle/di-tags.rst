Dependency Injection Tags
-------------------------

.. csv-table::
   :header: "Type name","Usage"

   "[oro.checkout.line_item.converter]","Allows to add a new checkout converter that expects an arbitrary source data and returns a collection of ``\Oro\Bundle\CheckoutBundle\Entity\CheckoutLineItem`` objects. Must implement ``\Oro\Bundle\CheckoutBundle\Model\CheckoutLineItemConverterInterface``."
   "[checkout.workflow_state.mapper]","Allows to add new checkout state diff mapper. Diff mappers are used to track changes in checkout. Must implement ``\Oro\Bundle\CheckoutBundle\WorkflowState\Mapper\CheckoutStateDiffMapperInterface``"
