.. _localization--translations--messages:

:oro_documentation_types: OroCommerce

Translate Labels, Options, and Messages
=======================================

.. hint:: This section is part of the :ref:`Localization and Translation <concept-guide--localization-translation>` concept guide that provides a general understanding of the localization and translation processes in OroCommerce.

To translate any UI system element, label, or a popup message, you need to update its translation from within the Translations grid under the **System > Localization > Translations** main menu.

Use the following filters to narrow down the search and locate the element's key.

* **Languages** --- The language in which the label was created.
* **Translated Value** --- [Label Name] or its part.
* **English Translation** -- Not available. Please note that when a system element is created under a non-English localization, the English translation is absent.
* **Key** --- All keys for system elements, labels, or messages end with a *label*. For example, *oro.email.created.label*.
* **Domain** --- messages

  .. image:: /user/img/concept-guides/localization/label-translations.png
     :alt: Filtered system labels

Once you locate the key, you can use it to translate the label into any selected language using the following filters:

* **Languages** --- All (or selected)
* **Key** --- [Your Key] e.g., *oro.task.updated_at.label*

  .. image:: /user/img/concept-guides/localization/translating-label-to-other-languages.png
     :alt: Translating the filtered label

