.. _dev-guide-continuous-integration:

Jenkins CI (Continuous Integration)
===================================

Jenkins is a widely used open-source automation server for continuous integration and continuous delivery (CI/CD). Its flexible, extensible architecture lets developers automate tasks and streamline their software development workflows.

To make Jenkins easier to deploy for use with Oro products, Oro provides a tool that builds Jenkins locally using Docker Compose and Jenkins Configuration as Code.

You can run Jenkins CI in a container for quick deployment of Oro's CI/CD environment. Use it to test your applications locally, or as a reference for deploying Jenkins on your own servers. Either way, the setup stays simple and consistent across environments.

To get started, install Docker and the Docker Compose plugin. Docker runs on any supported operating system, but we recommend a Linux-based OS for the best performance and compatibility.

Configure Jenkins
-----------------

The |docker-build| repository holds the configuration that adds Jenkins locally, including the Docker Compose configuration and Jenkins Configuration as Code. Its |jenkins| folder is a self-contained package that bundles everything needed to build Jenkins locally.

First, specify the GID of the docker group in the DOCKER_GROUP_ID variable in the `.env` file. To find the GID, run:

.. code-block:: bash

   getent group docker | cut -d: -f3

Next, set the UID (user ID) and GID (group ID) variables for the current user. To find these values, run:

.. code-block:: bash

   $ id -u
   1000

.. code-block:: bash

   $ id -g
   1000

When working with private repositories and registries, you may need credentials to access those resources. Which credentials you need depends on the resources you access. The sections below cover the credentials for using GitLab and GitHub for project code, authorizing Composer, and accessing private registries:

GitLab Credentials
^^^^^^^^^^^^^^^^^^

* **GitLab Personal Access Token:** Used to communicate with the GitLab API; requires the api scope. Configure it in the global settings of Jenkins, and grant an admin user the sudo capability to configure system hooks and trigger Merge Requests (MRs).

* **User Name with Password:** Used to clone the GitLab repository in specific job configurations. For more on using GitLab with Jenkins, see the |GitLab Branch Source Plugin| documentation.

GitHub Credentials
^^^^^^^^^^^^^^^^^^

**GitHub Application** is recommended for accessing GitHub repositories. See more in the |GitHub Branch Source Plugin| documentation.

Composer Authorization for Private Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Composer must be authorized to install vendors from private repositories. Because vendors can live on GitLab and/or GitHub, we authorize both and provide http-basic authentication for composer. To do this, use the `GitHub Application` credentials type or a `Username with password`, with a personal access token as the password.

Docker Registry Access
^^^^^^^^^^^^^^^^^^^^^^

After building the images, the job pushes them to the registry. For a private registry, provide access credentials using the `User Name and Password` credential type.

Alternatively, if the registry is hosted on the Google Cloud Platform (GCP), create a service account and obtain a JSON file containing an authorization key. For more information, see the |GCP| documentation.

.. note:: The credentials ID you create must match the credential ID in the `Jenkinsfile`.

To configure the credentials, specify them in the .env file, using `jcasc/credentials.yaml` as an example. For more detailed examples and information on managing credentials with the Configuration-as-Code plugin, see the |Credentials Plugin| and |Handling Secrets| documentation.

Run Jenkins
-----------

Once you complete these steps, launch the Jenkins instance by running:

.. code-block:: bash

   docker compose up -d

The command starts the Jenkins instance by orchestrating the necessary containers, including the Jenkins server, plugins, and any additional dependencies. Once it finishes, open the Jenkins GUI at http://localhost:8080 in your web browser to reach the web interface and configure your CI/CD pipelines.

.. note:: Currently, the Jenkins setup gives anyone unrestricted access to perform any action in the system. This may suit development and testing, but it poses significant risks when deploying our applications to production. Put proper authorization and security measures in place---configure authorization, implement HTTPS, and so on---to keep the infrastructure secure and controlled.

Out of the box, we provide two default jobs to exemplify the functionality of Jenkins:

* **Docker Pipeline Example**: A pipeline job example that shows how to define and run CI/CD workflows using the Jenkins Pipeline syntax. Access it at ``http://localhost:8080/job/docker-pipeline``.

* **Oro Commerce Application**: This job demonstrates a more comprehensive pipeline by executing a Jenkinsfile from the repository located at ``https://github.com/oroinc/orocommerce-application.git``. The job clones the repository's 5.1.0 tag, builds the application, creates runtime, test, init, and init-test images, and performs code style and unit tests. The Jenkinsfile also provides an example of running functional and behat tests (commented out). You can explore this job at ``http://localhost:8080/job/orocommerce-application``.

.. note:: Docker service is used on the host where Jenkins is deployed, i.e., Jenkins has the capability to manage Docker on the host machine. As a result of Jenkins' operations, Docker images are uploaded to the host and instances are created directly on the host. To view the Docker instances created by Jenkins, run ``docker ps -a``. To view the Docker images, run ``docker image ls``.

Building Jenkins locally offers several benefits. It streamlines setup, reduces dependency issues, and ensures consistent environments across systems. It also enables easy local testing and experimentation, so you can fine-tune your CI workflows before deploying them to production servers.

.. include:: /include/include-links-dev.rst
   :start-after: begin
