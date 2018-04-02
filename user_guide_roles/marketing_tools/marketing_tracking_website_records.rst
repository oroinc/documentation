.. _user-guide-marketing-tracking:

Tracking Websites
=================

With OroCRM Tracking Websites functionality you can learn how many users have visited your Web-site from links 
within a specific marketing campaign and what these users' actions at the site were. 

All you need to do, is to create a Tracking Website record and add the code generated to the web-pages that you want to 
monitor.

.. note::

    Tracking of Magento stores is pre-implemented and available with the extension at 
    https://marketplace.magento.com/oro-oro-tracking.html



.. _user-guide-marketing-tracking-websites-create:

Tracking Websites Records
-------------------------

1. Go to *Marketing → Tracking Websites* page and click :guilabel:`Create Tracking Website` button in the top right 
   corner to get to the *Create Tracking Website* :ref:`form <user-guide-ui-components-create-pages>`.

2. Define the settings of the tracking record:

There are four mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Field**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the record in the system"
  "**Identifier***","Unique code of the website used to generate its tracking"
  "**Url***","Url of the website to be tracked" 
  "**Owner***","Limits the list of Users that can manage the tracking website record to the users,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing tracking-websites of the owner (e.g. the owner, 
  members of the same business unit, system administrator, etc.)."

.. image:: ../img/marketing/tracking_general.png

Additionally, you can connect the tracking record with a channel in the system. If this is done, you will be able to 
bind events registered by the tracking engine and other CRM data like orders, shopping carts, customer profiles, etc. 
This connection can be further utilized in reports and segments.


3. Save the record in the system with the button in the top right corner of the page.


.. _user-guide-marketing-tracking-websites-actions:

Manage Tracking Websites Records
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following actions are available for a Tracking Websites record from the 
:ref:`grid <user-guide-ui-components-grids>`:

.. image:: ../img/marketing/tracking_grid_actions.png

- Delete the record from the system : |IcDelete| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the record: |IcEdit| 
 
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the record:  |IcView| 


.. note::

    The tracking process also depends on the :ref:`Tracking settings <admin-configuration-tracking>` defined for the 
    OroCRM instance.


.. _user-guide-marketing-tracking-websites-view-page:

Tracking Websites View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^

:ref:`View page <user-guide-ui-components-view-pages>` of a tracking websites contains the following three sections:

- General Information: general details specified for the tracking websites during creation and/or editing.


.. image:: ../img/marketing/tracking_view_general.png

- Tracking Code: a piece of code to be added to the website in order to :ref:`track <user-guide-how-to-track>` the 
  campaign-related user activities. 
  The code and its usage are described in more details in :ref:`How to Track Campaign Related 
  Activities on the Website <user-guide-how-to-track>` guide.

.. image:: ../img/marketing/tracking_view_code.png
  
- Events: each event represents one time a user has accessed a pre-defined part of the Website following the 
  campaign.
  Events grid contains name of the event, value of the event, user identification value, page url, campaign code and 
  time the event was logged at.

.. image:: ../img/marketing/tracking_view_events.png

*In the example above you can see the three kinds of events defined for the Jack and Johnson E-commerce website tracking.
As soon as a user gets on any of the Website pages, a "visit" is logged. Value of a visit is always "1".*
*As soon as a user gets to the "Orders" page of the Website, an "Order" is logged. Value of an order is the ordered 
item id.*
*As soon as a user gets to the "Item Details" page of the Website, an "View item" is logged. Value of a "View item" is 
the item id.*


.. _user-guide-how-to-track:

Using the Tracking Code
-----------------------

Tracking code that shall be added before the </body> tag  on every page of the website 
can be found on the :ref:`View page <user-guide-ui-components-view-pages>` of the corresponding 
:ref:`Tracking Website <user-guide-marketing-tracking>` record.

.. image:: ../img/marketing/how_to_tracking_code.png

The code defines some of `piwik <http://piwik.org>`_-specific settings that should not be changed and the following variables
that can/must be defined by the user:

.. code-block:: html
    :linenos:

    _paq.push(['setUserId', [user_identifier] ])

[user_identifier] defines the user id used in compliance with the Website settings.

.. code-block:: html
    :linenos:

    _paq.push(['trackEvent', 'OroCRM', 'Tracking', [name], [value] ]

If you want to allocate user activities on a specific page of the Website, uncomment this line and replace the 
"[name]" and "[value]".

- [name] is used in the system to refer to events on the page.
- [value] is any numeric value (e.g. for a cart, it can be an item code or cost).

.. note::
  
    The code may be filled with both static and dynamic values, however the use of dynamic values requires complex 
    back-end development. 


Tracked Website Example
^^^^^^^^^^^^^^^^^^^^^^^

This is the code pre-implemented for Magento stores:

.. code-block:: html
    :linenos:

    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(['setUserId', "id=guest; visitor-id=51"]);
        _paq.push(['setConversionAttributionFirstReferrer', false]);
        _paq.push(['trackPageView']);

        (function() {
            var u="http://crm.dev/";
            _paq.push(['setTrackerUrl', u+'tracking.php']);
            _paq.push(['setSiteId', 'MAGORO']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
            g.defer=true; g.async=true; g.src=u+'bundles/orotracking/js/piwik.min.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>

*Every time a user gets to the page where the code is implemented, a *"visit"* event will appear on the View page of the
Website Tracking record and a dynamic value that corresponds to the item ID will be saved.*

*Users are identified as guests until they sign in. As soon as a user signs in, their identification is a value of
the "visitor-id" field. A special block has been implemented to enable transfer of the 
ID data to Oro.*

      |
  
On some of the pages, activities of a user are defined more precisely. For example, this is a tracking script on the 
Cart page:

.. code-block:: html
    :linenos:

    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(['setUserId', "id=guest; visitor-id=51"]);
        _paq.push(['setConversionAttributionFirstReferrer', false]);
        _paq.push(['trackPageView']);
        _paq.push(['trackEvent', 'OroCRM', 'Tracking', 'cart item added', '27' ]);
        (function() {
           var u="http://crm.dev/";
         _paq.push(['setTrackerUrl', u+'tracking.php']);
         _paq.push(['setSiteId', 'MAGORO']);
         var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
         g.defer=true; g.async=true; g.src=u+'bundles/orotracking/js/piwik.min.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>

*Every time a user gets to the page where the code is implemented, a *"Cart item added"*
event will appear on the View page of the Website Tracking record and a dynamic value that corresponds to the item 
ID will be saved.*

      |
  
A similar tracking script is implemented on each of the Website pages. The order placement page has the following action
enabled:

.. code-block:: html
    :linenos:

    _paq.push(['trackEvent', 'OroCRM', 'Tracking', 'order successfully placed', '2699.990000' ]);            

*An "Order successfully placed" event is saved for the campaign with a dynamic value that corresponds to a total
cost of the order*.


.. _user-guide-marketing-tracking-websites-plus-campaign:

Assign a Tracking Websites Record to a Campaign
-----------------------------------------------

If you want to include one or several Tracking Website record(s) into one 
:ref:`Marketing Campaign <user-guide-marketing-campaigns>`, you can do it in one of the two ways:

- Add the piece of code from the :ref:`View page of the campaign <user-guide-marketing-campaigns-view-page>` to the 
  tracking script from the 
  :ref:`View page of the Website Tracking record <user-guide-marketing-tracking-websites-view-page>` after 
  setUserId call.

  Each time a user reaches a page with such a code, an event will be logged within the campaign.
   
- Add the piece of code from the :ref:`View page of the campaign <user-guide-marketing-campaigns-view-page>` 
  to the page url and use this modified URL in the link used for the mailing, advert, etc. 
  
  Each time a user reaches a page with such a url, an event will be logged within the campaign.





.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle
   
.. |BGotoPage| image:: ../../img/buttons/BGotoPage.png
   :align: middle
   
.. |Bdropdown| image:: ../../img/buttons/Bdropdown.png
   :align: middle

.. |BCrLOwnerClear| image:: ../../img/buttons/BCrLOwnerClear.png
   :align: middle



