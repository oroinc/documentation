.. _doc-rfm-admin:


Configure RFM
=============

In OroCRM the RFM metrics are available for Magento customers and are defined per channel.

For information about what is RFM and how to use it in OroCRM, please see the :ref:`RFM Analysis <user-guide-rfm-user>` guide.

.. contents:: :local:
    :depth: 2

Configure RFM Segments While Creating a New Channel
---------------------------------------------------

1. Start creating a new Magento channel. To do this, follow the instructions provided in the :ref:`Create a Channel Record <user-guide-channel-guide-create>` section of the :ref:`Channels <user-guide-channels>` guide. For **Channel Type**, select *Magento*.

2. Click **Additional**.


   .. image:: /admin_guide/img/rfm/rfm_clickadditional.png
      :alt: Configure RFM segments while creating a new channel


3. In the **RFM Segment Configuration** section, select the **Enable RFM** check box. The default ranking table appears.

4. If required, modify the ranking table as described in the `Modify the Ranking Table <./rfm-admin#modify-the-ranking-table>`__ section of this guide.

5. Click **Save**.



Modify the Ranking Table
^^^^^^^^^^^^^^^^^^^^^^^^

Modify Segments
"""""""""""""""

To modify the ranking table with your data, specify the following information for each segment:

    -  **Recency** shows the number of days since the last order made by a customer. Measured in days. The fewer days has passed, the better must be the score.

    -  **Frequency** shows the total number of orders a customer placed in the course of the last 365 days. The more orders, the better the score.

    -  **Monetary value** shows the total amount of money spent in the course of the last 365 days. The more is spent, the better must be the score.

.. note::
    Note the following:

        -  Score 1 is considered the best.

        -  You need to specify only one of the thresholds, the other is filled in automatically.

    For information about how to define segments, see the `How the RFM Analysis Is Done <./rfm-user#how-the-rfm-analysis-is-done>`__ section of the `RFM Analysis <./rfm-user>`__ guide.


.. image:: /admin_guide/img/rfm/rfm_modifyrfmtable.png
   :alt: Modify the ranking table


Add a New Segment
"""""""""""""""""

If required, add another segment. To do this, **Add Segment** under the table. Repeat until all the categories added. You can add as many segments as you want.


Delete a Segment
""""""""""""""""

If required, delete excess segments. To do this, click the X icon in the **Actions** column at the end of the segment row. You cannot delete segments if there are only two segments left.



Configure RFM for the Existing Channel
--------------------------------------

1. Open the channel view:

    a. Navigate to **System > Channels** in the main menu.

    b. Open the required channel by clicking on it once. Please note that the channel should be of Magento type.

2. On the channel view, click **Edit** in the top right corner.

3. Follow steps 2–5 of the `Configure RFM While Creating a New Channel <./rfm-admin#configure-rfm-segments-while-creating-a-new-channel>`__ section.


.. image:: /admin_guide/img/rfm/rfm_editrfmconfiguration.png
   :alt: Configure RFM for the existing channel


Review the RFM Configuration
-----------------------------

1. Open the channel view:

    a. Navigate to **System > Channels** in the main menu.

    b. Open the required channel by clicking on it once. Please note that the channel should be of Magento type.

2. On the channel view, click **Additional Information** and in the **RFM Segment Configuration** section, review the RFM settings.


Disable RFM
-----------

1. Open the channel view:

    a. Navigate to **System > Channels** in the main menu.

    b. Open the required channel by clicking on it once. Please note that the channel should be of Magento type.

2. On the channel view, click **Edit** in the top right corner.

3. Click **Additional**.

4. In the **RFM Segment Configuration** section, clear the **Enable RFM** check box.

5. Click **Save**.
