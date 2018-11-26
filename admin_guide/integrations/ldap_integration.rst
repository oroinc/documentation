.. _user-guide-ldap-integration:

LDAP Integration
================

.. contents:: :local: 
   :depth: 1

Single sign-on capability (the ability for users to use the same login credentials for all corporate applications) is 
particularly important for efficiency and performance in large-scale companies. LDAP Integration in Oro application supports this capability.

.. note:: This feature is only available in the Enterprise edition.

LDAP is a Lightweight Directory Access Protocol, an open-source and vendor-neutral protocol that is commonly used to 
share user-related information in the network.
 
The integration can also significantly simplify the initial setup of OroCRM, as it allows businesses to upload existing 
:ref:`user <user-management-users>` records into OroCRM and map LDAP user role identifiers to  
:ref:`OroCRM's roles <user-guide-user-management-permissions-roles>`.

In order to enable this functionality you need to perform the steps described in the following sections.


Install Extension
-----------------

Since the extension is only available for Enterprise Edition users, you cannot download it directly from the website.

- Go to *System → Package Manager*
  
  - Click the |ComposerSettingsIcon| icon in the top right corner. 
  
  - The Composer Settings page will emerge.

    |
  
    |ComposerSettings1|
  
    |

  - Click the :guilabel:`Add a repository` button

  - Add a vcs repository https://github.com/orocrm/OroCRMProLDAPBundle.git

    |
  
    |ComposerSettings2|

    |

- Click the :guilabel:`Back to the Installed Packages` link
  
- Fill the  *Package Name* field in the top left part of the page with *"oro/crm_pro_ldap_bundle"*, and click the 
  :guilabel:`Install` button. 

- Proceed with the installation as described in the :ref:`Extensions and Package Manager Guide <admin-package-manager>`

Create Integration
-------------------

- Go to *System → Integrations → Manage Integration*
- Click the :guilabel:`Create Integration` button. The *"Create Integration"* form will emerge.
- In the form, choose the integration Type = *LDAP*. The form will be recalculated. Define the following integration 
  settings:
  
General Settings
^^^^^^^^^^^^^^^^
  
.. image:: ../img/ldap/ldap_general.png


These settings must be defined to enable the synchronization in OroCRM:

.. csv-table::
  :header: "",""
  :widths: 10, 30

  "**Name***","The name used to refer to the integration in OroCRM. It is better to keep the name reasonable." 
  "**Hostname***","The hostname of the target LDAP server."
  "**Port***","The port of the LDAP server."
  "**Encryption**","Select the encryption used by the LDAP server. The possible values are:
  
  - *None*: connection is not encrypted
  - *SSL*
  - *TLS*

  "
  "**Base Distinguished Name***","The default base distinguished name used by the LDAP server for search (e.g. to 
  search for LDAP accounts). This option is required for most account related operations and should indicate the 
  distinguished name under which accounts are located."
  "**Default Business Unit Owner***","A :term:`business unit <Business Unit>` that will by default own the newly 
  imported users in OroCRM (members of this unit can manage the user records subject to the 
  :ref:`role settings <user-guide-user-management-permissions>`). 
  
  If you want to assign users to multiple business units, 
  this can be done after the synchronization is complete - another option is to create separate integrations for every default business unit. "

Along with that, the following values can be defined, if they are required by the target LDAP server:

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
  is 
  usually used to specify the NetBIOS domain name for Windows networks but may also be used by non-AD servers."
  
Once all the necessary settings have been defined, click the :guilabel:`Check Connection` button. If everything is 
correct, the success message will appear.
  
.. image:: ../img/ldap/ldap_check_connection.png

  
Synchronization Settings
^^^^^^^^^^^^^^^^^^^^^^^^

Use the *Synchronization Settings* section to enable/disable two-way synchronization.

.. image:: ../img/ldap/ldap_synch.png

Check the *Enable Two Way Sync* box, if you want to upload the user-related data both from the LDAP server to OroCRM and
back. If the box is unchecked, data from the LDAP server will be loaded in to OroCRM, but changes performed in OroCRM will not 
be synchronized with the target server.

If two-way synchronization is enabled, define the priority used for conflict resolution (e.g. if the same
user details were edited from both OroCRM and the target LDAP server):

- *Remote wins*: the LDAP server data will be applied
- *Local wins*: the OroCRM data will be applied

Mapping Settings
^^^^^^^^^^^^^^^^  

Use the *Mapping Settings* section to define how the user attributes and role names of OroCRM and the target LDAP 
server will be mapped to each other.

.. image:: ../img/ldap/ldap_role_mapping.png

The following values must be defined:

.. csv-table::
  :header: "",""
  :widths: 10, 30

  "**User Filter***","The filter used to search for users in the target LDAP server. (e.g. 
  objectClass=inetOrgPerson)" 
  "**Username***","An attribute of the LDAP server that corresponds to OroCRM's user name (e.g. sn)."
  "**Primary Email***","An attribute of the LDAP server that corresponds to OroCRM's Primary Email (e.g. cn)."
  "**First Name***","An attribute of the LDAP server that corresponds to OroCRM's First Name (e.g. givenName)."
  "**Last Name***","An attribute of the LDAP server that corresponds to OroCRM's Last Name (e.g. displayName)."
  "**Role Filter***","The filter used to search for roles in the target LDAP server. (e.g. 
  objectClass=simpleSecurityObject)" 
  "**Role Id Attribute***","An attribute of the LDAP server that corresponds to OroCRM's Role Id (e.g. cn)."
  "**Role User Id Attribute***","An attribute of the LDAP server that corresponds to OroCRM's attribute that binds a 
  user to a role (e.g. roleOccupant)."
  "**Export User Object Class***","The class of the LDAP server objects that correspond to OroCRM's user profiles
  (e.g. inetOrgPerson)."
  "**Export User Base Distinguished Name***","Distinguished name of the directory that contains LDAP server objects 
  that correspond to OroCRM's user profiles (e.g. dc=orocrm,dc=com)."

Click the :guilabel:`+Add` button under the *Role Mapping* section to map roles of OroCRM and the target LDAP server.

Define the role name in the target LDAP server and choose the role in OroCRM to map.

.. image:: ../img/ldap/ldap_role_mapping_add_role.png
  
  
Conclusion
^^^^^^^^^^

Once the integration is established, user profiles are imported to OroCRM and users are able to use their usual credentials to log into OroCRM.

.. note::

   Using LDAP integration does not prevent you from creating user profiles in OroCRM manually; they will work as usual, and won’t be imported back to your LDAP server.
   
   The system administrators will be able to tell if a user has been added via LDAP integration, as their profile will contain the LDAP Distinguished Names value,  which will only be visible to users who have permission to manage LDAP integrations. 

The ability to quickly import users via LDAP integration allows organizations to become more efficient with their time 
and spend more energy growing their business.
  
  
.. |ComposerSettingsIcon| image:: ../img/ldap/composer_settings_icon.png
   :align: middle
   
.. |ComposerSettings1| image:: ../img/ldap/composer_settings_1.png
   :align: middle
   
   
.. |ComposerSettings2| image:: ../img/ldap/composer_settings_2.png
   :align: middle
   