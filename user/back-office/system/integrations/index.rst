:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-integrations:

Configure Integrations in the Back-Office
=========================================

OroCommerce fulfills individual customer wishes and provides miscellaneous extensions and third-party integration solutions to meet specific preferences of each business. Generally, the integrations are used for the operational routines digitalizing every possible area of your online webs store.

The section focuses on the integrations pre-implemented for your Oro applications and illustrates:

* what payment providers to use to help process different types of payments (PayPal, Apruve, Authorize.Net, etc.)
* what shipping methods you can offer your OroCommerce customers (UPS, FedEx)
* how to set up integrations with payment and shipping services
* how to use email marketing activities and email marketing automation (Mailchimp, Dotdigital)
* how to configure Google Tag Manager
* how to create the code that may be embedded to a third-party website to enable communication between the third-party website users and the Oro application
* how to configure Microsoft 365 calendar events and tasks synchronization

Check the following integrations that can be enabled/disabled and configured in **System > Configuration > Integration**:

* :ref:`Manage Integrations: Payment Method Integration <sys--integrations--manage-integrations--payment-methods>`

  * :ref:`Check/Money Order <user-guide--payment--check-money-order>`
  * :ref:`Payment Terms <user-guide--payment--payment-providers-overview--payment-term-config>`
  * :ref:`PayPal Payment Services <user-guide--payment--payment-providers-overview--paypal>`
  * :ref:`Apruve <user-guide--payment--payment-providers-overview--apruve>`
  * :ref:`Authorize.Net <user-guide--payment--payment-providers-overview--authorizenet>`
  * :ref:`InfinitePay <user-guide--payment--payment-providers-overview--infinitepay>`
  * :ref:`Ingenico <user-guide--payment--payment-providers-overview--ingenico>`
  * :ref:`CyberSource Payment Service <user-guide--payment--payment-providers-cybersource>`
  * :ref:`Stripe <user-guide--payment--payment-providers-stripe--overview>`

* :ref:`Manage Integrations: Shipping Method Integration <user-guide--shipping--configuration--common-details>`

  * :ref:`Flat Rate <doc--integrations--flat-rate>`
  * :ref:`Fixed Product Shipping Cost <doc-integration-fixed-shipping-cost>`
  * :ref:`UPS <doc--integrations--ups>`
  * :ref:`FedEx <doc--integrations--fedex>`
  * :ref:`DPD <doc--integrations--dpd>`

* :ref:`Dotdigital Integration <user-guide-dotmailer-overview>`
* :ref:`Mailchimp Integration <user-guide-mc-integration>`
* :ref:`Zendesk Integration <user-guide-zendesk-integration>`
* :ref:`LDAP Integration <user-guide-ldap-integration>`

* Embedded Forms

  * :ref:`Embedded Forms <admin-embedded-forms>`


.. toctree::
   :hidden:

   Manage Integrations: Payment Method Integration <payment-integration/index>
   Manage Integrations: Shipping Method Integration <shipping-integration/index>
   Google Tag Manager Integration <gtm/index>
   Dotdigital Integration <dotdigital/index>
   Mailchimp Integration <mailchimp-integration>
   Zendesk Integration <zendesk-integration>
   LDAP Integration <ldap-integration>
   Embedded Forms <embedded-forms/index>
