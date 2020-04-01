:oro_documentation_types: OroCommerce

.. _user-guide--marketing--web-catalog--preview:

Preview Web Catalog
-------------------

OroCommerce enables you to preview web catalog pages in the storefront applying different restrictions dynamically and checking how the content is reflected depending on these restrictions.

.. note:: The ability to preview web catalog nodes is controlled by the *Storefront Preview* permissions defined for the selected role in the system configuration.

   .. image:: /user/img/marketing/web_catalogs/preview_web_catalog_permissions.png
       :alt: Storefront Preview capabilities enabled for the admin role

To start previewing a selected node, follow the steps outlined below:

1. Enable the web catalog either on the :ref:`global level <user-guide--marketing--web-catalog--enable-globally>` or per :ref:`website <user-guide--marketing--web-catalog--enable-per-website>`.

2. Navigate to the required web catalog details page under **Marketing > Web Catalogs** and click |IcEditContentTree| **Edit Content Tree** in the more options menu of the related web catalog.

3. Select the content node to preview and click |IcPreview| **Preview** on the top right.

    .. image:: /user/img/marketing/web_catalogs/web_catalog_preview.png
       :alt: Clicking Preview on the top right of the Lighting  Products content node

4. The storefront page of the related content node opens in the preview mode in a new tab. The mode allows you to browse other pages as well. The configuration panel on the top of the page enables you to switch between websites, localizations, customer groups, and customers to ensure that the page is displayed properly based on different restriction scopes applied.

    .. image:: /user/img/marketing/web_catalogs/preview_mode.png
       :alt: Configuration panel in the storefront

5. If you want to adjust any settings and preview the results, you need to save these settings first.

To illustrate the example, let's consider the case where you run two businesses in the US and Canada selling various lighting products. While the US warehouse is all packed with the necessary products, the warehouse in Canada is only expecting the delivery. To notify the wholesale customers that the products are on the way, you have created a dedicated landing page. This way, your restrictions for the *Lighting Products* node can be configured the following way:

* The Lighting Products category page is visible for all customers, customer groups, and localizations of the US website.
* The related landing page is visible for all wholesale customers of the Canada website.

     .. image:: /user/img/marketing/web_catalogs/lighting_products_restrictions.png
        :alt: Restrictions set fot the lighting products content node
        :scale: 60%

When previewing this page, you need to set the same restrictions in the configuration panel to see how the page will be rendered in the storefront:

* for the US website

   .. image:: /user/img/marketing/web_catalogs/US_storefront_preview.png
      :alt: Restrictions set fot the lighting products content node

* for the Canada website

   .. image:: /user/img/marketing/web_catalogs/Canada_storefront_preview.png
      :alt: Restrictions set fot the lighting products content node

* If the web catalog page is not visible within the applied restrictions, the customers will see the 404 error.

    .. image:: /user/img/marketing/web_catalogs/404_error.png
       :alt: Restrictions set fot the lighting products content node


.. include:: /include/include-images.rst
   :start-after: begin