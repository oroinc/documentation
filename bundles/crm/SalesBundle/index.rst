.. _bundle-docs-crm-sales-bundle:

OroSalesBundle
==============

|OroSalesBundle| adds sales leads and sales opportunities entities to enable sales representative activities in Oro applications.

The bundle provides UI to manage these records and allows back-office administrators to enable and disable the functionality in the system configuration UI.

.. note::
    You can find sales-related user documentation :ref:`in the Manage Sales in the Back-Office <bundle-docs-crm-analytics-bundle>` and :ref:`Workflows documentation <system--workflows>`.

Sales Customer Relations
------------------------

Sales Entities Account Associations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can associate the sales lead and opportunity entities with a customer entity.
This option enables you to configure this relation and display a particular form type to choose or create a customer from any allowed types of customers in the application.
You can define the icon image, choose a grid and create a form route data.
Customer information will be displayed on the opportunity, lead view, and entity edit pages.

.. _bundle-docs-crm-sales-bundle-migration-extension:

Migration Extension
~~~~~~~~~~~~~~~~~~~

To enable the association, create a migration and add a relation to the opportunity and the lead.
Use migration extension `CustomerExtension`.

Migration example:

.. code-block:: bash

    class YourMigration implements Migration, CustomerExtensionAwareInterface
    {
        use CustomerExtensionTrait;

        #[\Override]
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->customerExtension->addCustomerAssociation($schema, 'target_customer_table');
        }
    }

Icon Provider
~~~~~~~~~~~~~

You can define the icon image for your associated customer entity. This image appears on the list of customers in the form type component.
To define this icon, create a class that implements ``CustomerIconProviderInterface`` and register the class as a service with
tag ``oro_sales.customer_icon``.

Example:

.. code-block:: bash

    class CustomerIconProvider implements CustomerIconProviderInterface
    {
        const CUSTOMER_ICON_FILE = 'bundles/yourbundlename/img/customer-logo.png';

        #[\Override]
        public function getIcon($entity)
        {
            if (!$entity instanceof Customer) {
                return null;
            }

            return new Image(Image::TYPE_FILE_PATH, ['path' => '/' . self::CUSTOMER_ICON_FILE]);
        }
    }


service.yml file:

.. code-block:: yaml

    oro_sales.provider.customer.customer_icon:
        class: Oro\Bundle\YourBundle\Provider\Customer\CustomerIconProvider
        tags:
            - { name: oro_sales.customer_icon }

Entity Configuration
~~~~~~~~~~~~~~~~~~~~

For the correct work of the customer integration function, configure an option for the customer entity.
First, add the default grid configuration.
If you want to create an option to enable for type component, add the ``routeCreate`` option to the config.

Example:

.. code-block:: bash

    #[ORM\Entity]
    #[ORM\Table(name: 'your_customer')]
    #[Config(
        routeCreate: 'your_customer_entity_create',
        defaultValues: [
            'grid' => ['default' => 'your-customer-select-grid']
            ...
        ]
    )]
    class Customer implements ExtendEntityInterface
    ...

.. include:: /include/include-links-dev.rst
   :start-after: begin