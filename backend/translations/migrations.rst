Schema Migrations
=================

**Class:** ``Oro\Bundle\TranslationBundle\Migration\DeleteTranslationKeysQuery``

It provides a useful way to delete custom translation keys during migration.

**Arguments**:

* `domain` (string) - a domain of translation keys to be removed
* `translationKeys` (array) - an array of translation key strings to be removed

**Example**:

To remove custom keys in your migration, use the `addQuery` method of ``Oro\Bundle\MigrationBundle\Migration\QueryBag``.

.. code-block:: php

    $queryBag->addQuery(
        new Oro\Bundle\TranslationBundle\Migration\DeleteTranslationKeysQuery(
            'custom_domain',
            ['translation.key1.to.remove', 'translation.key2.to.remove' ]
        )
    );


An ``Oro\Bundle\MigrationBundle\Migration\QueryBag`` instance is usually available in the ``Oro\Bundle\MigrationBundle\Migration\Migration::up`` method as the second argument.

See :ref:`migration details <backend-entities-migrations>` for more information.