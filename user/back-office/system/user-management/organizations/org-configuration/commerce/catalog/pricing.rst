.. _configuration--guide--commerce--configuration--catalog--pricing--organization:

Configure Pricing Settings per Organization
===========================================

.. hint::
    This section is part of the :ref:`Price Management <user-guide--pricing>` topic that provides a general understanding of pricing concept in Oro applications.

OroCommerce comes with a Combined Price List (CPL) functionality built for the needs of large B2B businesses with multiple price lists, pricing strategies, price fallbacks, and price merges. If your operate a small-scale business without complex pricing, or use an external third-party pricing system to generate and manage prices outside of OroCommerce, you can :ref:`switch from the default CPL pricing to a simpler flat pricing <dev-guide-setup-flat-pricing>`. The Pricing configuration page on the organization level has different options, depending on whether you have CPL or flat pricing configured for your application.

With Standard Combined Pricing
------------------------------

With standard CPL pricing, you can change **Price Calculation Precision In Price Lists** on the organization level. Price Calculation Precision In Price Lists represents the number of digits allowed in the fractional part of the price calculation rule results. The results will be rounded using the "round half away from zero" rule (2.5 will be rounded to 3). If this value is empty, the system will not apply any rounding until the maximum supported price precision (4 digits) is reached.

.. image:: /user/img/system/user_management/org_configuration/catalog/cpl-org-config-page.png
   :alt: Pricing configuration page on the organization level with standard CPL pricing

1. In the Pricing Rounding section, clear the **Use System** checkbox next to Price Calculation Precision In Price Lists.
2. Provide the precision number.
3. Click **Save Settings** on the top right.

With Flat Pricing
-----------------

When you switch from CPL to flat pricing is :ref:`configured for your application <dev-guide-setup-flat-pricing>`, you can add price lists per organization, as described below:

.. image:: /user/img/system/user_management/org_configuration/catalog/flat-pricing-organization-config.png
   :alt: Organization pricing configuration page when flat pricing is enabled

To add a price list to the default price lists:

1. Clear the **Use System** checkbox next to the option.
2. Click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions that match your entry appears. Press **Enter** or click the suggested value to add the price list.
3. Click **Save Settings** on the top right.