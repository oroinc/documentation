.. _cloud-environments:

OroCloud Environments
---------------------

.. contents::
   :local:
   :depth: 1

Software Development Lifecycle (SDLC) involves multiple activities, such as planning, analysis, design and development, different types of testing, deployment, and maintenance. These activities usually happen in different software environments, which could be classified as **development, testing, staging, and production environments**. Depending on your Oro license, you may have access to a different number and different types of OroCloud environments. However, out-of-license environments can also be requested for an additional cost.

.. image:: /cloud/img/cloud/orocloud_environments.png
   :alt: OroCloud environments

Let’s consider the main differences between these environments and why you may need them all during eCommerce implementation.

Production Environment
^^^^^^^^^^^^^^^^^^^^^^

A **production environment** is where your application lives and operates after the launch. It is where you deploy all the final work for your customer or roll out your new version of the application to be accessed by your own clients.

Now, before you can deploy your code from your **development environment** into the **production environment**, there are a few more things for you to do. The first one is **testing**. To ensure the testing is properly set up, there’s a need for a separate **testing environment**. It is specifically configured to allow the team to effectively execute their tests and check the system components in different use case scenarios.

The second activity you usually need to do before placing your code to production is the **user-acceptance testing**. This is when you check the entire system in the exact way it is going to be used in production, including live data volumes and types of data as well as user behavior. This type of testing requires a **staging environment**, which is identical to your production environment except that it’s not publicly accessible to end users.

Development Environment
^^^^^^^^^^^^^^^^^^^^^^^

A **development environment** is configured to enable developers to write code quickly, verify it by creating basic tests, and be productive. This environment resources are much smaller than what it takes to run an entire application in real-life implementation. It also features developer-specific tools that may at times hinder rigorous QA validation. And most importantly, the development environment is constantly changing – with new functionality being added all the time – which makes it difficult for QA team to run time-consuming tests, e.g., regression or integration tests, without disrupting the development process.

Testing Environment
^^^^^^^^^^^^^^^^^^^

A **testing environment** is where the QA team can use a variety of testing tools to run all their different tests over the application code taken from the development environment. While developers check their code for simple bugs before passing it for quality assurance, QA engineers execute more complex and time-consuming types of tests to check the compatibility of the new and old code, the correct integration of different modules, the system’s performance, etc. Running such tests on the development environment would lead to a huge waste of the developers’ time.

Staging Environment
^^^^^^^^^^^^^^^^^^^

Even though testing is typically performed alongside development, the need for user-acceptance testing on a **staging environment** is of paramount importance. A staging environment is an identical replica of the customer’s production environment, which also typically contains real production data that’s been sanitized for safety purposes. It is hosted in the same way as the production servers and involves an identical setup and update operations. Therefore, testing on a staging environment offers the most reliable way to check code quality and ensure the production servers are successful.

A testing environment – even though critical for ongoing code quality assurance – can hardly achieve the same real-life degree of the customer’s system emulation. That’s why it is a common best practice to have the application code fully tested on the staging environment before moving it to production. It is considered a must for enterprise applications.

OroCloud Environment Plans
^^^^^^^^^^^^^^^^^^^^^^^^^^

Not all OroCommerce Enterprise Edition licenses come with a staging and testing environment, so be sure to ask your Oro Representative if this is a requirement. However, customers can always add development and testing environments to their OroCloud environment for an additional cost. The OroCommerce staging and testing environments feature advanced monitoring, backups, redundancy, and other DevOps capabilities necessary to ensure rigorous UAT testing for a custom-tailored OroCommerce implementation.

To learn about the features included in different types of OroCloud environments, please refer to :ref:`OroCloud Environment Plans <cloud-environment-plans>`.

