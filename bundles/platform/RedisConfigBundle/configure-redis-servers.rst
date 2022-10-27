.. _bundle-docs-platform-redis-bundle--configure-servers:

Configure Redis Servers
=======================

Oro architecture requires a least two instances of Redis server. The first instance will be used as fast persistent
storage for sessions and the second one as LRU Cache storage.

Ubuntu Xenial or later
----------------------

Install redis-server via apt

.. code-block:: bash

    sudo apt install redis-server

Configure Second Instance as LRU Memory Cache
---------------------------------------------

Create folders for the **redis-cache** server

.. code-block:: bash

    sudo mkdir -p /var/lib/redis-cache /var/log/redis-cache /var/run/redis-cache
    sudo chown redis:redis /var/lib/redis-cache /var/log/redis-cache /var/run/redis-cache

Create tmpfiles config

.. code-block:: bash

    echo "d /run/redis-cache 2775 redis redis -" | sudo tee /usr/lib/tmpfiles.d/redis-cache-server.conf

Copy original configs for the second server

.. code-block:: bash

    sudo cp -rp /etc/redis /etc/redis-cache

Replace all content in `/etc/redis-cache/redis.conf` with:

.. code-block:: ini

    daemonize yes
    pidfile /var/run/redis-cache/redis-server.pid
    port 6380
    tcp-backlog 511
    bind 127.0.0.1
    timeout 0
    tcp-keepalive 0
    loglevel notice
    logfile /var/log/redis-cache/redis-server.log
    databases 16
    maxmemory 256mb
    maxmemory-policy allkeys-lru
    stop-writes-on-bgsave-error no
    rdbcompression yes
    rdbchecksum yes
    dbfilename dump.rdb
    dir /var/lib/redis-cache
    slave-serve-stale-data yes
    slave-read-only yes
    repl-diskless-sync no
    repl-diskless-sync-delay 5
    repl-disable-tcp-nodelay no
    slave-priority 100
    appendonly no
    appendfilename "appendonly.aof"
    appendfsync everysec
    no-appendfsync-on-rewrite no
    auto-aof-rewrite-percentage 100
    auto-aof-rewrite-min-size 64mb
    aof-load-truncated yes
    lua-time-limit 5000
    slowlog-log-slower-than 10000
    slowlog-max-len 128
    latency-monitor-threshold 0
    notify-keyspace-events ""
    hash-max-ziplist-entries 512
    hash-max-ziplist-value 64
    list-max-ziplist-entries 512
    list-max-ziplist-value 64
    set-max-intset-entries 512
    zset-max-ziplist-entries 128
    zset-max-ziplist-value 64
    hll-sparse-max-bytes 3000
    activerehashing yes
    client-output-buffer-limit normal 0 0 0
    client-output-buffer-limit slave 256mb 64mb 60
    client-output-buffer-limit pubsub 32mb 8mb 60
    hz 10
    aof-rewrite-incremental-fsync yes

Create systemd unit `/lib/systemd/system/redis-cache-server.service` for **redis-cache** with the following contents:

.. code-block:: ini

    [Unit]
    Description=Redis-Cache
    After=network.target

    [Service]
    Type=forking
    ExecStart=/usr/bin/redis-server /etc/redis-cache/redis.conf
    PIDFile=/var/run/redis-cache/redis-server.pid
    TimeoutStopSec=0
    Restart=always
    User=redis
    Group=redis

    ExecStartPre=-/bin/run-parts --verbose /etc/redis-cache/redis-server.pre-up.d
    ExecStartPost=-/bin/run-parts --verbose /etc/redis-cache/redis-server.post-up.d
    ExecStop=-/bin/run-parts --verbose /etc/redis-cache/redis-server.pre-down.d
    ExecStop=/bin/kill -s TERM $MAINPID
    ExecStopPost=-/bin/run-parts --verbose /etc/redis-cache/redis-server.post-down.d

    PrivateTmp=yes
    PrivateDevices=yes
    ProtectHome=yes
    ReadOnlyDirectories=/
    ReadWriteDirectories=-/var/lib/redis-cache
    ReadWriteDirectories=-/var/log/redis-cache
    ReadWriteDirectories=-/var/run/redis-cache
    CapabilityBoundingSet=~CAP_SYS_PTRACE

    ProtectSystem=true
    ReadWriteDirectories=-/etc/redis-cache

    [Install]
    WantedBy=multi-user.target
    Alias=redis-cache.service

Enable and start systemd unit

.. code-block:: bash

    systemctl enable redis-cache-server.service
    systemctl start redis-cache

Verify the status of the new service

.. code-block:: bash

    systemctl status redis-cache


See :ref:`Configure Application to Use Redis <bundle-docs-platform-redis-bundle--configuration>` for details on how to
configure the application to use Redis.


.. include:: /include/include-links-dev.rst
   :start-after: begin
