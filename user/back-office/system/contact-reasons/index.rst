.. _admin-guide-contact-reasons:

Contact Reasons
===============

Contact Reasons are used to help categorize the :ref:`contact requests <user-guide-activities-requests>` submitted by customers through any channel (either via the :ref:`embedded <admin-embedded-forms>` *Contact Us* form in the storefront, or by phone and email). You can create a list of contact reasons based on the most frequently asked questions or common issues. These reasons are displayed both in the storefront and in the back-office, enabling customers and sales representatives to select the appropriate topic for contact requests.

To create a contact reason:

1. Navigate to **System > Contact Reasons** in the main menu.

2. The list of available reasons is displayed.

   .. image:: /user/img/system/contact_reasons/all_contact_reasons.png
      :alt: The list of available reasons

3. Click **Create Contact Reason** on the top right.

4. Give the reason a meaningful name.

   .. image:: /user/img/system/contact_reasons/create_contact_reason.png
      :alt: A contact reason creation page

5. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. If :ref:`localization <config_guide--localization--organization-localization>` is enabled in the system configuration, the corresponding translation of the contact reason is displayed in the storefront. Click the same icon again to return to the single-language view.

6. Click **Save and Close**.

7. Now you can edit the existing contact reasons or delete the unnecessary ones if necessary by clicking the |IcEdit| or |IcDelete| icons respectively at the end of the selected reason's row.

Once saved, the reason appears in the dropdown list of the corresponding section of the *Contact Us* form in the storefront.

.. image:: /user/img/system/contact_reasons/select_reasons_storefront.png
   :alt: Select a contact reason from the dropdown list in the storefront

When a customer submits the form selecting a certain reason, the relevant request is created in the **Contact Request** module under the **Activities** main menu. The request contains the **Contact Reason** field that helps you identify a possible issue the customer is concerned about.

.. image:: /user/img/system/contact_reasons/contact_request_page.png
   :alt: Select a contact reason from the dropdown list in the storefront

You can also assign a contact reason to a contact request manually by selecting the appropriate category when creating or editing a contact request.

.. image:: /user/img/system/contact_reasons/assign_contact_reason.png
   :alt: Assign a contact reason manually when editing a contact request

For more details, see the :ref:`How to Create a Contact Request Manually <user-guide-activities-requests-create-manually>` topic.


.. include:: /include/include-images.rst
   :start-after: begin
