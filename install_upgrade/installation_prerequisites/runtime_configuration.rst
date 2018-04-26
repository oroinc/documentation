:orphan:

.. _installation--configure-php-runtime-environment:

PHP Runtime Environment Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin_runtime_configuration

When multiple PHP instances (and/or versions) are installed on the host that is intended for web server installation, please, configure the runtime environment to use one of these instances for CLI commands execution:

Apache
^^^^^^

Use the *SetEnv* directive that comes with the mod_env module to update the **ORO_PHP_PATH**
environment variable with the path to the necessary php instance:

    .. code-block:: apache

        SetEnv ORO_PHP_PATH c:\OpenServer\modules\php\PHP-7.0\

Nginx
^^^^^

Use the *fastcgi_param* directive to achieve the same on nginx:

    .. code-block:: nginx

        fastcgi_param ORO_PHP_PATH /usr/local/bin/php