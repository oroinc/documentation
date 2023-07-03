.. _dev-guide-continuous-integration:

Jenkins CI (Continuous Integration)
===================================

Jenkins is a widely used open-source automation server that provides a robust platform for continuous integration and continuous delivery (CI/CD) processes. It offers a flexible and extensible architecture, allowing developers to automate various tasks and streamline their software development workflows. To further enhance the accessibility and ease of deploying Jenkins, Oro offers a tool that allows users to build Jenkins locally using Docker Compose and Jenkins Configuration as Code in order to work with Oro products.

With this new capability, you can run Jenkins CI in a container, enabling quick and easy deployment of Oro's CI/CD environment. Whether you want to test your applications locally or use them as a reference to deploy Jenkins on your servers, this approach simplifies the setup process and ensures consistency across different environments.

To get started, you must install Docker and the Docker Compose plugin. While you can use any operating system with Docker support, we recommend using a Linux-based OS for optimal performance and compatibility.

Configure Jenkins
-----------------

The configuration that adds Jenkins locally is in the |docker-build| repository containing the necessary Docker Compose configuration and Jenkins Configuration as Code. The |jenkins| folder in the repository acts as a self-contained package, bundling all the necessary components and configurations to build Jenkins locally.

To start, first, specify the GID of the docker group in the DOCKER_GROUP_ID variable in the `.env` file. To determine the GID, use the following command:

.. code-block:: bash

   getent group docker | cut -d: -f3

Additionally, you need to set the UID (user ID) and GID (group ID) variables of the current user. To determine these values, execute the following commands:

.. code-block:: bash

   $ id -u
   1000

.. code-block:: bash

   $ id -g
   1000

Several credentials may be required to grant access to the necessary resources when working with private repositories and registries. The specific credentials needed depend on the resources you require access to. Below is a breakdown of the credentials required for using GitLab and GitHub for project code, authorizing Composer, and accessing private registries:

GitLab Credentials
^^^^^^^^^^^^^^^^^^

* **GitLab Personal Access Token:** This credential type is used for communication with the GitLab API and requires the scope api. It should be configured in the global settings of Jenkins. Ensure that an admin user is granted the sudo capability to configure system hooks and trigger Merge Requests (MRs).

* **User Name with Password:** This credential type is used for cloning the GitLab repository and should be used in specific job configurations. For more details on using GitLab with Jenkins, refer to the |GitLab Branch Source Plugin| documentation.

GitHub Credentials
^^^^^^^^^^^^^^^^^^

**GitHub Application** is recommended for accessing GitHub repositories. See more in the |GitHub Branch Source Plugin| documentation.

Composer Authorization for Private Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Composer must be authorized to install vendors from private repositories. Because vendors can be located both on GitLab and/or on GitHub, we authorize both and provide http-basic authentication for composer. To do this, use the `GitHub Application` credentials type or a `Username with password`, where a personal access token is used as the password.

Docker Registry Access
^^^^^^^^^^^^^^^^^^^^^^

After building the images, the job pushes them into the registry. If this is a private registry, you also need to provide credentials for access. You can use the `User Name and Password` credential type to provide the necessary access credentials.

Alternatively, if the registry is hosted on the Google Cloud Platform (GCP), create a service account and obtain a JSON file containing an authorization key. For more information, see the |GCP| documentation.

.. note:: The credentials ID you create must match the credential ID in the `Jenkinsfile`.

To configure the credentials, specify them in the .env file and use `jcasc/credentials.yaml` as an example. For more detailed examples, see and information on managing credentials using the Configuration-as-Code plugin, refer to the |Credentials Plugin| and |Handling Secrets| documentation.

Run Jenkins
-----------

Once you completed these steps, you can launch the Jenkins instance by running the following command:

.. code-block:: bash

   docker compose up -d

The command orchestrates the necessary containers, including the Jenkins server, plugins, and any additional dependencies, effectively starting the Jenkins instance. After successful execution, you can access the Jenkins GUI by navigating to http://localhost:8080 in your preferred web browser. This grants you entry into the Jenkins web interface, allowing you to configure your CI/CD pipelines.

.. note:: Currently, the Jenkins setup has been configured to allow anyone to have unrestricted access and perform any action within the system. While this configuration may be suitable for development and testing purposes, it poses significant risks when deploying our applications into production environments. Ensure appropriate authorization and security measures are in place to maintain a secure and controlled infrastructure (configure authorization, implement HTTPS, etc.).

Out of the box, we provide two default jobs to exemplify the functionality of Jenkins:

* **Docker Pipeline Example**: This job serves as a pipeline job example, showcasing how you can define and execute CI/CD workflows using the Jenkins Pipeline syntax. Access this job by navigating to ``http://localhost:8080/job/docker-pipeline``.

* **Oro Commerce Application**: This job demonstrates a more comprehensive pipeline by executing a Jenkinsfile from the repository located at ``https://github.com/oroinc/orocommerce-application.git``. The job clones the repository's 5.1.0 tag, builds the application, creates runtime, test, init, and init-test images, and performs code style and unit tests. The Jenkinsfile also provides an example of running functional and behat tests (commented out). You can explore this job at ``http://localhost:8080/job/orocommerce-application``.

.. note:: Docker service is used on the host where Jenkins is deployed, i.e., Jenkins has the capability to manage Docker on the host machine. As a result of Jenkins' operations, Docker images are uploaded to the host and instances are created directly on the host. To view the Docker instances created by Jenkins, run ``docker ps -a``. To view the Docker images, run ``docker image ls``.

Building Jenkins locally offers numerous benefits to developers and organizations alike. It streamlines the setup process, reduces dependency issues, and ensures consistent environments across different systems. Moreover, it enables easy local testing and experimentation, allowing developers to fine-tune their CI workflows before deploying them to production servers.

.. include:: /include/include-links-dev.rst
   :start-after: begin
