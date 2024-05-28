:title: Understanding OroCommerce Release Process

.. meta::
   :description: Insights into the OroCommerce release process, versioning strategy, and upgrade recommendations

.. _doc--community--release:

Understand Release Process
==========================

OroCommerce Enterprise Edition Releases and Support Cycle
---------------------------------------------------------

- **Long-term support (LTS)** versions are released once a year. These versions contain all features that were introduced in preview and patch releases since the previous LTS version and are recommended for general use.
- **Preview** versions are released a few months in advance of the planned LTS release. These versions contain new features, capabilities and technology updates that might not be complete yet, but can be used for early compatibility testing by extension developers and system integrators in anticipation of the upcoming LTS version release. Preview versions are not maintained, there are no patch releases for preview versions, and any completed fixes are accumulated until the publication of the next preview or LTS release.
- **Patch** version releases are mainly used for bug fixes, security patches and minor improvements. **Patch** versions may be released as often as every few weeks for all currently maintained/supported LTS versions of OroCommerce Enterprise Edition.

Version Numbering
-----------------

OroCommerce uses MAJOR.MINOR.PATCH version numbering scheme:

- **Major** version releases are reserved for significant backward incompatible architecture and technology changes, e.g. a switch to a new version of Symfony framework.
- **Minor** version releases introduce new features and provide a clear migration path in case of relatively small backward incompatible architectural and technology changes.
- **Patch** version releases usually do not contain any backward incompatible changes, unless noted otherwise in the release notes.

Developer preview versions may have additional suffixes to denote the expected amount of upcoming changes on the code interfaces level (e.g., Beta and RC preview releases).

Release Schedule
----------------

Oro Team works on OroCommerce using a time-based schedule, with an LTS version coming out every year in March and multiple preview and patch versions published between LTS releases.

.. note::

   **LTS** versions of OroCommerce Enterprise Edition are supported for 36 months from the date of the release. Oro’s Extended Coverage is a service that prolongs the life of an OroCommerce LTS version by 24 months up to a total of 5 years. This offering will lengthen the service period of all critical product patches and security fixes for their respective LTS version. If you are an existing OroCommerce customer, contact your Customer Success Manager to learn more.

Below is the approximate schedule of the currently maintained/supported and planned upcoming releases and support timelines of OroCommerce Enterprise Edition. Please take into account that the numbering of planned major and minor versions is subject to change.

+--------------------------------+-------------------+-----------------------+
| OroCommerce Enterprise Edition | Release Date      | Support ends          |
+================================+===================+=======================+
| **4.1 LTS**                    | *January 2020*    | *January 2023*        |
+--------------------------------+-------------------+-----------------------+
| **4.2 LTS**                    | **January 2021**  | **January 2024**      |
+--------------------------------+-------------------+-----------------------+
| **5.0 LTS**                    | **January 2022**  | **January 2025**      |
+--------------------------------+-------------------+-----------------------+
| **5.1 LTS**                    | **March 2023**    | **March 2026**        |
+--------------------------------+-------------------+-----------------------+
| **6.0 LTS**                    | **March 2024**    | **March 2027**        |
+--------------------------------+-------------------+-----------------------+
| 6.1 RC                         | January 2025      | N/A                   |
+--------------------------------+-------------------+-----------------------+
| **6.1 LTS**                    | **March 2025**    | **March 2028**        |
+--------------------------------+-------------------+-----------------------+

Upgrade Recommendations
-----------------------

For long-term stability, we recommend upgrading from an LTS version to the next LTS version to take your time to adopt new features. Apply patch releases that become available for your LTS version to stay current and receive continued support without needing to upgrade frequently.

Upgrade to the newest preview version once it is available only if you are an enterprise partner or an extension developer and want to ensure that your extensions and customizations are tested in combination with the new features before the next LTS release.

If you are planning to start a new project **in 2025** and it is scheduled to **go live after March 2025**, we recommend starting the development on the most recent available release in the 6.1 series to immediately utilize and benefit from new features as soon as they are introduced. You will need to ultimately **upgrade to the 6.1 LTS version before going live** with the project.

OroCommerce Community Edition Releases
--------------------------------------

Oro Team produces patch releases for an **LTS** version of OroCommerce Community Edition only until the next LTS version is released (typically 12 months).

Community developers and users have access to the following two product branches:

- **Stable** – |6.0 branch| points to the latest LTS version. Use this branch for testing and deployment. To benefit from the latest features, fixes, and security updates, upgrade to the next patch release tag or LTS release tag as soon as they are available.
- **Development** – |6.1 branch| points to the latest published commit and is updated frequently. This branch should be used **only by the developers and contributors** who actively follow the project progress on GitHub. This branch is not considered stable and is not recommended for production use.

+-------------------------------+-------------------+--------------------------------+
| OroCommerce Community Edition | Release Date      | Patch Releases Available Until |
+===============================+===================+================================+
| **5.0 LTS**                   | **January 2022**  | **March 2023**                 |
+-------------------------------+-------------------+--------------------------------+
| **5.1 LTS**                   | **March 2023**    | **March 2024**                 |
+-------------------------------+-------------------+--------------------------------+
| **6.0 LTS**                   | **March 2024**    | **March 2025**                 |
+-------------------------------+-------------------+--------------------------------+
| 6.1 RC                        | January 2025      | N/A                            |
+-------------------------------+-------------------+--------------------------------+
| **6.0 LTS**                   | **March 2025**    | **March 2026**                 |
+-------------------------------+-------------------+--------------------------------+


.. admonition:: Business Tip

   Want to find out everything about |business-to-business eCommerce| and how it varies from B2C? Check out our in-depth overview of the subject.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
