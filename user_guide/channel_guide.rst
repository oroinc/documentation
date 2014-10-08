Introduction
-------------
-------------
Document Scope and Target Audience
-------------
The Guide is aimed at OroCRM users and provides description of the Channel functionality and its configuration instructions. It is deemed that readers are aquainted with OroCRM and its basic Sales Process management and monitoring capabilities.

Brief System and Functionality Overview
-------------
OroCRM is an easy-to-use, open source CRM with built in marketing automation tools. One of its major privileges is extensive Sales Process management and monitoring capabilities. With OroCRM's E-commerce reports and dashboard, our users can carefully watch and effectively plan their business development. (For more details on the Sales Process management and monitoring capabilities, please reffer to the relevant document (TBD).
Obviously, even the most powerful analysis tools cannot work without initial data. The Channels functionality described herein enables population of the OroCRM with customer-related information. In OroCRM v.1.4 there are two types of channels supported:

- *Web Channels* are sharpened for Magento and provide for easy automated population of the system with customer-related details from multiple shops on Magento
- *B2B Channels* are dedicated for manual population of the system with customer-related details for B2B businesses


Channels Configuration
-------------
-------------
Getting Started
-------------
Enter the system as a User authorized to view/create/edit Channels. Go to *"System" --> "Channels"*

01
*System / Channels* page will appear. Initially the page is empty.

Click B01 button in the top right corner. *Create Channel* page will appear.

02

The page contains *General* and *Entities* tabs. 
In the *General* tab you must define three obilgatory field for your Channel:

- *Status* (1): is a dropdown with two available values:
  * *Inactive*: (default); no data will be loaded from the Channel; the option is useful if a Channel is being configured for the future use or is out of date (while no new data is uploaded to the system, all the data the appeared while the channel was active will be used by the Sales Processes functionality.

  * *Active*: data will be loaded from the Channel. 
  
- *Name* (2): is the name of the channel that will be displayed on the screen (and thus used to manage the Channel).

- *Channel Type* (3): is a dropdown with three available values:
  * *Custom*: (default); provides for ability to create Channels with specific customized settings and is subject to seperate customization and integration
  
  * *B2B*: choose the option if there is need to process B2B enterprise data. Initially, the data shall be input manually; though the system support integration with third-party enterprise systems
  
  * *Magento: choose the option if you want to upload data for further analysis and monitoring from your Magento stores. 
  
  **Please note that you can create several B2B or Magento Channels and process all the data therefrom for a single Account.**
  
  At this point you can:
  - Click BS&C button to Save the empty channel in the System.
  - Click BCancel

