.. _bundle-docs-extensions-ai-content-generation:

OroAiContentGenerationBundle
============================

.. note:: OroAiContentGenerationBundle is available as of OroCommerce version 5.1.8.

OroAiContentGenerationBundle provides integrations with Open AI and Vertex AI to generate content.

Configuration
-------------

To use AI Content Generation, first configure :ref:`integration in the back-office <integrations-ai-generation>`.

Technical Components
--------------------

1. Integration types (Open AI and Vertex AI):

   - ``Oro\Bundle\AiContentGenerationBundle\Integration\OpenAiChannel``
   - ``Oro\Bundle\AiContentGenerationBundle\Integration\OpenAiTransport``
   - ``Oro\Bundle\AiContentGenerationBundle\Integration\VertexAiChannel``
   - ``Oro\Bundle\AiContentGenerationBundle\Integration\VertexAiTransport``

2. AI Content Generation factories:

   - ``Oro\Bundle\AiContentGenerationBundle\Factory\ContentGenerationOpenAiClientFactory``
   - ``Oro\Bundle\AiContentGenerationBundle\Factory\ContentGenerationVertexAiClientFactory``
   - ``Oro\Bundle\AiContentGenerationBundle\Factory\ContentGenerationClientFactory`` - the general factory that builds Content Generation Client based on the chosen integration in the system configuration.

3. AI Content Generation clients:

   - ``Oro\Bundle\AiContentGenerationBundle\Client\ContentGenerationOpenAiClient``
   - ``Oro\Bundle\AiContentGenerationBundle\Client\ContentGenerationVertexAiClient``

4. AI Content Generation features:

   - ``oro_ai_content_generation``
   - ``Oro\Bundle\AiContentGenerationBundle\Feature\Voter\FeatureVoter`` - used to control access to AI features and to display AI Content Assistant icons for Wysiwyg and TinyMCE.

5. AI Content Generation tasks:

   - ``Oro\Bundle\AiContentGenerationBundle\Task\TaskInterface`` - represents tasks with specific phrases or predefined content that a user can choose for generation content.
   - ``Oro\Bundle\AiContentGenerationBundle\Task\OpenPromptTaskInterface`` - represents tasks with user predefined content.

Troubleshooting
---------------

1. If generated content is not completed you can increase the preferred size of the content and click on the button "Generate" to get a new result.

2. Please be aware that OpenAI-generated results may be incomplete due to the chat mechanism. If the full result isn't generated on the first try, we will send additional requests (up to 5 by default) to complete the result and provide you with the finished value. This also means that more credits may be used to generate the result than expected based on the Content size field.
