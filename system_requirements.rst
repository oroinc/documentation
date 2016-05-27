.. index::
    single: Requirements

System Requirements
===================

* Operating System
    * Linux x86, x86-64
    * Windows 7 and 8
    * Mac OS X 10.9 and above
* Browsers
    * Mozilla Firefox 6 and above
    * Google Chrome 31 and above
    * Microsoft Internet Explorer 10 and above
    * Safari
    * Opera 12.16 and above
* Web Servers
    * Apache 2.2.x
    * Nginx
    * Lighttpd
* Database Management Systems
    * MySQL 5.1 and above
    * PostgreSQL/EnterpriseDB 9.1 and above
* PHP 5.5.9 and above
* PHP Command Line Interface
* PHP extensions
    * ctype
    * fileinfo
    * GD 2.0 and above
    * intl
    * JSON
    * Mcrypt
    * PCRE 8.0 and above
    * SimpleXML
    * Tokenizer
* PHP settings
    * date.timezone must be set
    * detect_unicode must be disabled in php.ini
    * memory_limit should be at least 512M
    * xdebug.scream must be disabled in php.ini
    * xdebug.show_exception_trace must be disabled in php.ini
* Other requirements
    * ICU library 4.4 and above
    * mcrypt_encrypt() should be available
    * web/bundles/ directory must be writable
    * web/uploads/ directory must be writable

Optional recommendations
------------------------

* Node.js (for JS minification)
* PHP-XML module installed
* xdebug.max_nesting_level above 100 in php.ini
* iconv() available ◦mb_strlen() available
* posix_isatty() available
* utf8_decode() available
