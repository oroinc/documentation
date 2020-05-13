.. _concept-guide--taxes:

:oro_documentation_types: OroCommerce

Tax Management
==============

An online e-commerce store can help save money on a lot of expenses, such as rent and utilities, but there are certain tax obligations that online businesses cannot escape. Running a web store requires focusing on different angles of the business, which can be quite stressful and costly, especially when it comes to understanding and managing taxes. E-commerce tax laws can seem complicated and confusing to new entrepreneurs, and they are usually advised to consult a tax specialist to ensure a full understanding of tax liabilities applied to their online business.

When you are aware of all the taxes applicable to your business, OroCommerce comes in handy, taking over your tax management headache, saving you a lot of time, and simplifying tax calculations. You can also integrate a third-party tax provider, such as |Avalara| or |Vertex|, to automate your tax workflow and manage it both within and outside the US.


Origin vs Destination Sales Tax
-------------------------------

The sales tax calculation depends on various conditions, and the tax jurisdiction base is one of them. It determines which rate (%) to consider when calculating the tax for the order. It means that you must first focus on the state where your business is registered, and whether your home state has the origin-based or destination-based sales tax.

* **Shipping origin-based sales tax**

    Shipping origin-based sales tax is the tax you collect based on the *seller's location*. Your business is the provider or the seller, so the tax rate you apply to the product must match the local rate where your business is located (i.e., your home state).

    Let’s say your business is registered in Sun City, Arizona. You have a buyer in Mohave County, Arizona. You would collect the Sun City's sales tax rate of 6.3% instead of the Mohave County's rate of 5.6% because your home state, Arizona, is origin-based.

    .. image:: /user/img/concept-guides/taxes/arizona.jpg
       :alt: Illustration of applying the tax based on the seller's location

* **Destination-based sales tax**

    Destination-based sales tax is the tax rate you collect based on the *buyer's location*. Your customer is the destination, so the tax rate you apply to the product must match the local rate where your customer is located.

    Let’s say your business is registered in Vancouver, Washington. You sell to a customer from Seattle, Washington. You would need to use Seattle’s sales tax rate of 10.10% instead of Vancouver’s sales tax rate of 8.4% since your home state, Washington, is a destination-based state.

    .. image:: /user/img/concept-guides/taxes/washington.jpg
       :alt: Illustration of applying the tax based on the buyer's location

OroCommerce enables you to define the default tax jurisdiction base for your business in the system configuration.

For the shipping origin-based states, select the related option from the list and define the address where your company is registered to find the matching :ref:`tax rule <tax-rules>` and provide appropriate tax calculation.

.. image:: /user/img/concept-guides/taxes/shipping_origin_tax.png
   :alt: Global tax jurisdiction configuration for the shipping origin-based states

For the destination-based states, select the required option in the system configuration and define the address to be considered when calculating the tax rate, either the shipping or billing address.

.. image:: /user/img/concept-guides/taxes/destination_based_tax.png
   :alt: Global tax jurisdiction configuration for the destination-based states

.. hint:: Check out the Tax Calculation topic to learn more on :ref:`tax jurisdiction configuration  <user-guide--taxes--tax-configuration>`.

Once you have defined your local tax jurisdiction, consider the other states where you have a significant presence and configure additional tax jurisdiction for them.

Remote Sellers
--------------

Aside from your home state, some other states may also require you to collect the tax based on their tax jurisdiction, mostly because you have nexus there. In this case, you are considered as a remote seller.

Usually, states require remote sellers to charge taxes at the destination rate, meaning to charge the local rate of the buyer, even if they follow an origin-based tax policy.

So, for instance, your home state is in Washington, and your inventory is in Ohio. For Ohio, you are a remote seller, so you are subject to charge the tax rate of the ship-to location, regardless of Ohio's origin-based tax rates. Make sure to consult a tax specialist for the tax rules that apply to your business.

OroCommerce enables you to add multiple tax jurisdictions to cover all possible sales tax cases. Our example with Washington and Ohio can be configured as follows:

.. image:: /user/img/concept-guides/taxes/remote_seller.png
   :alt: Global tax jurisdiction configuration for the remote sellers

Exempt Organizations and Products
---------------------------------

There are certain products and organizations that are exempt from paying taxes. However, the tax rules, as we know,  can vary from jurisdiction to jurisdiction throughout the US. Where one state does not apply tax, another state requires to pay two or more combined taxes. You will need to check |each state’s tax policy| directly to find the companies and products that are tax-free.

* **Exempt and non-exempt organizations**

Usually, all companies are obliged to pay the sales tax. However, unlike VAT, it is paid only once, when buyers purchase the finished products, so the companies that manufacture the products may not be required to pay tax on the raw materials used to create new products. Government agencies and some non-profit organizations (e.g., charity, educational, or religious) can also be tax-free.

OroCommerce enables you to create a required :ref:`customer tax code <user-guide--taxes--customer_tax_codes>`. It is a label (e.g., *exempt, non-exempt, state_government, charity_organization*, etc.) that defines the tax obligations of a particular customer or customer group. These customer tax obligations are considered when the customer places an order.

.. image:: /user/img/concept-guides/taxes/customer_tax_code_examples.png
   :alt: Illustration of applying customer tax codes to a customer
   :scale: 70%

* **Taxable and non-taxable products**

Similarly to organizations, taxable items vary from state to state, which means that items that are tax-free in some states may be subject to the sales tax elsewhere. For example, in many states, groceries and clothing are not taxable (except for luxury clothing items). Likewise, medicines and health products, magazines, digital products, and religious books are also tax-free in some states.

With OroCommerce, you can create a :ref:`product tax code label <taxes--product-tax-code>` (e.g., *taxable, non-taxable, groceries, medical_products*, etc) that would define the tax obligations of a particular customer or customer group when they purchase this product.

.. image:: /user/img/concept-guides/taxes/product_tax_code_examples.png
   :alt: Illustration of applying product tax codes to a product
   :scale: 70%

* **Digital products**

Digital products have their own place in the US tax policy. Different states impose different tax rates on *digital goods* or even no rates at all. If your home state applies a zero tax rate to digital products, then you should charge the tax rate of the customer's shipping or billing address.

Such a scenario can be implemented in OroCommerce if you create digital-related product codes, assign them to all products that you consider digital, and list all these codes in the :ref:`US Sales Tax configuration <user-guide--taxes--us>`. Once a customer purchases a digital item, the tax rate will be calculated based on the shipping destination, regardless of the global tax calculation rules.

.. image:: /user/img/concept-guides/taxes/digital_products_US.png
   :alt: Global US sales tax configuration for digital products

Whenever you sell your digital goods outside of the US (in particular to the EU), you are responsible for value-added tax (VAT). So, no matter which state you are selling the products from, you should charge the tax for digital goods based on the shipping address. For this, add all the digital product codes to the :ref:`EU VAT Tax configuration <user-guide--taxes--eu>` to calculate the tax based on the shipping destination and ignore the global tax configuration rule.

.. image:: /user/img/concept-guides/taxes/digital_products_EU_VAT.png
   :alt: Global EU VAT tax configuration for digital products

Taxes in OroCommerce
--------------------

Taxes in OroCommerce are applied to an order based on the tax rules that you configure in the application. When a customer creates an order in the storefront, OroCommerce starts searching for the appropriate tax rule in the back-office, if such is configured for the customer. The rule defines the rate that should be charged for the products listed in the order by matching the product tax code to the customer tax code and to the tax jurisdiction where the tax is due.

The main components that build a qualifying :ref:`tax rule <tax-rules>` are:

* :ref:`Customer tax code <user-guide--taxes--customer_tax_codes>` - a label assigned to a customer or customer group and defines whether the customer is exempt or non-exempt from paying the taxes and why.

* :ref:`Product tax code <taxes--product-tax-code>` - a label assigned to a group of products with similar taxation rules in at least one tax jurisdiction.

* :ref:`Tax jurisdiction <taxes--tax-jurisdiction>` - an address, usually a state in a country with defined taxation policies that determine when and how a business should pay its taxes (sales or VAT), and what rates to use, depending on the tax status of the products the business sells and the parties it sells to.

* :ref:`Tax rate <user-guide--taxes--tax-rates>` - the percentage of the sales income that should be paid as a tax in the particular tax jurisdiction for a certain type of products sold to a group of customers with the same tax status.


.. image:: /user/img/concept-guides/taxes/Orocommerce_tax_diagram.png
   :alt: Steps you need to take to create a tax rule

.. image:: /user/img/taxes/all_tax_rules.png
   :alt: A list of all tax rules that bind customer tax codes, product tax codes, tax jurisdictions, and tax rates

.. hint:: All components are mandatory for creating a tax rule.

.. _tax-concept-guide-tax-rules-in-use:

Tax Rules in Use
----------------

To illustrate a tax rule in action, let's consider the following example:

You run an online business selling taxable items in New York City. You have customers within your home state, from Los Angeles, California, and Galeton, Colorado. New York has the destination-based tax jurisdiction, so whenever a customer places the order, a tax rate is calculated based on the customer's shipping address.

.. image:: /user/img/concept-guides/taxes/NYC_example.jpg
   :alt: A visual representation of the mentioned example

Let's outline the steps that you need to take to configure the tax settings for your business in New York City:

1. Set the required tax jurisdiction for New York City in the system configuration.

.. image:: /user/img/concept-guides/taxes/tax_jurisdiction_configuration.png
   :alt: Tax jurisdiction configuration for the New York state

2. Provided that all your customers are eligible to pay taxes, and all your products are taxable, create the tax rules that match the sales scenario of your business, where each customer has the devoted tax rule based on their location.

.. image:: /user/img/concept-guides/taxes/tax_rules_steps.png
   :alt: Steps you need to take to create a tax rule and the list of the rules created based on the provided example

3. Decide whether you want to include or exclude the sales tax from product prices when displaying the products in the storefront.

    .. hint:: The setting can be toggled in the :ref:`Tax Calculation configuration <user-guide--taxes--tax-configuration>`.

           .. image:: /user/img/concept-guides/taxes/price_include_feature_toggle.png
              :alt: Toggle the feature to include or exclude the tax from product prices
              :scale: 60%

When the **tax is excluded**, all customers see the same *initial price of the product before taxes*. The tax is calculated and applied to the order at checkout based on the customer's shipping address (in our case).

So, the customer from Los Angeles who is going to submit the order for $169.58 has to pay additionally their local sales tax rate of 9.5% ($16.11) for the order total as all items in the order are taxable.

.. image:: /user/img/concept-guides/taxes/LA_customer_order.png
   :alt: The LA customer's order summary with original product prices and taxes applied separately

As for the customer from Galeton, Colorado, they have to pay an extra $4.92, based on the Galeton's local tax rate of 2.9%.

.. image:: /user/img/concept-guides/taxes/Galeton_customer_order.png
   :alt: The Galeton customer's order summary with original product prices and taxes applied separately

Sometimes, you may prefer to **include the taxes** to the product prices and display the *final price* to your customers when they browse the storefront. In this case, you have to create related price lists that would reflect the prices with taxes per each customer individually, depending on their local tax rates.

With this configuration, the order of your LA customer would look as illustrated in the picture below, where the tax is just displayed as a reference and is not charged twice. The tax ($16.11) and total order amount ($169.58) remain the same as in the order with the taxes that are excluded from product prices.

.. image:: /user/img/concept-guides/taxes/LA_customer_order_include_tax.png
   :alt: The LA customer's order summary where the product prices include taxes

Once the tax rule is matched, and all taxes are calculated, the customer can submit the order that is fully compliant with tax obligations.

**Related Topics**

* :ref:`Taxes User Guide <user-guide--taxes>`
        * :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`
        * :ref:`Product Tax Codes <taxes--product-tax-code>`
        * :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`
        * :ref:`Tax Rates <user-guide--taxes--tax-rates>`
        * :ref:`Tax Rules <tax-rules>`
* :ref:`Taxation Configuration <configuration--guide--commerce--configuration--taxation>`


.. include:: /include/include-links-user.rst
   :start-after: begin