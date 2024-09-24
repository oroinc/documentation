.. _bundle-docs-platform-email-bundle-template:

Email Templates
===============

Any bundle can define its templates using Data Fixtures.
To achieve this, add a fixture in the ``SomeBundle\Migrations\Data\ORM`` folder that extends the ``Oro\Bundle\EmailBundle\Migrations\Data\ORM\AbstractEmailFixture`` abstract class and implements the only method - getEmailsDir:

.. code-block:: php

    class DataFixtureName extends AbstractEmailFixture
    {
        #[\Override]
        public function getEmailsDir(): string
        {
            return __DIR__ . DIRECTORY_SEPARATOR . '../data/emails';
        }
    }

Place email templates in that defined folder with any file name.

Email Format
------------

You can define email format based on file name, e.g.:

- html format: update_user.html.twig, some_name.html
- txt format: some_name.txt.twig, some_name.txt
- default format - html, if file extension can't be recognized as html or txt

Email Parameters
----------------

Each template must define these params:

- name - template name
- subject - email subject

Optional parameter:

- entityName - each template knows how to display some entity
- isSystem - 1 or 0, default - false (0)
- isEditable - 1 or 0, default - false (0); make sense only if isSystem = 1 and allow to edit content of system templates

Params defined with syntax at the top of the template.

.. code-block:: twig

    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Subject {{ entity.username }} #}
    {# @isSystem = 1 #}

Basic Email Template Structure
------------------------------

Be aware that HTML email templates are passed to WYSIWYG when edited. **WYSIWYG automatically tries to modify the given HTML according to HTML specifications.** Therefore, text and tags that violate HTML specifications should be wrapped in HTML comments. For example, no tags or text are allowed between `<table></table>` tags except `thead`, `tbody`, `tfoot`, `th`, `tr`, `td`.

Examples:

Invalid template:

.. code-block:: twig

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

.. include:: /include/include-links-dev.rst
    :start-after: begin
