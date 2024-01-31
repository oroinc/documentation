.. _bundle-docs-platform-search-bundle-datetime:

DateTimeFormatter
=================

.. hint:: See the :ref:`Search Index <search_index_overview>` documentation to get a more high-level understanding of the search index concept in the Oro application.

Class |DateTimeFormatter|.

Please use this class if you need format \DateTime object to |string by specific format|.

* format

  .. code-block:: php

     public function format(\DateTime $dateTimeValue)

  Returns formatted string of \DateTime. The class uses DateTimeFormatter::DATETIME_FORMAT constant to format the \DateTime object as a string.

.. include:: /include/include-links-dev.rst
   :start-after: begin