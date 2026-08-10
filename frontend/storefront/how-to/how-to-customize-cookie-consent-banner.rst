.. _frontend--how-to-customize-cookie-consent-banner:

How to Customize the Cookie Consent Banner
==========================================

OroCommerce provides a built-in :ref:`cookie consent banner <frontstore-guide--cookie-banner>` through the :ref:`CookieConsentBannerBundle <bundle-docs-commerce-cookie-consent-bundle>`. The banner displays a short message, an accept button, and a link to the cookie policy page.

Use this article to learn how to change the banner text, appearance, markup, and behavior. The final example extends the banner to enable visitors to choose which cookies they accept.

.. note:: Before you start, :ref:`set up the development environment <dev-guide-development-practice-setup-dev-env>` with your own custom bundle, and :ref:`create a storefront theme <dev-doc-frontend-layouts-theming-definition>`.

.. note:: The examples use the following placeholders:

   * ``{BundleName}`` --- the path to your bundle in the ``src`` folder (for example, ``Custom/Bundle/ThemeBundle``).
   * ``{bundle_name}`` --- the name of the folder under ``public/bundles/`` where the assets of your bundle are published. The name is based on the bundle class name without the ``Bundle`` suffix and is written in lowercase. For example, use ``customtheme`` for ``CustomThemeBundle``.
   * ``{theme_name}`` --- the identifier of your storefront theme.

Change the Text
---------------

The title, text, and policy page link are set in the back-office, under **System > Configuration > Commerce > Customer > Customer Users > Cookies Banner**. No code is needed. See :ref:`Cookie Consent Banner <frontstore-guide--cookie-banner>` for details.

The accept button label and the ARIA labels come from translations. To change them, override the keys in your bundle:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/translations/jsmessages.en.yml

    oro_cookie_banner:
        accept_button:
            label: "Accept All"
            aria_label: "Accept all cookies and close the cookie banner"
        close:
            aria_label: "Close the cookie banner"

.. important:: The override takes effect only if your bundle loads **after** ``OroCookieConsentBundle`` (priority ``1000``). Set a higher priority in your ``bundles.yml``:

   .. code-block:: yaml
      :caption: src/{BundleName}/Resources/config/oro/bundles.yml

       bundles:
           - { name: Custom\Bundle\ThemeBundle\CustomThemeBundle, priority: 2100 }

Then reload and re-dump the translations:

.. code-block:: none

    php bin/console cache:clear
    php bin/console oro:translation:load
    php bin/console oro:translation:dump

Change the Styles
-----------------

The banner styles are SCSS variables. They are located in ``variables/cookie-banner-view-config.scss`` in ``OroCookieConsentBundle``. Each style  uses the ``!default`` flag, so your theme can override it.

Set your own values in a variables file in your bundle:

.. code-block:: scss
   :caption: src/{BundleName}/Resources/public/{theme_name}/scss/variables/custom-cookie-banner-view-config.scss

    $cookie-banner-view-background-color: get-var-color('primary', 'main');
    $cookie-banner-view-border-radius: 0;

Register the file in the ``styles`` group of your theme's ``assets.yml``:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/assets.yml

    styles:
        inputs:
            - 'bundles/{bundle_name}/{theme_name}/scss/variables/custom-cookie-banner-view-config.scss'

Then rebuild the theme:

.. code-block:: none

    php bin/console assets:install --symlink
    php bin/console cache:clear
    php bin/console oro:assets:build {theme_name}

See :ref:`Stylesheets (SCSS) <dev-doc-frontend-css>` for more on the theme CSS structure.

Change the Markup
-----------------

The cookie consent banner markup uses an Underscore template, which is an HTML template with embedded JavaScript expressions. The file is ``orocookieconsent/templates/cookie-banner-view.html``. To change the banner markup, create your own template and map it to the default template in your theme's ``jsmodules.yml``:

.. code-block:: none
   :caption: src/{BundleName}/Resources/public/templates/cookie-banner-view.html

    <% let oroui = _.macros('oroui') %>
    <div class="cookie-banner-view__inner-container" data-skip-focus-decoration tabindex="0" data-bottom-bar="">
        <div class="cookie-banner-view__content cms-typography">
            <p class="h4 cookie-banner-view__title"><%= bannerTitle %></p>
            <div class="cookie-banner-view__description">
                <span class="cookie-banner-view__text">
                    <%= bannerText %>
                    <% if (!_.isEmpty(landingPageHref) && !_.isEmpty(landingPageLabel)) { %>
                        <a class="inverse" href="<%- landingPageHref %>" target="_blank">
                            <%- landingPageLabel %>
                        </a>
                    <% } %>
                </span>
                <div class="cookie-banner-view__actions">
                    <button data-action="accept" class="btn btn--inverse text-nowrap"
                            aria-label="<%- _.__('oro_cookie_banner.accept_button.aria_label') %>">
                        <%- bannerButtonLabel %>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn--simple-colored-inverse close-dialog absolute" data-role="close" title="<%- _.__('Close') %>"
            aria-label="<%- _.__('oro_cookie_banner.close.aria_label') %>">
        <%= oroui.renderIcon({name: 'close', extraClass: 'theme-icon--medium'}) %>
    </button>

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/jsmodules.yml

    map:
        '*':
            orocookieconsent/templates/cookie-banner-view.html: '{bundle_name}/templates/cookie-banner-view.html'

The template receives ``bannerTitle``, ``bannerText``, ``bannerButtonLabel``, ``landingPageHref``, and ``landingPageLabel``. Keep the ``[data-action="accept"]`` and ``[data-role="close"]`` attributes - the view binds to them.

Then rebuild the theme:

.. code-block:: none

    php bin/console assets:install --symlink
    php bin/console cache:clear
    php bin/console oro:assets:build {theme_name}

Change the Behavior
-------------------

To change the way the banner works, extend ``CookieBannerView`` and map your module to the default module:

.. code-block:: javascript
   :caption: src/{BundleName}/Resources/public/js/views/custom-cookie-banner-view.js

    import CookieBannerView from 'orocookieconsent/js/views/cookie-banner-view';

    const CustomCookieBannerView = CookieBannerView.extend({
        constructor: function CustomCookieBannerView(options) {
            CustomCookieBannerView.__super__.constructor.call(this, options);
        },

        onClose() {
            CustomCookieBannerView.__super__.onClose.call(this);

            // Persist the dismissal so the banner does not reappear on every page
            localStorage.setItem(this.storageKey, true);
        }
    });

    export default CustomCookieBannerView;

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/jsmodules.yml

    map:
        '*':
            orocookieconsent/js/views/cookie-banner-view: '{bundle_name}/js/views/custom-cookie-banner-view'
        '{bundle_name}/js/views/custom-cookie-banner-view':
            orocookieconsent/js/views/cookie-banner-view: orocookieconsent/js/views/cookie-banner-view

.. note:: The second ``map`` entry keeps the original module reachable from your view. Without this entry, the import in your file would resolve to itself.

Then rebuild the theme:

.. code-block:: none

    php bin/console assets:install --symlink
    php bin/console cache:clear
    php bin/console oro:assets:build {theme_name}

Move or Remove the Banner
-------------------------

The banner is added to every storefront page as the ``banner_content`` block. Use :ref:`layout update <dev-doc-frontend-layouts-layout>` to move or remove it. For example, to remove it from the customer login page:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/oro_customer_customer_user_security_login/remove_banner.yml

    layout:
        actions:
            - '@remove':
                id: banner_content

Example: Let Visitors Choose Which Cookies They Accept
------------------------------------------------------

This example adds category checkboxes to the banner and saves the choice so other scripts can read it. It is a minimal version of the *Native OroCommerce or Custom Banner* approach from the :ref:`Cookie Consent concept guide <concept-guide-cookie-consent>`.

.. image:: /user/img/storefront/how_to_customize_cookie_consent_banner/cookie_banner_categories.png
   :alt: The cookie consent banner extended with the Strictly necessary, Analytics, and Marketing checkboxes, and the Accept Necessary and Accept All buttons

.. important:: The choice is saved in the browser's local storage, so it is per-browser. The default banner uses a server-side flag that follows the customer across devices. To keep the two consistent, the last step switches the banner to a per-browser model.

**1. Add the checkboxes to the template** --- The **Strictly necessary** checkbox is informational, so it has no ``data-role="category"`` attribute:

.. code-block:: none
   :caption: src/{BundleName}/Resources/public/templates/cookie-banner-view.html

    <% let oroui = _.macros('oroui') %>
    <div class="cookie-banner-view__inner-container" data-skip-focus-decoration tabindex="0" data-bottom-bar="">
        <div class="cookie-banner-view__content cms-typography">
            <p class="h4 cookie-banner-view__title"><%= bannerTitle %></p>
            <div class="cookie-banner-view__description">
                <span class="cookie-banner-view__text">
                    <%= bannerText %>
                    <% if (!_.isEmpty(landingPageHref) && !_.isEmpty(landingPageLabel)) { %>
                        <a class="inverse" href="<%- landingPageHref %>"><%- landingPageLabel %></a>
                    <% } %>
                </span>
                <div class="cookie-banner-view__categories">
                    <label class="checkbox-label">
                        <input type="checkbox" checked disabled>
                        <%- _.__('custom.cookie_banner.category.necessary') %>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" data-role="category" value="analytics">
                        <%- _.__('custom.cookie_banner.category.analytics') %>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" data-role="category" value="marketing">
                        <%- _.__('custom.cookie_banner.category.marketing') %>
                    </label>
                </div>
                <div class="cookie-banner-view__actions">
                    <button data-action="reject" class="btn btn--outlined-inverse text-nowrap"
                            aria-label="<%- _.__('custom.cookie_banner.reject_button.aria_label') %>">
                        <%- _.__('custom.cookie_banner.reject_button.label') %>
                    </button>
                    <button data-action="accept" class="btn btn--inverse text-nowrap"
                            aria-label="<%- _.__('oro_cookie_banner.accept_button.aria_label') %>">
                        <%- bannerButtonLabel %>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn--simple-colored-inverse close-dialog absolute" data-role="close" title="<%- _.__('Close') %>"
            aria-label="<%- _.__('oro_cookie_banner.close.aria_label') %>">
        <%= oroui.renderIcon({name: 'close', extraClass: 'theme-icon--medium'}) %>
    </button>

**2. Style the list** --- Stack the checkboxes and add spacing:

.. code-block:: scss
   :caption: src/{BundleName}/Resources/public/{theme_name}/scss/components/custom-cookie-banner-categories.scss

    .cookie-banner-view__description {
        gap: spacing('lg');
    }

    .cookie-banner-view__categories {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: spacing('sm');
        margin-block: spacing('sm');

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: spacing('sm');
            white-space: nowrap;
        }
    }

    .cookie-banner-view__actions {
        display: flex;
        gap: spacing('sm');
    }

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/assets.yml

    styles:
        inputs:
            - 'bundles/{bundle_name}/{theme_name}/scss/components/custom-cookie-banner-categories.scss'

**3. Store the choice** --- Extend the view. Both buttons call ``applyConsent``: **Accept All** passes the checked categories, **Accept Necessary** passes an empty list. A stored choice also hides the banner on the next visit:

.. code-block:: javascript
   :caption: src/{BundleName}/Resources/public/js/views/custom-cookie-banner-view.js

    import mediator from 'oroui/js/mediator';
    import CookieBannerView from 'orocookieconsent/js/views/cookie-banner-view';

    const CATEGORIES_STORAGE_KEY = 'acceptedCookieCategories';

    const CustomCookieBannerView = CookieBannerView.extend({
        events: {
            'click [data-action="reject"]': 'onReject'
        },

        constructor: function CustomCookieBannerView(options) {
            CustomCookieBannerView.__super__.constructor.call(this, options);
        },

        initialize(options) {
            if (localStorage.getItem(CATEGORIES_STORAGE_KEY) !== null) {
                this.dispose();
                return;
            }

            CustomCookieBannerView.__super__.initialize.call(this, options);
        },

        onAccept() {
            const acceptedCategories = this.$('[data-role="category"]:checked')
                .map((index, checkbox) => checkbox.value)
                .get();

            this.applyConsent(acceptedCategories);
        },

        // Strictly necessary cookies do not require consent, so rejecting stores an empty list
        onReject() {
            this.applyConsent([]);
        },

        applyConsent(acceptedCategories) {
            mediator.trigger('cookie-consent:accepted', acceptedCategories);

            CustomCookieBannerView.__super__.onAccept.call(this);

            localStorage.setItem(CATEGORIES_STORAGE_KEY, JSON.stringify(acceptedCategories));
        }
    });

    export default CustomCookieBannerView;

**4. Show the banner in every browser** --- By default, the platform hides the banner once the server-side ``cookiesAccepted`` flag is set. That flag follows the customer across devices, but the stored categories do not. Make the banner depend only on the **Show Banner** option instead:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/cookie_banner_visibility.yml

    layout:
        actions:
            - '@setOption':
                id: banner_content
                optionName: visible
                optionValue: '=data["system_config_provider"].getValue("oro_cookie_consent.show_banner")'

Now the banner shows in every browser until the visitor makes a choice there. The ``initialize`` method from step 3 hides it once a choice is stored.

**5. Register everything** --- Map both files and add the labels:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/jsmodules.yml

    map:
        '*':
            orocookieconsent/js/views/cookie-banner-view: '{bundle_name}/js/views/custom-cookie-banner-view'
            orocookieconsent/templates/cookie-banner-view.html: '{bundle_name}/templates/cookie-banner-view.html'
        '{bundle_name}/js/views/custom-cookie-banner-view':
            orocookieconsent/js/views/cookie-banner-view: orocookieconsent/js/views/cookie-banner-view

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/translations/jsmessages.en.yml

    custom:
        cookie_banner:
            category:
                necessary: "Strictly necessary"
                analytics: "Analytics"
                marketing: "Marketing"
            reject_button:
                label: "Accept Necessary"
                aria_label: "Accept only strictly necessary cookies and close the cookie banner"

Then rebuild the assets:

.. code-block:: none

    php bin/console assets:install --symlink
    php bin/console cache:clear
    php bin/console oro:translation:dump
    php bin/console oro:assets:build {theme_name}

.. note:: The ``acceptedCookieCategories`` local storage key and the ``cookie-consent:accepted`` event are **not** platform APIs. They are names defined by this example. You can use different names, but the code that stores the consent choice and the code that reads it must use the same values.

Other scripts can now read the accepted categories from local storage and react to the ``cookie-consent:accepted`` event. See :ref:`How to Add Third-Party Scripts to Storefront Pages <frontend--how-to-add-third-party-scripts-to-storefront>` for details on how to load a script only after its category is accepted.

**Related Articles**

* :ref:`Cookie Consent in OroCommerce: Guidance for Merchants <concept-guide-cookie-consent>`
* :ref:`Cookie Consent Banner (User Documentation) <frontstore-guide--cookie-banner>`
* :ref:`How to Add Third-Party Scripts to Storefront Pages <frontend--how-to-add-third-party-scripts-to-storefront>`
* :ref:`Layouts <dev-doc-frontend-layouts-layout>`
* :ref:`JS Modules Configuration <reference-format-jsmodules>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
