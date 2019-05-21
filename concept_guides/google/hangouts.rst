.. _user-guide-hangouts:

Voice and Video Calls via Hangouts
==================================

.. contents:: :local:
   :depth: 2

Oro application’s integration with Google Hangouts enables you to make Hangouts voice or video calls from within your Oro application, providing an advantage for sales and support teams by helping them connect with customers directly. You can make voice calls to a single phone number, or launch a audio/video conference with up to 5 participants. Call data is logged automatically, including any notes made during the call.
 
For the integration between Hangouts and your Oro application to be successful, make sure you:

* Have an active Google account (if you try using the feature when not logged in, you will be prompted to log-in) 
* Have the Hangouts extension installed in Oro application as described in the :ref:`Extensions and Package Manager <admin-package-manager>` topic.
* If you are using a browser other than Chrome, install a Google Hangout or Google Talk extension for the browser.
* If you are going to call phone-numbers beyond USA and Canada, make sure you have funds in your Google Wallet.

Configure the Integration 
-------------------------

To enable the the integration in the Oro application:
 
1. Navigate to the **System > Configuration** in the main menu.
2. Click **Integrations > Google Settings** in the panel to the left.
3. In the **Google Hangouts** section, select the following check boxes:
 
   * **Enable for Emails** --- to call via email (you can invite up to 5 users to a Google Hangout by emailing them)
   * **Enable for Phones** --- to make phone calls 
  
   .. image:: /img/system/integrations/google/enable.png


Initiate a Hangout Call
-----------------------

Call from a Record Page
^^^^^^^^^^^^^^^^^^^^^^^

In order to start a hangout call from the page of a record:

1. Navigate to the page of the record that you need to contact (account, lead, contact, user, etc.) . 
2. Hover the mouse over a phone number or an email address on the page.

   .. image:: /img/system/integrations/google/hover.png

3. Click the hangouts icon.
4. In the **Invite Contacts to a Google Hangout** form , click **Start a Hangout**.

   .. image:: /img/system/integrations/google/invite.png

5. If you have already logged into your Google account, the call starts immediately, otherwise you will be
    prompted to log in. 

.. _user-guide-hangouts-call:

Call a Phone Number
^^^^^^^^^^^^^^^^^^^
 
If you call your contact via their phone number, and the telephone calling has been enabled for your Google Hangouts, 
the call will start immediately. 

Otherwise, you will be prompted to enable it:

.. image:: /img/system/integrations/google/enable_phone.png

Most calls within the USA and Canada are free, and you can pay your balance for other regions using Google Wallet.

Call via Email
^^^^^^^^^^^^^^

If you call via email, the call is initiated. You can invite other call participants (up to 5 total),
remove them (click **X** next to the name) or send them a link to the session.

.. image:: /img/system/integrations/google/invite_more.png

Once the contact has joined the session, you can talk.

  
Call via the Log Call Form
^^^^^^^^^^^^^^^^^^^^^^^^^^

To make calls from :ref:`Log Call <doc-activities-calls>` form, click **Start a Hangout** in the bottom right corner.

.. image:: /img/system/integrations/google/log_call_hangout.png


Call from the Calendar Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start a Hangout call with contacts invited to an event:

1. Navigate to your :ref:`calendar <doc-activities-events>` (or the calendar widget on the dashboard). 
2. Click the event name.
3. If the event has at least one guest invited, the **Start a Hangout** button is displayed.

   .. image:: /img/system/integrations/google/view_event.png
      :width: 40%

4. Click **Start a Hangout** to start a call using the email addresses of the first five guests.

.. stop

**Related Topics**

* :ref:`Activities: Calls <doc-activities-calls>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin