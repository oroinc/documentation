Schema Migrations
=================

**Class:** ``Oro\Bundle\TranslationBundle\Migration\DeleteTranslationKeysQuery``

Provides a useful way to delete custom translation keys during migration.

**Arguments**:

* `domain` (string) - domain of translation keys to process removal by
* `translationKeys` (array) - an array of translation key strings to remove

**Example**:

To remove custom keys in your migration, use method `addQuery` of ``Oro\Bundle\MigrationBundle\Migration\QueryBag``.
   
.. code-block:: php

    $queryBag->addQuery(
        new Oro\Bundle\TranslationBundle\Migration\DeleteTranslationKeysQuery(
            'custom_domain',
            ['translation.key1.to.remove', 'translation.key2.to.remove' ]
        )
    );


An ``Oro\Bundle\MigrationBundle\Migration\QueryBag`` instance is usually available in ``Oro\Bundle\MigrationBundle\Migration\Migration::up`` method as second argument.

See :ref:`migration details <backend-entities-migrations>` for more information.
