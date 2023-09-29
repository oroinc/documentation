.. _integrations-payment-authorize:

Integration with Authorize.Net
==============================

OroCommerce offers seamless integration with Authorize.Net, one of the leading payment gateway providers, to facilitate secure and efficient online payment processing for B2B eCommerce businesses. This integration allows OroCommerce users to offer their customers a wide range of payment options, enabling smooth transactions while maintaining the highest level of data security.

.. image:: /user/img/system/integrations/authorizenet/authorize-net-checkout-options.png
   :alt: Authorize.net checkout options

Supported Authorize.Net Services
--------------------------------

The integration between OroCommerce and Authorize.Net supports the following key services:

1. **Payment Processing:** OroCommerce allows customers to make payments using various payment methods supported by Authorize.Net, such as credit/debit cards, eChecks (ACH), and digital payment solutions like Apple Pay.

2. **Payment Authorization and Capture:** OroCommerce facilitates the authorization of payments through Authorize.Net. The payment can be captured immediately or later during order fulfillment, depending on the merchant's requirements.

3. **Refunds and Voiding:** OroCommerce supports the seamless processing of refunds and voiding transactions through Authorize.Net, providing a hassle-free experience to both customers and merchants in case of order cancellations or returns.

4. **Tokenization:** For enhanced security and to streamline the checkout process for returning customers, OroCommerce utilizes Authorize.Net's tokenization service. This service replaces sensitive payment data with a unique token, reducing the risk of data exposure.

5. **Customer Payment Profiles Integration:** CIM integration allows merchants to securely store customer payment data, including credit card numbers, billing addresses, and shipping information, on Authorize.Net's servers; the merchant is issued a unique identifier called a Customer Profile ID, which represents the stored customer data. OroCommerce customer users can save and manage up to 10 payment profiles for future orders in their OroCommerce storefront account.

Data Exchange
-------------

Exchanged General Data
^^^^^^^^^^^^^^^^^^^^^^

During integration, OroCommerce and Authorize.Net exchange essential transactions and customer data to ensure smooth payment processing. The exchanged data typically includes:

**Data Passed from OroCommerce to Authorize.Net**

.. csv-table::

   "Order Information","
   - Order ID: A unique identifier for each order.
   - Order Total: The total amount of the order to be charged to the customer.
   - Currency: The currency in which the transaction is to be processed."
   "Customer Information","
   - Customer Name: The name of the customer placing the order.
   - Customer Email: The customer's email address for communication and transaction notifications.
   - Billing Address: The billing address associated with the customer's payment method.
   - Shipping Address: The shipping address where the order will be delivered."
   "Payment Information","
   - Credit Card Number: The customer's credit card's primary account number (PAN).
   - Expiration Date: The expiration date of the customer's credit card.
   - CVV: The Card Verification Value, a security code present on credit cards."

**Data Passed from Authorize.Net to OroCommerce**

.. csv-table::

   "Transaction Status and Response","
   - Authorization Code: A unique code provided by the issuing bank confirming the transaction's approval.
   - Transaction ID: A unique identifier for the completed transaction.
   - Transaction Status: Indicates whether the transaction was successful or declined.
   - Response Messages: Messages describing the transaction status or any errors encountered during processing."
   "Token (For Tokenized Payments)","
   - Token: In tokenized payments, Authorize.Net provides a unique token to represent the customer's payment data securely. This token is used for subsequent transactions, reducing the need to pass sensitive card information."

Exchanged Fields
^^^^^^^^^^^^^^^^

Standard fields typically passed between OroCommerce and Authorize.Net during integration:

**Fields Passed from OroCommerce to Authorize.Net:**

.. csv-table::

   "Customer Information","Customer details such as name, email address, shipping address, and billing address are commonly passed to Authorize.Net to associate the payment with the corresponding customer."
   "Payment Amount","The transaction amount is sent from OroCommerce to Authorize.Net to process the payment."
   "Order Details","Information about the products or services being purchased, including item names, quantities, prices, and total order value, is usually transmitted to Authorize.Net."
   "Currency","The currency code in which the payment is made is sent to Authorize.Net to ensure accurate processing."
   "Shipping Information","If applicable, shipping-related data, such as shipping method and cost, may be passed from OroCommerce to Authorize.Net."
   "Additional Notes or Comments","Any additional comments or notes provided by the customer during checkout may also be sent to Authorize.Net."

**Fields Passed from Authorize.Net to OroCommerce:**

.. csv-table::

  "Transaction Status","Information about the transaction status, such as approved, declined, or void, is passed from Authorize.Net to OroCommerce to update the order status accordingly."
  "Transaction ID","A unique identifier assigned to the transaction by Authorize.Net is typically sent back to OroCommerce for order tracking and reference purposes."
  "Authorization Code","If the transaction is approved, an authorization code is sent from Authorize.Net to OroCommerce as proof of the successful authorization."
  "Payment Method Details","Certain details about the payment method used, such as the last few digits of the credit card number, may be sent from Authorize.Net to OroCommerce for record-keeping."

It's important to note that the specific fields and data exchanged may be subject to customization based on the merchant's requirements, the integration configuration, and the data mapping setup during the integration process. Additionally, some additional data may be passed or requested based on the payment method selected (e.g., credit card, eCheck, etc.) and any specific features enabled by the merchant.

Security Measures
-----------------

The following security measures that both OroCommerce and Authorize.Net typically implement to ensure a secure integration:

1. **Data Encryption:** OroCommerce and Authorize.Net use encryption protocols (such as SSL/TLS) to secure the transmission of sensitive data, such as payment information, between the customer's browser and the server. This helps protect against eavesdropping and data interception during the communication process.

2. **PCI Compliance:** Both platforms comply with the Payment Card Industry Data Security Standard (PCI DSS), which sets security requirements for handling cardholder data. PCI compliance ensures that customer payment data is handled and stored securely, reducing the risk of data breaches and fraud.

3. **Tokenization:** Authorize.Net uses a tokenization system to replace sensitive cardholder data with unique tokens. This means that a random token is stored in the database instead of storing actual credit card information. Even if the token is compromised, it cannot be used to reconstruct the original card data.

4. **Secure Customer Data Storage:** OroCommerce and Authorize.Net store sensitive customer payment data on secure servers with restricted access. These servers are designed to safeguard against unauthorized access and data breaches.

5. **Two-Factor Authentication:** Both platforms offer two-factor authentication options for enhanced user account security, reducing the risk of unauthorized access.

6. **Fraud Detection and Prevention:** Authorize.Net provides advanced fraud detection tools to help merchants identify and prevent fraudulent transactions.

7. **Regular Security Audits:** Both OroCommerce and Authorize.Net conduct regular security audits and vulnerability assessments to identify and address potential security weaknesses.

The integration between OroCommerce and Authorize.Net streamlines payment processing for B2B eCommerce businesses, providing customers with a secure and efficient checkout experience. By supporting a wide range of Authorize.Net services and exchanging essential transaction data, OroCommerce ensures seamless payment processing, allowing businesses to focus on delivering exceptional services to their customers.