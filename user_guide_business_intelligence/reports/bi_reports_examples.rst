.. _user-guide--business-intelligence--reports--reports-examples:

Reports in Use
==============

This section contains several examples of the report configuration:

.. contents:: :local:
   :depth: 3

Aggregate Data in the Report
----------------------------

Below is an example of a simple report that displays a particular budget per opportunity.

.. image:: /user_guide/img/business_intelligence/reports_examples_1.png
   :alt: An example of a simple report

1. Once you set up the *Budget amount* column, click **Add** to add it into the **Columns** list.

2. Click **Save**.

3. You are now redirected to the report view that shows the opportunities with the known **Budget Amount**:

   .. image:: /user_guide/img/business_intelligence/reports_examples_2.png
      :alt: Report view with the opportunities

4. Click **Edit** to continue the report configuration.

Let us see what happens after we use the **Count** function for the **Opportunity Budget** column:

5. Click |IcEdit| to update the column and change the function for the **Budget amount** to *Count*.

   .. image:: /user_guide/img/business_intelligence/reports_examples_3.png
      :alt: Updating the buget amount in the report

6. Click **Save**. The report data changes:

   **Report Preview (Function = Count)**

   .. image:: /user_guide/img/business_intelligence/reports_examples_4.png
      :alt: Report example illustrating the count function

Similarly, you can use sum, max, average, and min functions.

**Report Preview (Function = Sum)**

.. image:: /user_guide/img/business_intelligence/reports_examples_5.png
   :alt: Report example illustrating the sum function

The sum of **Budget Amount** values of all opportunities makes $202,565.00.

**Report Preview (Function = Max)**

.. image:: /user_guide/img/business_intelligence/reports_examples_6.png
   :alt: Report example illustrating the max function

The biggest budget amount value of the opportunity is $9,902.00.

Use Simple Grouping by Value
----------------------------

You can group the information in the report by unique values in the column(s).

.. image:: /user_guide/img/business_intelligence/reports_examples_7.png
   :alt: Group the information in the report by unique values in the column(s)

The report preview:

.. image:: /user_guide/img/business_intelligence/reports_examples_8.png
   :alt: The report preview

Use Grouping by Value at Multiple Levels
----------------------------------------

You can group records based on several columns (e.g. per opportunity status and the B2B customer name).

.. image:: /user_guide/img/business_intelligence/reports_examples_9.png
   :alt: Group records based on several columns

Now, you can see the calculated budget metrics (total, average, min, and max) for all the opportunities with the same status that belong to a specific customer.

The report preview:

.. image:: /user_guide/img/business_intelligence/reports_examples_10.png
   :alt: Calculated budget metrics for all the opportunities

.. hint::

    Once a report is generated, you can click the name of a column to sort all the data in the report by the specified field value (ascending or descending).

    Here is an example of the report ordered by the **Name** column:

    .. image:: /user_guide/img/business_intelligence/reports_examples_11.png
       :alt: Sort all the data in the report by clicking the name of a column

    As you can see in the outlined area, there are opportunities which are both in progress and lost for Albers Super Markets. You can view the budget details for the both groups.

.. note::

    If the customer's name is the most important part of the grouping, it might be reasonable to edit the report and move the column to make it first.

.. _user-guide--business-intelligence--reports--chart-examples:

Use Charts
----------

Let us make a chart for the budget per opportunity status report (not grouped by customers).

Configuration:

.. image:: /user_guide/img/business_intelligence/reports_examples_12.png
   :alt: Make a chart for the budget per opportunity status report

Output:

.. image:: /user_guide/img/business_intelligence/reports_examples_13.png
   :alt: Output from the budget status report

**Related Topics**

:ref:`Use System Reports <user-guide--business-intelligence--reports--use-system-reports>`

:ref:`Use Custom Reports <user-guide--business-intelligence--reports--use-custom-reports>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin
