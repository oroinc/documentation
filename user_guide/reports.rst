.. _user-guide-reports:

Reports
=======

The Oro Platform gives you the opportunity to create customized reports about
the entities in your application.

To manage your custom reports, go to *Reports & Segments*/*Manage Custom Reports*.
You'll see a list of all created reports:

.. image:: /user_guide/img/reports/reports.png

.. _book-reports-create-report:

Creating Reports
----------------

Creating reports is a simple task. When you view the list of custom reports,
click on the button labeled *Create Report*. You'll see a form like this:

.. image:: /user_guide/img/reports/form.png

Select the entity to create a report for, fill in the name field and select
the business unit that gets access to the report (at the moment, the only
supported report type is *table*).

Then, choose as many entity fields as you like:

.. image:: /user_guide/img/reports/fields.png

.. tip::

    You cannot only select fields of the entity you create the report for,
    but you can also fields of entities that are associated with the current
    entity.

It is not only possible to display the raw value of a field, but you can also
apply functions like ``Count``, ``Sum``, ``Average``, ``Min`` or ``Max``:

.. image:: /user_guide/img/reports/functions.png

You can fill in an alternative label which will be displayed if provided instead
of the original field name.

Finally, choose in which order the selected columns will be grouped:

.. image:: /user_guide/img/reports/grouping.png

.. _book-reports-view-report:

Viewing a Report
----------------

You can access a report in two ways:

#. From any place in the web UI, you can enter a certain by choosing it from
   the quick menu:

   .. image:: /user_guide/img/reports/quick-menu.png

#. When you're viewing the list of all available reports, you can simply click
   on its row.

When you have selected the report to view, you'll see the data you selected
when creating it presented as a nice table:

.. image:: /user_guide/img/reports/report-details.png

You can export the presented data in CSV format clicking on the *Export Grid*
button. The data shown above will then look like this:

.. code-block:: text

    Name,"Parent BU","# Users"
    Main,,1
    Sales,"Sales Asia",0
    Sales,"Sales Europe",0
    Sales,"Sales North America",0
    "Sales Asia",,0
    "Sales Europe",,0
    "Sales North America",,0

Modifying and Deleting Records
------------------------------

When you :ref:`view <book-reports-view-report>`, you can modify or delete
a report clicking on the appropriate button in the upper right corner. To
avoid accidentally losing reports, you will have to confirm the removal of
a report when you click the *Delete* button:

.. image:: /user_guide/img/reports/delete-confirm.png

When you click on the *Edit* button, you'll see the form that you already
saw when :ref:`creating <book-reports-create-report>` the report.
