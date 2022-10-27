Mediator Handlers
=================

OroSyncBundle declares some mediator handlers.

Content Manager
---------------

**Cache Management Handlers**

.. csv-table::
   :header: "Handler Name","Method","Description"

   "`pageCache:init`","`contentManager.init`","Sets up content management component, sets the initial URL"
   "`pageCache:add`","`contentManager.add`","Adds the current page to permanent cache"
   "`pageCache:get`","`contentManager.get`","Fetches cache data for the URL, by default for the current URL"
   "`pageCache:remove`","`contentManager.remove`","Clears cached data, by default for the current URL"

**State Management Handlers**

.. csv-table::
   :header: "Handler Name","Method","Description"

  "`pageCache:state:save`","`contentManager.saveState`","Saves the state of a page component in a cache"
  "`pageCache:state:fetch`","`contentManager.fetchState`","Fetches the state of a page component from the cached page"
  "`pageCache:state:check`","`contentManager.checkState`","Checks if the state's GET parameter (pair key and hash) reflects the current URL"

**Helper Methods Handlers**


.. csv-table::
   :header: "Handler Name","Method","Description"

   "`currentUrl`","`contentManager.currentUrl`","Returns the current URL (path + query)"
   "`compareUrl`","`contentManager.compareUrl`","Retrieves the meaningful part of the path from the URL and compares it to the reference path (or to the current one if the last one is undefined)"
   "`changeUrl`","`contentManager.changeUrl`","Changes the URL for the current page"
   "`changeUrlParam`","`contentManager.changeUrlParam`","Updates the URL parameter for the current page"

See |orosync/js/content-manager| module for details.

.. include:: /include/include-links-dev.rst
   :start-after: begin