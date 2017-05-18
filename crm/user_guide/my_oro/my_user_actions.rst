.. _doc-my-user-actions:


Actions with My User
====================

.. contents:: :local:
   :depth: 3


Actions
-------

.. _doc-my-user-actions-review:

Review Your Profile
^^^^^^^^^^^^^^^^^^^
1. In the user menu, click **My User**.

|

.. image:: ../img/my_oro/user_menu_my_user.png

|

2. Review your profile settings. Please, see details in the :ref:`My User Page <doc-my-user-view-page>` section.

.. _doc-my-user-actions-edit:

Edit Your Profile
^^^^^^^^^^^^^^^^^

1. In the user menu, click **My User**.

2. On your profile view page, click the **Edit** button in the upper-right corner of the page.

3. On the **Edit My User** page, click **General** and modify the following fields if required:

    - **Username**—Type a name that the user will use to log into the system. This field is mandatory.

    - **Name Prefix**—Type a name prefix of the user. A name prefix is used in front of the user's name and provides additional information about the user.

    - **First Name**—Type the first name of the user. You can use any number of characters of any alphabet in the name. This field is mandatory. A user's first name is displayed on the interface when the user logs in.

    - **Middle Name**—Type the middle name of the user.

    - **Last Name**—Type the last name of the user. You can use any number of characters of any alphabet in the name. Together with the user's first name, a user's last name is displayed on the interface when user logs in.

    - **Name Suffix**— Type a name suffix of the user. A name suffix is used after the user's name and provides additional information about the user.

    - **Birthday**—Click this field and select the user's date of birth using a pop-up calendar. Alternatively, you can type the date in the format defined by your current locale (for more information about locales, see the :ref:`Localization <doc-my-user-configuration-localization>` section).

    -  **Avatar**—Click :guilabel:`Choose File` to locate a user's photo or another picture associated with the user on your computer or other device.

     - **Primary Email**—Type the user's main email address that will be used for communications. This field is mandatory.

    - **Emails**—Click the :guilabel:`Add Another Email` button and type an additional email address in the field that appears. You can add as many email addresses as required. To delete an email address, click the **x** icon next to the email field you want to delete.

    - **Phone**—Type the user's phone number.

|

.. image:: ../img/my_oro/my_user_edit_general.png

|

4. Click **Additional** and provide more information about you.

5. If you want to change your password, click **Password** and provide the following information:

    - **Password**—Type your current password.

    - **New Password**—Type a new password. Click the tooltip to learn more about what a password must consist of.

    - **Repeat New Password**—Type the new password one more time to confirm it.

|

.. image:: ../img/my_oro/my_user_edit_password.png

|


6. Click :guilabel:`Save` or :guilabel:`Save&Close` in the upper-right corner of the page.




.. _doc-my-user-actions-api:

Generate an API Key
^^^^^^^^^^^^^^^^^^^

When the integration with a third-party software or other work requirements demand a user to have the API access to OroCRM, generate an API key. You can use this key to access API while protecting your password from being disclosed to the third party.

1. In the user menu, click **My User**.

2. On your profile view page, click **General Information**.

3. Find the **API Key** field and click the :guilabel:`Generate Key` button next to it. A new API key appears. It will look similar to `bba1b83312a50836d78cbef4d2705125a6ce1d4d`.

After the API key is generated, you will be able to execute API requests via the sandbox, Curl command, any other REST client or use the API via the custom application.

.. important::
	Please note that an API key must be generated within the organization the data of which it will be used to access. Therefore, before generating an API key, make sure that you are logged into the desired organization.

    Within one organization there can be only one API key at a time.


.. _doc-my-user-actions-email:

Send an Email
^^^^^^^^^^^^^

You can send an email message to other users or external emails.

1. In the user menu, click **My User**.

2. On your profile view page, perform one of the following:

    - Click :guilabel:`More Actions` in the upper-right corner of the page and click **Send Email** on the list.

      |

      .. image:: ../img/my_oro/my_user_sendemail0.png

      |

    - In the **General Information** section, find the **Emails** field, and point to one of your email address—actually the one that you want to use to send the email from. Click the **Send Email** icon that appears next to it.

      |

      .. image:: ../img/my_oro/email_icon.png

      |


3. In the **Send Email** dialog box, specify the required data. For help on this, see the :ref:`Email <user-guide-using-emails>` guide.

|

.. image:: ../img/my_oro/my_user_sendmail.png

|

4. Click :guilabel:`Send`. The email will appear in the **Activity** section of the user view page.


.. _doc-my-user-actions-call:

Log or Make a Call
^^^^^^^^^^^^^^^^^^^

1. In the user menu, click **My User**.

2. On your profile view page, perform one of the following:

   - Click :guilabel:`More Actions` in the upper-right corner of the page and click **Log Call** on the list.

     |

     .. image:: ../img/my_oro/my_user_logcall0.png

     |

   - In the **General Information** section, find the **Phone** field, and point to a specified phone number. The **Hangouts Call** and **Log Call** icons appear next to it.

     - Click the **Hangouts Call** icon to immediately call to the specified phone number.


     - Click the **Log Call** icon to specify call details.

     |

     .. image:: ../img/my_oro/my_user_hangouts_call.png

     |

   - In the **General Infromation** section, find the **Emails** field, and point to the required email. Click the **Hangouts Call** icon that appears next to it.

     |

     .. image:: ../img/my_oro/my_user_hangouts_call2.png

     |

3. If you used **Log Call** action button or icon, in the **Log Call** dialog box, specify the required data.

|

.. image:: ../img/my_oro/my_user_logcall.png

|

4. Click :guilabel:`Log Call` to log a call, or click the **Start** button next to **Hangouts** label to start a hangout call. The call will appear in the **Activity** section of the user view page.


.. important::
    - If you do not see icons and buttons that allow making Hangouts calls, make sure that the Hangouts functionality is enabled for the organization. See :ref:`Google Integration Settings <admin-configuration-integrations-google>` for more information.

    - You need to be logged into your google account to make a Hangouts call.

    - If you are using a browser other than Chrome, you also need to have the Google Hangout or Google Talk extension for your browser installed.

For more information about calls, see the :ref:`Calls <doc-activities-calls>` guide.



.. _doc-my-user-actions-event:

Assign an Event
^^^^^^^^^^^^^^^

1. In the user menu, click **My User**.

2. On your profile view page, click :guilabel:`More Actions` in the upper-right corner of the page and click **Assign Event** on the list.

|

.. image:: ../img/my_oro/my_user_assignevent0.png

|


3. In the **Assign Event To** dialog box, specify the required data. For help on this, see the :ref:`Calendar Events <doc-activities-events>` guide.

|

.. image:: ../img/my_oro/my_user_assignevent.png

|

4. Click :guilabel:`Save`. The event will appear in the **Activities** section of the page.

.. _doc-my-user-actions-task:

Assign a Task
^^^^^^^^^^^^^^^

1. In the user menu, click **My User**.

2. On your profile view page, click :guilabel:`More Actions` in the upper-right corner of the page and click **Assign Task** on the list.

|

.. image:: ../img/my_oro/my_user_assigntask0.png

|


3. In the **Assign Task To** dialog box, specify the required data. For help on this, see the :ref:`Tasks <user-guide-activities-tasks>` guide.

|

.. image:: ../img/my_oro/my_user_assigntask.png

|

4. Click :guilabel:`Create Task`. The task will appear in the **Additional Information** section, **User Tasks** subsection of the page.


.. _doc-my-user-actions-configure:

Configure Interface, Email Settings and Integrations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important::
   Note that configuration you set up will be applicable only for the current organization.

1. In the user menu, click **My User**.

2. On your profile view page, click :guilabel:`Configuration` in the upper-right corner of the page.

3. On the **Configuration** page, in the left panel, click **System Configuration**. If required, make changes to your system configuration. For information about the fields, see the :ref:`My System Configuration <doc-my-user-configuration>` description.

4. Click :guilabel:`Save Settings` in the upper-right corner of the page.


.. _doc-my-user-actions-configure-menus:

Configure Menus
^^^^^^^^^^^^^^^

You can configure how the menus in the system will look for you.

.. important::
	Note that configuration you set up will be applicable only for the current organization.

1. In the user menu, click **My User**.

2. On your profile page, click :guilabel:`More Actions` in the upper-right corner of the page and click **Change Password** on the list.

|

.. image:: ../img/my_oro/my_user_editmenus.png

|


3. On the **Menus** page, click the menu you want to configure. Follow the instructions provided in :ref:`My Menus Configuration <doc-my-user-menus>`.



.. _doc-my-user-actions-change-password:


Change Your Password
^^^^^^^^^^^^^^^^^^^^

1. In the user menu, click **My User**.

2. On your profile view page, click **Edit**.

3. On your profile edit page, click **Password**.

4. Provide the following information

    - **Password**—Type your current password.

    - **New Password**—Type a new password. Click the tooltip to learn more about what a password must consist of.

    - **Repeat New Password**—Type the new password one more time to confirm it.

|

.. image:: ../img/my_oro/my_user_edit_password.png

|

4. Click :guilabel:`Save` or :guilabel:`Save&Close` in the upper-right corner of the page.


Change Your Password via Action Button
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important:: This action is available only for administrators. However, it is recommended to follow the instruction provided in the :ref:`Change Password<doc-my-user-actions-change-password>` action description.

1. In the user menu, click **My User**.

2. On your profile page, click :guilabel:`More Actions` in the upper-right corner of the page and click **Change Password** on the list.

|

.. image:: ../img/my_oro/my_user_changepassword0.png

|


3. In the **Change Password** dialog box, type a new password. Alternatively, you can click the **Suggest Password** link to generate a secure random password. To see / hide  the entered password, click the |IcShow| **Show** / |IcHide| **Hide** icon next to the **New password** field.

|

.. image:: ../img/my_oro/my_user_changepassword.png

|

4. Click :guilabel:`Save`. The new password will be also sent to your primary email address.



.. _doc-my-user-actions-reset-password:

Reset Your Password
^^^^^^^^^^^^^^^^^^^

.. important:: This action is available only for administrators.

1. In the user menu, click **My User**.

2. On your profile page, click :guilabel:`More Actions` in the upper-right corner of the page and click **Reset Password** on the list.

|

.. image:: ../img/my_oro/my_user_resetpassword0.png

|

3. In the **Reset Password** dialog box, click :guilabel:`Reset`. The password reset link will be sent to your primary email address.

|

.. image:: ../img/my_oro/my_user_resetpassword.png

.. warning::
	You will be immediately logged out of the OroCRM and will not be able to log ib before your password is changed.




See Also
--------

    :ref:`My User Page <doc-my-user-view-page>`

    :ref:`My System Configuration <doc-my-user-configuration>`

    :ref:`My Menus Configuration <doc-my-user-menus>`


.. |IcRemove| image:: ../../img/buttons/IcRemove.png
   :align: middle

.. |IcClone| image:: ../../img/buttons/IcClone.png
   :align: middle

.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle

.. |IcShow| image:: ../../img/buttons/IcShow.png
   :align: middle

.. |IcHide| image:: ../../img/buttons/IcHide.png
   :align: middle

.. |IcPassReset| image:: ../../img/buttons/IcPassReset.png
   :align: middle

.. |IcConfig| image:: ../../img/buttons/IcConfig.png
   :align: middle


