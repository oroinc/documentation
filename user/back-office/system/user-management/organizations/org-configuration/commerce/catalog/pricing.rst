:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--catalog--pricing--organization:

Configure (Flat) Pricing Settings per Organization
==================================================

.. hint:: This section is a part of the :ref:`Price Management <user-guide--pricing>` topic that provides the general understanding of pricing concept in Oro applications.

Flat pricing configuration helps you enable price lists for the relevant organization. Please, be aware that this configuration page is only available when :ref:`flat pricing is configured for your application <dev-guide-setup-flat-pricing>`. This is done by your system administrator via the console, not the application UI. If you do not have flat pricing enabled, this configuration page will not be displayed in the Commerce > Catalog settings list.

.. note:: The :ref:`website level <sys--website--edit--price-lists>` configuration has higher priority and overrides these configuration settings. :ref:`Customer group <customers--customer-groups--edit--price-lists>` configuration overrides configuration on the website level. Custom configuration on the :ref:`customer level <customers--customer-groups--edit--price-lists>` has the highest priority.

.. image:: /user/img/system/user_management/org_configuration/catalog/flat-pricing-organization-config.png
   :alt: Organization pricing configuration page when flat pricing is enabled

To add a price list to the default price lists:

1) Clear the **Use System** check box next to the option.
2) Click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions that match your entry appears. Press **Enter** or click the suggested value to add the price list.
3) Click **Save Settings**.