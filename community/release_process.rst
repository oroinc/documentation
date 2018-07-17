.. _doc--community--release:

Understand Release Process
==========================

.. contents:: :local:
    :depth: 1

OroCRM Versions
--------------------

OroCRM follows `Semantic Versioning`_ strategy (MAJOR.MINOR.PATCH) with a few additions:

- **Major** version releases are reserved for backward incompatible architecture and technology changes, e.g. introduction of application namespaces, or a switch to a new version of Symfony.
- **Minor** version releases may introduce new features and provide a clear migration path in case of small backward incompatible changes.
- **Patch** version releases are mainly used for bug fixes and minor improvements and usually do not contain any backward incompatible changes.


Release Schedule
----------------

Oro Team works on OroCRM using a time-based schedule, with a new minor or major version coming out every 2 months.

OroCRM Enterprise Edition Releases and Support Cycle
---------------------------------------------------------

- **Preview** major or minor versions are released every 2 months. These versions contain new features and capabilities that might not be complete yet, but still offer value to the users.
- **Long-term support (LTS)** versions are released roughly two times a year. These versions contain all completed features that were introduced in preview releases since the previous LTS version.

.. note::

   **Patch** versions may be released as often as every week for all currently maintained/supported LTS versions of OroCRM Enterprise Edition.


The key difference between preview and LTS versions is the duration of the maintenance (bugfix) period. LTS versions are also supported for security fixes.

- **Preview** versions are not maintained, unless announced otherwise.
- **LTS** versions of OroCRM Enterprise Edition are maintained for 18 months after the release, and security fixes are released for 18 more months.

Below is the approximate schedule of the currently maintained/supported and planned upcoming releases and support timelines of OroCRM Enterprise Edition until 2019. Please take into account that numbering of major and minor versions is subject to change.

.. .. image:: /community/img/release_process/OroCRM_release_schedule.png

+--------------------------------+-------------------+-------------------+-------------------+
| OroCRM Enterprise Edition      | Release           | Maintenance ends  | Support ends      |
+================================+===================+===================+===================+
| **1.12 EE**                    | **August 2016**   | **June 2018**     | **January 2020**  |
+--------------------------------+-------------------+-------------------+-------------------+
| **2.0** (LTS)                  | **January 2017**  | **June 2018**     | **January 2020**  |
+--------------------------------+-------------------+-------------------+-------------------+
| **2.3** (LTS)                  | **July 2017**     | **January 2019**  | **June 2020**     |
+--------------------------------+-------------------+-------------------+-------------------+
| **2.6** (LTS)                  | **January 2018**  | **June 2019**     | **January 2021**  |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.0 Beta                       | March 2018        | March 2018        | March 2018        |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.0 RC                         | May 2018          | May 2018          | May 2018          |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.0                            | July 2018         | July 2018         | July 2018         |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.1 Beta                       | September 2018    | September 2018    | September 2018    |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.1 RC                         | November 2018     | November 2019     | November 2019     |
+--------------------------------+-------------------+-------------------+-------------------+
| **3.1** (LTS)                  | **January 2019**  | **June 2020**     | **January 2022**  |
+--------------------------------+-------------------+-------------------+-------------------+
| 3.2 Beta                       | March 2019        | March 2019        | March 2019        |
+--------------------------------+-------------------+-------------------+-------------------+


Upgrade Recommendations
-----------------------

OroCRM Enterprise Edition release cycle offers two primary upgrade models:

- **(Recommended) Long Term Stability** – Upgrade from an LTS version to the next LTS version to take your time to adopt new features. Choose this model to receive continued support without necessity to upgrade frequently.
- **Bleeding Edge** – Immediately utilize and benefit from new features as soon as they are introduced by always upgrading to the newest preview version every 2 months. Choose this model if you are an enterprise partner or an extension developer and you want to ensure that your extensions and customizations are tested in combination with all new features before the next LTS release.


OroCRM Community Edition Releases
--------------------------------------

Oro Team produces patch releases for an **LTS** version of OroCRM Community Edition only until the next LTS version is released.

Community developers and users have access to the following two product branches:

- **Stable** – The `stable <https://github.com/oroinc/crm-application/tree/stable>`_ branch always points to the latest LTS version. Use this branch for testing and deployment. To benefit from the latest features, fixes, and security updates, upgrade to the next patch release tag or LTS release tag as soon as they are available in this branch.
- **Master** – The `master <https://github.com/oroinc/crm-application/tree/master>`_ branch points to the latest available commit and is updated daily. This branch should be used **only by the developers and contributors** who actively follow the project progress on GitHub. This branch is not considered stable and it is not recommended for production use.

+-------------------------------+-------------------+--------------------------------+
| OroCRM Community Edition      | Release           | Patch Releases Available Until |
+===============================+===================+================================+
| **2.6** (LTS)                 | **January 2018**  | **January 2019**               |
+-------------------------------+-------------------+--------------------------------+
| 3.0 Beta                      | March 2018        | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 3.0 RC                        | May 2018          | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 3.0                           | July 2018         | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 3.1 Beta                      | September 2018    | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 3.1 RC                        | November 2018     | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| **3.1** (LTS)                 | **January 2019**  | **July 2019**                  |
+-------------------------------+-------------------+--------------------------------+
| 3.2 Beta                      | March 2019        | N/A                            |
+-------------------------------+-------------------+--------------------------------+


.. _Semantic Versioning:    http://semver.org/
