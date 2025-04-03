.. _integrations-ai-generation:

Integration with AI Clients: Open AI and Vertex AI
==================================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Oro offers integration with AI services to generate content for product descriptions, landing pages, content blocks, master catalog categories, and emails. Integration brings several benefits, including improved SEO with high-quality, unique content, significant time savings in content creation, and enhanced user experiences through more informative and engaging product descriptions on the website.

Supported AI Clients and Models
-------------------------------

The AI Content Generation integration feature works with two AI clients, Open AI and Vertex AI.

OpenAI is known for creating models like GPT-3 and GPT-4, which are large-scale, general-purpose language models that excel at natural language understanding and generation.
Vertex AI is a part of Google Cloud's suite of AI and machine learning tools and services, designed to provide a comprehensive platform for developing, deploying, and managing machine learning models.

Once the AI Content Generation integration is installed for your Oro application, you can choose between the two clients and their models in the back-office configuration settings (on global and/or organization :ref:`levels <mc-system-configuration>`):

* For Open AI, these are *gpt-3.5-turbo, gpt-3.5-turbo-16k, gpt-4*, and others.
* For Vertex AI, these are *text-bison, text-bison-32k, text-bison@001*.

.. image:: /user/img/integrations/ai-generation-settings.png
   :alt: AI generation settings for Open AI and Vertex AI in the Oro back-office

OpenAI's text generation in your Oro application is flexible in length, while Vertex AI allows for precise generation of text with options for generating 500, 1000, or 2000 words.

Content Generation Options
--------------------------

There are two ways to generate content in your WYSIWYG editor for product descriptions, landing pages, content blocks, and master catalog categories: via a button at the top or a :ref:`WYSIWYG function <getting-started-wysiwyg-editor-field>` on the right.

In addition to generating simple text, you also have an option to generate text with HTML tags, producing content with HTML markup for formatting and structuring web content. This option can be enabled in the configuration settings on the Oro back-office.

You can also generate text for emails using keywords and/or the subject of the email.

.. image:: /user/img/integrations/emails-ai-generator.png
   :alt: Illustration of the AI generator feature in an email window

Depending on where you use the AI generator, there may be various options available. Typically, you can select a number of tasks to perform, add features and keywords to base content, and specify the tone for the generated text.

Typical tasks and text tones are listed below:

.. csv-table::

   "Task","
    * Generate product description with a custom prompt
    * Populate short description based on long description
    * Populate long description based on short description, product title, and other product attributes
    * Extract product attributes from description
    * Shorten text
    * Expand text
    * Correct Grammar"
   "Text Tone","formal, casual, instructive, persuasive, humorous, professional, emotional, sarcastic, narrative, analytical, descriptive, informative, optimistic, cautious,reassuring, educational, dramatic, poetic, satirical"

.. image:: /user/img/integrations/wysiwyg-ai-generator.png
   :alt: Content AI generator window on a product page offering to generate product description with a custom prompt

Security Measures
-----------------

Sensitive information, such as the OpenAI token, is stored securely in encrypted form, safeguarding it from unauthorized access. No other information is kept on our servers except for the execution of requests, receipt of information, and presentation to the client. If approved by the client, the information is transferred to one of the text fields, which are then processed as usual.

**Related Topics**

* :ref:`Configure AI Integrations in the Back-Office <user-guide-ai-integrations>`

.. include:: /include/include-links-user.rst
   :start-after: begin
