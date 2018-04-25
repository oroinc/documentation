.. index::
    single: Platform Application; Customization

Customizing the Platform Application
====================================

Symfony offers easy-to-use options for overriding parts of third party
bundles in an application. Since the OroPlatform Application consists of
several well-structured bundles, you can customize almost every part of it
as easily as you could in any other Symfony application.

.. _extending-bundles:

Extending a Bundle
------------------

Some of the techniques described below require extending an existing bundle.
Essentially, extending a bundle is nothing more than implementing the ``getParent()``
method in the bundle's class. The ``getParent()`` method returns the name of
the extended bundle:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/AcmeDemoBundle.php
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeDemoBundle extends Bundle
    {
        // ...

        public function getParent()
        {
            return 'OroDataGridBundle';
        }
    }

.. seealso::

    You can find more information on how to extend bundles in
    :doc:`the cookbook </dev_guide/cookbook/how_to_extend_existing_bundle>`.

.. index::
    single: Templates
    single: Customization; Templates

Overriding Templates
--------------------

There are two options for overriding the OroPlatform templates:

#) Overriding one of the platform templates is as easy as adding a template
   at the same path under ``app/Resources/`` as the template being overriden.
   For example, to override the ``Grid/widget/widget.html.twig`` template
   from the DataGridBundle, create a new template file located at
   ``app/Resources/OroDataGridBundle/views/Grid/widget/widget.html.twig``.

#) You can :ref:`extend an existing bundle <extending-bundles>` to override
   its templates. For example, if the AcmeDemoBundle extends the OroDataGridBundle,
   you can override  the ``Grid/widget/widget.html.twig`` template by creating
   a template with the same name in the ``Resources/views/Grid/widget`` directory
   of the AcmeDemoBundle.

Both methods of overriding the templates have their advantages. Putting templates under the ``app/Resources``
directory ensures that they can't be overriden by any bundle. For example,
you usually store templates that are specific to a particular application
under this path. Extending one of the Platform bundles is useful if you want
to be able to re-use the overriden templates in several applications.

.. seealso::

    The mechanism for overriding bundle templates is described in detail in the
    `templating chapter`_ in the Symfony documentation.

Twig Placeholders
~~~~~~~~~~~~~~~~~

The `OroUIBundle`_ extends Twig templates by allowing them to use so-called
"placeholders". Placeholders are defined in any bundle in the `placeholders.yml`
file which is stored in the bundle's ``Resources/config/oro`` directory. For
example, the placeholders file of the OroDataGridBundle looks like this:

.. code-block:: yaml
    :linenos:

    # platform/src/Oro/Bundle/DataGridBundle/Resources/config/oro/placeholders.yml
    placeholders:
        placeholders:
            scripts_before:
                items:
                    template_datagrid_toolbar:
                        order: 20
                    template_datagrid_toolbar_pagination:
                        order: 30
                    template_datagrid_toolbar_pagination_input:
                        order: 40
                    template_datagrid_toolbar_page_size:
                        order: 50
                    template_datagrid_select_all_header_cell:
                        order: 50
                    template_datagrid_action_header_cell:
                        order: 50

        items:
            template_datagrid_toolbar:
                template: OroDataGridBundle:js:toolbar.html.twig
            template_datagrid_toolbar_pagination:
                template: OroDataGridBundle:js:pagination.html.twig
            template_datagrid_toolbar_pagination_input:
                template: OroDataGridBundle:js:pagination-input.html.twig
            template_datagrid_toolbar_page_size:
                template: OroDataGridBundle:js:page-size.html.twig
            template_datagrid_select_all_header_cell:
                template: OroDataGridBundle:js:select-all-header-cell.html.twig
            template_datagrid_action_header_cell:
                template: OroDataGridBundle:js:action-header-cell.html.twig

A placeholder is rendered in a twig template using the ``placeholder`` tag:

.. code-block:: html+jinja
    :linenos:

    {% placeholder scripts_before %}

You can pass additional options to the placeholder using ``with``:

.. code-block:: html+jinja
    :linenos:

    {% placeholder right_panel with {placement: 'right'} %}

.. index::
    single: Translations; Custom Translations
    single: Customization; Translations

Create Custom Translations
--------------------------

Translations are grouped by message domains. Thus, you can overwrite any
translation as long as it is in the same message domain. When there are more
than one translation, the order in which they are loaded is crucial. Therefore,
make sure that your bundle containing the overriding translation
files is loaded after the OroPlatform bundles in ``AppKernel``. To change
order in which bundles are loaded, you can use the priority option in the bundle configuration.

.. tip::
    Translation files located in the ``app/Resources/translations`` directory
    always win over others as they are loaded last.


Crowdin Translations
~~~~~~~~~~~~~~~~~~~~

OroPlatform supports using translations from `Crowdin`_. You can then
use the ``oro:translation:pack`` command with your authentication data to
download and apply a translation pack:

.. code-block:: bash

    $ php app/console oro:translation:pack -i <project-id> -k <api-key> --download <project>

.. seealso::

    You can learn more about the Crowdin translation process
    :doc:`in the community section </community/translations>`.

.. index::
    single: Customization; Services
    single: Services; Overriding Services

.. _replace-services:

Replacing a Service
-------------------

You can replace any service defined by one of the OroPlatform bundles with
your own implementation. All you have to do is fill the class parameter
name for the service you want to replace with the name of your new service
class. All parameters used to set the services' class names are in the form of
``bundle_alias.service_name.class`` (for example, ``oro_datagrid.configuration.provider.class``
is the parameter holding the class name for the ``oro_datagrid.configuration.provider``
service):

.. code-block:: yaml
    :linenos:

    # app/config/parameters.yml
    parameters:
        # ...
        oro_datagrid.configuration.provider.class: Acme\DataGridBundleBundle\Provider\ConfigurationProvider

.. index::
    single: Customization; Forms
    single: Forms; Overriding Forms

.. _replace-forms:

Replacing Forms
---------------

Most forms from the OroPlatform bundles are registered as services. Hence,
they can be replaced :ref:`like any other service <replace-services>`.

.. index::
    single: Customization; Controllers
    single: Controllers; Overriding Controllers

Adding custom Validation Constraints
------------------------------------

Symfony doesn't allow you to override validation constraints. Instead, all rules
configured for a particular subject being validated are merged into one large
validation metadata tree.

You can learn more about where and how you are able to use custom validation constraints from the cookbook:

* :doc:`/dev_guide/cookbook/user_custom_validation_constraints`

Overriding a Controller
-----------------------

To override a controller of the OroPlatform bundle with your own implementation,
you must first extend that bundle (read :doc:`/dev_guide/cookbook/how_to_extend_existing_bundle`
for more information). Then, create a controller class with the same name
as the parent bundle:

.. code-block:: php
    :linenos:

    // src/Acme/DataGridBundle/Controller/GridController;
    namespace Acme\DataGridBundle\Controller;

    use Oro\DataGridBundle\Controller\GridController as BaseController;

    class GridController extends BaseController
    {
        public function widgetAction($gridName)
        {
            // call the parent action first or completely reimplement
            // the action
        }
    }

.. tip::

    You should extend the controller class from the parent bundle so that
    you have to implement the customized action instead of re-implementing
    all other actions. Don't forget to register your controller action
    either with annotation or using configuration from the routing.yml file.

Customizing the Database Schema
-------------------------------

OroPlatform supports two types of entities: regular entities that are
mapped via Doctrine metadata and OroPlatform specific entities that exist
in the database and which are then generated into the application's cache
directory.

OroPlatform Entities
~~~~~~~~~~~~~~~~~~~~

The OroPlatform Application ships with a set of predefined entities. Their
basic configuration is stored in the ``oro_entity_config`` table. Its structure
looks essentially like this:

.. code-block:: text

    +------------+--------------+------+-----+---------+----------------+
    | Field      | Type         | Null | Key | Default | Extra          |
    +------------+--------------+------+-----+---------+----------------+
    | id         | int(11)      | NO   | PRI | NULL    | auto_increment |
    | class_name | varchar(255) | NO   | UNI | NULL    |                |
    | created    | datetime     | NO   |     | NULL    |                |
    | updated    | datetime     | YES  |     | NULL    |                |
    | mode       | varchar(8)   | NO   |     | NULL    |                |
    | data       | longtext     | YES  |     | NULL    |                |
    +------------+--------------+------+-----+---------+----------------+

You can add new fields to already existing entities and also add your own
custom entities. To do this, all you have to do is to create a Migration that
performs the steps need to customize the entity schema.

.. caution::

    Migrations loaded by the OroMigrationBundle are grouped into versions
    on a per bundle basis. This means that all migrations stored in a migration
    version directory are executed just once. The version number of the last
    executed migration is then stored in the database. So, if you want to
    create another custom entity, you have to create a new subdirectory called
    ``v1_1``, then ``v1_2``, and so on.

    You can skip any version number (for example you can have a ``v1_1`` and
    a ``v1_3`` directory). It is just important that new migrations are placed
    in directory with higher version numbers (as determined by PHP's
    :phpfunction:`version_compare` function.

Adding Fields to an Existing Entity
...................................

To add a field to an existing entity, use the ``addColumn()`` method. It's
important that you pass the special ``oro_options`` key to the options argument
which ensures that the column is recognized properly.

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/MigrationBundle/Schema/v1_0/AddCustomFieldMigration.php
    namespace Acme\DemoBundle\Migrations\Schema;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddCustomFieldMigration implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('oro_user');
            $table->addColumn(
                'custom_field',
                'text',
                array('oro_options' => array(
                    'extend' => array('is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM),
                    'datagrid' => array('is_visible' => true),
                    'merge' => array('display' => true),
                ))
            );
        }
    }

Apply these changes by running the ``oro:migration:load`` command:

.. code-block:: bash

    $ php app/console oro:migration:load

This command updates the ``oro_entity_config`` and ``oro_user`` tables. Additionally,
each time the cache is generated, corresponding entity and mapping files are
created in the ``app/cache``:

.. code-block:: bash

    $ ls -l app/cache/<env>/oro_entities/Extend/Entity
    total 28
    -rw-rw-r--+ 1 user user  245 Jun  6 20:40 ExtendUser.orm.yml
    -rw-rw-r--+ 1 user user  347 Jun  6 20:40 ExtendUser.php
    -rw-rw-r--+ 1 user user   65 Jun  6 20:40 alias.yml

Creating Custom Entities
........................

Thanks to the EntityExtendBundle, you can create your own entities which are
then available in the *Section*/*Entities* section of the Platform Application.
To create your own entities, simply create a migration class that implements
the :class:`Oro\\Bundle\\EntityExtendBundle\\Migration\\Extension\\ExtendExtensionAwareInterface`
and the :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration` interfaces:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migrations/Schema/v1_0/CreateCustomEntityMigration.php
    namespace Acme\DemoBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class CreateCustomEntityMigration implements ExtendExtensionAwareInterface, Migration
    {
        private $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $this->extendExtension->createCustomEntityTable($schema, 'CustomEntity');
            $table->addColumn('name', 'string');
            $this->extendExtension->addManyToOneRelation(
                $schema,
                $table,
                'user',
                'oro_user',
                'first_name'
            );
        }
    }

This migration creates a new entity, ``Extend\Entity\CustomEntity``. Its PHP
class doesn't reside in any bundle but only in the application cache. Also,
a new table ``oro_ext_customentity`` will be created in your database which
should look something like this:

.. code-block:: bash

    mysql> DESCRIBE oro_ext_customentity;
    +---------+--------------+------+-----+---------+----------------+
    | Field   | Type         | Null | Key | Default | Extra          |
    +---------+--------------+------+-----+---------+----------------+
    | id      | int(11)      | NO   | PRI | NULL    | auto_increment |
    | user_id | int(11)      | YES  | MUL | NULL    |                |
    | name    | varchar(255) | NO   |     | NULL    |                |
    +---------+--------------+------+-----+---------+----------------+

Furthermore, two new files are created in the entities cache directory:

.. code-block:: bash

    $ ls -l app/cache/<env>/oro_entities/Extend/Entity
    total 36
    -rw-rw-r--+ 1 user user  202 Jun  6 20:49 CustomEntity.orm.yml
    -rw-rw-r--+ 1 user user  488 Jun  6 20:49 CustomEntity.php
    -rw-rw-r--+ 1 user user  245 Jun  6 20:49 ExtendUser.orm.yml
    -rw-rw-r--+ 1 user user  347 Jun  6 20:49 ExtendUser.php
    -rw-rw-r--+ 1 user user   65 Jun  6 20:49 alias.yml

Regular Entities
~~~~~~~~~~~~~~~~

You can create regular Doctrine entities as you would in
other Symfony applications. For example, have a look at the following entity:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/RegularEntity.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
    * @ORM\Entity
    */
    class RegularEntity
    {
        /**
        * @ORM\Column(type="integer")
        * @ORM\Id
        * @ORM\GeneratedValue(strategy="AUTO")
        */
        protected $id;

        /**
        * @ORM\Column(type="string")
        */
        protected $name;
    }

To create a migration file for this entity, run the ``doctrine:schema:update``
command in the ``dev`` environment first:

.. code-block:: bash

    $ php app/console doctrine:schema:update --force

This created a ``RegularEntity`` table in your database. You can now use the
``oro:migration:dump`` to dump the complete database schema:

.. code-block:: php
    :linenos:

    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AllMigration implements Migration
    {
        /**
        * @inheritdoc
        */
        public function up(Schema $schema, QueryBag $queries)
        {
            /** Generate table RegularEntity **/
            $table = $schema->createTable('RegularEntity');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
            /** End of generate table RegularEntity **/

            /** Generate table acl_classes **/
            $table = $schema->createTable('acl_classes');
            $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
            $table->addColumn('class_type', 'string', ['length' => 200]);
            $table->setPrimaryKey(['id']);
            $table->addUniqueIndex(['class_type'], 'UNIQ_69DD750638A36066');
            /** End of generate table acl_classes **/

            // ...
        }
    }

Search for the parts that are related to the ``RegularEntity`` table (the
lines between its related ``Generate table`` and ``End of generate table``
comments) and copy them to a new migration file. After that, the new migration
file should look like this:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migrations/Schema/CreateRegularEntityMigration.php;
    namespace Acme\DemoBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class CreateRegularEntityMigration implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->createTable('RegularEntity');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
        }
    }

From now on, you can simply create the ``RegularEntity`` table by running
the ``oro:migration:load`` command.

.. caution::

    Remember that command doctrine:schema:update can only be executed for
    development or testing purposes. All real application database updates must be
    applied using migrations.

.. seealso::

    Read more about Doctrine mappings `in the Symfony Book`_ and in the
    `official Doctrine documentation`_.


Business Logic
--------------

Since OroPlatform entities are only created inside the application's cache
directory, you cannot add your business logic to these entity classes. To
overcome this drawback, you can create a service that does all the necessary
actions required by your business.

For example, imagine that the users of your application are accounted based
on the number of months they used your service during the last year. The longer
your user uses the service, the lower the fee they are charged per month:

====================== =====================
Service used in months Service fee per month
====================== =====================
1 - 4                  20 $
---------------------- ---------------------
5 - 8                  15 $
---------------------- ---------------------
9 - 12                 10 $
====================== =====================

The entity class for such a user may look like this:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Account.php
    namespace Acme\DemoBundle\Entity;

    class Account
    {
        private $monthsUsed;

        private $totalFee;

        public function setMonthsUsed($monthsUsed)
        {
            $this->monthUsed = $monthsUsed;
        }

        public function getMonthsUsed()
        {
            return $this->monthsUsed;
        }

        public function setTotalFee($totalFee)
        {
            $this->totalFee = $totalFee;
        }

        public function getTotalFee()
        {
            return $this->totalFee;
        }
    }

You can then create a class which performs all of the calculations based on the rules
above which should be `registered as a service`_ in your Symfony
application:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Accounting/TotalFeeCalculator.php
    namespace Acme\DemoBundle\Accounting;

    use Acme\DemoBundle\Entity\Account;

    class TotalFeeCalculator
    {
        public function calculateTotalFee(Account $account)
        {
            if ($account->getMonthsUsed() === 0) {
                $account->setTotalFee(0);
            } elseif ($account->getMonthsUsed() >= 1 && $account->getMonthsUsed() < 5) {
                $account->setTotalFee(20);
            } elseif ($account->getMonthsUsed() >= 5 && $account->getMonthsUsed() < 10) {
                $account->setTotalFee(15);
            } elseif ($account->getMonthsUsed() >= 10) {
                $account->setTotalFee(10);
            }
        }
    }

This way, you can access your business logic rules simply by requesting the
calculator service from the service container or inject it into your custom
services like any other service.

Learn more
----------

You can learn more about customizing a Symfony application in general from
the Symfony documentation as well as customizing the OroPlatform Application:

* `How to Override any Part of a Bundle`_
* `How to Use Bundle Inheritance to Override Parts of a Bundle`_
* :doc:`/dev_guide/cookbook/how_to_create_and_customize_application_menu`

.. _`templating chapter`: http://symfony.com/doc/current/book/templating.html#overriding-bundle-templates
.. _`OroUIBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/UIBundle
.. _`Crowdin`: https://crowdin.net/
.. _`How to Override any Part of a Bundle`: http://symfony.com/doc/current/dev_guide/cookbook/bundles/override.html
.. _`How to Use Bundle Inheritance to Override Parts of a Bundle`: http://symfony.com/doc/current/dev_guide/cookbook/bundles/inheritance.html
.. _`in the Symfony Book`: http://symfony.com/doc/current/book/doctrine.html
.. _`official Doctrine documentation`: http://docs.doctrine-project.org/en/latest/
.. _`registered as a service`: http://symfony.com/doc/current/book/service_container.html
