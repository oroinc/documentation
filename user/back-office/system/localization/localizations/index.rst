.. _localization--localizations:

Configure Localizations in the Back-Office
==========================================

.. hint:: This section is part of the :ref:`Localization and Translation <concept-guide--localization-translation>` concept guide that provides a general understanding of the localization and translation processes in OroCommerce.

.. note:: The Localizations settings are accessible from the **Global organization only**. Find more on working with organizations in the :ref:`Company Structure and Organization Selector <user-guide-getting-started-company-structure>`.

.. begin

Localization helps to bind the language and locale-specific formatting for smooth localization of the Oro system elements and messages visible to the user.

To enable easy inheritance from the parent or similar language, localizations may form groups organized as an ancestors tree, for example:

* English

  - English (UK)
  - English (USA)
  - English (Canada)

To view all localizations, navigate to **System > Localizations** in the main menu.

.. image:: /user/img/system/localization/localizations.png
   :alt: Localizations grid

The following information about the localizations is available in the Localizations list:

+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| Name                | Description                                                                                                                       |
+=====================+===================================================================================================================================+
| NAME                | The name of the localization that identifies settings for the particular locale. It is displayed in the back-office.              |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| TITLE               | The name of the localization set with a specific configuration displayed to the user in the storefront.                           |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| LANGUAGE            | The target language of the UI elements displayed to the user in the storefront.                                                   |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| FORMATTING          | The formatting style of the corresponding target language that is applied in the localized instance.                              |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| ENABLE RTL MODE     | The option that defines whether Right-to-Left text direction is enabled                                                           |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| PARENT LOCALIZATION | Another localization that the current one should fall back to whenever a system element has no translation in the target language.|
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| CREATED AT          | The date when the localization is created.                                                                                        |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+
| UPDATED AT          | The date when the localization is updated.                                                                                        |
+---------------------+-----------------------------------------------------------------------------------------------------------------------------------+

Manage Localizations
^^^^^^^^^^^^^^^^^^^^

Hover over the |IcMore| **More Options** menu to the right of the necessary localization:

1. Click |IcView| to view the localization details. Alternatively, click the corresponding item to open its details page.

2. Click |IcEdit| to edit the localization.

3. Click |Trash-SVG| to remove the localization from the list.

.. image:: /user/img/system/localization/localizations_more_options.png

Create a New Localization
^^^^^^^^^^^^^^^^^^^^^^^^^

Create a new localization with a specific configuration by clicking **Create Localization** in the top right.

.. image:: /user/img/system/localization/localizations_create.png
   :alt: Crete a new localization page

1. Give the localization a meaningful name and a title. The name is displayed in the back-office while the corresponding title is used in the storefront.

.. image:: /user/img/system/localization/localizations_name_and_title.png
   :alt: An illustration of how localization name added to the back-office is displayed in the storefront.

2. Select the target language from the list for this particular localization. Make sure to enable the required language as described in the :ref:`Languages <localization--languages>` section to display it in the list of the available languages.

3. Select the language formatting style.

4. If the localization you are creating requires Right-to-Left text direction, select the checkbox for **Enable RTL Mode**.

5. Select the parent localization from the available list. If no relations are set, the current localization inherits the English translation equivalents by default.

6. Click **Save** in the top right.

Once the localization is configured, you need to enable it in the system configuration menu. Proceed to the :ref:`Localization Settings <localization--localization>` section and follow the steps described in the guide.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
