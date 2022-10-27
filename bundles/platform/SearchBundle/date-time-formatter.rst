.. _bundle-docs-platform-search-bundle-datetime:

DateTimeFormatter
=================

Class |DateTimeFormatter|.

Please use this class if you need format \DateTime object to |string by specific format|.

* format

  .. code-block:: php

     public function format(\DateTime $dateTimeValue)

  Returns formatted string of \DateTime. The class uses DateTimeFormatter::DATETIME_FORMAT constant to format the \DateTime object as a string.

.. include:: /include/include-links-dev.rst
   :start-after: begin