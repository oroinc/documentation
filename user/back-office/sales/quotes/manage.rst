:oro_documentation_types: OroCommerce

Manage Quotes
=============

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

You can edit and delete existing quotes, as well as engage them in various activities, such as :ref:`attaching files to a quote <user-guide-activities-attachments>`, :ref:`making notes <user-guide-add-note>` on the quote, :ref:`creating calendar events <doc-activities-events>` linked to the quote, :ref:`sending emails <user-guide-using-emails>` related to the quote.

.. _quotes--actions--edit:

Edit a Quote
------------

.. _quotes--actions--edit--fromgrid:

Edit a Quote from the Quote Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

.. important::
   This option is available only when:

   * :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.
   * One of the workflows is active, and the current workflow step allows editing the quote.

To edit a quote:

#. Navigate to **Sales > Quotes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click the |IcEdit| **Edit** icon to start editing its details.

   .. important:: The icon that starts a workflow looks like the **Edit** icon. Please check the hint that appears when you hover over the icon to make sure that you select the desired action.

#. Update the **Quote General Information**, **Line Items**, **Shipping Address**, or **Shipping Information** sections. See :ref:`Create a Quote <quote--create-from-scratch>` topic for detailed information on the available options.

#. Click **Save** on the top right of the page.

The quote is updated.

.. finish

.. _quotes--actions--edit--fromviewpage:

Edit a Quote from the Quote View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important:: You can edit a quote in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.  Otherwise, use the Edit transition defined within the active workflow:

               .. image:: /user/img/sales/quotes/quotes_workflowedit1.png
                  :alt: Click the Edit button within the active Backoffice Quote Flow with Approvals workflow

To edit a quote:

1. In the main menu, navigate to **Sales > Quotes**.
#. Choose the quote in the list and click it. The quote details page opens.
#. Click **Edit** on the top right of the page:

   .. image:: /user/img/sales/quotes/quotes_edit1.png
      :alt: Click the Edit button on the quote edit page

#. Update the **Quote General Information**, **Line Items**, **Shipping Address**, or **Shipping Information** sections. See :ref:`Create a Quote <quote--create-from-scratch>` topic for detailed information on the available options.
#. Click **Save** on the top right of the page.

The quote is updated.

.. _quotes--actions--delete:
.. _quotes--actions--delete--fromgrid:

Delete a Quote
--------------

Delete a Quote from the Quote Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

.. important::
   This option is available only when:

   * :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive
   * One of the workflows is active, and the current workflow step allows quote deletion.

1. In the main menu, navigate to **Sales > Quotes**. The quote list opens.
2. Choose the quote you need to delete, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcDelete| **Delete** icon.
#. In the confirmation dialog, click **Yes, Delete**.

.. finish

.. _quotes--actions--delete--fromviewpage:

Delete a Quote from the Quote View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important::
   You can delete a quote in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive. Otherwise, use the Delete transition defined within the active workflow:

   .. image:: /user/img/sales/quotes/quotes_workflowdelete1.png
      :alt: Click the Delete button within the active Backoffice Quote Flow with Approvals workflow

1. In the main menu, navigate to **Sales > Quotes**. The quote list opens.
2. Click the quote that you need to delete. The page with quote details opens.
3. Click **Delete** on the top right of the page.

   .. image:: /user/img/sales/quotes/quotes_delete1.png
      :alt: Click the Delete button on the quote view page

#. In the confirmation dialog, click **Yes, Delete**.

.. _quotes--actions--delete--multiple:

Delete Multiple Quotes
^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Sales > Quotes**. The quote list opens.
2. Select the checkboxes in front of the quotes that you need to delete, click the |IcMore| **More Options** menu at the end of the list header, and then click |IcDelete| **Delete**.

   .. tip::
      To select a bulk of items quickly, click |IcSortDesc| next to the checkbox at the beginning of the table header and then select one of the following options:

      * *All* --- Select all quotes.
      * *All Visible* --- Select only quotes that are visible on the page now.

      To clear the selection, select *None*.

#. In the confirmation dialog, click **Yes, Delete**.

.. include:: /include/include-images.rst
   :start-after: begin
