Recipients Autocompletion
=========================

Add Additional Recipients in Autocompletion
-------------------------------------------

* create provider implementing ``Oro\Bundle\EmailBundle\Provider\EmailRecipientsProviderInterface``

  * it has 2 methods

    * getSection

      * returns translation key of section in select where recipients from the provider will be placed

    * getRecipients

      * return associative array where key is email address and value is email address with name

      * its argument ``EmailRecipientsProviderArgs`` contains

        * relatedEntity - object from which email is being send
        * limit - maximum number of emails which should be returned from the provider
        * query - string writte by user when typing email address/name
        * excludedEmails - emails returned by previously executed providers

* tag provider with the ``oro_email.recipients_provider`` tag

Useful Classes
--------------

* ``Oro\Bundle\EmailBundle\Provider\RelatedEmailsProvider`` extracts emails from the given object and its relations
* EmailRecipientsHelper helps to filter given emails
