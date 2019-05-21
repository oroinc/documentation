.. _user-guide--consents--add:

Add a Consent Landing Page to a Web Catalog
-------------------------------------------

.. note:: To add the consents to a web catalog, make sure that consents are :ref:`enabled in the application <configuration--guide--commerce--configuration--consents>`. 

To be able to display the text of the consent to customers in the storefront, you need to create a consent landing page with the corresponding description and add it as a content variant for a specific node in a web catalog.

.. important:: Please be aware that if your consent does not require any descriptive text, or if your consent is optional, you do not have to add it to the web catalog node as a landing page. However, if you need to :ref:`comply with the GDPR <user-guide--consents>`, make sure that the mandatory consent has detailed description of the terms that the buyer should agree to, in which case you do need to add this consent as a landing page to the selected web catalog node.

To add a consent landing page to a web catalog content node:

1. Navigate to **Marketing > Web Catalogs** in the main menu.
#. For the necessary catalog, hover over the |IcMore| **More Options** menu to the right of the necessary catalog, and click |IcEditContentTree| to start editing the catalog content tree.
#. Click on the required root content node where you want the consent to be displayed.

   .. note:: If you do not want the consent to be displayed in the storefront menu, add it to the 5th menu level to hide it from the storefront, or apply appropriate :ref:`restrictions <user-guide--marketing--web-catalog--content--visibility>`.

 .. since by default only the first 4 levels are visible on the storefront

#. In the **Content Variants** section, click **Add Landing Page** in the Content Variants list.

    .. image:: /img/system/consents/add_landing_page_with_consent.png
       :class: with-border
       :alt: Add a landing page with a consent as a content variant to a web catalog

#. Select a landing page with the consent description from the list, if such landing page has been created previously under **Marketing > Landing Pages**.
 
   To create a new landing page from within the web catalog, click **+** next to the hamburger menu in the Landing Page field.

    .. image:: /img/system/consents/add_landing_page_from_web_catalog_page.png
       :class: with-border
       :alt: Create a new landing page from the web catalog page

#. In the dialog that opens, provide the following key details:
    
   * **Titles** --- Provide the name for the consent.
   * **Content** --- Provide the consent description. The text that you enter will be displayed to customers in the storefront.

     .. note:: To localize the consents, you need to create separate landing pages for each target language and add all related landing pages to the content node. Set the proper restrictions to limit the consent visibility to a certain localization when it is selected in the storefront. See the :ref:`Localize Consents <user-guide--consents--localizing-consents>` guide for more details on how to translate consents into different languages.

   .. image:: /img/system/consents/add_landing_pages_to_consents.png
      :alt: Add landing pages with localized consents to a content node

   .. note:: You can read more on creating and managing landing pages in the corresponding :ref:`Landing Pages <user-guide--landing-pages>` topic.

#. Click **Save** at the bottom of the dialog to save consent details. 

   The consent is now added to the Landing Page content variant field.

   .. important:: Be aware that web catalog restrictions can affect the visibility of the consent in the storefront. Make sure that the visibility restriction are configured properly. Read more on restrictions in the :ref:`Set Up Content Variant Visibility topic <user-guide--marketing--web-catalog--content--visibility>`.

#. Click **Save** on the top right to save the content node.

Once the landing page with the consent description is added to a web catalog node, you can :ref:`create a new consent <user-guide--consents--create>` under **System > Consent Management**, and link it to the required web catalog node.

.. important:: Keep in mind that for the consents to be displayed in the storefront, you need to :ref:`add them to the list of enabled consents <admin--guide--commerce--configuration--customers--consents--enable--globally>` in the system configuration.

.. important:: You can view all consents accepted by your customer users in the **Consents** section of their pages under **Customers > Customer Users**.

        .. image:: /img/system/consents/consents_section_customer_user_page.png


.. important:: Keep in mind that once a consent is accepted by at least one person in the OroCommerce storefront, it becomes uneditable and unremovable as well as the associated landing page.

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports>`
* :ref:`Add a Cookie Banner to the Website <user-guide--consents--cookie-banner>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin