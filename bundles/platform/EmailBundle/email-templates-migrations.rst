.. _bundle-docs-platform-email-bundle-templates-migrations:

Email Templates Migrations
==========================

This section describes how to create migration for email template to update it to a new version:

1. Get `MD5` hash of old template content (previous version). The most straightforward way is to run ``Oro\Bundle\EmailBundle\Command\GenerateMd5ForEmailsCommand`` to generates MD5 hashes for email template contents:

   .. code-block:: shell

      php bin/console oro:email:generate-md5

   It will output all available template names with hashes from the current database state. Copy hash for a specific template name.

2. Create migration class extending ``Oro\Bundle\EmailBundle\Migrations\Data\ORM\AbstractHashEmailMigration`` and implement two required methods.

   * `getEmailHashesToUpdate` - specifies template name with an array of hashes (from the first step) which represent old content versions.

   * `getEmailsDir` - returns folder where the current email templates are placed.

Here is an example of such a class:

.. code-block:: php

    class EmailTemplateMigrationExample extends AbstractHashEmailMigration
    {
        #[\Override]
        protected function getEmailHashesToUpdate(): array
        {
            return [
                'some_email_template_name_1' => ['ded063280f6463f1f30093c00e58b123'],
                'some_email_template_name_2' => ['2699723490ba63ffdf8cd76292bd8456'],
                'some_email_template_name_3' => ['740d3535b2e4041de1d4f1a274e4e789'],
            ];
        }

        #[\Override]
        public function getEmailsDir(): string
        {
            return $this->container
                ->get('kernel')
                ->locateResource('@OroEmailBundle/Migrations/Data/ORM/data/emails');
        }
    }

You can edit email templates in a specified folder. New changes will be applied to the database after the migration is executed. To make things even easier, implement  ``Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface`` so for new updates, it will be enough to increment the version as well as add a new hash to the array. There may be any number of such hashes which guaranty corresponding versions will be updated to actual one.

.. note:: Email template file name must match the email template name, e.g. ``some_email_template_name_1.html.twig`` for ``some_email_template_name_1``.

Email Template Format
---------------------

You can define email format based on file name, for example:

- html format: update_user.html.twig, some_name.html
- txt format: some_name.txt.twig, some_name.txt
- default format: html, if file extension cannot be recognized as html or txt

Email Template Metadata
-----------------------

Email template contains metadata defined with params at the top of the template.

Required parameters are:

- **name** - email template machine name;
- **subject** - email subject. Can contain entity variables, e.g., "Welcome, {{ entity.username }}".

Optional parameters are:

- **entityName** - class name of an entity that the email template is related to;
- **isSystem** - flags whether the template is a system one - 1 or 0, default - 0. System templates cannot be deleted in the UI;
- **isEditable** - flags whether the template is editable - 1 or 0, default - 0; make sense only if isSystem = 1 to allow editing content of system templates;
- **attachments** - array of attachments, where each element is either a *file placeholder* or *base64-encoded content* of a file.

.. code-block:: twig

    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Subject {{ entity.username }} #}
    {# @isSystem = 1 #}
    {# @attachments = ["{{ entity.avatar }}"] #}

.. note:: File placeholder is an entity variable that references a file, image, multiFile or multiImage field. Find more about email template attachments in :ref:`Email Templates Attachments <bundle-docs-platform-email-bundle-templates-attachments>`.

Attachments metadata parameter can contain either a numeric array (list) or an associative array (map). In case of a map, the key is used as a name of the corresponding *base64-encoded content* of a file. For example:

.. code-block:: twig

    {# @attachments = {"custom_name_1.pdf": "JVBERi0xLjQKJcfs..."} #}

For a *file placeholder*, the name is extracted from the referenced file during the rendering of an email.

Email Template Factory
----------------------

When an email template is imported from a file, it is parsed and processed by the ``\Oro\Bundle\EmailBundle\Model\Factory\EmailTemplateFromRawDataFactory``. It is responsible for extracting metadata parameters and creating an email template entity. Under-the-hood, it delegates the parsing to the ``\Oro\Bundle\EmailBundle\EmailTemplateHydrator\EmailTemplateRawDataParser`` and the processing to the ``\Oro\Bundle\EmailBundle\EmailTemplateHydrator\EmailTemplateFromArrayHydrator``. Hydrator fills an email template entity with the data parsed from the raw content of a template.

.. hint:: You can create a listener for ``\Oro\Bundle\EmailBundle\Event\EmailTemplateFromArrayHydrateBeforeEvent`` to preprocess the metadata parameters before they are set to an email template entity.

Basic Email Template Structure
------------------------------

Be aware that HTML email templates are passed to WYSIWYG when edited. **WYSIWYG automatically tries to modify the given HTML according to HTML specifications.** Therefore, text and tags that violate HTML specifications should be wrapped in HTML comments. For example, no tags or text are allowed between `<table></table>` tags except `thead`, `tbody`, `tfoot`, `th`, `tr`, `td`.

Examples:

Invalid template:

.. code-block:: twig

    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Subject {{ entity.username }} #}
    {# @isSystem = 1 #}
    {# @attachments = ["{{ entity.avatar }}"] #}

    <table>
        <thead>
            <tr>
                <th><strong>Acme</strong></th>
            </tr>
        </thead>
        {% for item in collection %}
        <tbody>
            {% for subItem in item %}
            <tr>
                {% if loop.first %}
                <td>{{ subItem.key }}</td>
                <td>{{ subItem.value }}</td>
                {% endif %}
            </tr>
            {% endfor %}
        </tbody>
        {% endfor %}
    </table>


Valid template:

.. code-block:: twig

    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Subject {{ entity.username }} #}
    {# @isSystem = 1 #}
    {# @attachments = ["{{ entity.avatar }}"] #}

    <table>
        <thead>
            <tr>
                <th><strong>Acme</strong></th>
            </tr>
        </thead>
        <!--{% for item in collection %}-->
        <tbody>
            <!--{% for subItem in item %}-->
            <tr>
                <!--{% if loop.first %}-->
                <td>{{ subItem.key }}</td>
                <td>{{ subItem.value }}</td>
                <!--{% endif %}-->
            </tr>
            <!--{% endfor %}-->
        </tbody>
        <!--{% endfor %}-->
    </table>


.. admonition:: Business Tip

   What is |business-to-business eCommerce|, and how does it support business growth? In our guide, you'll learn the fundamentals of digital commerce for businesses.


.. include:: /include/include-links-seo.rst
   :start-after: begin
