.. _user-guide-getting-started:

Understanding the System UI
===========================

.. _user-guide-getting-started-log-in:

Log-In
------

To get to your OroCRM account, enter the OroCRM instance url.

.. image:: ./img/ui_components/login.png

- Enter your username and password.
- To save your credentials on the device, check the *"Remember me on this computer"* box.
- If you have forgotten the credentials, click the *"Forgot your password"* link and follow the wizard to restore them.
- To log-in using your Google account , click the *"login using google"* link. (The link is only available if 
  :ref:`Google Single Sign-On functionality <admin-configuration-google-settings>` is enabled for the instance).

.. _user-guide-getting-started-controls:
  
Navigation
----------

Once you have logged in, you will see a Dashboard of your organization.
If there are several organizations (available in the OroCRM Enterprise Edition only), you will see the Dashboard of the
the latest used organization.

To navigate through the system, use the header, as described below:

.. image:: ./img/ui_components/header.png


.. _user-guide-getting-started-change-organization:

Change Organization
^^^^^^^^^^^^^^^^^^^
If there are several organizations available to a user (in OroCRM Enterprise Edition only), this user can switch between 
the organizations.

Organization name is displayed in the top left corner. (1)

To switch to another organization, click the selector in the top-left corner and choose the organization.

|multi_org_choice|

.. hint::

    The :ref:`system organization <user-ee-multi-org-system>` (if any) is shifted left related to the other 
    organizations. The organization you are currently logged into is displayed in bold. 

Please follow the :ref:`link <user-ee-multi-org>`, to find out more about multiple organization support  available in 
the Enterprise Edition.


.. _user-guide-getting-started-first-menu-level:

Menu
^^^^

Below the organization name, you can see the first level menu items (7 - the Dashboard icon and 8 - names of other menu
items).

.. note::

    In mobile applications the first level menu items are hidden in a list by the organization name:
    
    |header_mobile|
 
The first level menu items define basic OroCRM sections. Click the icon or name to get to the relevant subsections and 
access corresponding pages or grids. 

- The list of all the available menu items and links to the documents with detailed description of entities reltated to 
  each of the menu items is available in the :ref:` OroCRM Menu Items guide <user-guide-menu-items>`.

- For better understanding of the grid structure in OroCRM read the :ref:`Grids guide <user-guide-ui-components-grids>`.

- From each grid you can get to :ref:`Create/Edit forms <user-guide-ui-components-create-pages>` and 
  :ref:`View pages <user-guide-ui-components-view-pages>` of specific records.


.. _user-guide-getting-started-shortcuts:

Shortcuts
^^^^^^^^^

You can get to a grid, page, or create form directly with the shortcuts.

- Click the shortcuts icon (2)

- Type in the name of a related entity in the text field, to see the direct links:

  |shortcut|
  
|

- Click *"See the full list"* link to see all the shortcut actions available.

  |shortcut_all|


.. hint::

    All the :ref:`menu and sub-menu items <user-guide-menu-items>` and 
    :ref:`Create forms <user-guide-ui-components-create-pages>`
    are available.
  
.. _user-guide-getting-started-search:

Search
^^^^^^
You can find a specific record of any entity in the system by its name or by the name of a related entity.

To do so,

- Click the search icon (3)

- Type the search key the text field, to perform the search.

- Click :guilabel:`Go`

For example, we are searching for "Ann" all over the system:

|

.. image:: ./img/ui_components/search_ex_1.png

These are our search results:

.. image:: ./img/ui_components/search_ex_2.png

There is total of 28 records, 2 of which are Account names, 6 are names of related entities of Magento Shopping Carts,
there are 9 names of related entities that contain the key in the calendar event records.

|

Modify the Search
"""""""""""""""""

You can limit the entities within which the search will be performed. For example, you can look for Ann only in the 
names of Account records.

.. image:: ./img/ui_components/search_ex_3.png


.. _user-guide-getting-started-favorites:

Mark as Favorite
^^^^^^^^^^^^^^^^

You can mark any page, whether it is a grid, form, report, search result or other as favourite. 

To do so:

- Open the page that you want to mark as favorite.

- Click the "Mark as favorite" icon (9)

.. image:: ./img/ui_components/favorite.png  

- The icon will turn yellow

- You can now see the page in the User's Favorites section 

.. image:: ./img/ui_components/favorite_1.png  


.. _user-guide-getting-started-pinbar:

Pinbar
^^^^^^

You can pin any page to the header and come back to it at any time in one click.

To do so:

- Open the page that you want to pin.

- Click the pin icon (10)   

.. image:: ./img/ui_components/pin.png  

- The icon will turn yellow

- The page link is now available in the pin section (left from the search icon)

.. image:: ./img/ui_components/pin_2.png  


.. _user-guide-getting-started-user-menu:

User Menu
^^^^^^^^^

In the top left corner there is a User Menu drop-down

.. image:: ./img/ui_components/user_menu.png

The menu contains following sub-items:

- My User: View page of the :ref:`User record <user-management-users>` that corresponds to the credentials used to 
  access the system.
  
- My Emails: all the emails sent or received by the user or a related contact and available in the system. 
  
  These may be emails :ref:`sent within OroCRM <user-guide-activities-emails>`, collected to OroCRM from the user's 
  mailbox with :ref:`email synchronization settings <user-management-users-email-sync>` or collected through 
  :ref:`integration with Microsoft Exchange Server <admin-configuration-ms-exchange>` or another third-party mail 
  service.

- My Tasks: all the :ref:`tasks <user-guide-activities-tasks>` assigned to the user.

- My Calendar: user's :ref:`calendar <user-guide-calendar-add-another-user>` of the user.

- Logout: click the menu item to logout from the system.


.. _user-guide-getting-started-history:

History, Favorites and Most Viewed
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
To view the history of pages viewed in the system, the list of favorites and the list of most viewed pages for a 
specific user, click the list icon to the left from the User Menu (6).

All the page names there are links, which you can click to get to the page.

.. image:: ./img/ui_components/history.png  

   
.. |multi_org_choice| image:: ./img/multi_org/multi_org_choice.png

.. |header_mobile| image:: ./img/ui_components/header_mobile.png

.. |shortcut| image:: ./img/ui_components/shortcut.png

.. |shortcut_all| image:: ./img/ui_components/shortcut_all.png