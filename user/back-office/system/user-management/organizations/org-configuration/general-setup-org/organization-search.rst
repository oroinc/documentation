.. _organization-config-search-synonyms:

Configure Back-Office Search Settings per Organization
======================================================

.. important:: The feature is available for the Enterprise edition only.

Search synonyms allow Elasticsearch to treat different forms of the same term as equivalent during searches. For example, searches for St can return results containing Street, and NC can match North Carolina. Synonym groups are configured by developers and cannot be created or managed from the back-office.

To enable search synonyms for an organization:

1. Navigate to **System > Configuration > User Management > Organizations** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > General Setup > Search** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. To enable the functionality, clea the **Use System** box, and select the checkbox next to option **Enable Search Synonyms**.
5. Click **Save settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
