.. _orocloud-maintenance-advanced-use:

Advanced Configuration
======================

Deployment and Maintenance Configuration
----------------------------------------

To modify configuration options for maintenance agent, you need to have the `orocloud.yaml` file placed in Git repository root directory. If the application is not yet deployed, modifications can also be made in `/mnt/(ocom|ocrm)/app/orocloud.yaml`.

The `validation` command checks your configuration for syntax errors or wrong configuration values. Use the `files` argument to check custom files or multiple files merge result:

.. code-block:: bash

    orocloud-cli config:validate

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/www/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml /mnt/ocom/app/www/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml /mnt/ocom/app/www/orocloud.yaml /mnt/ocom/app/www/orocloud_prod.yaml

Valid changes are applied within 10 minutes or automatically during deployments.

Use the `help` command to get configuration details or configuration reference:

.. code-block:: bash

    orocloud-cli config:help
    orocloud-cli config:help webserver.limit_whitelist
    orocloud-cli config:help orocloud_options.webserver.limit_whitelist

.. note:: Please do not use double quotes for any variables. Use single quotes instead.

.. note:: Please do not use tabs in `orocloud.yaml` as indentations as they are treated differently by different editors and tools. Since indentation is crucial for  proper interpretation of YAML, **use spaces only**.

With `orocloud.yaml` it is possible to override the following nodes:

**install_commands**

.. hint:: See the :ref:`oro:install <bundle-docs-platform-installer-bundle-oro-install-command>` command description for more information.

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        install_commands: # Application commands which run during the installation process
          - 'oro:install --sample-data=n --user-name=admin --user-email=admin@example.com --user-password=new_password --user-firstname=John --user-lastname=Doe --application-url=https://example.com --organization-name=Oro'

.. note:: As most of time the `deploy` operation runs only once, it is recommended to avoid storing any sensitive data (such as email, username, or password) in any files for security purposes. You can omit options like `user-name`, `user-email` or `user-password`. When omitted, they are asked interactively during the `deploy` operation.

**upgrade_commands**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        upgrade_commands: # Application commands which run during update process
          - 'oro:platform:update'

**pre_upgrade_commands, post_upgrade_commands, pre_maintenance_commands, post_maintenance_commands**

Set up notifications using :ref:`Maintenance mode notifications <bundle-docs-platform-notification-bundle>` for :ref:`Upgrades <orocloud-maintenance-use-upgrade>` and :ref:`Maintenance Mode <dev-cookbook-system-websockets-maintenance-mode>`.

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        # Executed after `oro:platform:update` dry-run check.
        # Executed before `oro:platform:update --force` or customized `upgrade_commands` commands.
        pre_upgrade_commands: 
          - 'oro:maintenance-notification --message=Deploy\ start --subject=At\ UAT'

        # Executed after `oro:platform:update` dry-run check.
        # Executed before `oro:platform:update --force` or customized `upgrade_commands` commands, `oro:maintenance:lock` or `lexik:maintenance:lock` commands.
        # Works with Upgrade With Downtime using `orocloud-cli upgrade` only.
        pre_maintenance_commands:
          - 'oro:maintenance-notification --message=Maintenance\ start --subject=At\ UAT'

        # Executed after `oro:platform:update --force` or customized `upgrade_commands` commands, `oro:maintenance:unlock` or `lexik:maintenance:unlock` commands.
        # Works with Upgrade With Downtime using `orocloud-cli upgrade` only.
        post_maintenance_commands:
          - 'oro:maintenance-notification --message=Maintenance\ finish --subject=At\ UAT'

        # Executed after `oro:platform:update --force` or customized `upgrade_commands` commands and services start.
        post_upgrade_commands:
          - 'oro:maintenance-notification --message=Deploy\ finish --subject=At\ UAT'

**git clone configuration**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        git_clone_recursive: true

.. note:: Please note that by default, ``git_clone_recursive: true``. Allowed values: ``true``, ``false``.

**composer_command**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        composer_command: '{{composer_cmd}} install --no-dev --optimize-autoloader'

.. note:: Please note that ``{{composer_cmd}}`` is a reserved variable and in most cases during executions it will be replaced with the ``composer`` value. Please, keep in mind that the command format is IMPORTANT and should take the following form: ``{environment variables} {{composer_cmd}} {command} {option1 option2 ... option n}``.

For example:

* `{{composer_cmd}} install --no-dev -vvv`
* `COMPOSER=dev.json {{composer_cmd}} install --no-dev -vvv`

Some options may also be omitted as they are added automatically:

* The `--working-dir (-d)` option will be ignored because it is added automatically during the `deploy` | `upgrade` command.
* The `--no-interaction (-n)` option will be ignored because it is added automatically during the `deploy` | `upgrade` command.
* The `-v|vv|vvv, --verbose` option will be used (if specified) with a higher priority than the same option in the `deploy` | `upgrade` command, e.g. ``orocloud-cli deploy -vv``.

**after_composer_install_commands**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        after_composer_install_commands:
          - 'command1'

**db_extensions**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        db_extensions:
          - 'uuid-ossp'
          - 'pgcrypto'

**before_backup_create_commands**

.. code-block:: yaml

    ---
    orocloud_options:
      deployment:
        before_backup_create_commands:
          - 'command1'
          - 'command2'

**after_backup_create_commands**

.. code-block:: none


    ---
    orocloud_options:
      deployment:
        after_backup_create_commands:
          - 'command1'
          - 'command2'

.. _orocloud-maintenance-advanced-use-application-config:

Application Configuration
-------------------------

There are two types of pages in OroCloud, maintenance and error. Maintenance pages allow to determine the page you will see when you move the application into the maintenance mode. Error pages allow to redefine the standard pages that will be displayed in the event of the following errors:

* Error 403 can be returned by the application itself when authorization is blocked, and by the web application firewall. 

  .. note:: This status also can also be returned by nginx when the requested URL is forbidden or by the OroCommerce application itself. These pages are mananged by ngnix and the  application respectively.

* Error 451 appears when requests are blocked by the firewall if they do not fit access policy, for example, when a request is coming from a forbidden IP address (see `OroCloud WAF Configuration`_ section for more information)
* Error 501 is returned when service is not implemented and/or the application does not support the requested functionality
* Error 502 is returned when the server is unavailable (for example, because of the outage).

``error_pages_path`` is a dynamic error page directory configuration. The default location is the ``error_pages`` directory in a repository. File matching works with response codes and hosts, like 503.$host.html => 503.html => ``error_pages`` option value. Supported response codes are 403, 451, 501, 502, and 503.		

Custom maintenance pages, error pages (403, 451, 501, 502), error pages path, web backend prefix, and consumer debug mode can be configured as described below. Keep in mind that the web_backend_prefix parameter must start with "/" but never end with "/" (for instance, '/admin'):

.. code-block:: none

    ---
    orocloud_options:
      application:
        maintenance_page: 'public/maintenance.html'
        error_pages:
          403: 'public/403.html'
          451: 'public/451.html'
          501: 'public/501.html'
          502: 'public/502.html'
        error_pages_path: 'error_pages'
        web_backend_prefix: '/my_admin_console_prefix'
        consumers_debug_mode: true


The ``maintenance_page``, ``error_pages_path`` and ``error_pages`` are relative paths to files in the application repository. When modified, changes are applied after the `deploy` or `upgrade` operation in approximately 10 minutes.

.. note:: Changing the ``web_backend_prefix`` value without notifying the Cloud team can break the back-office of the application. Make sure you create a request to the Service Desk before making any changes. You can also change the value without creating a request. In this case, you should wait for approximately 30 min and then, run ``upgrade:source`` to apply changes.

Webserver Configuration
-----------------------

Webserver configuration can be modified, as illustrated below:

.. code-block:: none

    ---
    orocloud_options:
      webserver:
        header_x_frame: true
        header_x_frame_app_control: true
        redirects_map:
          '/about_us_old': '/about'
          '/about_them_old': '/about_them'
          '/news/new_event' : 'https://corpsite.com/events/newest'
        redirects_map_include:
          - 'redirects/website1.yml'
          - 'redirects/website2.yaml'
          - '/mnt/ocom/app/redirects.yml'
        locations:
          'root':
            type: 'php'
            satisfy: any # Allow access if all (all) or at least one (any) access directive satisfied
            location: '~ /index\.php(/|$)'
            auth_basic_enable: true
            auth_basic_userlist:
              user1:
                ensure: 'present'
                password: 'password1'
              user2:
                ensure: 'absent'
                password: 'password2'
          'admin':
            type: 'php'
            satisfy: any # Allow access if all (all) or at least one (any) access directive satisfied
            location: '~ /index\.php/admin(/|$)'
            auth_basic_enable: true
            auth_basic_userlist:
              user3:
                ensure: 'present'
                password: 'password1'
              user4:
                ensure: 'absent'
                password: 'password2'
            allow:
              - '127.0.0.1'
              - '127.0.0.2'
            deny:
              - 'all'
          'de':
            type: 'php'
            location: '/de'
            fastcgi_param:
              'WEBSITE': '$host/de'
            allow:
              - '127.0.0.1'
              - '127.0.0.2'
            deny:
              - 'all'
          'en':
            type: 'php'
            location: '/en'
            fastcgi_param:
              'WEBSITE': '$host/en'
            allow:
              - '127.0.0.1'
              - '127.0.0.2'
            deny:
              - 'all'
        access_policy:
          'ip':
            'type'  : 'allow'
            'allow' :
              - '127.0.0.1'
              - '192.168.0.1'
              - '172.16.0.0/16'
            'deny'  :
              - '10.0.0.1'
          'country':
            'type'  : 'deny'
            'allow' :
              - 'US'
              - 'CA'
          'ua':
            'allow' :
              - 'GoogleStackdriverMonitoring'
              - 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider',
              - 'Mozilla\/5\.0 \(compatible\;\ MSIE\ 9\.0;\ Windows\ NT 6\.1\;\ Trident\/5\.0\)\;\ 360Spider',
            'deny'  :
              - 'AcoiRobot'
              - 'Wget'
          'uri':
            'allow' :
              - '~(^/api/(.*))'
        limit_whitelist:
          - '8.8.8.8'
          - '10.1.0.0/22'
        limit_whitelist_uri:
          - '~(^/admin/test/(.*))'
        blackfire_options:
          agent_enabled : true
          apm_enabled   : 1
          server_id     : '<server-id>'
          server_token  : '<server-token>'
          log_level     : '1'
          log_path      : '/var/log/blackfire/agent.log'
        newrelic_options:
          license_key: ‘shaike5fith3ieKahn4zae6iedeiphoo7Phoo1ca’


Redirects Configuration
^^^^^^^^^^^^^^^^^^^^^^^

This configuration option enables you to setup redirects to the existing URLs of OroCloud application.

* **redirects_map** — the hash where the key is an old URL, and the value is a new URL.

Examples, applicable both for `redirects_map` values and those which are listed in `redirects_map_include` files:

.. code-block:: none

    orocloud_options:
      webserver:
        redirects_map:
          # Simple examples that don't envolve using special characters other than `/`.
          /us: /us/
          /gb: /gb/
          /news/new_event: https://corpsite.com/events/newest


          # Examples of using special characters without wrapping values with `"` or `'` characters.
          /about'old: /about
          /about(old): /about
          
          # Regular expression example with a simple capturing group and backreference.
          ~/about(\d[a-z]): /about#$1
          
          # Regular expression example with named capturing group and backreference.
          ~/about-(?<suffix>[[:alpha:]]*): /about#$suffix


          # Examples of values wrapped with `"` or `'` characters.
          # Wrapping values in the examples bellow is required because of `{` character within the values.
          
          # Value wrapped with `"` character requires to escape `'` character with `'` character itself.
          '"~/about''\d{1}$"': /about
          '"~/about''(\d{3})$"': /about#$1
          
          # Value wrapped with `'` character requires to escape '`' character with `\\` characters and `\` character with `\` character itself.
          "'~/about\\'\\d{2}$'": /about

* **redirects_map_include** — list of YAML files with the hashes where the key is an old URL, and the value is a new URL (similar to ``redirects_map``).

Examples:

.. code-block:: none

    orocloud_options:
      webserver:
        redirects_map_include:
          # Values with relative paths are relative to Git repository root directory.
          - 'redirects/redirects.yml'

          # Values with absolute paths are environment-specific.
          - '/mnt/ocom/app/redirects.yml'

Old URL values in redirects are case insensitive and must not contain duplicates.

When modified, changes are applied after the `deploy` or `upgrade` operation in approximately 10 minutes

X Frame Header Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* **header_x_frame: true** — is the default value of the flag, configured in the Webserver configuration section. In this case, OroCloud WAF adds the “X-Frame-Options: SAMEORIGIN” header when responding to the initial request. It makes it impossible to embed any OroCommerce site into iFrame at any site except itself to fulfill security requirements.

* **header_x_frame_app_control: true** - Ignore the “X-Frame-Options” header and allow the application to decide if the header is required. It can be configured in the Webserver or Domain configuration section. Configuration in the domain section takes priority over the webserver section.

Some business cases require embedding the OroCloud site into the iFrame at other sites, in which case you must set the value to “false”: ``header_x_frame: false``.
This prevents WAF from sending the “X-Frame-Options” header, which allows embedding into any iFrame.

.. _orocloud-maintenance-advanced-use-locations-config:

Locations Configuration
^^^^^^^^^^^^^^^^^^^^^^^

This configuration option is used to manage locations.

* **locations** — the hash of hashes. The top key is the location name; the lower keys are:

   * `type` — location type. Possible values are ``php``, ``static``, ``rewrite``.
   * `satisfy` — defines how conditions are used. Possible values are ``all`` and ``any``.

      * `all` - all conditions must be met for the specific location (logical ``and``)
      * `any` - any condition can be met for the specific location (logical ``or``)

        .. note:: When ``auth_basic_enable`` is set to true, the ``satisfy`` directive is automatically configured as *any*. This ensures that authentication is allowed based on any of the specified conditions, including IP whitelisting.

   * `location` — location URI. The value may have regular expressions and modifiers, as it is used in the Nginx location directive.
   * `fastcgi_param` — the hash for php-specific custom variables.
   * `auth_basic_enable` — a boolean trigger for HTTP basic authentication.

      * `auth_basic_userlist` — the hash of hashes with a user name as a key and mandatory nested keys:

          * `ensure` — ensures if the user is **present** or **absent**.
          * `password` — a plain text user password.

   * `allow` — an array of IP addresses or network masks allowed to access location. Use one record per line or ``any`` to allow access from anywhere.
   * `deny` — an array of IP addresses or network masks denied to access location. Use one record per line or ``any`` to deny access from anywhere.

OroCloud WAF Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^

Approach
~~~~~~~~

OroCloud provides two ways to protect the application from big amounts of requests which can cause denial of service. There are two layers of protection used by the OroCloud application which are illustrated in the diagram below:

.. image:: /cloud/img/cloud/protection_layers.png
   :alt: Protection layers used by the OroCloud application
   :scale: 60%

Requests Filtering
~~~~~~~~~~~~~~~~~~

This layer is responsible for filtering HTTP requests depending on their sources. The requests can come from certain:

* IP addresses or networks
* Countries
* User Agents

The rules used by this firewall are defined in the ``access_policy`` section of the `orocloud.yaml` file and are explained below. The HTTP request dropped at this layer of protection has HTTP status 451, which is “Unavailable For Legal Reasons”.

Robot Detection
"""""""""""""""

The application drops requests from the user agents that do not support JS effectively protecting from the simple robots. Any request from a client (browser, robot, etc.) which do not support cookies and JS is dropped with HTTP status 451, and this client is redirected to the error page. It is possible to whitelist specific user agents using the rules described below.

The IP addresses of the search engines, which cannot pass the WAF test cookie module, are whitelisted to allow the exchange of information between the Oro application and these platforms, facilitating accurate search results. See the complete list of IP addresses below:

.. code-block:: none

   # OroInc monitoring IP list
      - '35.246.191.79' # puppet-prod1-mon1
      - '35.239.98.170' # puppet-prod2-mon1
      # Alexa Bot IP Addresses
      - '204.236.235.245'
      - '75.101.186.145'
      # Baidu Bot IP Addresses
      - '180.76.15.0/24'
      - '119.63.196.0/24'
      - '115.239.212.0/24'
      - '119.63.199.0/24'
      - '122.81.208.0/22'
      - '123.125.71.0/24'
      - '180.76.4.0/24'
      - '180.76.5.0/24'
      - '180.76.6.0/24'
      - '185.10.104.0/24'
      - '220.181.108.0/24'
      - '220.181.51.0/24'
      - '111.13.202.0/24'
      - '123.125.67.144/29'
      - '123.125.67.152/31'
      - '61.135.169.0/24'
      - '123.125.68.68/30'
      - '123.125.68.72/29'
      - '123.125.68.80/28'
      - '123.125.68.96/30'
      - '202.46.48.0/20'
      - '220.181.38.0/24'
      - '123.125.68.80/30'
      - '123.125.68.84/31'
      - '123.125.68.0/24'
      # Bing Bot IP Addresses
      - '65.52.104.0/24'
      - '65.52.108.0/22'
      - '65.55.24.0/24'
      - '65.55.52.0/24'
      - '65.55.55.0/24'
      - '65.55.213.0/24'
      - '65.55.217.0/24'
      - '131.253.24.0/22'
      - '131.253.46.0/23'
      - '40.77.167.0/24'
      - '199.30.27.0/24'
      - '157.55.16.0/23'
      - '157.55.18.0/24'
      - '157.55.32.0/22'
      - '157.55.36.0/24'
      - '157.55.48.0/24'
      - '157.55.109.0/24'
      - '157.55.110.40/29'
      - '157.55.110.48/28'
      - '157.56.92.0/24'
      - '157.56.93.0/24'
      - '157.56.94.0/23'
      - '157.56.229.0/24'
      - '199.30.16.0/24'
      - '207.46.12.0/23'
      - '207.46.192.0/24'
      - '207.46.195.0/24'
      - '207.46.199.0/24'
      - '207.46.204.0/24'
      - '157.55.39.0/24'
      # Duckduck Bot IP Addresses
      - '46.51.197.88'
      - '46.51.197.89'
      - '50.18.192.250'
      - '50.18.192.251'
      - '107.21.1.61'
      - '176.34.131.233'
      - '176.34.135.167'
      - '184.72.106.52'
      - '184.72.115.86'
      # Facebook Bot IP Addresses
      - '31.13.107.0/24'
      - '31.13.109.0/24'
      - '31.13.200.0/24'
      - '66.220.144.0/20'
      - '69.63.189.0/24'
      - '69.63.190.0/24'
      - '69.171.224.0/20'
      - '69.171.240.0/21'
      - '69.171.248.0/24'
      - '173.252.73.0/24'
      - '173.252.74.0/24'
      - '173.252.77.0/24'
      - '173.252.100.0/22'
      - '173.252.104.0/21'
      - '173.252.112.0/24'
      - '2a03:2880:10::/48'
      - '2a03:2880:11::/48'
      - '2a03:2880:20::/48'
      - '2a03:2880:1010::/48'
      - '2a03:2880:1020::/48'
      - '2a03:2880:2020::/48'
      - '2a03:2880:2050::/48'
      - '2a03:2880:2040::/48'
      - '2a03:2880:2110::/48'
      - '2a03:2880:2130::/48'
      - '2a03:2880:3010::/48'
      - '2a03:2880:3020::/48'
      # Google Bot IP Addresses
      - '203.208.60.0/24'
      - '66.249.64.0/20'
      - '72.14.199.0/24'
      - '209.85.238.0/24'
      - '66.249.90.0/24'
      - '66.249.91.0/24'
      - '66.249.92.0/24'
      - '2001:4860:4801:1::/64'
      - '2001:4860:4801:2::/64'
      - '2001:4860:4801:3::/64'
      - '2001:4860:4801:4::/64'
      - '2001:4860:4801:5::/64'
      - '2001:4860:4801:6::/64'
      - '2001:4860:4801:7::/64'
      - '2001:4860:4801:8::/64'
      - '2001:4860:4801:9::/64'
      - '2001:4860:4801:a::/64'
      - '2001:4860:4801:b::/64'
      - '2001:4860:4801:c::/64'
      - '2001:4860:4801:d::/64'
      - '2001:4860:4801:e::/64'
      - '2001:4860:4801:2001::/64'
      - '2001:4860:4801:2002::/64'
      # Sogou Bot IP Addresses
      - '220.181.125.0/24'
      - '123.126.51.64/27'
      - '123.126.51.96/28'
      - '123.126.68.25'
      - '61.135.189.74'
      - '61.135.189.75'
      # Yahoo Bot IP Addresses
      - '67.195.37.0/24'
      - '67.195.50.0/24'
      - '67.195.110.0/24'
      - '67.195.111.0/24'
      - '67.195.112.0/23'
      - '67.195.114.0/24'
      - '67.195.115.0/24'
      - '68.180.224.0/21'
      - '72.30.132.0/24'
      - '72.30.142.0/24'
      - '72.30.161.0/24'
      - '72.30.196.0/24'
      - '72.30.198.0/24'
      - '74.6.254.0/24'
      - '74.6.8.0/24'
      - '74.6.13.0/24'
      - '74.6.17.0/24'
      - '74.6.18.0/24'
      - '74.6.22.0/24'
      - '74.6.27.0/24'
      - '98.137.72.0/24'
      - '98.137.206.0/24'
      - '98.137.207.0/24'
      - '98.139.168.0/24'
      - '114.111.95.0/24'
      - '124.83.159.0/24'
      - '124.83.179.0/24'
      - '124.83.223.0/24'
      - '183.79.63.0/24'
      - '183.79.92.0/24'
      - '203.216.255.0/24'
      - '211.14.11.0/24'
      # Yandex Bot IP Addresses
      - '100.43.90.0/24'
      - '37.9.115.0/24'
      - '37.140.165.0/24'
      - '77.88.22.0/25'
      - '77.88.29.0/24'
      - '77.88.31.0/24'
      - '77.88.59.0/24'
      - '84.201.146.0/24'
      - '84.201.148.0/24'
      - '84.201.149.0/24'
      - '87.250.243.0/24'
      - '87.250.253.0/24'
      - '93.158.147.0/24'
      - '93.158.148.0/24'
      - '93.158.151.0/24'
      - '93.158.153.0/32'
      - '95.108.128.0/24'
      - '95.108.138.0/24'
      - '95.108.150.0/23'
      - '95.108.158.0/24'
      - '95.108.156.0/24'
      - '95.108.188.128/25'
      - '95.108.234.0/24'
      - '95.108.248.0/24'
      - '100.43.80.0/24'
      - '130.193.62.0/24'
      - '141.8.153.0/24'
      - '178.154.165.0/24'
      - '178.154.166.128/25'
      - '178.154.173.29'
      - '178.154.200.158'
      - '178.154.202.0/24'
      - '178.154.205.0/24'
      - '178.154.239.0/24'
      - '178.154.243.0/24'
      - '37.9.84.253'
      - '199.21.99.99'
      - '178.154.162.29'
      - '178.154.203.251'
      - '178.154.211.250'
      - '95.108.246.252'
      - '5.45.254.0/24'
      - '5.255.253.0/24'
      - '37.140.141.0/24'
      - '37.140.188.0/24'
      - '100.43.81.0/24'
      - '100.43.85.0/24'
      - '100.43.91.0/24'
      - '199.21.99.0/24'
      # Youdao Bot IP Addresses
      - '61.135.249.200/29'
      - '61.135.249.208/28'
      # Symantec Corporation IP
      - '168.149.144.12'

Rate Limiting Request
~~~~~~~~~~~~~~~~~~~~~

On this layer, WAF performs rate limiting to detect crawling robots and excessive HTTP requests using the following mechanisms.

Rate limiting algorithm uses 3 parameters: ``rate limit``, ``delay``, and ``burst``. It groups requests by the source IP and destination URI and throttles them to the ``rate limit`` if there are more than a ``delay`` requests per second for a given group of requests. Nginx drops all consequent requests from a group if their amount is bigger than the ``burst`` value. The exact values of these parameters depend on the grouping factor (IP, URI, etc.).

HTTP request dropped at this layer of protection has HTTP status 451 “Unavailable For Legal Reasons”. It is possible to define exceptions for rate limiting using the ``limit_whitelist`` and ``limit_whitelist_uri`` sections of the `orocloud.yaml` file.

Rules Definition
~~~~~~~~~~~~~~~~

WAF Rules
"""""""""

Rules to manage HTTP requests filtering are defined in the following sections of the `orocloud.yaml` file.

Before implementing changes in this file on production, you should always test it at the environment stage to avoid issues with live application.

Source filtering rules are defined in the ``webserver`` section. This is the child element of the ``orocloud_options`` data structure. Here is an example of rules definitions:

.. code-block:: none

    ---
    orocloud_options:
      webserver:
        access_policy:
          'ip':
            'type'  : 'allow'
            'allow' :
              - '127.0.0.1'
              - '192.168.0.1'
              - '172.16.0.0/16'
            'deny'  :
              - '10.0.0.1'
          'country':
            'type'  : 'deny'
            'allow' :
              - 'US'
              - 'CA'
          'ua':
            'allow' :
              - 'GoogleStackdriverMonitoring'
              - 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider',
              - 'Mozilla\/5\.0 \(compatible\;\ MSIE\ 9\.0;\ Windows\ NT 6\.1\;\ Trident\/5\.0\)\;\ 360Spider',
            'deny'  :
              - 'AcoiRobot'
              - 'Wget'
          'uri':
            'allow' :
              - '~(^/api/(.*))'

``access_policy`` --- The hash of hashes provides the ability to manage Oro Web Application Firewall and allow or deny requests depending on the source address, source country, user agent, and URI.

All rejected requests receive status 451.

The following hashes can be used:

* ``ip`` — the hash defines the rules for the source IP filtering.
* ``country`` — the hash defines rules for the originating country filtering. The value of `type` key defines if the hash contains the allowed or prohibited countries. Country must be defined by ISO 3166 Alpha1 code. GeoIP database is used to define a country from the source IP.

An example of the rule to allow only the defined countries:

.. code-block:: none


   'country':
     'type'  : 'deny'
     'allow' :
       - 'US'
       - 'CA'

In this example, only the requests from the USA and Canada are allowed. All other requests are rejected.

An example of the rule to deny requests from the defined countries:

.. code-block:: none


   'country':
     'type'  : 'allow'
     'deny' :
       - 'CN'
       - 'RU'

In this example, all requests from China and Russia are to be rejected.

* ``ua`` --- The hash provides the ability to allow or deny requests from the specific user agents. A user agent is defined by the regexp string. Scalar values are transformed to regexps automatically. There are two possible lists for this hash: ``allow`` and ``deny`` to allow or deny requests from the listed user agents.

An example of the user agent rule:

.. code-block:: none


   'ua':
     'allow' :
        - 'GoogleStackdriverMonitoring'
        - 'AdsBot-Google (+http://www.google.com/adsbot.html)'
     'deny'  :
       - 'AcoiRobot'
       - 'Wget'


This example allows requests from the ``GoogleStackdriverMonitoring`` and ``AdsBot-Google`` user agents and rejects all requests from ``AcoiRobot`` and ``Wget``.


* ``uri`` --- The hash provides the ability to allow requests to the specific URI and override the rules defined by other hashes in ``access_policy``. URI can be defined by standard regexp.

An example of the URI rule:

.. code-block:: none


   'uri':
     'allow' :
       - '~(^/api/(.*))'

This example allows any requests to the URI which fits ``~(^/api/(.*))`` regex overriding any rule defined for IP, country, and/or user agent.

Request Rate Limit Rules
""""""""""""""""""""""""

There are two lists to allow any rate of requests for the specific IPs or to the specific URIs. They are the child elements of the ``webserver`` data structure.

Here is an example:

.. code-block:: none


   limit_whitelist:
     - '8.8.8.8'
     - '10.1.0.0/22'
   limit_whitelist_uri:
     - '~(^/admin/test/(.*))'

``limit_whitelist`` --- The list contains source IPs and subnets which are allowed to send requests to the application with any rate. This can be used to whitelist some service IPs which need to perform many requests, e.g., for load testing.

An example of the whitelist:

.. code-block:: none


   limit_whitelist:
     - '8.8.8.8'
     - '10.1.0.0/22'

This rule allows unlimited rate of requests from IP 127.0.0.1 (local host) and subnet 10.1.0.0/22.

``limit_whitelist_uri`` ---  The list contains regular expressions to define URI of the application which must not be limited by request rate. This can be used to whitelist URIs that need to receive many requests, e.g., integration URI.

An example of the whitelist:

.. code-block:: none

   limit_whitelist_uri:
     - '~(^/admin/test/(.*))'

This rule allows the unlimited rate of requests to URI containing the /admin/test/ string.

.. note:: Allowing access via WAF does not affect simultaneous connections limits. Use **limit_whitelist** or **limit_whitelist_uri** to set unlimited connectios for a client IP or URI on the server.

Domain Configuration
--------------------

``webserver``-like configuration per domain:

.. code-block:: none

    orocloud_options:
      domains:
        oro-cloud.com:
          locations_merge: true
          maintenance_page: 'public/oro-cloud.html'
          header_x_frame_app_control: true
          redirects_map:
            '/about_us_old': '/about'
            '/about_them_old': '/about_them'
          redirects_map_include:
            - 'redirects/website1.yml'
            - 'redirects/website2.yaml'
            - '/mnt/ocom/app/redirects.yml'
          locations:
            'de':
              type: 'php'
              location: '/de'
              fastcgi_param:
                'WEBSITE': '$host/de'
              allow:
                - '127.0.0.1'
                - '127.0.0.2'
              deny:
                - 'all'
            'en':
              type: 'php'
              location: '/en'
              fastcgi_param:
                'WEBSITE': '$host/en'
              allow:
                - '127.0.0.1'
                - '127.0.0.2'
              deny:
                - 'all'
        example.com:
          locations_merge: false
          maintenance_page: 'public/example.html'
          header_x_frame_app_control: true
          redirects_map:
            '/about_us_old': '/about'
            '/about_them_old': '/about_them'
          redirects_map_include:
            - 'redirects/website3.yml'
            - 'redirects/website4.yaml'
            - '/mnt/ocom/app/redirects.yml'
          locations:
            'root':
              type: 'php'
              satisfy: any # Allow access if all (all) or at least one (any) access directive satisfied
              location: '~ /index\.php(/|$)'
              auth_basic_enable: true
              auth_basic_userlist:
                user1:
                  ensure: 'present'
                  password: 'password1'
                user2:
                  ensure: 'absent'
                  password: 'password2'
            'admin':
              type: 'php'
              satisfy: any # Allow access if all (all) or at least one (any) access directive satisfied
              location: '~ /index\.php/admin(/|$)'
              auth_basic_enable: true
              auth_basic_userlist:
                user3:
                  ensure: 'present'
                  password: 'password1'
                user4:
                  ensure: 'absent'
                  password: 'password2'
              allow:
                - '127.0.0.1'
                - '127.0.0.2'
              deny:
                - 'all'
            'de':
              type: 'php'
              location: '/de'
              fastcgi_param:
                'WEBSITE': '$host/de'
              allow:
                - '127.0.0.1'
                - '127.0.0.2'
              deny:
                - 'all'
            'en':
              type: 'php'
              location: '/en'
              fastcgi_param:
                'WEBSITE': '$host/en'
              allow:
                - '127.0.0.1'
                - '127.0.0.2'
              deny:
                - 'all'

Profiling Application Console Commands via Blackfire
----------------------------------------------------

The configuration option enables you to configure Blackfire.

``blackfire_options`` --- The hash is used to configure the Blackfire agent on environment

   * `agent_enabled` — a boolean trigger for Blackfire installation
   * `apm_enabled` - the option enables (1) or disables (0) the Blackfire APM feature. Please note that you need to have it included into your license.
   * `server_id` — a server ID string. Refer your Blackfire account to this value.
   * `server_token` — a server token string. Refer your Blackfire account to this value.
   * `log_level` — Blackfire agent log verbosity.
   * `log_path` — a path to the log file location.


You can then profile the application console commands via configured Blackfire:

.. code-block:: none


    orocloud-cli app:console [command] --blackfire-enable --blackfire-client-id [client-id] --blackfire-client-token [client-token] [--blackfire-env env] [--blackfire-samples count]

.. note:: Make sure you enable Blackfire via orocloud.yaml before using this functionality.

Profiling Application Using NewRelic
------------------------------------

The ``newrelic_options`` configuration option allows you to configure NewRelic profiler (must be installed and configured per separate support request). Please, pay attention that the value of the license_key is provided as an example, and you need to use your actual license key there.

.. _orocloud-maintenance-advanced-use-mail-settings:

Mail Settings
-------------

To prevent sending test emails accidentally from the staging environment to any real users or customers, add the domains of email recepients that you will be using for testing to your whitelist:

.. code-block:: none


    ---
    orocloud_options:
      mail:
        whitelist:
          - 'example.com'
          - 'examlpe.org'
          - 'example.net'

Where:

* **mail** is a hash of mail-related settings
* **whitelist** is an array of whitelisted mail domains

.. note:: In production environments all domains are whitelisted. When you create a whitelist, it blocks sending email to any recipients, except for the ones in the whitelisted email domains.

.. _orocloud-maintenance-advanced-use-sanitization-conf:

Sanitizing Configuration
------------------------

Regardless of the Oro application type, each has its own default sanitize rules (`sanitize.method.rawsql` and `sanitize.method.update`). However, you can add your own rules, remove a specific default rule, or completely override them.

The sanitize configuration is grouped under the `sanitize` node and supports the following sanitize methods:

* **sanitize.rawsql_add_rules** — the list of raw SQL queries that helps you to sanitize the existing data, for example, delete data using the TRUNCATE method, UPDATE data to apply any custom modification, etc.

* **sanitize.rawsql_delete_rules** —  the list of raw SQL queries, which should be removed from the list in `sanitize.method.rawsql`. The format is the same as `sanitize.rawsql_add`.

* **sanitize.rawsql_override_rules** —  the list of raw SQL queries, which will be applied to sanitizing data and override default sanitize rule `sanitize.method.rawsql`. Please note, that if this option is specified, all `sanitize.rawsql_add_rules` and `sanitize.rawsql_delete_rules` will be ignored. The format is the same as `sanitize.rawsql_add_rules`.

* **sanitize.update_add_rules** — the mapping between specific table columns and the sanitizing method that should be used for the values.

* **sanitize.update_delete_rules** — the list of rules which will be deleted from the list in `sanitize.method.update`. The format is the same as in `sanitize.update_add_rules`.

* **sanitize.update_override_rules** — the list of rules which will be applied to sanitizing data and overriding the default sanitize rule `sanitize.method.update`. Please note, that if this option is specified, all `sanitize.update_add_rules` and `sanitize.update_delete_rules` will be ignored. The format is the same as `sanitize.update_add_rules`.

.. note:: Please keep in mind that **ALL** values in `rawsql_*_rules` and `update_*_rules` **MUST** be wrapped in **SINGLE** quotes.

.. code-block:: none


      ---
      orocloud_options:
        deployment:
          sanitize:
            rawsql_add_rules:
              - 'TRUNCATE oro_message_queue_job_unique_test'
            rawsql_delete_rules:
              - 'TRUNCATE oro_tracking_visit_event'
              - 'TRUNCATE oro_tracking_website CASCADE'
            rawsql_override_rules:
              - 'TRUNCATE oro_tracking_visit_event'
              - 'TRUNCATE oro_tracking_website CASCADE'
            update_add_rules:
              - '{ table: oro_email_test, columns: [{name: subject, method: md5}, {name: from_name, method: md5}] }'
            update_delete_rules:
              - '{ table: oro_integration_transport, columns: [{name: api_key, method: md5},{name: api_user, method: md5},{name: api_token, method: md5}] }'
            update_override_rules:
              - '{ table: oro_integration_transport, columns: [{name: api_key, method: md5},{name: api_user, method: md5},{name: api_token, method: md5}] }'
            custom_email_domain: 'example.com'

General Conventions
^^^^^^^^^^^^^^^^^^^

Please use the following conventions to design your `sanitize.update_*` strategy:

* Provide sanitizing configuration for every table as a new item:

  .. code-block:: none


      update_add_rules:
            - '{ table: oro_address, columns: [{name: street, method: md5}, {name: city, method: md5}, {name: postal_code, method: md5}, {name: last_name, method: md5}] }'
            - '{ table: oro_business_unit, columns: [{name: email, method: email}, {name: name, method: md5}, {name: phone, method: md5}] }'

* Provide the table name in the table node.
* In the columns section, provide an array of column name and sanitizing method pairs for all the columns that should be sanitized in the mentioned table.

  For example:

  .. code-block:: none


      columns: [{name: street, method: md5}, {name: city, method: md5} ]

* Provide the column name in the name node. Use the following sanitize methods/strategies (ensure they reasonably match the column type):

  * `md5` — Replaces the original string with the string hash.
  * `email` — Replaces the email with the sanitized version of the email. When the `sanitize.custom_email_domain` configuration parameter is provided in the `deployment.yml` or `orocloud.yaml` files, the email strategy replaces the real email domain with the custom one provided as `sanitize.custom_email_domain`. If the custom domain is not provided, the sanitized email will be generated randomly. For example, `example@example.com`.
  * `date` — Replaces the date values with the current date and time.
  * `attachment` — Replaces the attachment file content with a dummy blank image.

Environments Data Synchronization
---------------------------------

Cloud-based environments may be synchronized by a user without filing a request to the support team.

To retrieve a list of the environments to which you can sync the sanitized data from the current environment, run the following command:

.. code-block:: none

    orocloud-cli dump:environments

.. note:: If you have no environments in the output, ask the support team to update your environment settings.

This means that you can push data from the current environment to the linked environment.

.. code-block:: none

    orocloud-cli dump:create --help

.. code-block:: none

    Description:
      Create application environment data dump and copy it to another environment.

    Usage:
      dump:create [options]

    Options:
          --log=LOG                                Log to file
          --downtime-duration[=DOWNTIME-DURATION]  (OPTIONAL) Downtime duration, by default 1 hour. Expected format: '{number}d{number}h{number}m'. Usage example: '1d3h15m' means 1 day 3 hours 15 minutes OR '30m' means 30 minutes.
          --downtime-comment[=DOWNTIME-COMMENT]    Comment for provided custom downtime value. Required if [downtime-duration] provided. Wrap with double-quotes if contains spaces.
      -e, --environment[=ENVIRONMENT]              Name of the destination environment where data dump will be copied. To list all available environments, please use dump:environments command.
      -c, --components[=COMPONENTS]                Comma-separated components list (without spaces) to be included in the dump. Allowed: db,ess,media,code. Default: db. Database is sanitized. If media component selected, it may take much time. [default: "db"]
      -i, --indices[=INDICES]                      Comma-separated Elastic indices list to be included in the dump. If not set - all indices will be included.
      -h, --help                                   Display this help message
      -q, --quiet                                  Do not output any message
      -V, --version                                Display this application version
          --ansi                                   Force ANSI output
          --no-ansi                                Disable ANSI output
      -n, --no-interaction                         Do not ask any interactive question
      -v|vv|vvv, --verbose                         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

    * **option "--environment"** - Name of the destination environment where data dump will be copied.

    * **option "--components"** - Comma-separated components list (without spaces) to be included in the dump. Allowed: db,ess,rpm. Default: db. Database is sanitized.

    * **option "--indices"** - Comma-separated Elastic indices list to be included in the dump. If not set - all indices will be included.

.. note:: RabbitMQ messages sync is not supported. If media component is selected, sync may take a long time.

When data push is done, you may start with import in the target environment.

To list all available data dumps that can be restored to the current environment, run:

.. code-block:: none

    orocloud-cli dump:list --help

.. code-block:: none

    Description:
      Lists all available data dumps that can be restored to the current environment.

    Usage:
      dump:list [options]

    Options:
          --log=LOG            Log to file
          --page=PAGE          Page for display (25 items per page) [default: 1]
          --per-page=PER-PAGE  Items per page [default: 25]
      -h, --help               Display this help message
      -q, --quiet              Do not output any message
      -V, --version            Display this application version
          --ansi               Force ANSI output
          --no-ansi            Disable ANSI output
      -n, --no-interaction     Do not ask any interactive question
      -v|vv|vvv, --verbose     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

To restore it as is, run the following command in the target environment:

.. code-block:: none

    orocloud-cli dump:load --help

.. code-block:: none

    Description:
      Load application data from the dump to the current environment.

    Usage:
      dump:load [options] [--] [<timestamp>]

    Arguments:
      timestamp                                    The timestamp of the exported environment list items to be restored.

    Options:
          --log=LOG                                Log to file
          --downtime-duration[=DOWNTIME-DURATION]  (OPTIONAL) Downtime duration, by default 1 hour. Expected format: '{number}d{number}h{number}m'. Usage example: '1d3h15m' means 1 day 3 hours 15 minutes OR '30m' means 30 minutes.
          --downtime-comment[=DOWNTIME-COMMENT]    Comment for provided custom downtime value. Required if [downtime-duration] provided. Wrap with double-quotes if contains spaces.
          --force[=FORCE]                          Force dump:load operation execution, otherwise the confirmation will be requested. [default: false]
          --host[=HOST]                            Stop program(s) on specified job host only [ocom-vdrizheruk-dev2-app1], otherwise [all].
      -c, --components[=COMPONENTS]                Comma-separated list (without spaces) of components for data to be loaded. Allowed: db,ess,media,code. Default: db. Database is sanitized. If media component selected, it may take much time.
          --skip-purge-media                       Skip purging media on fetch operation
          --skip-prepare-app                       Skip prepare application operations. With this option application will not be usable after finishing operation.
          --flush-elasticsearch                    Flush ElasticSearch. All ElasticSearch data will be lost.
          --run-base-reindex                       Run command [oro:search:reindex] in background.
          --run-website-reindex                    Run command [oro:website-search:reindex] in background.
      -h, --help                                   Display this help message
      -q, --quiet                                  Do not output any message
      -V, --version                                Display this application version
          --ansi                                   Force ANSI output
          --no-ansi                                Disable ANSI output
      -n, --no-interaction                         Do not ask any interactive question
      -v|vv|vvv, --verbose                         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

    * **option "--components"** - Comma-separated list (without spaces) of components for data to be loaded. Allowed: db,ess,rpm. Default: db. Database is sanitized.

    * **option "--skip-prepare-app"** - Skip prepare application operations. With this option application will not be usable after finishing operation.

    * **option "--flush-elasticsearch"** - Flush ElasticSearch. All ElasticSearch data will be lost.

    * **option "--run-base-reindex"** - Run command [oro:search:reindex] in background to update search index for the specified entities.

    * **option "--run-website-reindex"** - Run command [oro:website-search:reindex] in background to rebuild storefront search index.

.. note:: If during dump:load not all components(db,ess,rpm) are selected, the application may be not working. By default only db will be restored.

.. note:: During dump:load, the database is always sanitized.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
