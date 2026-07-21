.. _dev-integrations-integrations-additional-capabilities:

Additional Capabilities
=======================

**Save Service Data Between Synchronizations**

If an integration connector needs to store data between imports, use the status entity.
For example, you can store the date of the last synchronization, the current download state, or data required to support multiple import modes, such as update or initial imports.

To use this feature, extend your connector class from ``Oro\Bundle\IntegrationBundle\Provider\AbstractConnector``. Then, the ``addStatusData`` and ``getStatusData`` methods will be available.

**Example:**

.. code-block:: php


    // your connector class
    // ...
    #[\Override]
    public function read()
    {
        $item = parent::read();

        // store last item updated at
        if (null !== $item && !$this->getSourceIterator()->valid()) {
            $this->addStatusData('lastItemUpdatedAt', $item['updated_at']);
        }

        return $item;
    }
    // ...


    // retrieve data from status
    $status = $this->container->get('doctrine')->getRepository('Oro\Bundle\IntegrationBundle\Entity\Channel')
        ->getLastStatusForConnector($channel, $this->getType(), Status::STATUS_COMPLETED);
    /** @var array **/
    $data = $status->getData();
    $lastItemUpdatedAt = $data['lastItemUpdatedAt'];

