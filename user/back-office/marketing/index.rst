:oro_documentation_types: OroCRM, OroCommerce

:title: Marketing Tools in the OroCommerce and OroCRM Back-Office

.. meta::
   :description: Marketing campaigns, promotions, and web catalog management guides for the OroCommerce and OroCRM back-office users


.. _user-guide-marketing:

Manage Marketing Activities in the Back-Office
==============================================

The Marketing Menu in the Oro application provides access tools for managing the following marketing activities:

* :ref:`Marketing lists <user-guide-marketing-lists>`
* :ref:`Email Campaigns <user-guide-email-campaigns>`
* :ref:`Campaign <user-guide-marketing-campaigns>`
* :ref:`Promotions <user-guide--marketing--promotions>`
* :ref:`Coupons <user-guide--marketing--promotions--coupons>`
* :ref:`Tracking Websites <user-guide-marketing-tracking>`
* :ref:`Web catalog <user-guide--web-catalog-create>`
* :ref:`Landing page <user-guide--landing-pages>`
* :ref:`Content Blocks <user-guide--landing-pages--marketing--content-blocks>`
* :ref:`Customer Login Pages <customer-login-pages>`
* :ref:`Digital Assets <digital-assets>`

:ref:`Marketing lists <user-guide-marketing-lists>` are lists of contacts segmented according to conditions which are defined for the purpose of bulk emailing or telephone outreach. In your Oro application, virtually every entity is available as a marketing list target. For instance, marketing lists can be created based on accounts (primary email of a default contact is used), or, if you are using OroCommerce, from customer users, quotes, orders, and shopping lists.

Marketing lists can be used to synchronize with subscribers lists in :ref:`MailChimp <user-guide-mc-integration>`, and once the integration is configured, :ref:`send an email campaign via MailChimp <user-guide-mailchimp-campaign>`.

Also, the Oro application supports out-of-the-box integration with :ref:`dotmailer <user-guide-dm-integration>`, allowing you to map the marketing lists to address books in dotmailer, use your address books to :ref:`send an email campaign via dotmailer <user-guide-dotmailer-campaign>`, and :ref:`manage dotmailer data fields and mappings <user-guide-dotmailer-data-fields>`.

:ref:`Email Campaigns <user-guide-email-campaigns>` can be generated and sent in your Oro application without the involvement of external marketing automation applications. This means that once you have defined the rules for a :ref:`marketing list <user-guide-marketing-lists>` generation and have created an :ref:`email template <user-guide-email-template>`, you can easily set up an email campaign within which all the contacts on the list will receive personalized emails in compliance with the campaign. You can then collect statistics for such campaigns and :ref:`create reports <user-guide-reports>`.

:ref:`Campaign <user-guide-marketing-campaigns>` records in the Oro application are used to define general details of the marketing activity and monitor its flow and results. You can include any number of email campaigns and :ref:`tracking website records <user-guide-marketing-tracking>` into one marketing campaign and get the full picture to evaluate the campaign efficiency.

:ref:`Promotions <user-guide--marketing--promotions>` are the part of marketing communication in your Oro application. In this section, you will learn how to create promotions to enable sellers to apply various discounts to their orders, generate personalized discount :ref:`coupons <user-guide--marketing--promotions--coupons>`, and build a strategic schedule for promotions.

With the Oro :ref:`Tracking Websites <user-guide-marketing-tracking>` functionality, you can learn how many users have visited your website from links within a specific marketing campaign and what these users' actions at the site were.

:ref:`Web catalog <user-guide--web-catalog-create>` helps present the products in a personalized way that fits your target audience and improves their purchase experience. Keep in mind that if no web catalog is enabled for your website, the structure of the :ref:`master catalog <user-guide--master-catalog>` will be used in the storefront.

:ref:`Landing page <user-guide--landing-pages>` is a section of a website accessible by clicking or being directed from a hyperlink. This is often the first page customers land on when they arrive at the storefront.

:ref:`Content Blocks <user-guide--landing-pages--marketing--content-blocks>` enable to display generic information on your website customizing the pages with a variety of content.

You can also customize the content of :ref:`Customer Login Page <customer-login-pages>` in the storefront.

.. toctree::
   :maxdepth: 2
   :hidden:

   Marketing Lists <marketing-lists/index>
   Email Campaigns <email-campaigns/index>
   Marketing Campaigns <marketing-campaigns/index>
   Promotions <promotions/index>
   Tracking Websites <tracking-websites/index>
   Web Catalogs <web-catalogs/index>
   Landing Pages <landing-pages/index>
   Content Blocks <content-blocks/index>
   Customer Login Pages <customer-login-pages/index>
   Content Widgets <content-widgets/index>
   Digital Assets <digital-assets/index>

