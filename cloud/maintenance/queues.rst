.. _orocloud-queues:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

How to Work with Queues
=======================

Queues
------

List
^^^^

To view the vhosts and queues, use the `orocloud-cli queue:list` command.

.. code-block:: none

    $ orocloud-cli queue:list

    +-------+-----------------+----------+-----------+----------+
    | Vhost | Queue           | Messages | Consumers | Memory   |
    +-------+-----------------+----------+-----------+----------+
    | oro   | oro.default     | 0        | 1         | 0.03 MiB |
    | oro   | oro.index       | 0        | 1         | 0.04 MiB |
    | oro   | oro.integration | 0        | 1         | 0.03 MiB |
    | oro   | oro.system      | 0        | 1         | 0.04 MiB |
    | oro   | oro.unprocessed | 0        | 0         | 0.03 MiB |
    +-------+-----------------+----------+-----------+----------+

List Messages
^^^^^^^^^^^^^

To view the queue messages, use the `orocloud-cli queue:messages` command.

.. code-block:: none

    $ orocloud-cli queue:message oro.index

    +------------------------------------+-----------------------------+
    | Routing key                        | Message Id                  |
    +------------------------------------+-----------------------------+
    | oro.search.reindex                 | oro.66bf2d5e53bf29.67150857 |
    | oro.website.search.indexer.reindex | oro.66bf2d61c56634.74060103 |
    +------------------------------------+-----------------------------+

To view the messages payloads, use the `orocloud-cli queue:messages --payload` command.

.. code-block:: none

    $ orocloud-cli queue:message --payload oro.index

    +------------------------------------+-----------------------------+---------+
    | Routing key                        | Message Id                  | Payload |
    +------------------------------------+-----------------------------+---------+
    | oro.search.reindex                 | oro.66bf342e848a91.69847603 | []      |
    | oro.website.search.indexer.reindex | oro.66bf3431c2c699.28695682 |         |
    +------------------------------------+-----------------------------+---------+

Purge
^^^^^

To purge messages from a queue, use the `orocloud-cli queue:purge` command.

.. code-block:: none

    $ orocloud-cli queue:purge oro.index

    All you have to do is confirm the action [No]:
    [y] Yes
    [n] No
    > y

    | Processing... (2 secs, 14.0 MiB)

    2/2 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100% < 1 sec/< 1 sec 14.0 MiB

    [OK] Queue purged.

Reroute
^^^^^^^

To reroute messages from a queue to the `oro.default` exchange, use the `orocloud-cli queue:reroute` command.

.. code-block:: none

    $ orocloud-cli queue:reroute oro.index

    All you have to do is confirm the action [Yes]:
    [y] Yes
    [n] No
    > y

    2/2 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100% < 1 sec/< 1 sec 14.0 MiB

    [OK] Messages were rerouted.

To reroute some messages from a queue to the `oro.default` exchange, use the `orocloud-cli queue:reroute --filter={{match}}` command.

.. code-block:: none

    $ orocloud-cli queue:reroute oro.index --filter=website

    All you have to do is confirm the action [Yes]:
    [y] Yes
    [n] No
    > y

    2/2 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100% < 1 sec/< 1 sec 14.0 MiB

    [OK] Messages were rerouted.

.. note:: Rerouting `oro.unprocessed` using the `--filter` option will send all messages to the exchange, however, only matching messages will go to the target queue, other messages will get back to `oro.unprocessed`.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
