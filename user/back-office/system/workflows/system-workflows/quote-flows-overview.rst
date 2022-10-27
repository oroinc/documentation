:oro_documentation_types: OroCRM, OroCommerce

.. _system--workflows--quote--understanding:

Configure Quote Workflows in the Back-Office
============================================

.. toctree::
   :maxdepth: 2

   Quote Management Flow <quote-management-workflow>
   Backoffice Quote Flow with Approvals <backoffice-quote-flow-with-approvals>

.. note:: For general information on using workflows, see the :ref:`Workflows <user-guide--system--workflow-management>` section.

Quote workflows lead a sales person through the process of gaining agreement with a buyer on a quote. Backoffice workflows control the actions available in the back-office.

Out-of-the-box, OroCommerce supports two mutually exclusive quote management workflows:

* :ref:`Quote Management Flow <system--workflows--quote-backoffice-workflow>` --- A simple quote management flow, where a sales person is not bound by any limitations and can handle the sale without supervision.
* :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` --- A flow, where a sales person might have to get approval from the authorized person (e.g. their manager) before sending the quote with updated prices to the buyer.

.. warning:: Approval is not requested when the **Price Override Requires Approval** option is disabled in the workflow configuration. In this case, both workflows follow the simple quote management flow, with no approvals. See the :ref:`Enable Approvals in Workflow Configuration <doc--workflows--backoffice-quote-flow-with-approvals--configure>` section for more information on how to enable approvals.





.. include:: /include/include-images.rst
   :start-after: begin