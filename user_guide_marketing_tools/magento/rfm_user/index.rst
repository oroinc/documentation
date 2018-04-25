.. _user-guide-rfm-user:

RFM Analysis
============

In OroCRM the RFM metrics are available for Magento customers and are
defined per channel.

.. contents:: :local:
    :depth: 1


What Is RFM?
------------

In sales and marketing, a correct targeting is often the very thing that
makes a deal or promotion campaign successful. Thus it is useful to have
a handy technique for dividing customers into segments.

The RFM analysis is one of such techniques. It is based on the customer
order history. Its title stands for "recency, frequency, monetary"
meaning it helps evaluate customers from the following points:

- **Recency**—How long ago the customer made their last order?

- **Frequency**—How often the customer made orders?

- **Monetary value**—How much money did the customer spend on the orders?

Answers to these questions allow you to identify your "best customers",
"worst customers" and any required number of segments between them.

How It Helps You?
-----------------
It is well-known that 20% of customers bring 80% of the business'
profit. Thus, having identified which customers constitute the most
profitable 20%, you can focus your promotional efforts where you will
get the best return.

At the same time, knowing your worst customers, you can develop
retention and reactivation campaigns to engage this segment more and
consequently, strengthen your customer base.

How the RFM Analysis Is Done?
-----------------------------
RFM is quite easy.

Step 1
^^^^^^
In step 1, you define how to rank your customers. For each of the
"recency", "frequency" and "monetary value" parameters, you define
segment thresholds and which rank to assign to customers that fall in
this segment. For example, you may define that you want to rank your
customers the following way:

+-------------+----------------------------------------+
| Rank        | Recency                                |
+=============+========================================+
| 1 (Highest) | Last purchase was made 0–30 days ago   |
+-------------+----------------------------------------+
| 2           | Last purchase was made 31–90 days ago  |
+-------------+----------------------------------------+
| 3           | Last purchase was made 91–365 days ago |
+-------------+----------------------------------------+

|

+-------------+----------------------------+
| Rank        | Frequency                  |
+=============+============================+
| 1 (Highest) | Over 20 purchases per year |
+-------------+----------------------------+
| 2           | 5–19 purchases per year    |
+-------------+----------------------------+
| 3           | 0–4 purchases per year     |
+-------------+----------------------------+

|

+-------------+---------------------------+
| Rank        | Monetary value            |
+=============+===========================+
| 1 (Highest) | Over $1000 spent per year |
+-------------+---------------------------+
| 2           | $200–$999 spent per year  |
+-------------+---------------------------+
| 3           | $0–$200 spent per year    |
+-------------+---------------------------+


.. hint::
	-  Define the same number of ranks for each parameter, this is a traditional approach.
	
	-  Do not define too many ranks. Segments must be large enough to be statistically valid, thus 3–5 ranks usually bring the most sensible results. However, if you have a very big amount of customers, you may need to use more ranks.
	
	-  Use data analysis methods, such as calculating the percentiles, to correctly identify segment thresholds.
	
	-  Make sure that segments do not intersect.

In OroCRM, this step is performed by the system administrator and is described in the `Configure RFM <../../admin-guide/marketing-tools/rfm-admin/>`__ guide.

Step 2
^^^^^^
In step 2 each customer is assigned corresponding ranks. OroCRM performs
this step automatically after segments are defined.

+-----------------+-----------+-------------+------------------+
| Rank            | Recency   | Frequency   | Monetary value   |
+-----------------+-----------+-------------+------------------+
| John Doe        | 1         | 3           | 3                |
+-----------------+-----------+-------------+------------------+
| Jane Roe        | 3         | 2           | 1                |
+-----------------+-----------+-------------+------------------+
| Joan Anderson   | 3         | 1           | 2                |
+-----------------+-----------+-------------+------------------+

The three ranks together are called "RFM cell."

Step 3
^^^^^^
In step 3, you study RFM cells. This can help you determine, among other things, which promotions are the best for which customers.

For example, the data above can be interpreted as follows:

-  John Dow makes frequent and small orders. An upselling / cross-selling technique can be tried out to make this customer more profitable for the store.

-  Jane Row made many orders on regular basis and spent a significant amount of money on them. She has not returned to the store for some time thought. A reactivation promotion may help her switch back to making orders in your store.


For how you can study the RFM metrics with OroCRM, see the `Use RFM data <./rfm-user#use-the-rfm-data>`__ section.



Use the RFM Data
----------------

When sales or customer service staff contacts a particular customer, the
RFM information can help them make better decisions. For this purpose,
the customer’s FRM metrics can be easily accessed from the customer or
account views.

Create segments based on the RFM metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To simplify creating of marketing lists and reports, you can create a
customer segment based on the RFM metrics and reuse it wherever
appropriate.


Example 1. Churn candidates segment
"""""""""""""""""""""""""""""""""""
You may want to define a segment which comprises customers that
made orders frequently in the past but show no recent activity (let’s
assume, it is those whose recency is 4 and worth and frequency is 3 and
better). Make this segment dynamic and it will be automatically updated
as soon as new data appears in the system.

1. From the **Type** list, select **Dynamic**.

2. Select customers’ identifiers (ID, first name, last name, etc.) and the recency metrics as the report columns.

3. Filter data by the recency and frequency values (the combined filter should look like: ``Recency >= 4 AND Frequency >=3``).


|

.. image:: /user_guide/img/rfm/rfm_segment-norecentactivity.png 
  
|


When you decide to start reactivation campaign and start creating a marketing list, specify that you want to include only customers belonging to the particular segment into it. To do this, use the **Apply Segment** filter on the marketing list creation form.

For more details about segments and their creation, please see the :ref:`Segments <user-guide-filters-segments>` guide.


Example 2. Top customers segment
""""""""""""""""""""""""""""""""
Another useful segment includes your best customers. Assuming you consider such those who fall into the RFM cells 111, 112, 121, 122, create a segment as described in the `Example 1 <./rfm-user#example1-churn-candidates-segment>`__  of this section, but in step 3, define for a combined filter: ``Recency = 1 AND Frequency <=2 AND Monetary <=2``.

|

.. image:: /user_guide/img/rfm/rfm_segment-topcustomers.png 





Create a marketing list based on the RFM metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Exmaple 1. Top customers marketing list
"""""""""""""""""""""""""""""""""""""""
Let’s imagine that you regularly run upselling marketing campaigns that
include sending promotional offers to your top customers. You can create
a dynamic marketing list based on the filtering customers by RFM
metrics. This list can be reused and will always contain actual data
about the top customers.

To create such marketing list, do as follows:

1. From the **Type** list, select **Dynamic**.

2. Select customers’ identifiers (ID, first name, last name, etc.) and contact information as the report columns.

3. Filter data by the recency, frequency and monetary values (the combined filter should look like: ``Recency = 1 AND Frequency <=2 AND Monetary <=2``).

|

.. image:: /user_guide/img/rfm/rfm_marketinglist-topcustomers.png 

|


To simplify creation of the marketing list, you can filter data using a predefined segment. Assuming that you have created the "Top customers" segment as described in the `Example 2. Top customers segment <./rfm-user#example2-top-customers-segment>`__ , in step 3, instead of applying individual filters on recency, frequency and monetary values, use the **Apply Segment** filter and select the "Top customers" segment for it. 

|

.. image:: /user_guide/img/rfm/rfm_marketinglist-topcustomers_sgmnt.png 

|

For more details about marketing lists and their creation, please see the `Marketing Lists <../../user-guide-role-based/marketing-tools/marketing-lists>`__ guide.


Create a report with the RFM metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In developing business plans, marketers and business owners usually rely
on the information from reports. Reports based on the RFM metrics can
help them create a fine marketing strategy and set adequate goals.

Example 1. Simple RFM report
""""""""""""""""""""""""""""

You can build a simple report that shows RFM cells for each customer.

To create such a report, select the RFM metrics and the customers’
identifiers (ID, first name, last name, etc.) as the report columns.
Apply sorting to the RFM metrics fields to show RFM cells in the rank
order.

|

.. image:: /user_guide/img/rfm/rfm_report-cell.png 

|

.. image:: /user_guide/img/rfm/rfm_report-cell2.png



Example 2. Top customers report
"""""""""""""""""""""""""""""""

Another report may show your top customer, the total amount of all their orders and the totals amount paid. 

Let’s assume, you have created the corresponding "Top customers" segment in advance by following the instruction provided in the `Example 2. Top customers segment <./rfm-user#example2-top-customers-segment>`__. Then, to create the top customers report, do as follows:

1. Select customers’ identifiers (ID, first name, last name, etc.), RFM metrics and the totals as the report columns (do not forget to add all the fields that do not have a function assigned to them into the **Grouping** section).

2. In the **Filters** section, use the **Apply Segment** filter and select the "Top customers" segment for it.

|

.. image:: /user_guide/img/rfm/rfm_report-topcustomers_sgmnt.png 
  
|

.. image:: /user_guide/img/rfm/rfm_report-topcustomers_sgmnt2.png 

  


For more details about reports and their creation, please see the :ref:`Reports <user-guide-reports>` guide.



Review the RFM Metrics for a Customer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the Magento customer view:

    a. In the **Main Menu**, point to **Customers** and in the
         drop-down menu, click **Magento Customers**.

    b. In the grid on the **All Magento Customers** view, click the
         required Magento customer.

2. On the Magento customer view, the RFM cell under is displayed at the
   top of the view, right under the customer name.

|

.. image:: /user_guide/img/rfm/rfm_cusomerview.png 

  


Review the RFM Metrics for a Customer from an Account View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the account view:
   
    a. In the **Main Menu**, point to **Customers** and in the
         drop-down menu, click **Accounts**.

    b. In the grid on the **All Accounts** view, click the required
         account.

2. In the sections menu, click the name of the required Magneto channel.

4. Click the tab with required customer name.

6. The RFM cell is displayed at the upper right-hand corner of the
   customer tab.

|

.. image:: /user_guide/img/rfm/rfm_accountview.png 


  

.. Important::
	It is possible that the same customer is displayed in the account as
	belonging to different channels.

	For example, the data from two Magento web stores is loaded to OroCRM
	via two different channels. And the same customer (identified by the
	name and email, for example) makes orders in the both web stores.

	In this case, the RFM metrics will be different for each of the customer
	records displayed. This must not confuse you because:

	-  The RFM segments are defined per channel, thus customers of each channel are likely to be segmented based on different thresholds.

	-  Order history data differs for each channel.
	
	|

  .. image:: /user_guide/img/rfm/rfm_accountview2.png 
  

.. toctree::
   :hidden:
   :titlesonly:
   :maxdepth: 1

   rfm_admin

