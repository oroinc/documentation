.. _web-services-api--error-messages:

Error Messages
==============

Similar to an HTML error page that shows a useful error message to a visitor, the API displays an error message in
a consumable format. Representation of an error looks the same as the representation of any resource, only
with its own set of fields.


.. code-block:: json
    :linenos:

    {
      "errors": [
        {
          "status": "404",
          "title": "not found http exception",
          "detail": "An entity with the requested identifier does not exist."
        }
      ]
    }

