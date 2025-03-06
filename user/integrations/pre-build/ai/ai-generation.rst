.. _integrations-ai-generation:

Integration with AI Clients: OpenAI and Vertex AI
=================================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Oro offers an out-of-the-box integration with AI services to generate content for product descriptions, landing pages, content blocks, master catalog categories, and emails. Integration brings several benefits, including improved SEO with high-quality, unique content, significant time savings in content creation, and enhanced user experiences through more informative and engaging product descriptions on the website.

Supported AI Clients and Models
-------------------------------

The AI Content Generation integration feature works with two AI clients, OpenAI and Vertex AI.

OpenAI is known for creating models like GPT-3 and GPT-4, which are large-scale, general-purpose language models that excel at natural language understanding and generation.
Vertex AI is a part of Google Cloud's suite of AI and machine learning tools and services, designed to provide a comprehensive platform for developing, deploying, and managing machine learning models.

Once the AI Content Generation integration is :ref:`configured <user-guide-ai-integrations>` in your Oro application, you can choose between the two clients and their models in the back-office system configuration settings on global and/or organization levels, for example:

* For OpenAI - *gpt-3.5-turbo, gpt-3.5-turbo-16k, gpt-4*, etc.
* For Vertex AI - *text-bison, text-bison-32k*, etc.

.. image:: /user/img/system/config_system/ai-global-settings.png
   :alt: Global AI configuration settings

OpenAI's text generation in your Oro application is flexible in length, while Vertex AI allows for precise generation of text with options for generating 500, 1000, or 2500 words.

Content Generation Options
--------------------------

When OroCommerce is integrated with AI clients such as OpenAI or Vertex AI, you can use an AI-Powered Content Assistant widget in the WYSIWYG editor to generate content for product descriptions, landing pages, content blocks, master catalog categories, and emails.

.. image:: /user/img/system/integrations/ai/ai-widget-example.png
   :alt: An illustration on an AI widget generating content using OpenAI integration.

Depending on where you use the AI generator, there may be various options available. Typically, you can select a number of tasks to perform, add features and keywords to base content, and specify the tone for the generated text.

Typical tasks and text tones may include the following:

.. csv-table::

   "Task","
    * Generate product description with a custom prompt
    * Populate short description based title, sku and other attributes
    * Generate product description with an open prompt
    * Extract product features from  the description
    * Make the description more specific by incorporating the product attributes into it
    * Shorten text
    * Expand text
    * Correct Grammar"
   "Text Tone","formal, casual, instructive, persuasive, humorous, professional, emotional, sarcastic, narrative, analytical, descriptive, informative, optimistic, cautious,reassuring, educational, dramatic, poetic, satirical"

.. image:: /user/img/integrations/wysiwyg-ai-generator.png
   :alt: Content AI generator window on a product page offering to generate product description with a custom prompt

Security Measures
-----------------

Sensitive information, such as the OpenAI token, is stored securely in encrypted form, safeguarding it from unauthorized access. No other information is kept on our servers except for the execution of requests, receipt of information, and presentation to the client. If approved by the client, the information is transferred to one of the text fields, which are then processed as usual.


**Related Articles**

* :ref:`AI Integrations in the Back-Office <user-guide-ai-integrations>`
* :ref:`Generate Content Using AI-Powered Content Assistant <getting-started-wysiwyg-editor-field-ai>`

.. include:: /include/include-links-user.rst
   :start-after: begin
