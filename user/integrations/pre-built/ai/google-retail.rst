.. _integrations-misc-google-retail-recommendations:

Integration with Google Retail Recommendations
==============================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Oro supports integration with |Google Retail Recommendations|, allowing you to take advantage of the Google Retail API and Recommendation AI models. With its help, you can offer personalized product recommendations to your customers based on their browsing history and preferences.

Collected Events
----------------

Google Retail uses real-time events to generate recommendations and search results. Different events can be collected on all or some pages of the website. Below is a list of event types obtained from `productCatalogs` and `userEvents` that you can record when users browse your website:

* add-to-cart
* category-page-view
* detail-page-view
* home-page-view
* purchase-complete
* search
* shopping-cart-page-view

These collected events are used to help build a range of recommendation models. These models are used to place the recommended products on the relevant pages of the website.

.. image:: /user/img/integrations/google-ai-user-events.png
   :alt: User events and models on the Google side

When integrated, Oro sends certain data to Google Retail Cloud. The data are collected from productCatalogs and userEvents and include information from product, shopping list and checkout pages:

.. csv-table::
   :header: "userEvents", "productCatalog"

    "Customer ID","Product Name"
    "Product ID", "Product Type"
    "Product Quantity","Product Category"
    "Shopping List ID","Product Default Short Description"
    "Product price","Brand"
    "Order total","Quantity"
    "Tax amount","Product Price"
    "","Product attributes"

Recommendation Models
---------------------

The integration supports several Recommendation AI models, such as:

.. csv-table::

    "*Recommended for you*", "Predicts the next item a user is likely to purchase based on their history and contextual information, commonly displayed on the homepage."
    "*Others you may like*","Predicts the next product a user is likely to engage with, based on their history and candidate product's relevance to a current specified product."
    "*Frequently bought together*","Suggest items that are frequently purchased together either during a shopping session or based on a list of products that are being viewed."
    "*Similar items*","Predicts products with similar attributes, commonly displayed on product detail pages or when a recommended product is out of stock."
    "*Buy it again*","Encourages users to make repeat purchases based on their previous recurring orders; predicts products bought at least once and typically purchased regularly."
    "*On-Sale*","Recommends discounted items based on personalized data, encouraging users to make purchases at lower prices."
    "*Recently Viewed*","Lists recent product IDs in descending order based on user interaction."

The choice of models and customizations depends on your specific business needs and where you intend to display the resulting recommendations. Each model works with certain types of pages. For example, model *Others you may like* supports the product details page (event detail-page-view), add to shopping list page (event add-to-cart), and the shopping shopping list page (event shopping-cart-page-view). Once you configure a model of your choice, you can tune and train it to provide personalized product recommendations to users.

Once trained, these models can be added to various pages of your website such as the home page, search results page, product listing page, product detail page, shopping list, and checkout pages. Each of your trained models to these pages with the help of the generated serving config ID added to Oro's Google Recommendations content :ref:`widget <content-widgets-user-guide>`. This will improve the user experience on your website, increasing customer engagement, and boosting conversion rates.

.. image:: /user/img/integrations/google-retail-ai.png
   :alt: Content widget of type Google Recommendation



**Recommended Articles**

* |Google Retail Recommendations|

.. include:: /include/include-links-user.rst
   :start-after: begin
