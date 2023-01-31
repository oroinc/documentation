.. _setup-from-db-dump:

Set Up OroPlatform-Based Application From Database Dump
=======================================================

This guide demonstrates how to set up Oro applications from database dumps (postgres only).

There are 3 typical use cases for restoring your application from a database dump:

1. Create a db dump before executing migration and reload in case anything goes wrong.
2. Reload a db dump provided by your Project Lead in order to have a unified data across the team.
3. Reload a db dump from production or staging environment to troubleshoot issues.

Prepare a Database Dump
-----------------------

1. Locally

    .. code-block:: none

       # make sure to adapt username and other params based on the values from your application's environment variables or .env-app.local file
       # you can omit --host and --port if you are using localhost and 5432 respectively
       pg_dump --no-owner --username=oro_db_user --host=localhost --port=5432 oro_db > /tmp/oro_db_dump.sql

2. Docker

    .. code-block:: none

       # commerce-crm-ee_pgsql_1 - docker container of your DB
       # oro_db_user - oro database user
       # oro_db - oro database
       docker exec commerce-crm-ee_pgsql_1 pg_dump --no-owner -U oro_db_user oro_db > /tmp/oro_db_dump.sql

3. Default docker-compose.yml setup

    .. code-block:: none

       # oro_db_user - oro database user
       # oro_db - oro database
       docker exec $(docker-compose ps -q pgsql) pg_dump --no-owner -U oro_db_user oro_db > /tmp/oro_db_dump.sql


3. OroCloud

    Follow the |Sanitized Backup| documentation for more details.

   .. code-block:: none

      # make sure VPN to your OroCloud instance in on
      # ssh to your instance
      ssh USERNAME@ocom-PROJECTNAME-prod1-maint1

      # execute sanitized backup command
      orocloud-cli backup:create:sanitized -v

      # output should be similar to below
      # Done, sanitized backup saved to: '/mnt/ocom/backup/20220081102000-sanitized-db.sql.gz'
      # download it then to your local instance
      scp USERNAME@ocom-PROJECTNAME-prod1-maint1:/mnt/ocom/backup/20220081102000-sanitized-db.sql.gz /tmp/oro_db_dump.sql.gz

      # unzip it
      gzip -dk /tmp/oro_db_dump.sql.gz

Restore a Database Dump
-----------------------

.. _setup-from-db-dump_restore_local_cloud:

1. Locally and from OroCloud

    .. hint:: Postgres superuser (sudo -u postgres) is used here to make sure there are no permission issues. If you don't have access to sudo or prefer running the commands as a different user, use ``psql -U username``.

    .. code-block:: none

       # drop an old db first
       sudo -u postgres psql -c "DROP DATABASE oro_db;"

       # an recreate a fresh db
       sudo -u postgres psql -c "CREATE DATABASE oro_db;"
       sudo -u postgres psql -d oro_db -c 'CREATE EXTENSION IF NOT EXISTS "uuid-ossp";'
       sudo -u postgres psql oro_db < /tmp/oro_db_dump.sql

    .. hint:: if you are using database user with insufficient permissions, you might need to grant access to the newly created db.

    .. code-block:: none

       sudo -u postgres psql -c "GRANT CONNECT ON DATABASE oro_db TO oro_db_user2;"
       sudo -u postgres psql oro_db -c "GRANT USAGE ON SCHEMA public TO oro_db_user2;"
       sudo -u postgres psql oro_db -c "GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO oro_db_user2;"
       sudo -u postgres psql oro_db -c "GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO oro_db_user2;"
       sudo -u postgres psql oro_db -c "SELECT 'ALTER TABLE '|| schemaname || '.' || tablename ||' OWNER TO oro_db_user2;' FROM pg_tables WHERE NOT schemaname IN ('pg_catalog', 'information_schema') ORDER BY schemaname, tablename;"
       sudo -u postgres psql oro_db -c "SELECT 'ALTER SEQUENCE '|| sequence_schema || '.' || sequence_name ||' OWNER TO oro_db_user2;' FROM information_schema.sequences WHERE NOT sequence_schema IN ('pg_catalog', 'information_schema') ORDER BY sequence_schema, sequence_name;"
       sudo -u postgres psql oro_db -c "SELECT 'ALTER VIEW '|| table_schema || '.' || table_name ||' OWNER TO oro_db_user2;' FROM information_schema.views WHERE NOT table_schema IN ('pg_catalog', 'information_schema') ORDER BY table_schema, table_name;"

2. Docker

    .. code-block:: none

       # commerce-crm-ee_pgsql_1 - docker container of your DB
       # oro_db_user - oro database user
       # oro_db - oro database
       # Recreate containers in order to kill all the active db sessions
       docker stop commerce-crm-ee_pgsql_1
       docker start commerce-crm-ee_pgsql_1

       # drop an old db first
       docker exec commerce-crm-ee_pgsql_1 psql -U oro_db_user -d postgres -c "DROP DATABASE oro_db;"

       # and recreate a fresh db
       docker exec commerce-crm-ee_pgsql_1 psql -U oro_db_user -d postgres -c "CREATE DATABASE oro_db;"
       docker exec commerce-crm-ee_pgsql_1 psql -U oro_db_user -d oro_db -c "CREATE EXTENSION IF NOT EXISTS \"uuid-ossp\";"
       cat /tmp/oro_db_dump.sql | docker exec -i commerce-crm-ee_pgsql_1 psql -U oro_db_user oro_db

3. Default docker-compose.yml setup

    .. code-block:: none

       # oro_db_user - oro database user
       # oro_db - oro database
       # Recreate containers in order to kill all the active db sessions
       docker-compose stop pgsql # or docker-compose down
       docker-compose up -d

       # drop an old db first
       docker exec $(docker-compose ps -q pgsql) psql -U oro_db_user -d postgres -c "DROP DATABASE oro_db;"

       # and recreate a fresh db
       docker exec $(docker-compose ps -q pgsql) psql -U oro_db_user -d postgres -c "CREATE DATABASE oro_db;"
       docker exec $(docker-compose ps -q pgsql) psql -U oro_db_user -d oro_db -c "CREATE EXTENSION IF NOT EXISTS \"uuid-ossp\";"
       cat /tmp/oro_db_dump.sql | docker exec -i $(docker-compose ps -q pgsql) psql -U oro_db_user oro_db

Prepare Application
-------------------

 .. hint:: If you use Symfony CLI, run `symfony console` instead of `bin/console`

1. Run composer install (optionally)

    .. code-block:: none

       composer install

2. Perform application upgrade

    .. hint:: This action is needed only if the code is not in sync with the database, e.g., you restore the database from the older version. Otherwise, skip this step.

    .. code-block:: none

       bin/console oro:platform:update -vv --timeout=0 --symlink --skip-search-reindexation --force

3. Update base url and optionally admin password

    .. code-block:: none

       bin/console oro:config:update oro_website.url https://oro.localhost
       bin/console oro:config:update oro_website.secure_url https://oro.localhost
       bin/console oro:config:update oro_ui.application_url https://oro.localhost
       bin/console oro:user:update admin --user-password=admin

Follow the InstallerBundle documentation for more references on the :ref:`oro:platform:update <installer-bundle-commands-oro-platform-update>` CLI command.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
