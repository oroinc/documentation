:title: Understanding OroCommerce and OroCRM Release Process

.. meta::
   :description: Insights into the Oro application release process, versioning strategy, and upgrade recommendations

.. _doc--community--release:

Understand Release Process
==========================

Versions
--------

Oro applications use MAJOR.MINOR.PATCH version numbering scheme:

- **Major** version releases are reserved for significant backward incompatible architecture and technology changes, e.g. a switch to a new version of Symfony.
- **Minor** version releases may introduce new features and provide a clear migration path in case of relatively small backward incompatible changes.
- **Patch** version releases are mainly used for bug fixes, security patches and minor improvements and usually do not contain any backward incompatible changes.

Developer preview versions may have additional suffixes to denote the expected amount of changes on the code interfaces level (e.g. Alpha, Beta, RC preview releases).

Release Schedule
----------------

Oro Team works on OroCommerce and OroCRM using a time-based schedule, with a new minor or major version coming out every 2 months.

OroCommerce and OroCRM Enterprise Edition Releases and Support Cycle
---------------------------------------------------------------------

- **Preview** major or minor versions are released every 2 months. These versions contain new features, capabilities and technology updates that might not be complete yet, but can be used for early compatibility testing by extension developers and system integrators in anticipation of the upcoming LTS version release.
- **Long-term support (LTS)** versions are released once a year. These versions contain all completed features that were introduced in preview releases since the previous LTS version and are recommended for general use.

.. note::

   **Patch** versions may be released as often as every week for all currently maintained/supported LTS versions of OroCommerce and OroCRM Enterprise Edition.

The key difference between preview and LTS versions is the duration of the maintenance (bugfix) period. LTS versions are also supported for security fixes.

- **Preview** versions are not maintained, unless announced otherwise. There are no patch releases for preview versions, and any completed fixes are accumulated until the publication of the next preview or LTS release.
- **LTS** versions of OroCommerce and OroCRM Enterprise Edition are actively maintained for 18 months after the release, and security fixes are released for 18 more months.

Below is the approximate schedule of the currently maintained/supported and planned upcoming releases and support timelines of OroCommerce and OroCRM Enterprise Edition until 2025. Please take into account that numbering of major and minor versions is subject to change.

+--------------------------------+-------------------+-------------------------+-----------------------+
| OroCommerce Enterprise Edition | Release Date      | Active Maintenance ends | Security Support ends |
+================================+===================+=========================+=======================+
| *1.3* (LTS)                    | *July 2017*       | *January 2019*          | *June 2020*           |
+--------------------------------+-------------------+-------------------------+-----------------------+
| *1.6* (LTS)                    | *January 2018*    | *June 2019*             | *January 2021*        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **3.1** (LTS)                  | **January 2019**  | **June 2020**           | **January 2022**      |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **4.1** (LTS)                  | **January 2020**  | **June 2021**           | **January 2023**      |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **4.2** (LTS)                  | **January 2021**  | **June 2022**           | **January 2024**      |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Alpha1                     | March 2021        | March 2021              | March 2021            |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Alpha2                     | May 2021          | May 2021                | May 2021              |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Beta1                      | July 2021         | July 2021               | July 2021             |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Beta2                      | September 2021    | September 2021          | September 2021        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 RC                         | November 2021     | November 2021           | November 2021         |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **5.0** (LTS)                  | **January 2022**  | **June 2023**           | **January 2025**      |
+--------------------------------+-------------------+-------------------------+-----------------------+

+--------------------------------+-------------------+-------------------------+-----------------------+
| OroCRM Enterprise Edition      | Release Date      | Active Maintenance ends | Security Support ends |
+================================+===================+=========================+=======================+
| *1.12 EE*                      | *August 2016*     | *June 2018*             | *January 2020*        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| *2.0* (LTS)                    | *January 2017*    | *June 2018*             | *January 2020*        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| *2.3* (LTS)                    | *July 2017*       | *January 2019*          | *June 2020*           |
+--------------------------------+-------------------+-------------------------+-----------------------+
| *2.6* (LTS)                    | *January 2018*    | *June 2019*             | *January 2021*        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **3.1** (LTS)                  | **January 2019**  | **June 2020**           | **January 2022**      |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **4.1** (LTS)                  | **January 2020**  | **June 2021**           | **January 2023**      |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Alpha1                     | March 2021        | March 2021              | March 2021            |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Alpha2                     | May 2021          | May 2021                | May 2021              |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Beta1                      | July 2021         | July 2021               | July 2021             |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 Beta2                      | September 2021    | September 2021          | September 2021        |
+--------------------------------+-------------------+-------------------------+-----------------------+
| 5.0 RC                         | November 2021     | November 2021           | November 2021         |
+--------------------------------+-------------------+-------------------------+-----------------------+
| **5.0** (LTS)                  | **January 2022**  | **June 2023**           | **January 2025**      |
+--------------------------------+-------------------+-------------------------+-----------------------+

Upgrade Recommendations
-----------------------

OroCommerce and OroCRM Enterprise Edition release cycle offers two primary upgrade models:

- **(Recommended) Long Term Stability** – Upgrade from an LTS version to the next LTS version to take your time to adopt new features. Choose this model to receive continued support without necessity to upgrade frequently.
- **Bleeding Edge** – Immediately utilize and benefit from new features as soon as they are introduced by always upgrading to the newest preview version every 2 months. Choose this model if you are an enterprise partner or an extension developer and you want to ensure that your extensions and customizations are tested in combination with all new features before the next LTS release.

If you are planning to start a new project this year which is scheduled to go live after January 2022, we recommend to start the development on the most recent release in 5.0 series. You might need to continually upgrade to the next available 5.0 Alpha, Beta and RC versions and ultimately upgrade to 5.0 LTS version prior to going live with the project.

OroCommerce and OroCRM Community Edition Releases
-------------------------------------------------

Oro Team produces patch releases for an **LTS** version of OroCommerce and OroCRM Community Edition only until the next LTS version is released.

Community developers and users have access to the following two product branches:

- **Stable** – |4.2 branch| points to the latest LTS version. Use this branch for testing and deployment. To benefit from the latest features, fixes, and security updates, upgrade to the next patch release tag or LTS release tag as soon as they are available.
- **Development** – |5.0 branch| points to the latest available commit and is updated daily. This branch should be used **only by the developers and contributors** who actively follow the project progress on GitHub. This branch is not considered stable and it is not recommended for production use.

+-------------------------------+-------------------+--------------------------------+
| Application Community Edition | Release Date      | Patch Releases Available Until |
+===============================+===================+================================+
| *2.6* (LTS)                   | *January 2018*    | *January 2019*                 |
+-------------------------------+-------------------+--------------------------------+
| *3.1* (LTS)                   | *January 2019*    | *January 2020*                 |
+-------------------------------+-------------------+--------------------------------+
| *4.1* (LTS)                   | *January 2020*    | *January 2021*                 |
+-------------------------------+-------------------+--------------------------------+
| **4.2** (LTS)                 | **January 2021**  | **January 2022**               |
+-------------------------------+-------------------+--------------------------------+
| 5.0 Alpha1                    | March 2021        | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 5.0 Alpha1                    | May 2021          | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 5.0 Beta1                     | July 2021         | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 5.0 Beta2                     | September 2021    | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| 5.0 RC                        | November 2021     | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| **5.0** (LTS)                 | **January 2022**  | **January 2023**               |
+-------------------------------+-------------------+--------------------------------+


.. include:: /include/include-links-dev.rst
   :start-after: begin
