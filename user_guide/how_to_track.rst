
.. _user-guide-how-to-track:

How to Track Campaign Related Activities on the Website
=======================================================

In order to track campaign-related activities of a Website user, you need to:

- Create a :ref:`*campaign <user-guide-marketing-campaigns>*`

- Create a :ref:`*Tracking Website*` <user-guide-tracking-websites>` records for this Website

- Use the "Tracking code" on their View pages to modify the code of the website.

Use Tracking Code
-----------------

Tracking code that shall be added to every page of the website before the </body> tag can be found on the View page of 
the corresponding *Tracking Website*` <user-guide-tracking-websites>` record.

.. image:: ./img/marketing/how_to_tracking_code.png

The code defines a number of piwik specific settings that should not be changed.

The following variables can/must be defined by the user:

.. code-block:: html

   _paq.push(['setUserId', [user_identifier] ])

[user_identifier] defines the user id used in compliance with the Website settings.

.. code-block:: html

    _paq.push(['trackEvent', 'OroCRM', 'Tracking', [name], [value] ]

If you want to allocate user activities on a specific page of the Website, uncomment this line and replace the 
"[name]" and "[value]".

- [name] is used in the system to refer to events on the page
- [value] is any numeric value (for example if the page tracked is a cart it can be an item code or cost)

One of the ways to implement tracking from the site is to 

..note::
  
    The code may be filled with both static and dynamic values, however the use of dynamic values requires complex 
    back-end development. 



.. code-block:: html
    :linenos:

    <script type="text/javascript">
        var _paq = _paq || [];
        
        /define the user_i
        _paq.push(['setUserId', [user_identifier] ]);
        _paq.push(['setConversionAttributionFirstReferrer', false]);
        _paq.push(['trackPageView']);
        // Uncomment following line to track custom events
        // _paq.push(['trackEvent', 'OroCRM', 'Tracking', [name], [value] ]);
        (function() {
            var u=(("https:" == document.location.protocol) ? "https" : "http") + "://demo.orocrm.com/";
            _paq.push(['setTrackerUrl', u+'tracking.php']);
            _paq.push(['setSiteId', 'jjec']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
            g.defer=true; g.async=true; g.src=u+'bundles/orotracking/js/piwik.min.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>

    
 _paq.push(['setUserId', [user_identifier] ])
