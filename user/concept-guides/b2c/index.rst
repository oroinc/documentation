:oro_documentation_types: OroCommerce

.. _b2c-solution-management-concept-guide:

B2C Websites in OroCommerce Concept Guide
=========================================

.. hint:: This feature is available since OroCommerce v4.1.1. To check which application version you are running, see the :ref:`system information <system-information>`.

The B2C (business-to-consumer) business model is a marketing strategy that is based on the transactions between a seller (business) and an individual customer (consumer). The B2C e-commerce refers to the online commerce transaction made from a company website with an online catalog.

Most consumers are now familiar with the B2C e-commerce, as it facilitates online shopping, providing the convenience of buying clothes, products, food, electronics, or services through the Internet.

B2C VS B2B: Spot the Difference
-------------------------------

The B2B eCommerce, which stands for business-to-business, is primarily focused on selling products or services to other businesses. This process is more complex in terms of negotiations, establishing long-term partnerships, scopes, and cost, as it involves transactions between manufacturers and wholesalers, wholesalers and retailers, and multiple industries, each with different needs and purchasing processes. It goes in contrast with the B2C approach, where buyers usually make spontaneous purchases.

Some companies can handle both B2C and B2B businesses. For instance, the companies like Home Depot and Office Max, which initially operated as B2C businesses, have separate B2B sales channels, focusing a portion of their website on the local general contractors who frequently buy in bulk.

Some B2B distributors, on the other hand, in the intention to meet their customers' expectations, start adopting B2C business models, implementing the proven B2C approaches, and developing seamless customer purchasing experience. That is a great tactic to create additional revenue channels and even acquire new B2B customers, as it is a usual practice for a B2B customer to check out the quality of a product by making a small initial purchase as a B2C buyer. Such an approach is gaining popularity among huge market leaders, such as Grainger. Being a gigantic B2B industrial supply company, Grainger has successfully adopted the B2C business model for its Zoro devision, which targets the general public, small companies, and individuals who want to fulfill their immediate need.

OroCommerce offers a new multichannel solution that can help you adopt any business model for your organization, either B2B, B2C, or both, on your application.

To try out the OroCommerce application in a test mode and to experience the benefits of the platform for your business, use our free |public self-serve demo|.

.. image:: /user/img/concept-guides/b2c/commerce_demo.png
   :alt: A log-in page to a B2B and B2C demo store
   :scale: 50 %


Three Multichannel eCommerce Strategies
---------------------------------------

OroCommerce supports three multichannel e-commerce strategies that enable you to deploy a B2B-specific e-commerce website with the incorporated references to other websites for B2C customers, a single website for B2C and B2B commerce, and multiple standalone B2C websites from one platform.

.. important:: Keep in mind that multi-website management is only available in the Enterprise edition.

Whichever strategy you select, OroCommerce is designed to adapt to your company's requirements in several clicks.

B2B Website with Limited B2C Access
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Usually, when you run the B2B business, you separate the showcased information based on the target audience, that is, your B2B and B2C consumers. While B2B customers have access to all products, prices, and discounts, general B2C customers can only access limited information, such as product catalog. That is done to prevent unregistered users from viewing product prices until they create an account. If the visitors reject the offer to establish an account, they can be directed to a retailer, wholesaler, or another intermediary platform, such as Amazon, where they already have an account, to make a purchase.

.. image:: /user/img/concept-guides/b2c/buy_on_Amazon.png
   :alt: Links to either register an account at B2B website or buy from Amazon as B2C customer

For instance, if you are a small B2B company that wants to establish a new B2C channel, you may want to start your B2C experience from the existing proven marketplaces, showcasing and selling your products via the intermediary platform. Once you go live with the Amazon store, you can place the referral link to your existing B2B website.

With OroCommerce, you can embed any link to any landing page, content block, or a product category.

.. image:: /user/img/concept-guides/b2c/insert_links.png
   :alt: Inserting links via WYSIWYG

.. hint:: To learn how to insert links, videos, clickable images, and other information to your content, check out the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` topic.


B2B and B2C on the Same Website
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This strategy enables you to deploy both B2B and B2C simultaneously on one website. With the advanced OroCommerce functionality, you can set different configuration for different customers, customer user groups, and localizations. By toggling the settings, you can customize what your customers can and cannot do within your website.

* **One website - multiple B2B and B2C customers**

OroCommerce gives you the possibility to diversify the content and access restrictions to certain customers.

For instance, you may want to allow all customers and guest visitors to browse your website and view product catalogs. However, B2B customers can create an account and log into the website to access additional product information, discounts, supporting documentation, and various shipping and payment options at checkout. They can also have their individually negotiated pricing based on the established partnership. While B2C customers or guest users, who do not have a dedicated account, can view the default pricing, displayed on the website.

Depending on the visitor who landed on your website, registered B2B or guest B2C, the same content can appear differently.

.. image:: /user/img/concept-guides/b2c/B2B_vs_B2C_option.png
   :alt: Different product pricing and additional options for B2B and B2C
   :scale: 60 %

The following settings can be customized per customer:

* :ref:`assigning a customer user group, related price lists, payment terms, and tax codes <user-guide--customers--customers--create>`

  .. image:: /user/img/concept-guides/b2c/new_customer_settings.png
     :alt: Assigning a related price list and payment terms to a customer

* :ref:`defining access levels and permissions for a customer with a certain customer user role <user-guide--customers--customer-user-roles>`

  .. image:: /user/img/concept-guides/b2c/access_levels_per_customer.png
     :alt: Defining access levels and permissions for a customer

* :ref:`configuring global customer settings <configuration--guide--commerce--configuration--customer>`

  .. image:: /user/img/concept-guides/b2c/global_customer_settings.png
     :alt: Global customer settings

* :ref:`configuring customer settings per organization <org--commerce--configuration--customer>`

  .. image:: /user/img/concept-guides/b2c/org_customer_settings.png
     :alt: Customer settings per organization

* :ref:`configuring customer settings per website <website--commerce--configuration--customer>`

  .. image:: /user/img/concept-guides/b2c/website_customer_settings.png
     :alt: Customer settings per website

* :ref:`configuring guest (B2C) customer settings <sys--conf--commerce--guest>`

  .. image:: /user/img/concept-guides/b2c/guest_functions.png
     :alt: Global guest customer settings

.. hint:: For more details on how to configure the website's settings per customer, check out the :ref:`Manage Customers in the Back-Office <user-guide--customers>` topic.

* **One website - multiple B2B and B2C customer user groups**

The settings for the customer user groups have the similar configuration as for the customers described above. You can split your customers (B2B Customer X, Y, Z, and B2C guest visitors) into certain customer groups, such as wholesalers, retailers, partners, non-authenticated customers and apply different restrictions to each group, depending on your business needs. After all, B2B and B2C buyers have distinct expectations from your website, and you can customize your marketing to satisfy their individual needs.

.. hint:: For more details on how to configure the website's settings per customer groups, check out the :ref:`Manage Customer Groups in the Back-Office <user-guide--customer-groups>` topic.

* **One website - multiple localizations for B2B and B2C buyers**

Another example goes for the case with several businesses running in different countries on the same platform. You may want to customize your products, services, prices, and content per each business individually by creating multiple localizations. This way, your website can look differently depending on your buyer's localization.

.. image:: /user/img/concept-guides/b2c/dif_localization.png
   :alt: Different website look for the English and French localizations

You can also create another localization for the same language (for instance, *English-B2B* and *English-B2C*) with the same formatting to enable the additional translation of the UI system elements and content. In this case, you can diversify the same UI and content elements for B2B and B2C businesses running on the same platform in the same language. This way, you can change the name and description of the same content element, turning *Women’s Nursing Shoe* from website A into *Women’s White Slip-On Clogs* for website B with different description, a *shopping list* into a *shopping cart*, and so on.

.. image:: /user/img/concept-guides/b2c/diff_local.png
   :alt: Different website look for the English-B2B and English-B2C localizations
   :scale: 50%

.. hint:: For more details on how to localize the content of your website, check out the :ref:`Localizations, Languages, and Translations <sys--config--sysconfig--general-setup--localization>` topic.


Standalone B2C Website
^^^^^^^^^^^^^^^^^^^^^^

The third strategy that you can deploy on the OroCommerce platform is the implementation of the standalone B2C website.

In the B2C business model, unlike B2B, you can enable guest shopping lists, disable the requirement of mentioning a company name when registering an account, disable the ability to request and view quotes, and place orders through a quick order form.

Here is a list of options that are configured to match the B2C strategy:

.. image:: /user/img/system/websites/B2C_settings2.png
   :alt: The list of options that are modified for the B2C website

All the settings can be manually adjusted in the system configuration later on, if needed.

A B2C website can be configured in two ways:

1. :ref:`During creation of a new website <system-websites-create>`

.. image:: /user/img/concept-guides/b2c/create_b2c_website.png
   :alt: Setting a website as B2C when creating a new website

2. :ref:`While viewing the existing website <user-guide--system-websites-b2c>`

.. image:: /user/img/concept-guides/b2c/configure_b2c_website.png
   :alt: Configure a website as B2C from the website's view page


.. note:: With OroCommerce, you can operate multiple websites with different business strategies on one platform. However, keep in mind that the :ref:`multi-website management <website-management-concept-guide>` is only available in the Enterprise edition.


**Related Topics**


* :ref:`Multi-Website Configuration Concept Guide <website-management-concept-guide>`
* :ref:`Manage a Website in the Back-Office <user-guide--system-websites--manage-websites>`
* :ref:`Guest Functions Concept Guide <sys--conf--commerce--guest>`
* :ref:`Manage Customers in the Back-Office <user-guide--customers>`
* :ref:`Manage Customer Groups in the Back-Office <user-guide--customer-groups>`
* :ref:`Manage Localizations, Languages, and Translations <sys--config--sysconfig--general-setup--localization>`


.. include:: /include/include-links-user.rst
   :start-after: begin






