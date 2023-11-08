:oro_documentation_types: Extension

.. _system--workflows--seller-product-approval-workflow:

Configure Seller Product Approval Workflow in the Back-Office
=============================================================

.. hint:: The workflow is only available in the Enterprise edition of the Oro application. It requires an extension, so visit Oro Extensions Store to download the |Seller Product Approval workflow extension| and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

The Seller Product Approval workflow is a powerful tool that enables global administrators to manage the review and publication of products from non-global organizations. Once the workflow extension is installed, it is initially disabled.

To enable the workflow, the global administrator needs to:

1. Navigate to **System > Workflows** in the main menu.

2. Activate the Seller Product Approval workflow by clicking |IcActivate| at the end of the row. Or click |IcView| to view the workflow's details.

.. image:: /user/img/system/workflows/seller-product-approval/enable-seller-product-flow.png
   :alt: Seller Product approval flow under the Workflow menu

Seller Product Approval workflow is a system workflow, which means it cannot be edited, only deactivated.

Workflow Steps and Transitions
------------------------------

**Draft**

Products created outside the global organization are **Disabled* by default and have the workflow in **Draft** status. In this status, users can edit products and submit them for approval by the global administrator.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-draft.png
   :alt: Newly created product is in Draft workflow status

**Waiting for Approval**

When a product is submitted for approval, it still has a *Disabled* status and a workflow status of **Waiting for Approval**. In this status, the global administrator, a user working within the global organization, can either approve or reject the product. Users can also add notes for the reviewer while sending the approval request. Once the request is sent, an email with a link to the product will be sent to the administrator for review. If users leave review comments, those comments will also be sent to the same email.

If a user in a regular organization needs to make any changes, they can cancel the approval request and continue editing the product.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-send-for-approval.png
   :alt: Display how the seller product approval workflow status changes after the user sends the request to approve the product creation

**Approved**

If the reviewer finds the product satisfactory and approves it, the product's status changes to *Enabled*, and its workflow status becomes **Approved**. Depending on the :ref:`configuration parameter <system-configuration--commerce--product--seller-product-approval-workflow>`, an email notification will be sent either to the business unit that owns the product or to the user who requested the approval.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-approved.png
   :alt: Display how the seller product approval workflow status changes after the admin approves the product creation

**Rejected**

If the reviewer decides to reject the product, it will be marked as *Disabled*, and the workflow status will be updated to **Rejected**. The reviewer can provide notes explaining the reason for the rejection. An email, containing the rejection comments left by the reviewer, will be sent to either the product's owning business unit or the user who submitted the product, depending on the :ref:`configuration parameter <system-configuration--commerce--product--seller-product-approval-workflow>`.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-rejected.png
   :alt: Display how the seller product approval workflow status changes after the admin rejects the product creation

**Requesting Changes**

After a product has been approved, the user can request changes by sending a list of desired changes to the reviewer. An email containing the list of changes will be sent to the reviewer. Statuses remain unchanged.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-request-change.png
   :alt: Possibility for the user to request changes for the approved product

Global Organization Products
----------------------------

Products created within the global organization are exempt from this workflow and have their status field **Enabled** for editing.

.. image:: /user/img/system/workflows/seller-product-approval/seller-product-flow-global-product.png
   :alt: Products created under the global organization do not have the seller product approval workflow and can be edited


**Related Topics**

* :ref:`Configure Global Seller Product Approval Workflow Settings <system-configuration--commerce--product--seller-product-approval-workflow>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin