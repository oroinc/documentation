How to install OroPlatform
==========================

*Used application: OroPlatform RC1*

* Download source code
* Update vendors libraries
* Set up database
* Set up virtual host
* Installation from browser
* Installation from console
* References

Download source code
--------------------

To install OroPlatform you first you need to download application source.

1. You can download the archive from our official site and extract it.
   For Linux it will look like this:

::

    cd /var/www/vhosts
    wget -c http://www.orocrm.com/downloads/platform-application.tar.gz
    tar -xzvf platform-application.tar.gz

For Windows you should download archive source code and extract it to appropriate folder.

2. You can clone the git repository from Github public repository:

::

    cd /var/www/vhosts
    git clone https://github.com/orocrm/platform-application

In this case we are cloning it to platform-application directory.

After downloading you should have a directory "platform-application" that contains application source code that contains the following:

::

    user@host:/var/www/vhosts/platform-application$ ls -l
    drwxrwxr-x 7 user user 4096 Янв  9 16:46 app
    -rw-rw-r-- 1 user user 4326 Янв  9 16:46 CHANGELOG.md
    -rw-rw-r-- 1 user user 1487 Янв  9 16:46 composer.json
    -rw-rw-r-- 1 user user 1103 Янв  9 16:46 LICENSE
    -rw-rw-r-- 1 user user 2331 Янв  9 16:46 README.md
    drwxrwxr-x 2 user user 4096 Янв  9 16:46 src
    -rw-rw-r-- 1 user user  207 Янв  9 16:46 UPGRADE.md
    drwxrwxr-x 3 user user 4096 Янв  9 16:46 web

