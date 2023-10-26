.. _dev-integrations-initial-data-load:

Initial Data Loading
====================

Initial data loading for Oro applications often involves populating your application's database with predefined data. This can be done using SQL queries and data fixtures. It's a good practice to store your fixtures and SQL scripts in version control systems (e.g., Git) to easily track changes to your initial data and share it with your development team.

Loading Initial Data with SQL Queries
-------------------------------------

SQL queries are used to insert data directly into the database, while fixtures provide a way to define data in a structured format that can be loaded into the database.

SQL queries are a straightforward way to insert data into the database. You can use these queries to populate your database tables with initial data. For example:

.. code-block:: sql


    -- Insert data into a table
    INSERT INTO oro_customer (name, created_at, updated_at) VALUES ('Customer #1', NOW(), NOW());
    INSERT INTO oro_customer (name, created_at, updated_at) VALUES ('Customer #2', NOW(), NOW());


You can execute these SQL queries using a database client or by running SQL scripts as part of your application's setup process.

Pros:

* SQL queries give you fine-grained control over data insertion, allowing you to specify exact values, relationships, and constraints. This is useful when performing complex data manipulations during the loading process.

* SQL queries are highly efficient, making them a valuable tool for quickly loading data from external sources in real-time situations.

* You don't need additional tools or libraries to execute SQL queries, as most database systems provide built-in support for running SQL scripts.

Cons:

* When inserting data using SQL script, application events will not be triggered, which may result in inconsistent data or incomplete related entities. Therefore, when writing SQL code, you must be aware of all potential consequences of data manipulation and ensure related entities are correctly filled in or required commands are executed to update search indexes manually or to recalculate related metrics.

* Writing and maintaining SQL scripts for data loading can be complex, especially for entities with a large amount of fields and complex relationships.

* SQL scripts created for one database schema may not be easily reusable for another project with a different schema.


Loading Initial Data with Data Fixtures
---------------------------------------

Fixtures are a more structured way to define initial data for your application. You typically define data in a structured format, such as JSON or YAML, and then use a custom command or data migration to load these fixtures into the database.


.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadCustomersData.php

    <?php

    namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\CustomerBundle\Entity\Customer;

    class LoadCustomerData extends AbstractFixture
    {
        private array $data = [
            ['name' => 'Customer #1']
        ];

        public function load(ObjectManager $manager): void
        {
            foreach ($this->data as $data) {
                $customer = new Customer();

                $customer->setName($data['name']);
                $manager->persist($customer);
            }

            $manager->flush();
        }
    }


Pros:

* Data fixtures are typically easier to create and understand, especially for those who are not proficient in SQL. They often use common data formats like JSON or YAML.

* Fixtures are often database-agnostic, making them easily portable across different application instances, simplifying migration or testing processes.

* Fixtures can be reused in multiple environments (e.g., development, testing, production), saving time and effort.

* Fixtures can be version-controlled, making tracking changes and collaborating with others easy.

* Data validation is automatically triggered upon loading the fixture, and all system events are subsequently initiated.

Cons:

* Fixtures may be slower to load than optimized SQL scripts, mainly when dealing with large datasets.

* You must be familiar with the data fixtures framework.

* Sometimes, triggering events manually or directly calling services is necessary to ensure all data is appropriately filled and processed.