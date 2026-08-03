.. _backend--workflows--translation-wizard:

Workflow Translation Wizard
===========================

WorkflowBundle supports translation, so you can translate each workflow's text fields into multiple languages.
This topic explains how to use it when you create a new workflow configuration or update an existing one.

Follow these three steps:

**Step 1**

First, load your workflow configuration. It is located in the `<YourBundle>/Resources/config/oro/workflows.yml` file and can be loaded with the `oro:workflow:definitions:load` command.

.. hint::
   See :ref:`Configuration Reference <backend--workflows--config-reference>` for more details.

*For example*:

.. code-block:: none


    bin/console oro:workflow:definitions:load --directories=$YOUR_BUNDLE_DIR/Resources/config/oro

**Step 2**

After your valid configuration is ready, add translations or user-friendly text representations of the configuration pieces.

You can load workflow translations from their translation files located in the `<YourBundle>/Resources/translations/workflows.{lang}.yml` file (the same behavior as `messages.{lang}.yml` in Symfony defaults).

To fill valid keys with translation text, use the `oro:workflow:translations:dump` command. It dumps all keys related to your workflow translation to the output (stdout), which you can use to build the `workflows.{lang}.yml` file.

For example, you can create a translation file directly by redirecting the command output to a file.

.. code-block:: none


    bin/console oro:workflow:translations:dump my_workflow --locale=en > $YOUR_BUNDLE_DIR/Resources/translations/workflows.en.yml

This fills the `<YourBundleDirectory>/Resources/translations/workflows.en.yml` file with a tree of translation keys and empty strings, so you can enter proper text (English in the example).

If your workflow extends another workflow, you may want to inherit existing translations from that parent workflow. To do so, pass the name of the parent workflow as the `--parent-workflow` option value. Any translations not present in your workflow are then copied from the parent workflow automatically.

.. code-block:: none


    bin/console oro:workflow:translations:dump my_workflow --locale=en --parent-workflow=the_parent_workflow > $YOUR_BUNDLE_DIR/Resources/translations/workflows.en.yml


**Step 3**

Once the translation file is updated, load its translations into the system by running the :ref:`oro:translation:load <oro-translation-load-command>` command.

To **update** an existing workflow, perform the same operations: `oro:workflow:translations:dump` fills its output with both the existing and the newly created text nodes. For full customization (replacing or renaming config nodes), dump the command output elsewhere so you can manually choose what to update.

.. hint::
    - To rebuild translation cache, use the :ref:`oro:translation:rebuild-cache <oro-translation-rebuild-cache-command>` command.
    - to download and update translations, use the :ref:`oro:translation:update <oro-translation-update-command>` command.
