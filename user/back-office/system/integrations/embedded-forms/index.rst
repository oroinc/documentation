:oro_documentation_types: OroCRM, OroCommerce

.. _admin-embedded-forms:

Embedded Forms
==============

In Oro application, embedded forms help create the code that may be added to a third-party website to enable communication between the third-party website users and the Oro application.

Embedded forms may be used to collect requests of marketing, technical, commercial or any other nature.

The fields of an embedded form depend on its type. The two out-of-the-box types of the embedded forms are:

* Contact Request

   .. image:: /user/img/system/integrations/emb_form/cont_req.png
      :width: 50%
      :alt: The contact request form
 
* Magento Contact Us Request
 
   .. image:: /user/img/system/integrations/emb_form/cont_req_magento.png
      :width: 50%
      :alt: Magento Contact Us Request form
 
Additional embedded form types may be created in the course of integration with the Oro application, subject to your specific business needs.

Create an Embedded Form
-----------------------

In order to create a new embedded form:

1. Navigate to **System > Integrations > Embedded Forms** in the main menu.
2. Click **Create Embedded Form**.
3. Provide the following details: 

   * **Title** --- The title used to refer to the form in the system. The field must be defined.
   * **Form Type** --- Choose one of the form types described above. Please note, that while the *Magento Contact Us Request* type is sharpened to suit the Magento design, you can choose the type regardless of the Channel chosen.
   * **CSS** --- Editable CSS. The default CSS corresponds to the initial form design, subject to its type. You can edit the CSS to change such settings as the border width, color, fonts etc.
   * **Success Message** --- The message to be displayed on the website following the successful form submission. By default is set to *Form has been submitted successfully*.
   * **Allowed Domains** --- Allowed cross origin domains where the form can be embedded. Supports wildcard, e.g., X.example.com.

      .. image:: /user/img/system/integrations/emb_form/embedded_form_contact_us.png
         :alt: A sample of the Thanks for question form configuration

4. Click **Save and Close**.

   .. image:: /user/img/system/integrations/emb_form/emb_form_create_ex_02.png
      :alt: The Thanks for question form preview

Once saved, the form is displayed on the page of all embedded forms under **System > Integrations > Embedded Forms**.
  
.. image:: /user/img/system/integrations/emb_form/emb_form_create_ex_01.png
   :alt: A list of all embedded forms

You can view |IcView|, edit |IcEdit|, and delete |IcDelete| contact requests using the corresponding action icons.

.. _admin-embedded-forms-code:
 
Add Embedded Forms to Your Site
-------------------------------

To add the necessary embedded form to your website:

1. Navigate to **System > Integrations > Embedded Forms** in the main menu.
2. Click once on the form to open its details page.
3. In the **Get Code** section, copy the provided code and paste it to the required section of your website. 

.. image:: /user/img/system/integrations/emb_form/emb_form_code.png
   :alt: A sample iframe code for the Thanks for question form

.. stop

.. include:: /include/include-images.rst
   :start-after: begin