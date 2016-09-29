FAQ
===

**Question:** I have problem with Magento channel sync: when I'm clicking on "Check Connection" it returns
error "Parameters are not valid!", but in fact parameters are valid and SOAP API URL is working fine.

**Answer:** Possible problems and solutions:

* *your SOAP API is protected by WWW Auth* - you have to either allow access from current IP, or add ``user:password@``
  prefix to your API URL (e.g. ``http://user:password@magento-domain.com/index.php/api/v2_soap/index/?wsdl=1``);

* *WSDL content is cached* - you have to remove outdated cached WSDL files from temporary directory
  (e.g. ``rm /tmp/wsdl-*``); alternatively you can disable WSDL cache on PHP level in php.ini:
  ``soap.wsdl_cache_enabled=0``.

