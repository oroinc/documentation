.. _orocloud-maintenance-advanced-use:

Advanced Configuration
~~~~~~~~~~~~~~~~~~~~~~

Deployment and Maintenance Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Customization is possible via the <oroapplication>.yml files that may rewrite some parameters of the deployment.yml. Note that customized parameters override the values in deployment.yml. If you would like to preserve the existing parameters from deployment.yml, copy them into <oroapplication>.yml.

.. note:: The  <oroapplication>.yml file name matches the app_type value that is enforced in the deployment.yml configuration file.

With <oroapplication>.yml you can rewrite the following nodes.

**install_commands**

.. code-block:: none
    :linenos:

    deployment:
        install_commands: # Application commands which run during the installation process
            - 'oro:install --sample-data=n --user-name=customized_admin --user-email=akokoa@okokoa.com --user-password=new_password --user-firstname=Steven --user-lastname=Franklin --application-url=https://okokoa.oro-cloud.com --organization-name=okokoa'

**upgrade command**

.. code-block:: none
    :linenos:

    deployment:
        upgrade_commands: # Application commands which run during update process
            - 'oro:platform:update'

**writeable_path_for_group**

.. code-block:: none
    :linenos:

    deployment:
        writeable_path_for_group:
            - { path: 'web/css', method: recursive }
            - { path: 'web/js', method: recursive }
            - { path: 'web/sitemaps', method: recursive }
            - { path: 'web/robots.txt' }
            - { path: 'web' }

.. _orocloud-maintenance-advanced-use-sanitization-conf:

Sanitizing Configuration
^^^^^^^^^^^^^^^^^^^^^^^^

The default sanitizing configuration is located in the <oroapplication>.yml.dist file (orocrm.yml.dist or orocommerce.yml.dist).

.. note:: The <oroapplication>.yml.dist file name matches the application type.

The sanitization configuration is grouped under the sanitize node and supports the following sanitization methods:

* `sanitize.method.rawsql`_
* `sanitize.method.update`_

sanitize.method.rawsql
""""""""""""""""""""""

The **sanitize.method.rawsql** method contains the list of raw SQL queries that help you sanitize the existing data. For example, delete the data using TRUNCATE method, UPDATE the data to apply any custom modification, etc.

.. code-block:: none
    :linenos:

    sanitize:
        method:
            rawsql:
                - TRUNCATE oro_audit CASCADE
                - UPDATE oro_email_attachment SET file_name='test.jpg', content_type='image/jpeg'
                - UPDATE oro_email_attachment_content SET content_transfer_encoding = 'base64'

sanitize.method.update
""""""""""""""""""""""

The **sanitize.method.update** method contains mapping between the specific table columns and the sanitizing method that should be used for the values. The update strategies are provided in JSON format, like in the following example:

.. code-block:: none
    :linenos:

    sanitize:
        method:
            update:
                - {
                     table:table_name,
                     columns:[
                        {
                           name:column_name_A,
                           method:sanitizing_strategy_for_column_A
                        },
                        {
                           name:column_name_B,
                           method:sanitizing_strategy_for_column_B
                        },
                        {
                           name:column_name_C,
                           method:sanitizing_strategy_for_column_C
                        }
                     ]
                  }

Please use the following conventions to design your sanitize.method.update strategy:

* Provide sanitizing configuration for every table as a new update item:

  .. code-block:: none
      :linenos:

      update:
            - { table: oro_address, columns: [{name: street, method: md5}, {name: city, method: md5}, {name: postal_code, method: md5}, {name: last_name, method: md5}] }
            - { table: oro_business_unit, columns: [{name: email, method: email}, {name: name, method: md5}, {name: phone, method: md5}] }

* Provide the table name in the table node.
* In the columns section, provide an array of column name and sanitizing method pairs for all the columns that should be sanitized in the mentioned table.
  For example:

  .. code-block:: none
      :linenos:

      columns: [{name: street, method: md5}, {name: city, method: md5} ]

* Provide the column name in the name node. Use the following sanitization methods/strategies (ensure they are reasonably matching the column type):

  * md5 — Replaces the original string with the string hash
  * email — Replaces the email with the sanitized version of the email. When the sanitize.custom_email_domain configuration parameter is provided in the deployment.yml or <oroapplication>.yml files, the email strategy replaces the real email domain with the custom one provided as sanitize.custom_email_domain. If the custom domain is not provided, the sanitized email will be generated randomly. For example, sdfsdf@dfdfdf.test
  * date — Replaces the date values with the current date and time
  * attachment — Replaces the attachment file content with the dummy blank image

Sample *<oroapplication>.yml* file for sanitizing data:

.. code-block:: none

   sanitize:
       method:
           rawsql:
               - TRUNCATE oro_tracking_website CASCADE
               - UPDATE oro_email_attachment SET file_name='test.jpg', content_type='image/jpeg'
           update:
               - { table: oro_comment, columns: [{name: message, method: md5}] }
               - { table: oro_email_address, columns: [{name: email, method: email}] }
               - { table: oro_email_attachment_content, columns: [{name: content, method: attachment}] }
