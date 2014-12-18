
Import and Export Functionality
===============================

OroCRM's import and export functionality enables a simple way of working with multiple records in CSV format.

If the functionality is enabled for an entity, :guilabel:`Export` and :guilabel:`Import` buttons are displayed
in the top right corner of the grid.


.. _user-guide-import:

Import
-------

- Click |Bdropdown| on the  :guilabel:`Import` button

- Choose :guilabel:`Download Data Template`

.. image:: ./img/export_import/download_data_template.png

- Prepare a .csv file following the template


.. caution::

    Mandatory fields of the entity **must** be specified


- Click  :guilabel:`Import` button

- Click :guilabel:`Choose File` and choose a .csv file to import

- Click :guilabel:`Submit`

.. image:: ./img/export_import/leads_import.png

- Carefully read through the submission form

.. image:: ./img/export_import/leads_import_validation_results.png

- Click :guilabel:`Back` to choose another file or :guilabel:`Import` button to go on with the import

  *"Validation started. Please wait."* message will appear.

  *"File is successfully imported."* message will appear when the import has finished.

Once import is over, the new entity records will appear in the :ref:`grid <user-guide-ui-components-grids>`.


.. _user-guide-export:

Export
------

- Go to the grid and
  - Click :guilabel:`Export` button

- *"Export started. Please wait."* message will appear at the top of the screen.

- As soon as the export finishes the message will change to: *"Export performed successfully, [number]
  downloads exported. Download result file."*

- Click the *"Download result file*" at the end of the message, and the download will be performed subject to your
  browser settings.

.. note::

    Please note that scope of record details exported, their names and position in the .csv file depend on the 
    Import&Export settings of the entity fields.



.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle
