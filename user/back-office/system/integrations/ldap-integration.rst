:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-ldap-integration:

Configure LDAP Integration in the Back-Office
=============================================

Single sign-on capability (the ability for users to use the same login credentials for all corporate applications) is
particularly important for efficiency and performance in large-scale companies. LDAP Integration in Oro application supports this capability.

.. note:: This feature is only available in the Enterprise edition.

LDAP is a Lightweight Directory Access Protocol, an open-source and vendor-neutral protocol that is commonly used to 
share user-related information in the network.
 
The integration can also significantly simplify the initial setup of Oro, as it enables businesses to upload existing
user records into Oro and map LDAP user role identifiers to Oro roles.

Install LDAP Extension
----------------------

LDAP extension is only available for the Enterprise Edition users and comes with Enterprise versions of every Oro
application, which means that no additional installation is required. However, you can install it separately if you use a custom Enterprise Edition application without the LDAP extension. For this, use the |composer| to install *oro/crm-pro-ldap-bundle* package in your Oro Enterprise application, as described in the :ref:`Extensions and Package Manager Guide <cookbook-extensions-composer>` topic.

Create LDAP Integration
-----------------------

To set up an integration with LDAP:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** on the top right.
3. On the **Create Integration** page, select the *LDAP* integration type. Th
4. In the **General Settings**, provide the following details:
  
  
   .. image:: /user/img/system/integrations/ldap/ldap_general.png
   
   .. csv-table::
     :header: "",""
     :widths: 10, 30
   
     "**Name***","The name used to refer to the integration in Oro application. It is better to keep the name reasonable."
     "**Hostname***","The hostname of the target LDAP server."
     "**Port***","The port of the LDAP server."
     "**Encryption**","Select the encryption used by the LDAP server. The possible values are:
     
     - *None*: connection is not encrypted
     - *SSL*
     - *TLS*
   
     "
     "**Base Distinguished Name***","The default base distinguished name used by the LDAP server for search (e.g., to
     search for LDAP accounts). This option is required for most account-related operations and should indicate the
     distinguished name under which accounts are located."
     "**Default Business Unit Owner***","A :term:`business unit <Business Unit>` that will by default own the newly 
     imported users in Oro application (members of this unit can manage the user records subject to the
     role settings).
     
     If you want to assign users to multiple business units, 
     this can be done after the synchronization is complete. Another option is to create separate integrations for every default business unit."
   
   Optionally, provide the following values, if they are required by the target LDAP server:
   
   .. csv-table::
     :header: "",""
     :widths: 10, 30
     
     "**Username**","The default username of the LDAP server. 
     Must be given in the Distinguished Name form, if the LDAP server requires a Distinguished Name to bind and binding 
     should be possible with simple usernames."
     "**Password**","The default password of the LDAP server used with the username above."
     "**Account Domain Name**","The fully qualified domain name (FQDN) of the domain, for which the target LDAP server is 
     an authority."
     "**Short Account Domain Name**","The short name of the domain, for which the target LDAP server is an authority. This 
     is usually used to specify the NetBIOS domain name for Windows networks but may also be used by non-AD servers."
     
5. Once all the necessary settings are defined, click **Check Connection**. 

   If everything is correct, the success message will appear.
     
   .. image:: /user/img/system/integrations/ldap/ldap_check_connection.png
      :width: 30%
   
  
6. In the **Synchronization Settings** section, enable/disable two-way synchronization.

   .. image:: /user/img/system/integrations/ldap/ldap_synch.png

   Select the **Enable Two Way Sync** checkbox to upload user-related data both from the LDAP server to the Oro application and back.

   If the box is unselected, data from the LDAP server will be loaded into the Oro application, but changes performed in Oro application will not be synchronized with the target server.

7. If two-way synchronization is enabled, define the priority used for conflict resolution (e.g., if the same user details were edited from both Oro application and the target LDAP server):

   * **Remote wins**: the LDAP server data will be applied
   * **Local wins**: the Oro application data will be applied

8. In the **Mapping Settings** section, define how the user attributes and role names of the Oro application and the target LDAP server will be mapped to each other.

   * Provide the following details: 

   .. csv-table::
     :header: "",""
     :widths: 10, 30
   
     "**User Filter***","The filter used to search for users in the target LDAP server. (e.g.,
     objectClass=inetOrgPerson)" 
     "**Username***","An attribute of the LDAP server that corresponds to Oro's user name (e.g., sn)."
     "**Primary Email***","An attribute of the LDAP server that corresponds to Oro's Primary Email (e.g., cn)."
     "**First Name***","An attribute of the LDAP server that corresponds to Oro's First Name (e.g., givenName)."
     "**Last Name***","An attribute of the LDAP server that corresponds to Oro's Last Name (e.g., displayName)."
     "**Role Filter***","The filter used to search for roles in the target LDAP server. (e.g.,
     objectClass=simpleSecurityObject)" 
     "**Role Id Attribute***","An attribute of the LDAP server that corresponds to Oro's Role Id (e.g., cn)."
     "**Role User Id Attribute***","An attribute of the LDAP server that corresponds to Oro's attribute that binds a
     user to a role (e.g., roleOccupant)."
     "**Export User Object Class***","The class of the LDAP server objects that correspond to Oro's user profiles
     (e.g., inetOrgPerson)."
     "**Export User Base Distinguished Name***","Distinguished name of the directory that contains LDAP server objects 
     that correspond to  the user profiles in the Oro application (e.g., dc=orocrm,dc=com)."

   * Click **+Add** under **Role Mapping** to map roles of Oro application and the target LDAP server.
   * Define the role name in the target LDAP server and choose the role in Oro application to map.

     .. image:: /user/img/system/integrations/ldap/ldap_role_mapping_add_role.png
  
  
9. Once the integration is established, user profiles are imported to the Oro application, and users will be able to use their
usual credentials to log into the Oro application.

.. note::

   Using LDAP integration does not prevent you from creating user profiles in the Oro application manually; they will work as usual, and will not be imported back to your LDAP server.
   
   The system administrators will be able to tell if a user has been added via LDAP integration. Their profile will contain the LDAP Distinguished Names value, which will only be visible to users who have permission to manage LDAP integrations.
   

.. include:: /include/include-links-user.rst
   :start-after: begin