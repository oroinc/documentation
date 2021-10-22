:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-integrations-azure-oauth:

Configure Microsoft 365 OAuth Integration (Azure Active Directory Application)
==============================================================================

Integration with Microsoft 365 via OAuth 2 API enables users to log in with their Microsoft 365 account and connect their mailbox to the Oro application using OAuth authentication.
To achieve this, you need to register a custom Azure application and connect it with your Oro application.

Register an Application in Azure
--------------------------------

Create a New Azure Active Directory Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The first step is to |create a new Azure Active Directory application| on the Microsoft side:

1. Navigate to the |Azure portal|.
2. Ensure that you are logged into your microsoft account and access to the Azure platform is granted.
3. Open the menu on your left and click **Azure Active Directory**.

   .. image:: /user//img/system/integrations/microsoft/azure-directory.png
      :alt: Open Azure Active Directory

4. Navigate to **App Registration** and click **New Registration**.

   .. image:: /user/img/system/integrations/microsoft/new-registration.png
      :alt: New registration button

5. Provide application information and click **Register**.

   .. image:: /user/img/system/integrations/microsoft/register-application.png
      :alt: Register button

   |

   Once you create the application, its basic information, such as **Application (client) ID** and **Directory (tenant) ID**, is displayed on the app’s main page section in the Essentials section.

   .. image:: /user/img/system/integrations/microsoft/essentials.png
      :alt: Essentials section on the main page displaying application credentials such as client id, directory id.

Create a Client Secret
^^^^^^^^^^^^^^^^^^^^^^

1. To create a password/client secret, navigate to **Manage > Certificates and Secrets**.

2. Click **New Client Secret** and fill in the form.

   .. image:: /user/img/system/integrations/microsoft/client-secret.png
      :alt: Creating a client secret under Certificates and Secrets

   |

   Remember to copy the client secret as soon as you create it. You will not be able to retrieve it after you perform another operation or leave the page.

   .. important:: To integrate with the Oro application, make sure to use the **client secret value**, not the secret ID.

                  .. image:: /user/img/system/integrations/microsoft/client-secret-value-id.png
                     :alt: Client secret value and ID on the Microsoft side

Grant API Permissions
^^^^^^^^^^^^^^^^^^^^^

Next, define the rights that the application will be able to grant.

1. In the panel to the left, click **API permissions**.
2. Select the permissions that your application needs access for. Try narrowing down the access to the smallest possible/required set.

   .. image:: /user/img/system/integrations/microsoft/api-permissions.png
      :alt: Api permissions

   |

   The screenshot below illustrates a set of permissions for User profile + Email access to Microsoft 365 services provided by Microsoft.You can use this set to authorize IMAP/POP/SMTP access (receiving, synchronizing and sending email messages and email account information):

   .. image:: /user/img/system/integrations/microsoft/example-permissions.png
      :alt: An example of a set of permissions for user profile and email access to Microsoft 365

3. Click **Add a permission** and then **Microsoft Graph**.

   .. image:: /user/img/system/integrations/microsoft/graph.png
      :alt: Microsoft graph menu

   |

4. Click **Delegated Permissions**  and select the ones that you need. You can also use **Search**.

   .. image:: /user/img/system/integrations/microsoft/delegated-permissions.png
      :alt: Delegated permissions list

   |

   .. note::
        Some access rights may require |Administrator Consent|. It is an administrative task and can be only performed by an organization admin user.

5. Click **Add permissions**.

   .. important:: Please be aware that in order to complete the active directory application configuration, you will need to copy the value of the **Redirect URI** from the Microsoft System Configuration Settings of your Oro application and paste it into the Azure application settings:

      .. image:: /user/img/system/integrations/microsoft/redirect-url-azure-side.png
         :alt: Copy Redirect URI and paste it into the Azure application settings

Configure Integration in the Oro Back-Office
--------------------------------------------

Once your Azure Active Directory application is configured, you can connect it to your Oro application.

For that:

1. Navigate to **System > Configuration > Integrations > Microsoft Settings**.

2. Provide the following details under **Azure Active Directory Application Settings**:

   .. image:: /user/img/system/config_system/azure-directory-application-settings.png
      :alt: Azure Active Directory Application Settings

   * **Application (Client) ID** - The client id generated on the Azure side when creating an active directory application. It is located on the main application page under **Essentials**. Selecting the *Use Default* checkbox resets the value.

   * **Client Secret** - Provide the client secret value generated on the Azure side. To integrate with the Oro application, make sure to use the *client secret value*, not the secret ID.

   .. image:: /user/img/system/integrations/microsoft/client-secret-value-id.png
      :alt: Client secret value and ID on the Microsoft side

   * **Directory (Tenant) ID** - The directory id generated on the Azure side when creating an active directory application. It is located on the main application page under **Essentials**.

   * **Redirect URI** - Copy this value and add it to your Azure Application trusted redirect URIs in order to complete the connection.

   .. image:: /user/img/system/integrations/microsoft/redirect-url-azure-side.png
      :alt: How to connect Redirect URI

3. Click **Save Settings**.

.. note:: To enable and configure email synchronization on the system level, please see the :ref:`Global Email Synchronization Settings <doc-email-configuration>` and :ref:`Global System Mailbox Synchronization Settings <admin-configuration-system-mailboxes-global>`.


**Related Topics**

* :ref:`Configure Global Microsoft Settings <configuration-integrations-microsoft>`
* :ref:`Microsoft 365 Single Sign-On <user-guide-integrations-microsoft-single-sign-on>`
* :ref:`Microsoft 365 Integrations <user-guide-integrations-microsoft>`


.. include:: /include/include-links-user.rst
   :start-after: begin