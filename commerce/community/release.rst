Release Process
===============

Oro Product Versions
--------------------

Oro products follow `Semantic Versioning`_ strategy (MAJOR.MINOR.PATCH) with a few additions:

- **Major** version releases are reserved for backward incompatible architecture and technology changes, e.g. introduction of application namespaces, or a switch to a new version of Symfony
- **Minor** releases include new features and a clear migration path in case of small backward incompatible updates
- **Patch** version releases are used for bug fixes and minor improvements


Release and Support Cycle
-------------------------

Oro Team works on multiple products and releases them on time-based schedule, with new minor or major versions coming out roughly every 2 months.

- **Regular** major or minor versions are released roughly every 2 months. These versions contain new features and capabilities that might not be complete yet, but still offer value to the users
- **Long-term support (LTS)** versions are released roughly every 6 months. These versions contain all completed features that were introduced in two previous regular versions

.. note::

   **Patch** versions are released roughly once in 2 weeks for all currently maintained regular and maintained/supported LTS versions.


The key difference between a regular and a LTS version is the duration of the maintenance (bugfix) period. LTS versions are also supported for security fixes.

- **Regular** versions are maintained for the next two release cycles, or roughly 4 months.
- **LTS** versions are maintained for 18 months after the release, and security fixes are released for 18 more months.

Below is the approximate schedule of Oro product releases and support timelines until 2019. Please take into account that numbering of major and minor versions is based on OroPlatform versions and is subject to change.

.. image:: /user_guide/img/OroCommerceReleaseScheduleDark.png

+------------------+--------------------+---------------------+-------------------+
| Version          | Release Planned in | Maintenance Ends in | Support Ends in   |
+==================+====================+=====================+===================+
|                  | **August 2016**    | **June 2018**       | **January 2020**  |
+------------------+--------------------+---------------------+-------------------+
| **1.0**          | **January 2017**   | **June 2018**       | **January 2020**  |
+------------------+--------------------+---------------------+-------------------+
| 1.1              | March 2017         | June 2017           | June 2017         |
+------------------+--------------------+---------------------+-------------------+
| 1.2              | May 2017           | August 2017         | August 2017       |
+------------------+--------------------+---------------------+-------------------+
| **1.3**          | **July 2017**      | **January 2019**    | **June 2020**     |
+------------------+--------------------+---------------------+-------------------+
| 1.4              | September 2017     | December 2017       | December 2017     |
+------------------+--------------------+---------------------+-------------------+
| 1.5              | November 2017      | February 2018       | February 2018     |
+------------------+--------------------+---------------------+-------------------+
| **1.6**          | **January 2018**   | **June 2019**       | **January 2021**  |
+------------------+--------------------+---------------------+-------------------+
| 2.0              | March 2018         | June 2018           | June 2018         |
+------------------+--------------------+---------------------+-------------------+
| 2.1              | May 2018           | August 2018         | August 2018       |
+------------------+--------------------+---------------------+-------------------+
| **2.2**          | **July 2018**      | **January 2020**    | **June 2021**     |
+------------------+--------------------+---------------------+-------------------+
| 2.3              | September 2018     | December 2018       | December 2018     |
+------------------+--------------------+---------------------+-------------------+
| 2.4              | November 2018      | February 2019       | February 2019     |
+------------------+--------------------+---------------------+-------------------+
| **2.5**          | **January 2019**   | **June 2020**       | **January 2022**  |
+------------------+--------------------+---------------------+-------------------+
| 2.6              | March 2019         | June 2019           | June 2019         |
+------------------+--------------------+---------------------+-------------------+

Upgrade Recommendations
-----------------------

Our release cycle offers two primary upgrade models:

- **"Bleeding Edge"** – always upgrade to the newest regular or LTS version to immediately utilize and benefit from new features. Choose this model if you mostly use the application without customizations and are OK with frequent updates.
- **"Stability"** – upgrade from one LTS version to the next one to take your time to adopt new features. Choose this model if version upgrade is complicated for you because of the sheer size of your business or due to rich customizations of the system.

.. _Semantic Versioning:    http://semver.org/
