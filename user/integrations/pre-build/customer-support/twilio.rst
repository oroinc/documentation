.. _integrations-customer-support-twilio:

Integration with Twilio
=======================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

Twilio is a cloud-based communication platform that helps businesses to integrate different communication channels into their systems and applications. This integration allows for better customer engagement and interaction. OroCommerce leverages Twilio Flex for live chat conversations and Twilio Programmable Messaging for SMS/MMS to enable businesses to reach their customers through multiple communication channels. In addition, OroCommerce uses its existing email synchronization functionality to synchronize emails, online chats, and SMS/MMS messages into one aggregated Contact Center > Conversations grid in the OroCommerce back-office. This centralization of all communication channels enables businesses to manage all customer interactions in one place.

.. image:: /user/img/integrations/twilio-conversations.png
   :alt: Conversations menu in the Oro back-office

Supported Features
------------------

* **Online Chat:** The integration leverages Twilio Flex, a powerful cloud-based contact center platform, to enable real-time online chat with customers. Businesses can engage with customers, answer inquiries, provide support, and offer personalized assistance through live chat, enhancing the overall customer experience.

.. image:: /user/img/integrations/twilio-live-chat.png
   :alt: Live chat functionality in the Oro back-office

* **Sending SMS/MMS**: Twilio Programmable Messaging is used to facilitate sending SMS (Short Message Service) and MMS (Multimedia Messaging Service) to customers. This feature enables businesses to send order updates, promotional messages, and important notifications directly to the customers' mobile devices, ensuring timely communication and engagement.

.. image:: /user/img/integrations/twilio-sms.png
   :alt: SMS functionality in the Oro back-office

* **Email Sync:** Oro's existing email functionality is seamlessly integrated, allowing businesses to synchronize and manage email communications.

Integration Benefits
--------------------

* **Multi-Channel Engagement:** The integration allows businesses to engage with customers through multiple communication channels, including email, live chat, and SMS/MMS. This flexibility ensures that customers can choose their preferred mode of communication, enhancing convenience and accessibility.

* **Improved Customer Service:** With real-time online chat, businesses can provide immediate customer assistance and support, addressing inquiries and resolving issues promptly. This leads to higher customer satisfaction and loyalty.

* **Enhanced Marketing:** SMS/MMS capabilities enable businesses to run targeted marketing campaigns, send promotional offers, and keep customers informed about new products and promotions, driving sales and engagement.

Data Exchange
-------------

Twilio acts as an intermediary to ensure efficient data exchange between live chats in the storefront, SMS/MMS, and the Oro application.

* **Online chat**: When a customer writes a message in the live chat, it is sent to Twilio for processing. Twilio then passes the information to Oro through a webhook request. When an agent responds to the message in live chat via Oro's back-office, the response is relayed back to the chat form on the website with the help of an API method request.

* **SMS/MMS**: Similarly, when an SMS/MMS message is sent from a customer, it is first sent to Twilio. Once the message is processed, Twilio passes the message to the Oro side via a webhook. When an agent sends an SMS/MMS to a customer, it is delivered via Twilio as an API request.

Data Security
-------------

OroCommerce and Twilio implement the following security measures to ensure the protection of data and maintain the integrity of the integration:

* **Authentication and Authorization:** Oro uses secure authentication protocols to verify the identity of users and applications accessing the platform.
* **Data Encryption:** Data exchanged between OroCommerce and Twilio is encrypted using industry-standard encryption protocols (such as SSL/TLS).
* **API Security:** Oro's API endpoints are protected using secure authentication mechanisms (API tokens, OAuth).
* **Data Validation and Sanitization:** Input validation and data sanitization techniques are employed to prevent injection attacks and other forms of malicious input.
* **Monitoring and Logging:** Oro employs logging and monitoring mechanisms to track and detect unusual or suspicious activities.
* **Webhooks and Callbacks Security:** Webhook and callback endpoints are protected with strong authentication to prevent unauthorized access. Incoming webhook requests are validated to ensure they originate from Twilio and are not tampered with.

.. include:: /include/include-links-user.rst
   :start-after: begin