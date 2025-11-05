:title: Understanding OroCommerce Release Process

.. meta::
   :description: Insights into the OroCommerce release process, versioning strategy, and upgrade recommendations

.. _doc--community--release:

Understand Release Process
==========================

OroCommerce Enterprise Edition Releases and Support Cycle
---------------------------------------------------------

- **Long-term support (LTS)** versions are released once a year. These versions contain all features that were introduced in preview and patch releases since the previous LTS version and are recommended for general use.
- **Preview** versions are released a few months in advance of the planned LTS release. These versions contain new features, capabilities and technology updates that may not yet be complete but can be used for early compatibility testing by extension developers and system integrators in anticipation of the upcoming LTS version release. Preview versions are not maintained, there are no patch releases for preview versions, and any completed fixes are accumulated until the publication of the next preview or LTS release.
- **Patch** versions are released as often as every few weeks for all currently maintained and supported LTS versions of OroCommerce Enterprise Edition. These are mainly used for bug fixes, security patches, and minor improvements.

Upgrade Recommendations
-----------------------

For production environments, the most reliable path is to move from one **LTS** version to the next. This ensures long-term stability and gives your team time to adopt new features.

It is recommended that you regularly apply **patch releases** to your active LTS version to stay current and receive continued support without needing to upgrade frequently.

Consider upgrading to the newest **preview versions** only if you are an enterprise partner or an extension developer who needs to validate customizations and extensions, and how they work in combination with the new features ahead of the next LTS release.

.. csv-table::
   :header: "Version Type", "Recommended For", "When to Upgrade"
   :widths: 20, 25, 55

   "**LTS**", "All production users", "Move from one LTS to the next to maintain stability and adopt new features."
   "**Patch Releases**", "All users on an active LTS version", "Apply regularly to stay supported and up-to-date."
   "**Preview Versions**", "Enterprise partners & extension developers", "Use to test extensions and customizations alongside upcoming features."

Version Numbering
-----------------

OroCommerce uses MAJOR.MINOR.PATCH version numbering scheme:

- **Major** version releases are reserved for significant backward incompatible architecture and technology changes, e.g. a switch to a new version of the Symfony framework.
- **Minor** version releases introduce new features and provide a clear migration path in case of relatively small backward incompatible architectural and technology changes.
- **Patch** version releases usually do not contain any backward incompatible changes, unless explicitly stated otherwise in the release notes.

Developer preview versions may have additional suffixes to denote the expected amount of upcoming changes at the code interface level (e.g., Beta and RC preview releases).

Release Schedule
----------------

The Oro team works on OroCommerce using a time-based schedule, with an LTS version coming out every year in March and multiple preview and patch versions published between LTS releases.

.. note::

   **LTS** versions of OroCommerce Enterprise Edition are supported for 48 months from the release date. Oro’s **Extended Coverage** service extends the lifespan of an OroCommerce LTS version by an additional 24 months, allowing for a total support period of up to 6 years. This service lengthens the service period of all critical product patches and security fixes for the respective LTS version. Existing OroCommerce customers should contact their Customer Success Manager for more information.

   For versions released prior to 5.1 LTS, the standard support period is 36 months. **Extended Coverage** may be available for purchase on a case-by-case basis, with the maximum coverage period specified in the table below.

Below is the approximate schedule of the currently maintained/supported and planned upcoming releases and support timelines of OroCommerce Enterprise Edition.

.. csv-table::
   :header: "OroCommerce Enterprise Edition", "Release Date", "Support Ends", "Extended Coverage Up To"
   :widths: 45, 20, 20, 35

   "**4.1 LTS**", "*January 2020*", "*January 2023*", "N/A"
   "**4.2 LTS**", "**January 2021**", "**January 2024**", "December 2026"
   "**5.0 LTS**", "**January 2022**", "**January 2025**", "January 2028"
   "**5.1 LTS**", "**March 2023**", "**March 2027**", "March 2029"
   "**6.0 LTS**", "**March 2024**", "**March 2028**", "March 2030"
   "**6.1 LTS**", "**March 2025**", "**March 2029**", "March 2031"
   "**7.0 LTS**", "**March 2026**", "**March 2030**", "March 2032"


New Projects
------------

If you are planning to start a new project in 2025, we recommend beginning development on the most recent available patch version of the **6.1 LTS** release.

OroCommerce Community Edition Releases
--------------------------------------

The Oro team produces patch releases for each version of OroCommerce Community Edition for 12 months after its release.

Community developers and users have access to the following two product branches:

- **Stable** – |6.1 branch| points to the latest stable release. Use this branch for testing and deployment. To benefit from the latest features, fixes, and security updates, upgrade to the next patch release tag as soon as it becomes available.
- **Development** – |7.0 branch| points to the latest published commit and is updated frequently. This branch should be used **only by the developers and contributors** who actively follow the project progress on GitHub. This branch is not considered stable and is not recommended for production use.

.. csv-table::
   :header: "OroCommerce Community Edition", "Release Date", "Patch Releases Available Until"
   :widths: 50, 35, 45

   "**5.0**", "**January 2022**", "**March 2023**"
   "**5.1**", "**March 2023**", "**March 2024**"
   "**6.0**", "**March 2024**", "**March 2025**"
   "**6.1**", "**March 2025**", "**March 2026**"

.. admonition:: Business Tip

   Want to find out everything about |business-to-business eCommerce| and how it varies from B2C? Check out our in-depth overview of the subject.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
