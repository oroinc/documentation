.. _integrations-misc-avatax:

Integration with Avatax
=======================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

AvaTax is a tax compliance and automation software solution provided by Avalara, designed to simplify and automate the calculation and management of sales and use taxes. When integrated with OroCommerce, it automatically calculates taxes and up-to-date tax rates for your store.

.. image:: /user/img/integrations/tax-provider.png
   :alt: Tax provider selection in the back-office configuration settings

Supported Features
------------------

* **Real-Time Tax Calculation:** AvaTax provides real-time tax calculation based on the latest tax rates, rules, and product taxability, ensuring accurate transaction tax amounts.

* **Sales Tax Rates and Rules:** AvaTax maintains a comprehensive database of sales tax rates and rules for various jurisdictions, allowing it to calculate taxes accurately based on the customer's location.

* **Address Validation:** AvaTax can validate and standardize customer addresses to ensure tax calculations are based on correct and up-to-date address information.

* **Product Taxability:** AvaTax can determine the taxability of products and services, ensuring that the correct tax rates are applied to different types of goods.

.. image:: /user/img/integrations/taxes-order-view.png
   :alt: Tax calculation breakdown for an order in the OroCommerce back-office

Integration Benefits
--------------------

Integrating OroCommerce with AvaTax can offer several benefits for businesses:

* **Accurate Tax Calculations:** AvaTax ensures real-time, precise tax calculations based on current tax rates and rules. This ensures that your e-commerce transactions are accurately taxed according to local, state, and national regulations.

* **Reduced Errors:** The integration reduces the risk of tax calculation errors, which could result in costly fines, penalties, and damage to your business's reputation. AvaTax's automation minimizes manual intervention and potential mistakes.

* **Time and Resource Savings:** By automating tax calculations and compliance processes, the integration saves your business time and resources that would otherwise be spent on manual tax calculations and management.

* **Scalability:** As your business grows and expands into new markets, AvaTax can handle complex tax scenarios, making it easier to scale your e-commerce operations without tax compliance challenges.

* **Enhanced Customer Experience:** Accurate tax calculations result in transparent pricing for your customers. This reduces the chances of unexpected charges and improves the overall shopping experience

Data Exchange
-------------

In the data exchange process between OroCommerce and AvaTax, a few steps are involved to ensure accurate tax calculations for products and orders. This process typically includes Tax codes synchronization from Avatax using connectors and real-time tax calculation requests during checkout and order placement. Tax calculation request uses the customer, product and order information:

*Data Passed from Avatax to OroCommerce:*

* **Product Tax Codes:** Product Tax Codes are codes associated with specific products or services in your catalog. These codes provide information to AvaTax about how each product should be taxed. For example, certain products may be subject to different tax rates or exemptions based on their category or characteristics. AvaTax passes these product tax codes to OroCommerce so that the e-commerce platform can accurately apply taxes to each product.

* **Customer Tax Codes:** Customer tax codes are codes associated with individual customers or groups of customers. These codes specify any special tax rules or exemptions that should apply to a particular customer or customer group. For instance, a customer may be tax-exempt due to their nonprofit status. AvaTax provides OroCommerce with customer tax codes to ensure the correct tax treatment is applied to each customer's transactions.

* **Tax Information:** Tax information includes details about the calculated taxes for a specific transaction. This data comprises the tax amounts, tax rates, and any additional tax-related information for the customer's purchase. After processing the transaction data received from OroCommerce, AvaTax calculates the applicable taxes and returns this tax information to OroCommerce. OroCommerce uses this information to display the correct tax amount to the customer during checkout or to record tax details for backend order management.

*Data passed from OroCommerce to Avatax:*

* **Customer Tax Code:** OroCommerce send the customer tax code to Avatax, and takes customer address details during the checkout process.

* **Order Information:** Order information encompasses all the details related to a specific transaction or purchase. This includes the items or products purchased, their quantities, prices, shipping details, and additional order-specific data. OroCommerce sends this order information to AvaTax to accurately calculate the appropriate taxes for the transaction. AvaTax uses this data to apply the relevant tax rules, rates, and exemptions to generate the correct tax amount for the order.

Data Security
-------------

The security measures taken by OroCommerce during the integration with AvaTax are critical to protect sensitive tax and transaction data. OroCommerce follows best practices for security to safeguard data and maintain the integrity of the integration. Here are some of the security measures that OroCommerce implements during the integration with AvaTax:

* **Data Encryption:** OroCommerce employs encryption protocols such as TLS or SSL to encrypt data in transit between OroCommerce and AvaTax. This ensures that data exchanged during the integration remains confidential and secure.

* **Authentication and Authorization:** OroCommerce implements strong authentication mechanisms to ensure only authorized users and systems can access the integrated services. Role-based access control (RBAC) is typically used to manage user permissions and restrict access to sensitive data.

* **API Key Management:** Secure management of API keys or credentials used for authentication between OroCommerce and AvaTax is crucial. OroCommerce securely stores and manages these keys, following best practices for key rotation and access control.

* **Data Privacy and Compliance:** OroCommerce ensures compliance with data privacy regulations, such as GDPR or CCPA, by handling customer data with care and anonymizing or pseudonymizing personal information when necessary.

* **Monitoring and Logging:** OroCommerce implements monitoring and logging capabilities to track integration activities. This includes monitoring for unusual or unauthorized access attempts and logging integration-related events for auditing and analysis.

* **Security Patching and Updates:** OroCommerce keeps its software components up to date with security patches and updates, and it regularly reviews security advisories to apply patches promptly and address known vulnerabilities.

.. include:: /include/include-links-user.rst
   :start-after: begin