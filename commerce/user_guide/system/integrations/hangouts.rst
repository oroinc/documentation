.. _user-guide-hangouts:

Voice and Video Calls via Hangouts
==================================

With the Hangouts integration feature, you can call via Google Hangouts directly from Oro application. This means that sales team
can make calls to their customers and prospects directly from Oro application, making it faster than ever to make and log your
sales calls. This feature is also great for support teams, as they can contact customers and utilize the screen sharing 
function for necessary support cases. Additionally, it can be used for internal communications (meetings and 
discussions), as it is possible to hold a session with up to five Oro application users. Moreover, integration with Oro’s
Calendar allows users to pre-arrange a meeting and then quickly launch a call from the event page.



Preliminary Conditions
----------------------

- Have an active Google account (if you try using the feature when not logged in, you will be prompted to log-in) 

- Have the Hangouts extension installed in Oro application as described in the
  :ref:`Extensions and Package Manager Guide <admin-package-manager>`

- If you are using a browser other than Chrome, install a Google Hangout or Google Talk extension for 
  the browser.

- If you are going to call phone-numbers beyond USA and Canada, make sure there are some funds on you Google Wallet.


System Settings
---------------

I order to enable the functionality in Oro application, navigate to the **System > Configuration** in the main menu and open **Integrations > Google Settings >
Google Hangouts** in the panel to the left.
  
.. image:: ../img/hangouts/enable.png  

Start a Hangout
---------------

From a View Page
^^^^^^^^^^^^^^^^

In order to start a hangout:

- Go to the :ref:`View page <user-guide-ui-components-view-pages>` of the record that you want to contact (account, 
  lead, contact, user, etc.) . 

- Hover the mouse over a phone number or an email address available on the View page.

.. image:: ../img/hangouts/hover.png  

- Click the |HObutton| button

- The **Invite Contacts to a Google Hangout** form will appear.

.. image:: ../img/hangouts/invite.png

- Click the **Start a Hangout** button.

  - If you are already logged in to your Google account, the Hangout will start immediately, otherwise you will be 
    prompted to log in. 

.. _user-guide-hangouts-call:

Start a Hangout Using Phone Number
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 
If you call your contact via their phone number, and the telephone calling has been enabled for your Google Hangouts, 
the call will start immediately. 

Otherwise, you will be prompted to enable it:

.. image:: ../img/hangouts/enable_phone.png

Most calls within the USA and Canada are free, and you can pay your balance for other regions using Google Wallet.

Start a Hangout Using Email
^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you call via email, the call will be initiated. You can invite other call participants (up to 5 total),
remove them (click the **X** button by the name) or send them a link to the session.

.. image:: ../img/hangouts/invite_more.png

Once the contact has joined the session, you can talk.

  
Start a Hangout from the Log Call Form
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Hangouts feature is also available in the :ref:`Log Call <doc-activities-calls>` form.

.. image:: ../img/hangouts/log_call_hangout.png

- Click the **Start a Hangout** button to start a Hangout using the phone number.


Start a Hangout from the Calendar
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Hangout feature is also integrated with Oro's Calendar. In order to start a Hangout with the users invited to an
event:

- Go to the Calendar (or the Calendar widget on the Dashboard) 

- Click the event name

- If the event has at least one guest invited, the **Start a Hangout** button will be available.

.. image:: ../img/hangouts/view_event.png

- Click the **Start a Hangout** button to start a Hangout using the email addresses of the first five guests.

.. stop



.. include:: /user_guide/include_images.rst
   :start-after: begin