.. _user-guide--products--recommendations:

Product Recommendations
=======================

OroCommerce understands the importance of providing personalized and relevant product suggestions to customers, which is why it offers sellers the ability to enhance the shopping experience and increase sales through the use of product recommendations. There are:

 * similar products
 * related products
 * up-sell products
 * featured products

By leveraging these product recommendation features, OroCommerce empowers sellers to curate a personalized shopping experience that engages customers and drives conversions. Through targeted suggestions and strategic promotions, sellers can increase customer satisfaction, boost sales, and foster long-term loyalty.

Similar Products
----------------

.. note:: Similar Products are available for the OroCommerce Enterprise edition if Elasticsearch is used as the search engine.

The Similar Products feature is designed to assist sellers in showcasing products on the product view page that are similar or complementary to the one currently being viewed by a customer. Based on the information stored in the search index, OroCommerce intelligently identifies and displays similar products, encouraging customers to explore additional options that align with their interests.

You can enable and configure the Similar Products feature in the system configuration :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`. For example, you can enable buyers to add a similar product to the shopping list directly from the product view page where the recommendation appears or toggle the minimum and maximum number of products displayed on the page.

.. image:: /user/img/products/recommendations/similar-products.png
   :alt: Illustration of similar product recommendations in the back-office and storefront

Related Products
----------------

The Related Products feature allows sellers to showcase a curated selection of products closely associated with the item a customer is currently viewing. OroCommerce identifies and presents related products that align with the customer's interests and preferences, guiding them towards products they may have otherwise overlooked.

By strategically selecting and displaying related products, sellers can encourage customers to explore additional offerings, discover new items, and make informed purchase decisions.

You can enable and configure the Related Products feature in the system configuration :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`. For example, you can ensure that related products are automatically linked to each other, enhancing the effectiveness of product recommendations. So if a customer is viewing the standing lamp, they will see the lightning bulb as a suggested related product. Similarly, if a customer is viewing the lightning bulb, they will also see the standing lamp as a related item.

You can also control whether customers can add a related item to the shopping list directly from the view page of the product they are browsing.

.. image:: /user/img/products/recommendations/related-products-config.png
   :alt: Global related items configuration

Up-Sell Products
----------------

This feature allows sellers to leverage customers' buying intent by suggesting higher-priced or upgraded alternatives to the product they are currently viewing on the product view page. By strategically showcasing products that offer additional features, improved quality, or enhanced functionality, sellers can encourage customers to consider upgrading their purchase, ultimately increasing the average order value and maximizing revenue.

The Up-sell feature enables sellers to tap into the customer's desire for a better product or an elevated shopping experience. By presenting a more premium option, sellers can cater to varying customer needs and preferences while simultaneously boosting their sales performance.

You can enable and configure the up-sell product feature options :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`.

.. image:: /user/img/products/recommendations/up-sell-config.png
   :alt: Illustration of the related and up-sell products segments in the storefront

Featured Products
-----------------

Lastly, the featured products on the homepage feature provides sellers with an opportunity to highlight specific products on the homepage. This feature allows for strategic placement of products that are popular, on sale, or aligned with current marketing campaigns, effectively capturing the attention of customers as soon as they land on the website.

A featured products block on the storefront homepage is represented by a :ref:`segment <user-guide--business-intelligence--filters-segments>` configured to include all products that you have marked as featured on the product page in the back-office.

.. image:: /user/img/products/recommendations/is-featured.png
   :alt: Product marked as featured

.. image:: /user/img/products/recommendations/featured-segment.png
   :alt: Creating a segment with a list of all products marked as featured

Once the segment is ready, you can connect it to the storefront website :ref:`via the system configuration <sys--commerce--product--featured-products>`.

.. image:: /user/img/products/recommendations/connect-segment-to-storefront.png
   :alt: Connecting the featured segment to the storefront

.. image:: /user/img/products/recommendations/featured-products-homepage.png
   :alt: Featured segment homepage