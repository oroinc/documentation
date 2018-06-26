.. _user-guide-marketing-tracking:

Tracking Websites
=================

With OroCRM Tracking Websites, you can learn how many users have visited your Web-site from links
within a specific marketing campaign and what these users' actions at the site were.

Before you start using tracking websites, ensure that :ref:`tracking is enabled <marketing-system-configuration>` and :ref:`configure tracking settings <admin-configuration-tracking>` in Oro application via system configuration.

When the tracking configuration is ready, create a Tracking Website record and add the code generated to the web-pages that you want to monitor.

.. contents:: :local:
    :depth: 1

.. note::  Tracking of Magento stores is pre-implemented and available with the extension that you can download at
    https://marketplace.magento.com/oro-oro-tracking.html

.. _user-guide-marketing-tracking-websites-create:

Create a Tracking Website and Generate a Tracking Code
------------------------------------------------------

1. Navigate to **Marketing > Tracking Websites** in the main menu.
#. Click **Create Tracking Website**.
#. In the **General Section**, define the following settings:

   .. csv-table::
      :header: "**Field**","**Description**"
      :widths: 10, 30

      "**Name***","Name used to refer to the record in the system"
      "**Identifier***","Unique code of the website used to generate its tracking"
      "**URL***","Url of the website to be tracked"
      "**Owner***","Limits the list of Users that can manage the tracking website record to the users,  whose
     roles allow managing tracking-websites of the owner (e.g. the owner,
     members of the same business unit, system administrator, etc.)."
      "**Description**","Optional."
      "**Channel**","Optional. Select one of the channels from the list. This connects the tracking record with a channel in the system.
     If this is done, you will be able to bind events registered by the tracking engine and other application data like orders, shopping carts, customer profiles, etc. This connection can be further utilized in reports and segments."

      .. image:: /img/marketing/tracking_general.png
         :alt: Create a tracking website and generate a tracking code

#. Once you finish configuring the tracking website, click **Save and Close** in the top right corner of the page.

.. _user-guide-marketing-tracking-websites-actions:

Manage Tracking Websites
------------------------

You can manage tracking websites from the page of all tracking websites under **Marketing > Tracking Websites**.

When you hover over the more options menu (ellipsis menu) at the end of the row of a tracking website in the table, you can perform the following actions to it:

.. image:: /img/marketing/tracking_grid_actions.png
   :alt: Manage tracking websites

* |IcEdit| Edit
* |IcDelete| Delete
* |IcView| View

.. note:: The tracking process also depends on the :ref:`Tracking Settings <admin-configuration-tracking>` defined for the
    OroCRM instance.

.. _user-guide-marketing-tracking-websites-view-page:

View Tracking Website Details
-----------------------------

To view the website tracking details:

#. Navigate to **Marketing > Tracking Website** in the main menu.

#. Click on the Tracking Website item to preview its contents.

Here you can:

* Preview the general website tracking details (including the identifier and the URL).

  .. image:: /img/marketing/tracking_view_general.png
     :alt: The general website tracking details

* Get the tracking code that may be incorporated into the website page to :ref:`track <user-guide-how-to-track>` the
  campaign-related user activities.

  .. image:: /img/marketing/tracking_view_code.png
     :alt: The tracking code may be incorporated into the website page

  .. note:: The tracking code comes with the following instructions on basic use and customization:

     *Make sure this code is on every page of your website before the </body> tag. To track custom events, please uncomment the trackEvent string and replace [name], [value], and [user_identifier] parameters with your values. The script will log an event with the [name] name and optional [value].*

* :ref:`Review the tracking results <user-guide-how-to-track--statistics>` in the Events section.

Share the Tracking Website
^^^^^^^^^^^^^^^^^^^^^^^^^^

To share the website tracking summary with other Oro application user:

#. Navigate to **Marketing > Tracking Websites** in the main menu.

#. Click on the Tracking Website to preview its contents.

#. Click **Share** at the top right corner of the page.

   The **Sharing Settings** open.

#. Type in the user name next to the *Share with* text, or search for the necessary user: click |IcBars|, find the person you need, tick the checkbox next to their name, and click **Add**.

.. note:: You can preview the sharing status and see who you already shared the Tracking Website with. For this, click **Share** again.

To cancel sharing the Tracking Website with a particular person, click **Share**, and then click |IcDelete| next to the user name. Use mass actions to cancel sharing for more than one user.

.. _user-guide-how-to-track:

Use the Tracking Code
---------------------

Tracking code generated in the Tracking Website shall be added before the </body> tag on every page of the website you would like to monitor.

.. image:: /img/marketing/how_to_tracking_code.png
   :alt: The generated tracking code for a website

The code defines some of `piwik <http://piwik.org>`_-specific settings that should not be changed.

The following variables may be amended:

.. code-block:: html
    :linenos:

    _paq.push(['setUserId', [user_identifier] ])

[user_identifier] defines the user id used in compliance with the website settings.

.. code-block:: html
    :linenos:

    _paq.push(['trackEvent', 'OroCRM', 'Tracking', [name], [value] ]

If you want to track user activities on a specific page of the Website, uncomment this line and replace the
"[name]" and "[value]" with the event name (string) and value (number) you would like to see in the Events report in Oro application (e.g. for a cart, event name may be cart_created, and the value may store the item code or cost).

.. note::

    The code may be filled with both static and dynamic values. However, the use of dynamic values requires complex back-end development.

Tracked Website Example
-----------------------

This is the code pre-implemented for an average website:

.. code-block:: html
    :linenos:

    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(['setUserId', "id=guest; visitor-id=51"]);
        _paq.push(['setConversionAttributionFirstReferrer', false]);
        _paq.push(['trackPageView']);

        (function() {
            var u="http://an.average.website.com/";
            _paq.push(['setTrackerUrl', u+'tracking.php']);
            _paq.push(['setSiteId', 'ANAWERAGEWEBSITE']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
            g.defer=true; g.async=true; g.src=u+'bundles/orotracking/js/piwik.min.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>

Every time a user gets to the page where this code is embedded, a *visit* event appears in the
Website Tracking details with the corresponding value.

Visitors are treated as guests unless they sign in. As soon as the visitor signs in, their identification is logged in the *visitor-id* field. A special block has been implemented to enable transfer of the ID data to Oro application.

On some of the website pages, user activities may be logged in more details. For example, on the shopping list or shopping cart page, the following tracking script may be used:

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
         _paq.push(['setSiteId', 'ANAWERAGEWEBSITE']);
         var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
         g.defer=true; g.async=true; g.src=u+'bundles/orotracking/js/piwik.min.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>

Every time a visitor gets to the website page where the code is embedded, a *Cart item added* event appears in the Website Tracking details.

A similar tracking script may be placed on any Website pages. For example, on the checkout page you may enable the following actions:

.. code-block:: html
    :linenos:

    _paq.push(['trackEvent', 'OroCRM', 'Tracking', 'order submitted', '2699.990000' ]);

An *order submitted* and the total cost of the order is logged.

.. _user-guide-marketing-tracking-websites-plus-campaign:

Assign a Tracking Websites to a Campaign
----------------------------------------

To include one or several Tracking Website(s) to a marketing campaign, use one of the following methods:

* Add a :ref:`marketing campaign code <user-guide-marketing-campaigns>` to the tracking  script provided in the Tracking Code section of the from the Website Tracking details (put it after the *setUserId* call). Each time a user reaches a page with such a code, an event will be logged within the campaign.
* Add :ref:`marketing campaign code <user-guide-marketing-campaigns>` to the url and use this modified URL as a target in the links that lead to the website page. Use these modified URL in mailing, advert, landing pages etc. Each time a user reaches a page using the modified url, an event is logged within the campaign.

.. _user-guide-how-to-track--statistics:

Collect Website Statistics
--------------------------

A list of events on the tracking website page helps you monitor every occurrence of the tracked action (e.g. a user has accessed a pre-defined part of the website following the campaign). You can find event name and value, user id (guest or user email), the url of the visited page, the code of the marketing campaign and time when the event was logged.

  .. image:: /img/marketing/tracking_view_events.png
     :alt: Collected website statistics displayed in the events section on the tracking website page in the management console

In the example above you can see the three kinds of events defined for the Jack and Johnson E-commerce website tracking. As soon as a user gets on any of the website pages, a *visit* event is logged with the *1* value. As soon as a user gets to the **Orders** page of the website, an *Order* event is logged, with the value that stores an ordered item id. As soon as a user gets to the **Item Details** page of the website, an *View item* event is logged with a value that stores a viewed item id.

.. important:: To make sure that synchronization between your website and the application is successful, you may need to enable dynamic website tracking. For this, navigate to **System > Configuration > General Setup > Tracking**, and select the **Enable Dynamic Tracking** check box.

     .. image:: /user_guide/img/marketing/enable_dynamic_tracking.png
        :alt: Enable dynamic tracking in system configuration




.. include:: /img/buttons/include_images.rst
   :start-after: begin
