.. _workflows--actions--clone:

How to Clone a System Workflow
==============================

To clone a workflow, create a dump of its configuration and translation files, adjust them, and load into the system:

1. Dump the workflow configuration.

   For example, you want to dump a configuration of the Alternative Checkout workflow to your CustomBundle:

   .. code-block:: bash
      :linenos:

       php app/console oro:debug:workflow:definitions b2b_flow_alternative_checkout > /home/oro/commerce-application/src/<Acme>/Bundle/<CustomBundle>/Resources/config/oro/workflows.yml

   where /<Acme>/Bundle/<CustomBundle> is a path to the bundle you want to create a workflow for.

   The copy of the initial file will be created in the destination directory.

2. Dump the workflow translations. Translation contain labels for workflow steps, transitions, etc., thus it is necessary to clone them too.

   .. code-block:: bash
      :linenos:

      php app/console oro:workflow:translations:dump b2b_flow_alternative_checkout --locale=en > /home/oro/commerce-application/src/<Acme>/Bundle/<CustomBundle>/Resources/translations/workflows.en.yml

   The copy of the initial file will be created in the destination directory.

3. Open copied files with workflow configuration and translations. Change the workflow name in both files. If required, adjust other settings.

   .. important:: You need to change the workflow name to avoid conflicts with the existing workflow: workflows must have unique names in the system.

   .. image:: /dev_guide/cookbook/img/how_to_clone_workflow/workflow_config_change_name.png

   .. image:: /dev_guide/cookbook/img/how_to_clone_workflow/workflow_transl_change_name.png

4. Remove section ``init_routes`` from the cloned workflow configuration:

   .. image:: /dev_guide/cookbook/img/how_to_clone_workflow/workflow_config_remove_init.png

5. Load your cloned and adjusted workflow translations:

   .. code-block:: bash
      :linenos:

      php app/console oro:translation:load

6. Load your cloned and adjusted workflow configuration:

   .. code-block:: bash
      :linenos:

      php app/console oro:workflow:definitions:load