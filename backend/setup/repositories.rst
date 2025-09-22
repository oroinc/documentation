:title: OroCommerce Source Code and Repositories

.. meta::
   :description: Learn how OroCommerce is structured across public Community Edition and private Enterprise Edition repositories, including applications, packages, and components hosted on GitHub.

Source Code
===========

OroCommerce and related Oro applications are developed and maintained in multiple source code repositories hosted on GitHub. These repositories include complete application codebases, independent packages, and reusable components. Developers can freely explore the open-source Community Edition (CE) repositories, while licensed customers gain access to private Enterprise Edition (EE) repositories that contain a range of advanced, enterprise-only features.

Licensing Models
----------------

**Community Edition:** The Community Edition of OroCommerce is a free, open-source version of the platform specifically designed for developers and technical teams. It provides direct access to the source code, architecture, and core modules, enabling users to inspect, experiment, and learn. This edition also offers a stable technical foundation for smaller B2B businesses, allowing them to implement digital sales channels without incurring any licensing fees.

**Enterprise Edition:** The Enterprise Edition extends the Community Edition by offering advanced features specifically designed for complex, large-scale B2B deployments. It supports multiple organizations and websites, includes improved workflows, process customization, and AI functionalities, and provides robust security along with performance enhancements and long-term support.

.. CE vs EE Comparison-------------------

.. .. csv-table::
   :header: "Feature / Capability", "Community Edition", "Enterprise Edition"
   :widths: 50, 25, 25
   "**Licensing & Support**", "", ""
   "License","Free, open source (MIT)","Commercial license"
   "Code Access","Public repositories on GitHub","Private repositories (licensed customers only)"
   "Long-term Support","Community Forum only","Guaranteed by Oro Inc."
   "**Security & Compliance**", "", ""
   "Security & Performance Optimizations","Limited","Enhanced"
   "User Login Attempts Configuration","Not available","Available"
   "User Password Change Policy Settings","Not available","Available"
   "Two-Factor Authentication","Not available","Available"
   "LDAP Integration","Not available","Available"
   "**Multi-Organization & Multi-Site**", "", ""
   "Multi-organization Support","Not available","Available"
   "Multi-website Support","Not available","Available"
   "Multi-warehouse Management","Limited","Available"
   "B2B Marketplace Support","Not available","Available"
   "**Product Management**", "", ""
   "Simple and Configurable Products","Available","Available"
   "Product Kits","Available","Available"
   "Support of Externally Stored Images and Files","Available","Available"
   "**Search & Navigation**", "", ""
   "Global Search Boost","Not available","Available"
   "Search Autocomplete","Not available","Available"
   "Fuzzy Search in the Storefront and Back-Office","Not available","Available"
   "Search Synonyms and History","Not available","Available"
   "**Integrations**", "", ""
   "Microsoft Office 365 Integration","Unavailable","Available"
   "Stripe Payment Service Integration","Not available","Available"
   "Google Analytics 4","Available","Available"
   "**Orders & Pricing**", "", ""
   "Backordering","Not available","Available"
   "Multiple Shipping (Order Splitting)","Not available","Available"
   "Multiple Currencies","Not available","Available"
   "Multiple Price Lists","Available","Available"
   "Online Quoting","Available","Available"
   "**CRM & Customer Management**", "", ""
   "Multi-Channel CRM","Available","Available"
   "SEO Management","Available","Available"
   "**Technology & Scalability**", "", ""
   "REST API Access","Available","Available"
   "MySQL Database Support","Available","Available"
   "PostgreSQL Database Support","Not available","Available"
   "Elasticsearch Support","Not available","Available"
   "Administrative and Functional Scalability (RabbitMQ)","Not available","Available"
   "**Advanced Features**", "", ""
   "Workflows & Process Customization","Basic workflows only","Advanced workflows and transitions"
   "AI Capabilities","Not available","Available"

Repositories
------------

Oro’s GitHub organization hosts over 70 public repositories, alongside additional private repositories for Enterprise Edition development. These repositories provide developers with access to the platform’s source code, reusable components, integrations, and tools. They are organized by application, package, and component:

* **Application repositories**: These contain the full source code for an application, such as |OroCommerce|, |OroPlatform|, |OroCRM|. When starting a new project, developers are advised to fork one of these to create their own custom application.

* **Package repositories**: A package repository refers to a repository containing a reusable PHP bundle or library that can be installed as a Composer package. These are usually independent components maintained by Oro that can be shared across Oro applications, for example |Marketing|.

* **Component repositories**: These contain reusable code modules that provide generic functionality. They can be used as standalone third-party libraries without requiring the full Oro application, for example |OroMessageQueueBundle|.

* **Private repositories** (Enterprise Edition): In addition to the public repositories, Oro maintains a number of private repositories that contain enterprise-only features. These include advanced functionality such as multi-organization and multi-website support, enhanced workflows, AI capabilities, and long-term support packages. Access is limited to licensed enterprise customers.

For the full list of public repositories, visit |https://github.com/oroinc/|.

.. hint:: **Once you identify the repository you need, follow the :ref:`Get the Oro Application Source Code guide <platform--installation--source-files>` to clone and start working with the codebase.**

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin



