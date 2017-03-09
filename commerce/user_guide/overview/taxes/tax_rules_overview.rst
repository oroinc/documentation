Overview
========

.. begin

Tax rules help OroCommerce find the correct tax rate that should be used for the products listed in the purchase order by matching the product tax code that indicates tax status of the product, customer tax code that indicates tax status of the buying company, and tax jurisdiction where the tax is due. OroCommerce supports tax exemption mechanism: you can set zero tax rate for some customers and/or products.

Basically, in OroCommerce, tax rule binds the following items:

* tax jurisdiction - an address, usually a state in a country that have defined taxation policies that determine when and how the company should pay their sales or VAT tax, and what rates should be used, depending on the tax status of the products you sell and  parties you sell to.

* customer tax code - a label for a customer or customer group that follow similar taxation rules in at least one tax jurisdictions.

* product tax code - a label for a group of products that have similar taxation rules in at least one tax jurisdictions.

* tax rate - the percentage of the sales income that should be payed as a tax in the particular tax jurisdiction for a certain type of products sold to a group of customers with the same tax status.

.. finish
