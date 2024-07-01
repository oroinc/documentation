.. _user-guide-ai-integrations:

Configure AI Integrations in the Back-Office
============================================

.. note:: This feature is available as of OroCommerce version 5.1.8.

In OroCommerce, you can integrate AI solutions to simplify the generation of content for product descriptions, landing pages, content blocks, master catalog categories, and emails. Integrating AI clients provides several key benefits, including saving time and resources by quickly creating high-quality, engaging content. This allows your team to focus on strategic tasks. It also improves consistency and creativity across all marketing materials, ensuring a unified brand voice.

Supported Clients
-----------------

OroCommerce integrates with two AI clients, OpenAI and Vertex AI.

**OpenAI** is a leading artificial intelligence research lab known for its advanced language models, such as GPT, which can generate human-like text based on given prompts. **Vertex AI**, a product from Google Cloud, provides a comprehensive platform for building, deploying, and scaling machine learning models.

The AI Content Generation feature incorporates an AI-powered Content Assistant widget into :ref:`WYSIWYG fields <getting-started-wysiwyg-editor-field-ai>` throughout the OroCommerce back-office. The widget allows users to generate content by providing custom prompts, ensuring grammatical accuracy, expanding or condensing text, and adjusting the tone of the produced content to suit specific needs, whether formal, analytical, educational, casual, or otherwise.

Below is an example of a product description generated using the integration with OpenAI, followed by Vertex AI.

.. image:: /user/img/system/integrations/ai/ai-widget-example.png
   :alt: An illustration on an AI widget generating content using OpenAI integration.

.. image:: /user/img/system/integrations/ai/vertex-widget-example.png
   :alt: An illustration on an AI widget generating content using Vertex AI integration

OpenAI’s text generation in your Oro application offers flexibility in length, while Vertex AI provides precise control with options for generating text in specific lengths of 500, 1000, or 2500 words.

Create Integration with OpenAI
------------------------------

To create an integration with OpenAI as the AI content generator of choice:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** on the top right and provide the following information:

   .. csv-table::
      :widths: 10, 30

      "**Type**","Select *OpenAI* as the integration type you are creating."
      "**Name**","Provide the name for the integration you are creating to refer to it in the Oro application."
      "**Label**","Provide a name that will be displayed as a choice of AI Generator selector in the :ref:`System Configuration <admin-configuration-ai-integration-settings>`."
      "**Token**","Provide a token generated on the page of |OpenAI API Keys|."
      "**Model**","Select the model that will generate the result, e.g., gpt-3.5-turbo. Click **Check OpenAI Connection** to make sure the connection has been established successfully."
      "**Default Owner**","Select the owner of the integration."

.. image:: /user/img/system/integrations/ai/open-ai.png
   :alt: OpenAI integration settings page

3. Click **Save and Close**.

Create Integration with Vertex AI
---------------------------------

To create and integration with Vertex AI as the AI content generator of choice:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** on the top right and provide the following information.

   .. csv-table::
      :widths: 10, 30

      "**Type**","Select *VertexAI* as the integration type you are creating."
      "**Name**","Provide the name for the integration you are creating to refer to it in the Oro application."
      "**Label**","Provide a name that will be displayed as a choice of AI Generator selector in the :ref:`System Configuration <admin-configuration-ai-integration-settings>`."
      "**Config File**","Upload here google service account json config file. Ensure that all needed permissions are added to that account."
      "**API Endpoint**","Use the Endpoint value from the VertexAI text playground."
      "**Project ID**","Use the ProjectID value from the VertexAI text playground."
      "**Location**","Use the Location value from the VertexAI text playground"
      "**Model**","Select the model that will generate the result, e.g., text-bison@001. Click **Check Vertex AI Connection** to make sure the connection has been established successfully."
      "**Default Owner**","Select the owner of the integration."

.. image:: /user/img/system/integrations/ai/vertex-ai.png
   :alt: Vertex AI integration settings page

3. Click **Save and Close**.

Configure AI Content Generation in the System Configuration
-----------------------------------------------------------

Once the integration with the chosen AI client is created and established, you can configure AI integration settings in the system configuration :ref:`globally <admin-configuration-ai-integration-settings>` and :ref:`per organization <organization-ai-settings>`. The configured AI client will be used to generate content throughout the application. Be aware that AI Content Generation feature requires data from your website to be used by a third party to generate content.

Use AI Content Generation in WYSIWYG Editor
-------------------------------------------

When OroCommerce is integrated with AI clients such as OpenAI or Vertex AI, you can use an AI-Powered Content Assistant widget in the WYSIWYG editor to generate content for product descriptions, landing pages, content blocks, master catalog categories, and emails.

For more information, see :ref:`Generate Content Using AI-Powered Content Assistant <getting-started-wysiwyg-editor-field-ai>`.


.. include:: /include/include-links-user.rst
   :start-after: begin