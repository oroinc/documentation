Troubleshooting
===============


**Exception `No alive nodes found in your cluster` during the installation or indexation**

Check if Elasticsearch instance is turned on and accessible. The easiest way to do that is to try connecting to the Elasticsearch host and port using the `curl` utility.

An example of an invalid response when the Elastic search is not available:

.. code-block:: none

   > curl localhost:9200
   curl: (7) couldn't connect to host


To fix this issue, please, turn on Elasticsearch and make sure that it is available, e.g., the host is resolved to an appropriate IP address and the port is open.

An example of a valid response when the Elastic search is available:

.. code-block:: none

    > curl localhost:9200
    {
      "name" : "rIQCO_H",
      "cluster_name" : "elasticsearch",
      "cluster_uuid" : "0Xma--_eREmnX6zd5KCEAQ",
      "version" : {
        "number" : "6.2.2",
        "build_hash" : "10b1edd",
        "build_date" : "2018-02-16T19:01:30.685723Z",
        "build_snapshot" : false,
        "lucene_version" : "7.2.1",
        "minimum_wire_compatibility_version" : "5.6.0",
        "minimum_index_compatibility_version" : "5.0.0"
      },
      "tagline" : "You Know, for Search"
    }

