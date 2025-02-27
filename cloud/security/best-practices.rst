.. _cloud-security-best-practice:

Shared Security Responsibility and Best Practices
=================================================

This section coordinates the area of security responsibility between Oro Inc. as the code and infrastructure provider and the Customer as the end-user of the Oro application. This document also contains Oro Inc. security best practices for the Customers to protect the data and ensure the maximum security level of the application.

Responsibility
--------------

Oro Inc
^^^^^^^

Infrastructure
~~~~~~~~~~~~~~

1. The infrastructure provided by Oro must have both secure public and private connection points.

    * Public connection means access for end-users over the Internet. Connections must use encrypted protocols (e.g., HTTPS) to exchange data, and standard web server configuration must prevent common vulnerabilities (XSS, clickjacking).
    * Private connection means access for environment users (engineers) and administrators who work on the infrastructure level. Access should be allowed only through the private network connection (VPN) using encrypted protocols.

2. The only application resource exposed to the Internet is the web server used by end-users to access the application. Direct access from the Internet to the internal application components (DBMS, search engine, MQ) should be disabled.
3. Oro Inc. must grant developers and infrastructure engineers access to the Oro management tools (orocloud-cli) and application logs.

Application
~~~~~~~~~~~

1. Oro Inc. provides a standard web application that follows global security best practices (OWASP top 10).
2. Oro applications must include standard configuration to prevent CSRF, XSS injection, and clickjacking vulnerabilities.
3. Oro Inc. provides fixes for discovered security vulnerabilities in the standard application in patch releases or code patches.
4. Standard Oro applications are responsible for encrypting sensitive information in standard components before saving it to internal storage.
5. Standard Oro applications are compliant with PCI-DSS requirements for processing customer and financial data (cardholder data) in standard components.
6. Standard Oro application does not store cardholder data, PANs, etc.
7. Application data is encrypted at rest and in transit in a standard Oro-managed application environment.

Customer/Implementation Partners
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Infrastructure
~~~~~~~~~~~~~~

1. Engineers that have access to Oro infrastructure must not share access credentials with other people.
2. Engineers that have access to Oro infrastructure must not expose any additional entry points (services, servers, etc.) to the Internet or install any additional software without approval from Oro Inc.
3. Engineers that have access to Oro infrastructure must immediately report all security vulnerabilities found in the application environment to Oro Inc. via the Customer Support Portal.
4. The customer/partner must immediately inform Oro Inc. in case of identity theft (e.g., credentials were lost or stolen) or lost device affecting Oro application environment accounts.
5. The customer must notify about the termination of the employee who has access to the Oro environment.
6. It is not recommended to use production data in a non-production environment to guarantee data consistency and security.
7. Notification settings of the non-production instances must be configured in such a way as to avoid sending information to real customers.

Development
~~~~~~~~~~~

1. Developers responsible for the Oro application customization must encrypt all sensitive information before storing it in any internal storage (database, session, cache, file system, search index, etc.) or passing it over to third-party applications.
2. Developers responsible for the Oro application customization must not store sensitive information or credentials directly in code.
3. Developers responsible for the Oro application customization must maintain all security best practices implemented in the standard application code.
4. Developers responsible for the Oro application customization must follow global secure development guidelines provided by OWASP.
5. Developers responsible for the Oro application customization must not add entry points (API, services) that may expose sensitive information or harm the application integrity and availability or customers in any other way.
6. During the integration development, developers responsible for the Oro application customization must use an encrypted connection (HTTPS, SSH, etc.) to exchange data with third-party systems.
7. During the payment integration development, developers responsible for the Oro application customization must follow PCI-DSS to guarantee the security of customer data.
8. Developers should avoid storing cardholder data in any storage (DB, session, cache, search index, file system, etc.) received from any data source.
9. Developers responsible for the Oro application customization must report all found vulnerabilities in Oro applications to Oro Inc.
10. Developers responsible for the Oro application customization must not expose customers' sensitive information for public usage.
11. Developers responsible for the Oro application customization must implement and follow global and local data protection regulations (GDPR, etc.).
12. Developers responsible for the Oro application customization are not allowed to expose the code of the Enterprise modules for public usage or to other people who do not have access to it.

Usage
~~~~~

1. The customer owns user accounts inside the Oro application.
2. Customers must maintain and follow their own access management procedure when handling Oro application accounts as well as accounts provisioned by Oro Inc. for customer employees.
3. Oro application users must not share access credentials with other persons.
4. Oro application users must not store secure information (passwords, CC number and PIN, etc.) in plain form or using pages and forms not designed specifically for that.
5. Oro application users must not expose customers' sensitive information for public usage.
6. Oro application users must report all found vulnerabilities to the application administrator, so they can fix them if they are part of customization or forward them to Oro Team if they are part of a standard application.
7. Oro customers are responsible for Information Security Awareness training for users of the Oro application.
8. Customers are responsible for validating data passed from external sources, e.g., for checking integration source files before importing them. Oro recommends using antivirus software to check data intended to be uploaded into OroCommerce.

Best Practices
--------------

Infrastructure
^^^^^^^^^^^^^^

1. Do not store secure or sensitive information in the home directory.
2. Clean up shared directories (e.g., SFTP folder) regularly to prevent exposing sensitive information.
3. Monitor application logs for hacking attempts regularly. They may look like access from unexpected IP addresses, unauthorized access responses, etc.
4. Check the list of executed commands (orocloud-cli log) for signs of hacking attempts.
5. Use data sanitization for DB intended for debugging or testing.

Development
^^^^^^^^^^^

1. Apply all the responsibilities and best practices to the customization itself and to all external libraries or packages added to the application.
2. Use the “minimum required access” approach to develop integrations when a third-party application is to interact with the Oro application (e.g., using API).
3. If the integration uses temporary storage to save data (e.g., files on SFTP), remember to clear it up when it is no longer needed.
4. Include security checks into the code review process and check against common vulnerabilities from OWASP top 10 (SQL injection, XSS, CSRF, code injection, etc.).
5. Automate checks for potential security vulnerabilities using CI. You can use one of the following libraries:

    * |https://github.com/oroinc/phpstan-rules|
    * |https://github.com/fabpot/local-php-security-checker/|
    * |https://github.com/FriendsOfPHP/security-advisories|

6. It is recommended to cover all actions (links, buttons, etc.) with an ACL check, so the application administrator can control what exactly is available for each role, and the lowest roles (e.g., for integrations) will not have access to most of the features. Actions must be covered from two sides: from the place where the trigger (link, button) is rendered and from the place where the action is executed (controller, CLI command).
7. It is recommended to cover every list of entities (grid, table, etc.) with ACL check using the ACL helper. This way, a user will see only entities visible to them based on the defined permissions.
8. Add the ACL configuration to every new entity visible to a user. You may consider adding ownership too to provide an extra level of flexibility.
9. If an entity has ownership, you must check permissions for this specific entity, not just a general ACL for the entity class.
10. Do not pass any sensitive information to logs, as all log records are stored in a simple form. If you have to do it, remember to mask sensitive information with asterisks or replace it with a hash.
11. Do not pass information to the client application (web browser, mobile application, etc.) if the current user is not allowed to see it.
12. Never evaluate code (use the eval function) passed from any internal or external source.
13. Remove all direct data output (print_r, echo, console.log, etc.) and other similar debug calls from the code.
14. Log every attempt of unauthorized access with the WARNING level or higher, and monitor application logs to determine where they come from. They may indicate either an application issue (some actions or data are visible to a user who should not have access to it) or hacking attempts.


Usage
^^^^^

1. If you, as an application user, have found that some secure data is not encrypted, please inform the administrator and check for similar issues across the application.
2. Plan permission for roles ahead and grant users minimum permissions required for their work.
3. Conduct security awareness training for all employees and explain security best practices.
4. Avoid exchanging secure or sensitive information in plain form, e.g., via emails or USB flash drives. If you need to do that, please encrypt the information first.
5. Perform regular data backup recovery tests using a non-production environment to check the integrity of these backups.


.. include:: /include/include-links-cloud.rst
   :start-after: begin