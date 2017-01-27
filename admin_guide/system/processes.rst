.. _user-guide-processes:

Processes
=========

Some actions in OroCRM trigger other actions. This behaviour is pre-defined at the background and can be modified in the
course of the system integration. Mostly, this actions are related to :ref:`OroCRM extensions <admin-package-manager>`.
For example, as soon as a new Magento Customer has been uploaded to OroCRM, an account and a record are
automatically created for it, and if a new campaign has been created in a Dotmailer address book synchronized with 
a marketing list in OroCRM, a new Email Campaign record is automatically created in OroCRM.

You can view and activate/deactivate the process in the OroCRM UI.

View Processes
--------------

To view the processes, go *System → Processes*.  

The *"All Processes"* grid contains the following details:


.. csv-table::
  :header: "Name","Description"
  :widths: 10, 30

  "NAME","Defines the process available in the system." 
  "RELATED ENTITY","OroCRM :term:`entity`, records of which are influenced by the process."
  "EXECUTION ORDER","Priority of the process execution. The smaller is the number, the higher is the priority. If 
  several processes have been triggered simultaneously, the processes
  with a higher priority are executed first."
  "ENABLED","If set to *Yes*, the process will be executed."
  "CREATED AT","Date and time when the process was added to the system."

.. image:: ../img/processes/pr_grid.png


View Process Details
--------------------

Click the |IcView| :ref:`action icon <user-guide-ui-components-grid-action-icons>` on the grid to get to the 
:ref:`View page <user-guide-ui-components-view-pages>` of the process an see its details. 

On the View Page you can see the basic process details (as in the grid) and the **Process Triggers**, i.e. in what
case and with what delay after the event the process will be executed.

.. image:: ../img/processes/pr_view.png


Manage Processes
----------------

The only action available from the UI is enabling/disabling the process.

This can be done with :guilabel:`Activate` and :guilabel:`Deactivate` buttons on the View page or |IcDeactivate| and 
|IcActivate| icons on the  *"All Processes"* grid.



.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle
   
.. |IcDeactivate| image:: ../../img/buttons/IcDeactivate.png
   :align: middle
   
.. |IcActivate| image:: ../../img/buttons/IcActivate.png
   :align: middle