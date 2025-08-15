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

**[Deprecated] after_composer_install_commands**

.. important:: Please avoid using it as it is incompatible with the :ref:`Application Packages Approach <orocloud-maintenance-use-upgrade>`.

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


The ``maintenance_page``, ``error_pages_path`` and ``error_pages`` are relative paths to files in the application repository.

Valid changes are applied within 10 minutes or automatically during deployments.

.. note:: Make sure you create a request to the Service Desk before making any changes. OroCloud’s customer support team can change your backend prefix, or you should wait for approximately 5 minutes after orocloud.yaml changes, and then, run ``upgrade:source`` or ``app:package:deploy --source`` to the previously released commit, tag, or application package to apply changes.

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
          - '/mnt/maint-data/redirects.yml'
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
          'asn':
            'type'  : 'allow'
            'allow' :
              - '31898'
            'deny'  :
              - '16591'
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

This configuration option enables you to set up redirects to the existing URLs of OroCloud application.

* **redirects_map** — the hash where the key is an old URL, and the value is a new URL.

Examples, applicable both for `redirects_map` values and those which are listed in `redirects_map_include` files:

.. code-block:: none

    orocloud_options:
      webserver:
        redirects_map:
          # Simple examples that don't involve using special characters other than `/`.
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
          # Wrapping values in the examples below is required because of the `{` character within the values.
          
          # Value wrapped with `"` character requires escaping the `'` character with the `'` character itself.
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
          - '/mnt/maint-data/redirects.yml'

Old URL values in redirects are case-insensitive and must not contain duplicates.

Valid changes are applied within 10 minutes or automatically during deployments.

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
          * `password` — a plain-text user password.

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
* Autonomous Systems (|ASN|)
* Countries
* User Agents

The rules used by this firewall are defined in the ``access_policy`` section of the `orocloud.yaml` file and are explained below. The HTTP request dropped at this layer of protection has HTTP status 451, which is “Unavailable For Legal Reasons”.

Robot Detection
"""""""""""""""

The testcookie module implements bot detection and mitigation functionality within the WAF Server. 
Trusted user agents, whitelisted IP addresses, approved ASN numbers, and specific URI patterns can be skipped; 
others must return a valid cookie or face redirection or blocking after a few tries.

The Naxsi request-scanning module inspects incoming traffic for common injection patterns and applies simple thresholds to decide whether to block or forward each request. 
Whitelisted requests can skip this scan.
The IP addresses of the search engines, which cannot pass the WAF test cookie module, are whitelisted to allow the exchange of information between the Oro application and these platforms, facilitating accurate search results. 
OroCloud customers can obtain the most up-to-date list of these IP addresses via a Customer Support Portal request.

Error Responses:

* 451 Unavailable for Legal Reasons - Returned when JS is not supported or blocked by Naxsi.

Rate Limiting Request
~~~~~~~~~~~~~~~~~~~~~

On this layer, WAF performs rate limiting to detect crawling robots and excessive HTTP requests using the following mechanisms.

.. image:: /cloud/img/cloud/rate_limit.png
   :alt: Rate limit detailed processing flow.

Request rate is calculated for the source IP addresses sharing the same |ASN| or originating from the zones defined by the setup, e.g.: 

* riskdb_bot: For known bots.
* riskdb_crawler: For web crawlers.
* ip_goodbot: For trusted bots.
* ip_datacenter: For requests from known datacenter IPs.

These zones are updated daily to keep the lists of bots, crawlers, and datacenter IPs current. 
Each zone uses a specific set of parameters for the rate limiting, which defines the rate limit itself,
applied locations, and the status code, e.g., 429 (Too Many Requests) or 503 (Service Unavailable), returned if the rate limit condition is met.
OroCloud customers can obtain the most up-to-date list of all used zones and their rate-limiting parameters via a Customer Support Portal request.

Rate limit definition can be bypassed for the specific source IPs or URI using the limit_whitelist and limit_whitelist_uri sections of the orocloud.yaml file.

Rate Limit for AJAX Requests
""""""""""""""""""""""""""""

OroCommerce rate limit setup contains a rate limit definition that specifically applies to AJAX requests, including the X-Requested-With: XMLHttpRequest header, which is a standard way for web applications to identify AJAX calls.
The rule ensures that AJAX traffic (like dynamic content loading) is managed separately from other requests, such as API calls or static file downloads.
This allows for more precise control over different types of traffic.

Rules Definition
~~~~~~~~~~~~~~~~

WAF Rules
"""""""""

Rules to manage HTTP requests filtering are defined in the following sections of the `orocloud.yaml` file.

Before implementing changes in this file on production, you should always test it in the environment stage to avoid issues with the live application.

Source filtering rules are defined in the ``webserver`` section. This is the child element of the ``orocloud_options`` data structure. Here is an example of rule definitions:

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
          'asn':
            'type'  : 'allow'
            'allow' :
              - '31898'
            'deny'  :
              - '16591'
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

The following hashes can be used:

* ``ip`` — the hash defines the rules for the source IP filtering.
* ``asn`` — the hash defines the rules for the source ASN filtering.
* ``country`` — the hash defines rules for the originating country filtering. The `type` key value defines whether the hash contains the allowed or prohibited countries. Country must be defined by ISO 3166 Alpha1 code. The GeoIP database is used to define a country from the source IP.

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

``limit_whitelist`` --- The list contains source IPs and subnets which are allowed to send requests to the application with ``common`` zone request rate. This can be used to whitelist some service IPs which need to perform more requests, e.g., for load testing.

An example of the whitelist:

.. code-block:: none


   limit_whitelist:
     - '8.8.8.8'
     - '10.1.0.0/22'

This rule allows an unlimited rate of requests from IP 127.0.0.1 (local host) and subnet 10.1.0.0/22.

``limit_whitelist_uri`` ---  The list contains regular expressions to define URI of the application which must be limited by ``common`` zone request rate. This can be used to whitelist URIs that need to receive more requests, e.g., integration URI.

An example of the whitelist:

.. code-block:: none

   limit_whitelist_uri:
     - '~(^/admin/test/(.*))'

This rule allows an unlimited rate of requests to a URI containing the /admin/test/ string.

.. note: Allowing access via WAF does not affect the simultaneous connections limits. Use **limit_whitelist** or **limit_whitelist_uri** to set unlimited connectios for a client IP or URI on the server.

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
            - '/mnt/maint-data/redirects.yml'
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
            - '/mnt/maint-data/redirects.yml'
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

GeoIP Databases
---------------

The following variables are available for locations with the `php` type:

* `GEOIP2_COUNTRY_CODE`, example value: `US` for USA
* `GEOIP2_SUBDIVISION_ISO_CODE`, example value: `OH` for Ohio, US state

Profiling Application Console Commands via Blackfire
----------------------------------------------------

The configuration option enables you to configure Blackfire.

``blackfire_options`` --- The hash is used to configure the Blackfire agent in the environment

   * `agent_enabled` — a boolean trigger for Blackfire installation
   * `apm_enabled` - the option enables (1) or disables (0) the Blackfire APM feature. Please note that you need to have it included in your license.
   * `server_id` — a server ID string. Refer your Blackfire account to this value.
   * `server_token` — a server token string. Refer your Blackfire account to this value.
   * `log_level` — Blackfire agent log verbosity.
   * `log_path` — a path to the log file location.


You can then profile the application console commands via the configured Blackfire:

.. code-block:: none


    orocloud-cli app:console [command] --blackfire-enable --blackfire-client-id [client-id] --blackfire-client-token [client-token] [--blackfire-env env] [--blackfire-samples count]

.. note:: Make sure you enable Blackfire via orocloud.yaml before using this functionality.

Profiling Application Using NewRelic
------------------------------------

The ``newrelic_options`` configuration option allows you to configure NewRelic profiler (must be installed and configured per separate support request). Please, pay attention that the value of the license_key is provided as an example, and you need to use your actual license key there.

.. _orocloud-maintenance-advanced-use-mail-settings:

Mail Settings
-------------

To prevent sending test emails accidentally from the staging environment to any real users or customers, add the domains of email recipients that you will be using for testing to your whitelist:

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

.. note:: In production environments, all domains are whitelisted. When you create a whitelist, it blocks sending emails to any recipients, except those in the whitelisted email domains.

.. _orocloud-maintenance-advanced-use-sanitization-conf:

Sanitizing Configuration
------------------------

.. important:: As of OroCommerce version 6.0 LTS, :ref:`Data Sanitization <dev-sanitize>` has replaced the previous Sanitizing Configuration functionality.

Regardless of the Oro application type, each has its own default sanitize rules (`sanitize.method.rawsql` and `sanitize.method.update`). However, you can add your own rules, remove a specific default rule, or completely override them.

The sanitize configuration is grouped under the `sanitize` node and supports the following sanitize methods:

* **sanitize.rawsql_add_rules** — the list of raw SQL queries that help you to sanitize the existing data, for example, delete data using the TRUNCATE method, UPDATE data to apply any custom modification, etc.

* **sanitize.rawsql_delete_rules** —  the list of raw SQL queries, which should be removed from the list in `sanitize.method.rawsql`. The format is the same as `sanitize.rawsql_add`.

* **sanitize.rawsql_override_rules** —  the list of raw SQL queries, which will be applied to sanitizing data and override the default sanitize rule `sanitize.method.rawsql`. Please note that if this option is specified, all `sanitize.rawsql_add_rules` and `sanitize.rawsql_delete_rules` will be ignored. The format is the same as `sanitize.rawsql_add_rules`.

* **sanitize.update_add_rules** — the mapping between specific table columns and the sanitizing method that should be used for the values.

* **sanitize.update_delete_rules** — the list of rules which will be deleted from the list in `sanitize.method.update`. The format is the same as in `sanitize.update_add_rules`.

* **sanitize.update_override_rules** — the list of rules which will be applied to sanitizing data and overriding the default sanitize rule `sanitize.method.update`. Please note that if this option is specified, all `sanitize.update_add_rules` and `sanitize.update_delete_rules` will be ignored. The format is the same as `sanitize.update_add_rules`.

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
* In the columns section, provide an array of column names and sanitizing method pairs for all the columns that should be sanitized in the mentioned table.

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
      Create an application environment data dump and copy it to another environment.

    Usage:
      dump:create [options]

    Options:
          --log=LOG                                Log to file
          --downtime-duration[=DOWNTIME-DURATION]  (OPTIONAL) Downtime duration, by default 1 hour. Expected format: '{number}d{number}h{number}m'. Usage example: '1d3h15m' means 1 day 3 hours 15 minutes OR '30m' means 30 minutes.
          --downtime-comment[=DOWNTIME-COMMENT]    Comment for provided custom downtime value. Required if [downtime-duration] provided. Wrap with double-quotes if it contains spaces.
      -e, --environment[=ENVIRONMENT]              Name of the destination environment where data dump will be copied. To list all available environments, please use dump:environments command.
      -c, --components[=COMPONENTS]                Comma-separated components list (without spaces) to be included in the dump. Allowed: db,ess,media,code. Default: db. The database is sanitized. If the media component is selected, it may take a long time. [default: "db"]
      -i, --indices[=INDICES]                      Comma-separated Elastic indices list to be included in the dump. If not set, all indices will be included.
      -h, --help                                   Display this help message
      -q, --quiet                                  Do not output any message
      -V, --version                                Display this application version
          --ansi                                   Force ANSI output
          --no-ansi                                Disable ANSI output
      -n, --no-interaction                         Do not ask any interactive question
      -v|vv|vvv, --verbose                         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

    * **option "--environment"** - Name of the destination environment where the data dump will be copied.

    * **option "--components"** - Comma-separated components list (without spaces) to be included in the dump. Allowed: db,ess,rpm. Default: db. The database is sanitized.

    * **option "--indices"** - Comma-separated Elastic indices list to be included in the dump. If not set, all indices will be included.

.. note:: RabbitMQ messages sync is not supported. If the media component is selected, sync may take a long time.

When the data push is done, you may start with the import in the target environment.

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
          --downtime-comment[=DOWNTIME-COMMENT]    Comment for provided custom downtime value. Required if [downtime-duration] provided. Wrap with double-quotes if it contains spaces.
          --force[=FORCE]                          Force dump:load operation execution, otherwise the confirmation will be requested. [default: false]
          --host[=HOST]                            Stop program(s) on specified job host only [ocom-vdrizheruk-dev2-app1], otherwise [all].
      -c, --components[=COMPONENTS]                Comma-separated list (without spaces) of components for data to be loaded. Allowed: db,ess,media,code. Default: db. The database is sanitized. If the media component is selected, it may take a long time.
          --skip-purge-media                       Skip purging media on fetch operation
          --skip-prepare-app                       Skip prepare application operations. With this option, the application will not be usable after finishing the operation.
          --flush-elasticsearch                    Flush ElasticSearch. All ElasticSearch data will be lost.
          --run-base-reindex                       Run command [oro:search:reindex] in background.
          --run-website-reindex                    Run command [oro:website-search:reindex] in background.
      -h, --help                                   Display this help message
      -q, --quiet                                  Do not output any message
      -V, --version                                Display this application version
          --ansi                                   Force ANSI output
          --no-ansi                                Disable ANSI output
      -n, --no-interaction                         Do not ask any interactive question
      -v|vv|vvv, --verbose                         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

    * **option "--components"** - Comma-separated list (without spaces) of components for data to be loaded. Allowed: db,ess,rpm. Default: db. The database is sanitized.

    * **option "--skip-prepare-app"** - Skip prepare application operations. With this option, the application will not be usable after finishing the operation.

    * **option "--flush-elasticsearch"** - Flush ElasticSearch. All ElasticSearch data will be lost.

    * **option "--run-base-reindex"** - Run command [oro:search:reindex] in background to update search index for the specified entities.

    * **option "--run-website-reindex"** - Run command [oro:website-search:reindex] in background to rebuild storefront search index.

.. note:: If during dump:load not all components(db,ess,rpm) are selected, the application may be not working. By default only db will be restored.

.. note:: During dump:load, the database is always sanitized.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
