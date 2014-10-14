===============
Sales Processes
===============

.. |B01| image:: ./img/channel_guide/Buttons/B01.png
   :align: middle
   

What Sales Processes are About
==============================
Sales Processes is a part of OroCRM responsible for automation of Business to Business workflow handling. 
This functionality provides for consistence and continuous monitoring of the sales process from initial arrangements all the way over negotiations and proposals to successfully realized opportunities. With the functionality and customizable embedded report sales managers can gain clear understanding of the specific workflows and implement more customer-oriented sales approach.


As any part of OroCRM, Sales Processes functionality is very flexible and can be tuned to correspond your specific business need. 
In fact, OroCRM may be filled with any business specific Entities and their details and Oro Platform can be used to set up a Workflow using this Entities. We have implemented such a workflow that fits general needs of B2B Sales Process management and may be used without additional tuning, without prejudice to its flexibility and scalability. 

  :Hint: OroCRM may be filled with any business specific Entities and their details and Oro Platform can be used to set up a Workflow using this Entities.  

Steps to Perform
================

As it was said above, the Sales Processes functionality is about Business to Business workflow. What do we need to create a meaningful workflow?

- Information about Channels of B2B Sales (shops, stores, retail outlets, etc.)

- Information about Leads that appear for these Channels (people/organizations that fit the Channels target-group and may make a good Opportunity)

- Information about Opportunities for these Channels (Leads for which there is a high probability of successful sales initiation)

Once these three are in the system, OroCRM provides for clear and convenient ways to input and process this information, as well as tools for its monitoring and analysis. In the following sections we shall consider, how to:

1. Populate the System with B2B Channels

2. Populate the System with Leads

3. Populate the System with Opportunities and/or Process Leads into Opportunities

4. Develop Sales Processes

5. View Sales Process details on the Dashboard.

Fill the System with B2B Channels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Channel in OroCRM represents a specific retail outlet. For each Channel there is a predefined set of entities (forms, flags, text-fields) used to collect outlet-specific data. A special type of Channels is devoted for B2B sales processing. 
To create a B2B channel go to *System --> Channels*, click |B01| button in the top right corner, and create a B2B type channel in the emerged page.
For more details on Channel creation please address our `Channels Guide </user_guide/channel_guide.rst#channel-guide>`_.

  :Note: When creating a B2B Channel Users with appropriate right can use default settings or modify B2B Customer, Lead and Opportunity forms, as well as enable/disable attachment storage within Sales Process details. This settings will then be applied for this Channel everywhere in OroCRM.

Populate the System with Leads
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are two ways to populate the system with Leads.
The shorter one, is to go to the dedicated *Sales --> Leads* section.

  :Hint: If you cannot see the section, there may be still no B2B Channels with Leads Entity assigned to them in the System. You need to F 
