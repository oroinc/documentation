Email Templates Migrations
==========================

This section describes how to create migration for email template to update it to a new version:

1. Get `MD5` hash of old template content (previous version). The most straightforward way is to run ``Oro\Bundle\EmailBundle\Command\GenerateMd5ForEmailsCommand`` to generates MD5 hashes for email template contents:

   .. code-block:: none

      php bin/console oro:email:generate-md5

   It will output all available template names with hashes from the current database state. Copy hash for a specific template name.

2. Create migration class extending ``Oro\Bundle\EmailBundle\Migrations\Data\ORM\AbstractHashEmailMigration`` and implement two required methods.

   * `getEmailHashesToUpdate` - specifies template name with an array of hashes (from the first step) which represent old content versions.

   * `getEmailsDir` - returns folder where the current email templates are placed.

Here is an example of such a class:

.. code-block:: php

    class EmailTemplateMigrationExample extends AbstractHashEmailMigration
    {
        /**
         * {@inheritdoc}
         */
        protected function getEmailHashesToUpdate(): array
        {
            return [
                'some_email_template_name_1' => ['ded063280f6463f1f30093c00e58b123'],
                'some_email_template_name_2' => ['2699723490ba63ffdf8cd76292bd8456'],
                'some_email_template_name_3' => ['740d3535b2e4041de1d4f1a274e4e789'],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function getEmailsDir()
        {
            return $this->container
                ->get('kernel')
                ->locateResource('@OroEmailBundle/Migrations/Data/ORM/data/emails');
        }
    }

You can edit email templates in a specified folder. New changes will be applied to the database after the migration is executed. To make things even easier, implement  ``Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface`` so for new updates, it will be enough to increment the version as well as add a new hash to the array. There may be any number of such hashes which guaranty corresponding versions will be updated to actual one.


.. admonition:: Business Tip

   What is |business-to-business eCommerce|, and how does it support business growth? In our guide, you'll learn the fundamentals of digital commerce for businesses.


.. include:: /include/include-links-seo.rst
   :start-after: begin