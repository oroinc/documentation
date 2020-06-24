:oro_documentation_types: OroCommerce

.. _concept-guide-rfq-quotes:

RFQ and Quote Management Concept Guide
======================================

Working in a competitive B2B environment often drives online stores to raise their game and add multiple features to effectively facilitate a buyer and seller’s interaction, especially at the early stage of negotiating prices and signing agreements. Such negotiations usually involve RFQs and quotes that bind customers to sales representatives who support communication at every step of the quotation process.

An :ref:`RFQ <user-guide--sales--requests-for-quote>`, or a request for a quote, is usually submitted by customers who are looking to get a better price than the one listed on the website. Through RFQ, they can ask sales representatives for specific quantities of products and bargain for the best prices, while sales reps can use :ref:`quotes <user-guide--sales--quotes>` to respond to the submitted RFQ with detailed pricing and payment terms. When all parties agree on the prices and conditions, quotes are converted into orders in just one click.

As OroCommerce is a dedicated B2B eCommerce platform, it is specifically designed to meet both the buyer and seller's needs. OroCommerce provides a robust out-of-the-box RFQ and Quote functionality tool with flexible customization capabilities that you can adjust to fit any business goals.

Here are some of the many benefits you get when running an RFQ and quote-friendly store:

* Minimizing the time to create and process quotes, maximizing conversion rates
* Taking the pressure off the sales team by letting your customers instantly create the requests from their account
* Ensuring up-to-date inventory and pricing data which mitigates the risks of manual mistakes
* Sending personalized quotes to buyers
* Converting RFQs to quotes and quotes to orders in one click, and more

Let's dive deeper into the specifics and functionality of the built-in RFQ and quote management tool that OroCommerce provides out-of-the-box.

RFQ: Customer's Request and Price Offer
---------------------------------------

Working with RFQs is a standard practice that B2B businesses use to allow communication between customers and sellers. OroCommerce has automated the RFQ submission process providing enough opportunities for customers to send a quotation request. Customers can reach the RFQ button from multiple locations where it is strategically placed to enhance fast and seamless interaction with the sales rep:

* **The RFQ button on the product details page**

  .. image:: /user/img/concept-guides/rfq/RFQ_product_page.png
     :alt: View the RFQ button on the product details page

* **The RFQ button on a customer's account menu page**

  Only signed-in users can have access to the Account menu and, therefore, to the Request for Quote section and RFQ button.

  .. image:: /user/img/concept-guides/rfq/RFQ_account_menu.png
     :alt: View the RFQ button on the customers' account menu page under RFQ section

* **The RFQ button on a shopping list page**

  .. image:: /user/img/concept-guides/rfq/RFQ_shopping_list.png
     :alt: View the RFQ button on a shopping list page

* **The RFQ button on the Quick Order Form page**

  .. image:: /user/img/concept-guides/rfq/RFQ_quick_order_form.png
     :alt: View the RFQ button on the Quick Order Form page

Every request is different. You can use the default OroCommerce RFQ form which should work well for most companies, or customize its code to match your business and sales processes.

.. image:: /user/img/concept-guides/rfq/RFQ_template.png
   :alt: A default RFQ template
   :scale: 70%

With an RFQ, buyers select the items they are interested in, adjust their quantities, and offer the prices they are willing to pay.

Once a buyer submits their RFQ in the storefront, it gets immediately visible in the back-office. A sales rep can then either turn the RFQs into a quote or convert it straight into an order. They can also assign the RFQ a corresponding status and open a discussion with the customer.

.. image:: /user/img/concept-guides/rfq/RFQ_create_quote.png
   :alt: Actions that a sales rep can do with the submitted RFQ in the back-office

RFQ-Related Options in the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make the most of an RFQ-friendly store, make sure you enable all related features in the back-office either on the :ref:`global <configuration--guide--commerce--configuration--sales-rfq>`, :ref:`organization <user-guide--system-configuration--commerce-sales--rfq--organization>`, or :ref:`website <user-guide--system-configuration--commerce-sales--rfq--website>` level:

* **Request For Quote Configuration**

  The setting defines whether to enable or disable the RFQ feature for the back-office and the storefront. The configuration is convenient for businesses that run multiple websites. This way, you can selectively enable the RFQ feature for certain websites and disable it for those that do not need it at all (for instance, if an RFQ is sent through emails and agreements).

  .. image:: /user/img/concept-guides/rfq/RFQ_system_config.png
     :alt: Global RFQ configuration settings

* **RFQ Notifications**

  These RFQ options enable you to determine the employee responsible for processing RFQs. They will receive all incoming email notifications every time a customer submits an RFQ.

  .. image:: /user/img/concept-guides/rfq/RFQ_notifications.png
     :alt: Global RFQ notifications settings

* **Guest RFQ**

  The option lets guest customers request quotes on the items they are interested in without registering an account. For this, make sure to enable :ref:`Guest Shopping List <user-guide--system-configuration--commerce-sales-shopping-list--mass-action>` and :ref:`Guest Quick Order Form <user-guide--system-configuration--commerce-sales--quick-order-form--global>` to display the RFQ button for unregistered visitors. As they do not have access to the Account menu, all the negotiations with sales reps are carried out via the email provided by the guest user in the RFQ form.

  .. image:: /user/img/concept-guides/rfq/RFQ_guest.png
     :alt: Global guest RFQ configuration settings

* **RFQ Management Flow Workflow**

  The default :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>` workflow activates additional capabilities to manage RFQs from the back-office, change the status of an RFQ as interaction with the customer progresses, decline, or delete it, and initiate communication process with the customer.

  .. image:: /user/img/concept-guides/rfq/RFQ_workflow.png
     :alt: View the additional RFQ options appeared after enabling the RFQ management flow workflow
     :scale: 60%

* **RFQ Submission Flow Workflow**

  The default :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` workflow enables customers to view statuses of their submitted RFQs and respond to the messages from sales reps from their Account menu in the storefront. For the feature to work properly, make sure you activate both RFQ Management and Submission workflows.

  .. image:: /user/img/concept-guides/rfq/RFQ_submission_wf.png
     :alt: View the status of the submitted RFQ's both in the back-office and storefront
     :scale: 60%

  If these two default RFQ workflows do not fully cover your business needs, you can always modify them through customization or create your own in the :ref:`system configuration <mc-system-wf>` in the back-office.


Quote: Seller's Response and Price Offer
----------------------------------------

A quote may be created in response to a (guest) customer request for a quote, from an open opportunity related to an OroCommerce customer, or as a result of the direct communication with the customer. Once the customer is happy with the offer in the quote and is ready to proceed with their order, they accept the quote.

While RFQs are submitted exclusively through the storefront, quotes are always created in the back-office in multiple ways:

* :ref:`From the submitted RFQ <quote--create-from-rfq>` as a response to a customer's request
* :ref:`From scratch <quote--create-from-scratch>` as a result of a verbal or email communication
* :ref:`From an opportunity <mc-sales-opportunities-quote>` as a way to convert an opportunity to a customer by making an attractive offer on the product price, payment, and/or shipping conditions

With OroCommerce, you can automate the process of generating and sending quotes to a customer. A quote is a flexible form that pulls all the available products, pricing, and shipping information, as well as customer data to create a personalized offer based on the predefined rules. Quotes enable you to check the inventory status for the specified products, update the price to offer customer-specific discounts, calculate the shipping cost based on the customer's location, and set payment terms, if required.

.. image:: /user/img/concept-guides/rfq/quote_form.png
   :alt: A default quote template
   :scale: 50%


Every quote has a **free-form entry** that lets you manually input any extra service or product that is not showcased on your website. This form is mainly used to offer additional services to the purchased products, such as additional software installation, warranty extension, assistance with assembly or installation, and so on.

.. image:: /user/img/concept-guides/rfq/free_form_entry.png
   :alt: View the free-form entry functionality

Quote-Related Options in the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To get the most benefits out of the OroCommerce quote functionality, make sure that all the related features are activated either on the :ref:`global <sys--conf--commerce--guest--enable--guest_quotes>`, :ref:`organization <sys--organization-quotes>`, or :ref:`website <sys--websites-quotes>` level:

* **Storefront Quote Configuration**

  The setting controls whether a registered customer can view their quotes in the storefront under the Account menu. You can toggle the option to display or hide the Quotes section from the menu.

  .. image:: /user/img/concept-guides/rfq/quote_configuration.png
     :alt: View the Quotes section in the storefront that appears after enabling quotes in the back-office configuration
     :scale: 60%

* **Guest Quote**

  Non-authenticated visitors do not have a dedicated account on your website, and, therefore, do not have access to the Quotes section to view details of their submitted RFQs. However, guest users can still request a quote for the products they are interested in. When the **Guest Quote** setting is enabled, buyers can access their quote via a unique direct link through the email, after the sales representatives have processed the request and created a quote in the back-office. With the help of this link, guest users can accept or decline the quote, and proceed to the checkout.

  To enable the Guest Quote functionality, ensure that you have also enabled :ref:`Guest Website Access <sys--conf--commerce--guest--enable--access>`, :ref:`Guest Checkout <user-guide--system-configuration--commerce-sales-checkout>`, :ref:`Guest RFQ <user-guide--system-configuration--commerce-sales--rfq>`, and :ref:`Guest Shopping List <user-guide--system-configuration--commerce-sales-shopping-list>` in the back-office system configuration.

  .. image:: /user/img/concept-guides/rfq/guest_quote.png
     :alt: Global guest quote configuration settings

* **Quote Management Flow Workflow**

  The default :ref:`Quote Management Flow <system--workflows-quote>`, or the simple quote submission workflow, where a salesperson is not bound by any limitations and can handle the sale without supervision. In this case, a sales rep has all the necessary rights to create and submit a quote directly to the customer.

  .. image:: /user/img/concept-guides/rfq/quote_management_flow.png
     :alt: View the additional quote options appeared after enabling the quote management flow workflow

* **Backoffice Quote Flow with Approvals Workflow**

  The :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` is a default workflow where a salesperson must get approval from an authorized or senior person (e.g., their manager) before sending the quote with updated prices to the buyer. It is a good practice for companies to protect their junior employees from making a mistake in a customer-specific document, or to require additional validation from other PMO, sales, procurement or delivery departments.

  .. image:: /user/img/concept-guides/rfq/backoffice_quote_with_applroval.png
     :alt: View the additional quote options appeared after enabling the Backoffice management flow workflow

  Unlike the two RFQ-specific workflows, which you must enable together, the Quote-related workflows are mutually exclusive, meaning that only one workflow can be activated for your application.

RFQs and Quotes in Use
----------------------

Many of our OroCommerce customers use the default quote functionality and workflows as they fit their business processes. However, we have numerously helped other customers customize and optimize the out-of-the-box functionality of the application to fully cover their sales and marketing needs and processes.

Here are some of the examples of the RFQ and quote functionality customization that our OroCommerce's customers implemented for their businesses:

1. Disable the Checkout and Order functionality from the storefront to work exclusively through RFQs and quotes. Use shopping lists as a convenient way to add items to the RFQ. In this specific case, the order lifespan ends at the quote level.

2. Use Quotes without RFQs.

3. Buyers can convert RFQs and Quotes into a .pdf file in order to attach it to emails when sending to customers.

4. Add new fields to the RFQ form and custom information to quotes through customization.

5. Auto-generate quotes based on RFQ using specific predefined rules.


**Related Topics**

* :ref:`Create and Manage RFQ in the Back-Office <user-guide--sales--requests-for-quote>`
* :ref:`Create and Manage Quotes in the Back-Office <user-guide--sales--quotes>`
* :ref:`Configure RFQ Settings Globally <configuration--guide--commerce--configuration--sales-rfq>`
* :ref:`Configure RFQ Settings per Organization <user-guide--system-configuration--commerce-sales--rfq--organization>`
* :ref:`Configure RFQ Settings per Website <user-guide--system-configuration--commerce-sales--rfq--website>`
* :ref:`Configure Quotes Settings Globally <sys--conf--commerce--guest--enable--guest_quotes>`
* :ref:`Configure Quotes Settings per Organization <sys--organization-quotes>`
* :ref:`Configure Quotes Settings per Website <sys--websites-quotes>`
* :ref:`Create and Manage RFQ in the Storefront <frontstore-guide--rfq>`
* :ref:`Create and Manage Quotes in the Storefront <frontstore-guide--quotes>`