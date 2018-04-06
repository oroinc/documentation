Release Process
===============

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

Oro Product Versions
--------------------

Oro products are following `Semantic Versioning`_ strategy (MAJOR.MINOR.PATCH) with a few additions:

- **Major** version releases are reserved for backward incompatible architecture and technology changes, e.g. introduction of application namespaces, or switch to new version of Symfony
- **Minor** releases include new features and clear migration path in case of small backward incompatible updates
- **Patch** version releases are used for bug fixes and minor improvements

Release and Support Cycle
-------------------------

Oro Team works on OroCRM using a time-based schedule, with new minor or major version coming out every 2 months.

* **Regular** major or minor versions are released every 2 months. These versions contain new features and capabilities that might not be complete yet, but still offer value to the users.
* **Long-term support (LTS)** versions are released roughly every 6 months. These versions contain all completed features that were introduced in regular releases since the previous LTS version.

.. note::

    **Patch** versions may be released as often as every week for all currently maintained regular and maintained/supported LTS versions.

The key difference between a regular and a LTS version is the duration of the maintenance (bugfix) period. LTS versions are also supported for security fixes.

* **Regular** versions are maintained for the next two release cycles, or 4 months.
* **LTS** versions are maintained for 18 months after the release, and security fixes are released for 18 more months.

Below is the approximate schedule of Oro product releases and support timelines. Please take into account that numbering of major and minor versions is subject to change.

 .. image:: img/OroCRM_release_schedule_3.0.png

 +---------------+-------------------+-------------------+-------------------+
 | Version       | Release           | Maintenance ends  | Support ends      |
 +===============+===================+===================+===================+
 | **1.12 EE**   | **August 2016**   | **June 2018**     | **January 2020**  |
 +---------------+-------------------+-------------------+-------------------+
 | **2.0** (LTS) | **January 2017**  | **June 2018**     | **January 2020**  |
 +---------------+-------------------+-------------------+-------------------+
 | 2.1           | March 2017        | June 2017         | June 2017         |
 +---------------+-------------------+-------------------+-------------------+
 | 2.2           | May 2017          | August 2017       | August 2017       |
 +---------------+-------------------+-------------------+-------------------+
 | **2.3** (LTS) | **July 2017**     | **January 2019**  | **June 2020**     |
 +---------------+-------------------+-------------------+-------------------+
 | 2.4           | September 2017    | December 2017     | December 2017     |
 +---------------+-------------------+-------------------+-------------------+
 | 2.5           | November 2017     | February 2018     | February 2018     |
 +---------------+-------------------+-------------------+-------------------+
 | **2.6** (LTS) | **January 2018**  | **June 2019**     | **January 2021**  |
 +---------------+-------------------+-------------------+-------------------+
 | 3.0 Beta      | March 2018        | March 2018        | March 2018        |
 +---------------+-------------------+-------------------+-------------------+
 | 3.0 RC        | May 2018          | May 2018          | May 2018          |
 +---------------+-------------------+-------------------+-------------------+
 | **3.0** (LTS) | **July 2018**     | **January 2020**  | **June 2021**     |
 +---------------+-------------------+-------------------+-------------------+
 | 3.1           | September 2018    | December 2018     | December 2018     |
 +---------------+-------------------+-------------------+-------------------+
 | 3.2           | November 2018     | February 2019     | February 2019     |
 +---------------+-------------------+-------------------+-------------------+
 | **3.3** (LTS) | **January 2019**  | **June 2020**     | **January 2022**  |
 +---------------+-------------------+-------------------+-------------------+
 | 3.4           | March 2019        | June 2018         | June 2018         |
 +---------------+-------------------+-------------------+-------------------+

Upgrade Recommendations
-----------------------

Our release cycle offers two primary upgrade models:

* **“Bleeding Edge”** – always upgrade to the newest regular or LTS version to immediately utilize and benefit from new features. Choose this model if you mostly use the application without customizations and are OK with frequent updates.

* **“Stability”** – upgrade from LTS to LTS version to take your time to adopt new features. Choose this model if version upgrade is complicated to you because of the sheer size of your business or due to rich customizations of the system.


.. _Semantic Versioning:    http://semver.org/
