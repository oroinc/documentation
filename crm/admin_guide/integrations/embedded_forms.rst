.. _admin-embedded-forms:

Embedded Forms
==============

In Oro application, **Embedded Forms** help create the code that may be added to a third-party website to enable communication between the third-party website users and the Oro application.
Embedded forms may be used to collect requests of marketing, technical, commercial or any other nature.

The fields of an embedded form depend on its type. 

Embedded Form Types and Fields
------------------------------

The two out-of-the-box types of the embedded forms are "Contact Request" and "Magento Contact Us Request".

.. hint::

    Additional embedded form types may be created in the course of integration with OroCRM, subject to your specific
    business needs.

Contact Request
^^^^^^^^^^^^^^^

The form initially looks as follows:

.. image:: ../img/emb_form/cont_req.png

Magento Contact Us Request
^^^^^^^^^^^^^^^^^^^^^^^^^^

The form is sharpened for the Magento design, however it can be used for any website.

The form initially looks as follows:

.. image:: ../img/emb_form/cont_req_magento.png


Create and Preview an Embedded Form
-----------------------------------

In order to create a new embedded form:

1. Go to the *System → Integrations → Embedded Forms*.

2. Click the :guilabel:`Create Embedded Form` button.

3. The "Create Embedded Form" form will appear. The form has the following fields:

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Channel***","The :term:`channel <Channel>` from which the form information will be received. The drop-down contains
  all the channels defined in the system. The field must be defined."
  "**Title***","The title used to refer to the form in the system. The field must be defined."
  "**Form Type***","Choose one of the form types described above. 
  
  Please note, that while the *Magento Contact Us Request* type is sharpened to suite the Magento design, you can choose 
  the type regardless of the Channel chosen."
  "**CSS***","Editable CSS. The default CSS corresponds to the initial form design, subject to its type. You can edit 
  the CSS to change such settings as the border width, color, fonts etc."
  "**Success Message***","The message to be displayed on the website following the successful form submission. By 
  default is set to *Form has been submitted successfully*."

4. Click the button in the top right corner to save the form.


For example, we have created a form for the custom channel. We've changed the text color to green and the background to 
yellow. We've also changed the Success Message to "Thank you for the question!".

      |
  
.. image:: ../img/emb_form/emb_form_create_ex.png

|

After we've saved it, the form has appeared in the Embedded Forms grid. 

       |
  
.. image:: ../img/emb_form/emb_form_create_ex_01.png

|

You can preview the form on its :ref:`View page <user-guide-ui-components-view-pages>` page:

      |
  
.. image:: ../img/emb_form/emb_form_create_ex_02.png


Manage Embedded Forms
---------------------

- From the gird, you can manage the Contact Request using the action icons:

  - Delete the form: |IcDelete|

  - Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the form: |IcEdit|

  - Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the form:  |IcView|

.. _admin-embedded-forms-code:
 
Add the Form to Your Site
-------------------------  
Open the form View page and go to the "Get Code" section. The code to add your form to the site is available there.

.. image:: ../img/emb_form/emb_form_code.png


.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle