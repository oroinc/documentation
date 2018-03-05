.. _doc--community--release:

Understand Release Process
==========================

.. contents:: :local:
   :depth: 1

OroCRM Versions
---------------

OroCRM follows `Semantic Versioning`_ strategy (MAJOR.MINOR.PATCH) with a few additions:

- **Major** version releases are reserved for backward incompatible architecture and technology changes, e.g. introduction of application namespaces, or a switch to a new version of Symfony.
- **Minor** version releases may introduce new features and provide a clear migration path in case of small backward incompatible changes.
- **Patch** version releases are mainly used for bug fixes and minor improvements and usually do not contain any backward incompatible changes.


Release Schedule
----------------

Oro Team works on OroCRM using a time-based schedule, with new minor or major version coming out every 2 months.

OroCRM Enterprise Edition Releases and Support Cycle
----------------------------------------------------

- **Regular** major or minor versions are released every 2 months. These versions contain new features and capabilities that might not be complete yet, but still offer value to the users.
- **Long-term support (LTS)** versions are released roughly every 6 months. These versions contain all completed features that were introduced in regular releases since the previous LTS version.

.. note::

   **Patch** versions may be released as often as every week for all currently maintained regular and maintained/supported LTS versions.


The key difference between a regular and a LTS version is the duration of the maintenance (bugfix) period. LTS versions are also supported for security fixes.

- **Regular** versions are maintained for the next two release cycles, or 4 months.
- **LTS** versions are maintained for 18 months after the release, and security fixes are released for 18 more months.

Below is the approximate schedule of OroCRM releases and support timelines until 2019. Please take into account that numbering of major and minor versions is subject to change.

.. image:: /community/img/release_process/OroCRM_release_schedule.png

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
| 2.7           | March 2018        | June 2018         | June 2018         |
+---------------+-------------------+-------------------+-------------------+
| 2.8           | May 2018          | August 2018       | August 2018       |
+---------------+-------------------+-------------------+-------------------+
| **3.0** (LTS) | **July 2018**     | **January 2020**  | **June 2021**     |
+---------------+-------------------+-------------------+-------------------+
| 3.1           | September 2018    | December 2018     | December 2018     |
+---------------+-------------------+-------------------+-------------------+
| 3.2           | November 2018     | February 2019     | February 2019     |
+---------------+-------------------+-------------------+-------------------+
| **3.3** (LTS) | **January 2019**  | **June 2020**     | **January 2022**  |
+---------------+-------------------+-------------------+-------------------+
| 3.4           | March 2019        | June 2019         | June 2019         |
+---------------+-------------------+-------------------+-------------------+


Upgrade Recommendations
-----------------------

OroCRM Enterprise Edition release cycle offers two primary upgrade models:

- **(Recommended) Long Term Stability** – Upgrade from an LTS version to the next LTS version to take your time to adopt new features. Choose this model to receive continued support without necessity to upgrade frequently, especially if the version upgrade is complicated for you because of the sheer size of your business or due to rich customizations of the system.
- **Bleeding Edge** – Immediately utilize and benefit from new features as soon as they are introduced by always upgrading to the newest version every 2 months. Choose this model if you mostly use the application without customizations and are OK with frequent updates. If you are an enterprise partner or an extension developer, choose this model to ensure that your extensions and customizations are tested in combination with all new features before the next LTS release.


Community Edition Releases
--------------------------

Community developers and users have access to the following two product branches:

- **Stable** – The `stable <https://github.com/oroinc/crm/tree/stable>`_ branch always points to the latest regular or LTS version. Use this branch for testing and deployment. To benefit from the latest features, fixes, and security updates, upgrade to the next stable release tag every 2 months or more frequently.
- **Development** – The `development <https://github.com/oroinc/crm/tree/development>`_ branch points to the latest available commit and is updated daily. This branch should be used **only by the developers and contributors** who actively follow the project progress on GitHub. This branch is not considered ready for production use.


.. _Semantic Versioning:    http://semver.org/
