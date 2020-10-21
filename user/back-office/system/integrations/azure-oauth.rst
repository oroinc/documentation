:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-integrations-azure-oauth:

Configure Microsoft Office365 OAuth Integration
===============================================

.. hint:: Microsoft Office365 oAuth is available since OroCommerce v4.1.9. To check which application version you are running, see the :ref:`system information <system-information>`.

Integration with Microsoft Office365 via oAuth 2 API enables users to log in with their Office365 account and connect their mailbox to the Oro application using OAuth authentication.
To achieve this, you need to register a custom Azure application and :ref:`connect it with your Oro application <configuration-integrations-azure>`.

Register an Application in Azure
--------------------------------

Create a new Azure Active Directory Application
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

   .. important:: Remember to copy the client secret as soon as you create it. You will not be able to retrieve it after you perform another operation or leave the page.


Grant API Permissions
^^^^^^^^^^^^^^^^^^^^^

Next, define the rights that the application will be able to grant.

1. In the panel to the left, click **API permissions**.
2. Select the permissions that your application needs access for. Try narrowing down the access to the smallest possible/required set.

   .. image:: /user/img/system/integrations/microsoft/api-permissions.png
      :alt: Api permissions

   |

   The screenshot below illustrates a set of permissions for User profile + Email access to Office 365 services provided by Microsoft. You can use this set to authorize IMAP/POP/SMTP access (receiving, synchronizing and sending email messages and email account information):

   .. image:: /user/img/system/integrations/microsoft/example-permissions.png
      :alt: An example of a set of permissions for user profile and email access to office 365

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

Configure Integration in the Oro Back-Office
--------------------------------------------

Once your Azure Active Directory application is configured, you can connect it to your Oro application. Please follow the steps outlined in the :ref:`Configure Microsoft Office365 oAuth Settings <configuration-integrations-azure>` section on how to achieve this.

For instructions on how to connect Office365 account type once the connection between Azure and Oro has been established, please see :ref:`User Email Synchronization Settings <my_email_configuration>` and :ref:`System Mailbox Synchronization Settings <admin-configuration-system-mailboxes>` documentation.

.. include:: /include/include-links-user.rst
   :start-after: begin