.. _user-guide-rfm-user:

RFM Analysis
============

In OroCRM the RFM metrics are available for Magento customers and are
defined per channel.

.. contents:: :local:
    :depth: 2

.. hint:: See a short demo on `how to use RFM analysis <https://oroinc.com/orocrm/media-library/how-to-use-rfm-analysis#play=mEAyF73Irm0>`__, or keep reading the step-by-step guidance.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/mEAyF73Irm0" frameborder="0" allowfullscreen></iframe>

Overview
--------

In sales and marketing, a correct targeting is often the key thing that
makes a deal or a promotion campaign successful. That is why it is useful to have
a technique for dividing customers into segments.

RFM analysis is one of such techniques. It is based on customer
order history. Its title stands for "recency, frequency, monetary", which means that it helps evaluate customers from the following points:

- **Recency** — How long ago did the customer create their last order?

- **Frequency** — How often does the customer make orders?

- **Monetary value** — How much money did the customer spend on the orders?

Answers to these questions allow you to identify your "best customers",
"worst customers" and any required number of segments between them.

How It Helps
------------

It is well-known that 20% of customers bring 80% of the business'
profit. That is why, having identified which customers constitute the most
profitable 20%, you can focus your promotional efforts where you will
get the best return.

At the same time, knowing your worst customers, you can develop
retention and reactivation campaigns to engage this segment more and,as a result, strengthen your customer base.

How It Works
------------

RFM analysis is comprised of the steps outlined below:

Step 1: Configure RFM
^^^^^^^^^^^^^^^^^^^^^

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

+-------------+----------------------------+
| Rank        | Frequency                  |
+=============+============================+
| 1 (Highest) | Over 20 purchases per year |
+-------------+----------------------------+
| 2           | 5–19 purchases per year    |
+-------------+----------------------------+
| 3           | 0–4 purchases per year     |
+-------------+----------------------------+

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
	-  Define the same number of ranks for each parameter (this is a traditional approach).
	
	-  Do not define too many ranks. Segments must be large enough to be statistically valid, therefore 3–5 ranks usually bring the most sensible results. However, if you have a great number of customers, you may need to use more ranks.
	
	-  Use data analysis methods, such as calculating the percentiles, to correctly identify segment thresholds.
	
	-  Make sure that segments do not intersect.

In OroCRM, this step is performed by the system administrator and is described in the :ref:`Configure RFM <doc-rfm-admin>` guide.

Step 2: Rank Your Customers
^^^^^^^^^^^^^^^^^^^^^^^^^^^

In step 2 each customer is assigned corresponding ranks. OroCRM performs
this step automatically when segments are defined.

+-----------------+-----------+-------------+------------------+
| Rank            | Recency   | Frequency   | Monetary value   |
+-----------------+-----------+-------------+------------------+
| John Doe        | 1         | 3           | 3                |
+-----------------+-----------+-------------+------------------+
| Jane Roe        | 3         | 2           | 1                |
+-----------------+-----------+-------------+------------------+
| Joan Anderson   | 3         | 1           | 2                |
+-----------------+-----------+-------------+------------------+

The three ranks together are called *an RFM cell*.

Step 3: Interpret the RFM Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In step 3, you study RFM cells. This can help you determine (among other things) which promotions are better for which customers.

For example, the data above can be interpreted as follows:

-  John Dow makes frequent and small orders. An upselling/cross-selling technique can help make this customer more profitable for the store.

-  Jane Row made many orders on regular basis and spent a significant amount of money on them. However, she has not returned to the store for some time. A reactivation promotion may help her switch back to making orders in your store.

For how you can study the RFM metrics with OroCRM, see the `How RFM Data is Used`_ section below.


How RFM Data is Used
--------------------

When sales or customer service staff contacts a particular customer, the
RFM information can help them make better decisions. For this purpose,
a customer's RFM metrics can be easily accessed from the customer or
account views.

Create Segments Based on RFM Metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To simplify the creation of marketing lists and reports, you can create a
customer segment based on RFM metrics, and reuse it wherever
required.


Example 1. Churn Candidates Segment
"""""""""""""""""""""""""""""""""""

You may want to define a segment which comprises customers that
made orders frequently in the past but show no recent activity. For instance, let us
assume, it is those whose recency is 4 and lower (5, 6, etc) and frequency is 3 and
higher (1,2). Make this segment dynamic and it will be automatically updated
as soon as new data appears in the system.

1. From the **Type** list, select **Dynamic**.

2. Select customers’ identifiers (ID, first name, last name, etc.) and the recency metrics as the report columns.

3. Filter data by the recency and frequency values (the combined filter should have the following values: ``Recency >= 4 AND Frequency <=3``).

 .. image:: /admin_guide/img/rfm/rfm_segment-norecentactivity.png

When you decide to start reactivation campaign and begin creating a marketing list, specify that you want to include only customers belonging to a particular segment into it. To do this, use the **Apply Segment** filter on the marketing list creation form.

For more details about segments and their creation, please see the :ref:`Segments <user-guide-filters-segments>` guide.


Example 2. Top Customers Segment
""""""""""""""""""""""""""""""""

Another useful segment includes your best customers. Assuming you consider those who fall into the RFM cells 111, 112, 121, 122, create a segment as described in the `Example 1 <./rfm-user#example1-churn-candidates-segment>`__  of this section, but in step 3, define ``Recency = 1 AND Frequency <=2 AND Monetary <=2`` for a combined filter.


.. image:: /admin_guide/img/rfm/rfm_segment-topcustomers.png


Create a Marketing List Based on RFM Metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Example 1. Top Customers Marketing List
"""""""""""""""""""""""""""""""""""""""

Let us assume that you regularly run upselling marketing campaigns that
include sending promotional offers to your top customers. You can create
a dynamic marketing list based on the filtering customers by RFM
metrics. This list can be reused and will always contain actual data
about the top customers.

To create such marketing list, do as follows:

1. From the **Type** list, select **Dynamic**.

2. Select customers’ identifiers (ID, first name, last name, etc.) and contact information as the report columns.

3. Filter data by the recency, frequency and monetary values (the combined filter should have the following values: ``Recency = 1 AND Frequency <=2 AND Monetary <=2``).


.. image:: /admin_guide/img/rfm/rfm_marketinglist-topcustomers.png


To simplify creation of the marketing list, you can filter data using a predefined segment. Assuming that you have created the "Top customers" segment as described in the `Example 2. Top customers segment <./rfm-user#example2-top-customers-segment>`__ , in step 3, instead of applying individual filters to recency, frequency and monetary values, use the **Apply Segment** filter and select the "Top customers" segment for it.


.. image:: /admin_guide/img/rfm/rfm_marketinglist-topcustomers_sgmnt.png


For more details about marketing lists and their creation, please see the `Marketing Lists <../../user-guide-role-based/marketing-tools/marketing-lists>`__ guide.


Create a Report with RFM Metrics
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In developing business plans, marketers and business owners usually rely
on the information from reports. Reports based on the RFM metrics can
help them create a fine marketing strategy and set adequate goals.

Example 1. Simple RFM Report
""""""""""""""""""""""""""""

You can build a simple report that shows RFM cells for each customer.

To create such a report, select RFM metrics and the customers’
identifiers (ID, first name, last name, etc.) as the report columns.
Apply sorting to the RFM metrics fields to show RFM cells in the rank
order.


.. image:: /admin_guide/img/rfm/rfm_report-cell.png


.. image:: /admin_guide/img/rfm/rfm_report-cell2.png



Example 2. Top Customers Report
"""""""""""""""""""""""""""""""

Another report may show your top customer, the total amount of all their orders and amounts paid.

Let us assume, you have created the corresponding "Top customers" segment in advance by following the instruction provided in the `Example 2. Top customers segment <./rfm-user#example2-top-customers-segment>`__. In this case, to create a top customers report, perform the following steps:

1. Select customers’ identifiers (ID, first name, last name, etc.), RFM metrics and the totals as the report columns (do not forget to add all the fields that do not have a function assigned to them into the **Grouping** section).

2. In the **Filters** section, use the **Apply Segment** filter and select the "Top customers" segment for it.


.. image:: /admin_guide/img/rfm/rfm_report-topcustomers_sgmnt.png
  

.. image:: /admin_guide/img/rfm/rfm_report-topcustomers_sgmnt2.png


For more details about reports and their creation, please see the :ref:`Reports <user-guide-reports>` topic.



Review RFM Metrics for a Customer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open a Magento customer view:

    a. Navigate to **Customers > Magento Customers** in the main menu.

    b. Click on the required Magento customer from the list.

2. You can see the RFM cell under the customer name in the top right corner of the page.

.. image:: /admin_guide/img/rfm/rfm_cusomerview.png

  


Review the RFM Metrics for a Customer from an Account View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open the account view:
   
    a. Navigate to **Customers > Accounts** in the main menu.

    b. Click on the required account from the list.

2. In the sections menu, click the name of the required Magneto channel.

4. Click the tab with required customer name.

6. The RFM cell is displayed in the top right corner of the
   customer tab.


.. image:: /admin_guide/img/rfm/rfm_accountview.png


.. Important::
	It is possible that the same customer is displayed in the account as
	belonging to different channels.

	For example, the data from two Magento web stores is loaded to OroCRM
	via two different channels. And the same customer (identified by the
	name and email, for example) makes orders in the both web stores.

	In this case, RFM metrics will be different for each of the customer
	records displayed. This must not confuse you because:

	-  RFM segments are defined per channel, thus customers of each channel are likely to be segmented based on different thresholds.

	-  Order history data differs for each channel.
	

  .. image:: /admin_guide/img/rfm/rfm_accountview2.png
  
.. toctree::
   :hidden:
   :titlesonly:
   :maxdepth: 1

   rfm_admin

