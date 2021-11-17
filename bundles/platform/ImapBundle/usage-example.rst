Usage Example
=============

.. code-block:: php

    // Preparing connection config
    $imapConfig = new ImapConfig('imap.gmail.com', 993, 'ssl', 'user', 'pwd');

    // Accessing IMAP connector factory
    /** @var ImapConnectorFactory $factory */
    $factory = $this->get('oro_imap.connector.factory');

    // Creating IMAP connector for the ORO user
    $imapConnector = $factory->createImapConnector($imapConfig);

    // Creating IMAP manager
    $imapManager = new ImapEmailManager($imapConnector);

    // Creating the search query builder
    $queryBuilder = $imapManager->getSearchQueryBuilder();

    // Building a search query
    $query = $queryBuilder
        ->from('test@test.com')
        ->subject('notification')
        ->get();

    // Request an IMAP server for find emails
    $imapManager->selectFolder('INBOX');
    $emails = $imapManager->findItems($query);

    // Creating IMAP folder manager
    $imapFolderManager = new ImapEmailFolderManager($imapConnector);

    // Getting IMAP folders
    $folders = $imapFolderManager->getFolders(null, true);


.. include:: /include/include-links-dev.rst
   :start-after: begin
