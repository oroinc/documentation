.. _dev-integrations-integrations-default-owner:

Default Owner for Integration Related Entities
==============================================

You can define the owner for related entities on the integration level.
The default user owner setting included into the integration configuration and should be configured during the integration creation.

Also **OroIntegrationBundle** brings a helper that can be used by the import process to perform the population of the integration owner.
It is registered as service `oro_integration.helper.default_owner_helper` and can be easily used as dependency.

**Usage Example:**

.. code-block:: php
   :linenos:

    use Oro\Bundle\ImportExportBundle\Strategy\StrategyInterface;
    use Oro\Bundle\IntegrationBundle\ImportExport\Helper\DefaultOwnerHelper;

    class ImportStrategy implements StrategyInterface
    {

        /** @var DefaultOwnerHelper */
        protected $defaultOwnerHelper;

        public function __construct(DefaultOwnerHelper $defaultOwnerHelper)
        {
            $this->defaultOwnerHelper = $defaultOwnerHelper;
        }

        // ....

        public function process($remoteEntity)
        {

            // ....

            /** @var object $importedEntity user owner aware entity */
            /** @var Channel $integration could be retrieved from import context */

            $this->defaultOwnerHelper->populateChannelOwner($importedEntity, $integration);

            // ....
        }

        // ....
    }


