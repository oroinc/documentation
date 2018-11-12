.. _doc-customer-management-overview:

Understanding Accounts, Channels, and Customers
-----------------------------------------------

For each :ref:`channel created <user-guide-channel-guide-create>`, there is a set of :term:`entities <Entity>`  that are defined. These entities correspond to the various types of information collected from the corresponding data source.

One of the entities must represent a :term:`customer <Customer>`.

Once a customer record is created, it is assigned to an account. Several accounts may be  :ref:`merged <user-guide-accounts-merge>`  into one, regardless of the channels. (For example, when you have a Business customer who represents a client of yours, and this client is also buying something from your Magento store).

.. note:: For quick guidance, please see a short demo on `accounts, contacts and customers <https://oroinc.com/orocrm/media-library/22091>`_.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/3typtIVAU6Y" frameborder="0" allowfullscreen></iframe>


.. _user-guide-common-features-channels:

Channels
^^^^^^^^

**Channels** are various sources of customer information.

Currently, there are three types of channels in your Oro application: Magento, Sales and Commerce.

* A Magento channel is required to enable Magento integration and work with Magento related data. More information on this can be found in the relevant :ref:`Magento channels <user-guide-magento-channel>` amd :ref:`Magento-based sales <doc-magento-based-sales>` topics.

* A Sales channel is required to enable a Business Customer entity. More information on business customers can be found in the :ref:`Business customer <user-guide-system-channel-entities-business-customer>` and :ref:`Business-to-business sales <user-guide-business-to-business-sales>` topics.

* A :ref:`Commerce <user-guide-commerce-integration>` channel is available only for those applications that are integrated with OroCommerce. In applications with active OroCommerce integration, a Commerce channel enables Customers and Customer users. More information can be found in the relevant `OroCommerce documentation <https://www.oroinc.com/doc/orocommerce/current/user-guide/customers>`_.

.. note:: Please note that a Custom channel, although available in the user interface, is deprecated, and will be removed in later releases.

.. _user-guide-common-features-customers:

Customers
^^^^^^^^^

Each profile within one channel is a *customer*. However, the type of customers depends on the type of channels that they arrived from.

* For profiles that come from Magento, these are **Magento Customers**.
* For profiles that come from the Sales channel, these are **Business Customers**.
* For profiles that come from the Commerce channel, these are **Customer Users** and **Customers**. In this case, Customers are companies who buy your products using OroCommerce storefront, and Customer Users are those people who act on behalf of a company.

.. image:: /user_guide/img/accounts/accounts_view_channels.png

Although all these customers may come from different channels, data received is aggregated under accounts. For instance, if customer A has arrived from Sales and Commerce channels, but has been recognized as the same person, information on such customer will be collected under one account. This means that all quotes, orders or carts created by Customer A will be visible and trackable on one page, giving a 360 degree view of his activity.



.. _user-guide-common-features-accounts:

Accounts 
^^^^^^^^

Using details of the customer records, you can manage the details within one source, however efficient and comprehensive customer relations management requires you to aggregate information of the customer-activities in different sources. To do so, you can use accounts.

When customer-related data is uploaded to OroCRM (such as from Magento), a new account is created for every customer automatically. When a customer is added in OroCRM directly, you can manually create a new account for each customer or assign them to an existing account. You can also merge several existing accounts.


.. note:: You can also checkout three short demos on:

          * `creating and editing <https://oroinc.com/orocrm/media-library/22093>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/00Vz_mkbeTE" frameborder="0" allowfullscreen></iframe>

          * `managing <https://oroinc.com/orocrm/media-library/22095>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/5FEyHWr-jQY" frameborder="0" allowfullscreen></iframe>

          * `merging account records <https://oroinc.com/orocrm/media-library/merge-account-records-2>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/x-LwwCQfwGQ" frameborder="0" allowfullscreen></iframe>

.. _user-guide-common-features-contacts:

Contacts
^^^^^^^^

While a Customer and an Account may refer to a company, an enterprise, or a person, the **Contact** entity represents an actual person you are dealing with. It contains their personal information, details of their position in the customer-company, their address information, and other related data.

System users can define a relationship between a customer and a contact (i.e. bind them to each other), or between a contact and a project (e.g., a lead or opportunity). They can easily find the contact record with OroCRM's :ref:`search functionality <user-guide-getting-started-search>` and use the contact details for the customer-related activities. Moreover, contacts can be allocated into groups to simplify the search and :ref:`filtration <user-guide-filters-management>`.


.. note:: You can also checkout a short video on `how to create and edit contact records <https://oroinc.com/orocrm/media-library/create-edit-contact-records-orocrm#play=SmkJGGwG-r0>`_.

Now that you have the general understanding of the Accounts, Contacts, Customers, and Customer Users concepts, you can summarize the information by checking the :ref:`Compare Accounts and Contacts to Customers and Customer Users <user-guide-commerce-integration-accounts--compare>` topic. It helps clarify the difference between all these entities in case your OroCRM application is integrated with OroCommerce, and the menu content is combined displaying the modules from both OroCRM and OroCommerce.