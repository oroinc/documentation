:oro_documentation_types: Extension

.. _integrations-tableau:

Tableau Integration
===================

.. important:: This is a custom extension, not a core feature of OroCommerce, and is not covered by the Oro User License Agreement. Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Tableau is a platform that provides business intelligence and data visualization services. It enables users to connect to diverse data sources, visualize and analyze data, and share insights interactively and meaningfully. The integration of Tableau with OroCommerce enhances the Oro application's back-office reporting capabilities. Users can seamlessly embed Tableau reports within Oro Dashboards, which creates a comprehensive analytical environment.

Integration Features
--------------------

Dashboards
^^^^^^^^^^

The Oro integration provides the ability to create a new type of dashboard in the Oro back-office with embedded Tableau components. The dashboard allows to incorporate three Tableau components and users can create a dashboard using one of the following:

* **View** -- enables the seamless embedding of Tableau View components, providing users with interactive visualizations.
* **Authoring** -- allows embedding the Tableau Authoring component and enables users to make real-time changes to the views of the Tableau dashboard
* **Ask Data** -- allows embedding the Tableau Ask Data component, offering users to type a question in a search bar and instantly get a response.

When creating a Tableau dashboard, you must provide an Embed URL that can be retrieved from the Tableau account as a **Share User Link**.

.. image:: /user/img/integrations/tableau-dashboard.png
   :alt: Creating a dashboard of type Tableau in the Oro back-office

Oro Context in Tableau Dashboard View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The integration enables you to connect data fields in your Tableau views with Oro entities through context menus. This makes it possible to navigate from a record in a Tableau report directly to the same record in the Oro application, allowing you to interact with it seamlessly.

.. image:: /user/img/integrations/tableau-context-menu.png
   :alt: Illustrating context menu in Tableau dashboard view

System Integration
^^^^^^^^^^^^^^^^^^

You can use the embedded Tableau dashboard functionality by signing into your Tableau account directly via the OroCommerce dashboard UI. Such authorization does not require creating an integration in the back-office system settings. However, this requires users to sign in to the Tableau app every time they log out.

To alleviate this, Oro offers the option of configuring a direct integration between Tableau and Oro. To achieve this:

* the Oro application needs to be added as a connected app in the Tableau developer account
* Tableau needs to be integrated into Oro via the Oro back-office UI

Configuring direct integration between Tableau and Oro is not mandatory but provides a more seamless user experience and helps users to authorize using the already provided information automatically.

.. image:: /user/img/integrations/tableau-connected-app.png
   :alt: Illustration of Oro as a connected app on the Tableau side and Tableau and integration

Tableau Accounts
^^^^^^^^^^^^^^^^

The integration allows creating Tableau Accounts. A Tableau account is a record representing an existing Tableau user, which can be assigned to an Oro user.

After creating an account, you can allocate it to individual users and specify access to Tableau accounts through :ref:`role permissions <user-guide-user-management-permissions>` in the Oro application. This will help reduce the number of Tableau accounts required, allowing multiple users to share one. Additionally, specific users can edit relevant Tableau reports in the Oro application if they do not have an active Tableau account, simplifying access and report management.

.. image:: /user/img/integrations/tableau-account-assign.png
   :alt: Illustration of Tableau accounts and the ability to assign a user to a Tableau account on their user view page

Data Security and Exchange
--------------------------

In the integration process between Oro and Tableau, data is retrieved by means of an embedded link, which establishes a direct connection between both systems. This method ensures that Oro does not store any data, but instead it displays the information obtained from the Tableau side. This approach offers multiple advantages, such as faster data access and real-time synchronization between the two systems.

Security is ensured through the encryption of keys. This means that sensitive information is not stored in Oro, but only encoded keys that allow the system to access the data in Tableau. By doing so, Oro prevents any unauthorized access or data breaches. Additionally, this encryption process guarantees that no other sensitive data is retained, providing an extra layer of protection for the user's information.


**Related Articles**

* |Get Started with Tableau|


.. include:: /include/include-links-user.rst
   :start-after: begin