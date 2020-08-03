.. _backend--workflows--translation-wizard:

Workflow Translation Wizard
===========================

WorkflowBundle supports the translation functionality and each workflow (in part of its text fields) can be translated into multiple languages.
This topic explains how to use it when creating new workflow configuration or updating the existing one.

Study the following three steps below:

**Step 1**

First of all, you should have your workflow configuration itself loaded, it is located in the `<YourBundle>/Resources/config/oro/workflows.yml` file and can be loaded by the `oro:workflow:definitions:load` command.

.. hint::
   See :ref:`Configuration Reference <backend--workflows--config-reference>` for more details.

*For example*:

.. code-block:: bash
   :linenos:

    bin/console oro:workflow:definitions:load --directories=$YOUR_BUNDLE_DIR/Resources/config/oro

**Step 2**

After your valid configuration is ready, add translations or user-friendly text representations of the configuration pieces.
 
You can load workflow translations from their translation files located in the `<YourBundle>/Resources/translations/workflows.{lang}.yml` file (the same behavior as `messages.{lang}.yml` in Symfony defaults). To fill valid keys with translation text, use the `oro:workflow:translations:dump` command that dumps all keys related to your workflow translation to the output (stdout), and can be used to build the `workflows.{lang}.yml` file.

For example, this is how you would create a translation file directly by redirecting output of command to a file.

.. code-block:: bash
   :linenos:

    bin/console oro:workflow:translations:dump my_workflow --locale=en > $YOUR_BUNDLE_DIR/Resources/translations/workflows.en.yml

This way, file `<YourBundleDirectory>/Resources/translations/workflows.en.yml` is filled by translation keys tree with empty strings, so a developer can fill their values with proper text (English in the example).

**Step 3**

When the translation file is updated, you might need to load translations into the system from that file; for this, run the following command:

.. code-block:: bash
   :linenos:

    bin/console oro:translation:load

Now, if you need to **update** an existing workflow, you can perform the same operations because dumped translations of `oro:workflow:translations:dump` will be filled by the existing and newly created nodes of the text. For full customization, (replace config nodes, rename them), dump the output of command elsewhere so you could manually choose what to update.
