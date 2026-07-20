.. _concept-guide-cookie-consent:

Cookie Consent in OroCommerce: Guidance for Merchants
=====================================================

This document explains how OroCommerce handles cookies out-of-the-box, how additional tracking, marketing, and analytics cookies are typically introduced into a storefront, and what options merchants have for collecting and managing visitor cookie consent.

.. important:: This is general implementation guidance, not legal advice. Whether a given setup meets your obligations under GDPR, the ePrivacy Directive, UK GDPR/PECR, U.S. state privacy laws such as the CCPA/CPRA and VCDPA, Brazilian LGPD, or similar privacy, electronic communications, and online tracking laws depends on your business, your audience's location, and the specific third-party services you use. Consult your legal/privacy team to confirm your consent approach before going live.

Strictly Necessary Cookies (Default Behavior)
---------------------------------------------

Out-of-the-box, with **no external integrations enabled**, OroCommerce uses only **strictly necessary cookies** that are required for the application to function (session handling, authentication, "remember me," and CSRF protection). It does not set advertising, analytics, or other tracking cookies on its own.

In the storefront, the relevant strictly necessary cookies are:

.. csv-table:: Strictly Necessary Cookies
   :header: "Cookie","Purpose"
   :widths: 30, 70

   "``OROSFID``","Stores the storefront session for a logged-in customer user."
   "``OROSFRM``","Stores the ""remember me"" token for a customer user."
   "``customer_visitor``","Stores session data for a non-logged-in (guest) visitor."
   "``_csrf`` / ``https-_csrf``","Holds the CSRF token used to protect requests."
   "``OCXS``","Used by OroCloud for robot detection and prevention. This cookie is automatically set for applications hosted in OroCloud and is required to help protect the application from automated malicious traffic."

The back-office equivalents (``BAPID``, ``BAPRM``, ``_csrf``) apply to admin users rather than storefront visitors.

Full technical details and configuration options, including ``HttpOnly``, ``Secure``, ``SameSite``, and cookie names, are documented in :ref:`Configure Cookies <dev-guide-setup-cookies-configuration>`.

Because these cookies are strictly necessary, most privacy regimes do not require opt-in consent for them - but they do generally require that visitors be **informed** of their use.

Native Cookie Consent Banner
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To satisfy that "inform the visitor" requirement, OroCommerce ships with a simple, built-in **cookie consent banner** (the :ref:`CookieConsentBannerBundle <bundle-docs-commerce-cookie-consent-bundle>`). It:

- displays a configurable message telling visitors that cookies are used,
- provides a "Yes, Accept" button that records the visitor's acknowledgment and stops the banner from reappearing during navigation, and
- provides a configurable secondary button (by default "Cookie Policy") linking to a CMS page where you describe your cookie usage.


For more information, see :ref:`Cookie Consent Banner <frontstore-guide--cookie-banner>`.

This native banner is a **notice-and-acknowledge banner**. It informs visitors and records acceptance. It does **not**, by itself, present granular category choices (e.g., separate toggles for analytics vs. marketing) or conditionally block third-party scripts based on those choices. For a default install that uses only strictly necessary cookies, that is usually sufficient.

Tracking, Marketing, and Analytics Cookies
------------------------------------------

The situation changes as soon as you add third-party services. These typically introduce non-essential cookies (analytics, advertising, personalization) into the storefront in one of two ways:

1. **Via the Google Tag Manager (GTM) integration.** OroCommerce includes a built-in GTM integration. Once enabled, you manage third-party "tags" (essentially tracking scripts) inside GTM, including Google's own products such as Google Analytics and Google Ads, as well as many non-Google platforms.

   For configuration details, see :ref:`Configure Google Tag Manager Integration in the Back-Office <gtm-ga-4-integration>`.

2. **By inserting third-party JavaScript directly into the storefront** (not through GTM). This means placing the JS snippet or markup supplied by a marketing/analytics/ad platform directly into the frontend, for example through theme/template customization or a content block.

In both cases, the moment you introduce these services you are adding **non-essential cookies**, which in many jurisdictions require **prior, informed, opt-in consent** before they may be set. The default notice-and-acknowledge banner is generally **not** sufficient on its own for this scenario, because it neither captures granular consent nor gates the scripts on it. You will need one of the approaches below.

Approaches to Collecting Cookie Consent
---------------------------------------

There are three practical approaches. A specialized Consent Management Platform (CMP) is the recommended approach in most cases, whether or not you use GTM.

A. Specialized CMP with Google Tag Manager (recommended)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you use the GTM integration, pair it with a dedicated CMP. When working through GTM, choose one of the 40+ solutions in |Google's CMP Partner Program|, which are built and certified to work natively with GTM and Google Consent Mode.

Benefits of a specialized CMP:

- **Automatic cookie scanning, detection, and categorization.** The CMP scans your site, discovers the cookies and trackers actually in use, and sorts them into standard categories (strictly necessary, functional, analytics, marketing, etc.), so your banner stays accurate as your tag stack changes.

- **Ready-made legal templates for different use cases.** Pre-built, regularly updated consent notices and configurations aligned to GDPR, ePrivacy, CCPA/CPRA, and other frameworks, reducing the need to draft consent text from scratch.

- **Geolocation-based variations.** The consent experience adapts to where the visitor is. For example, opt-in banners for EU visitors and opt-out/notice for other regions, so you can serve a global audience with one configuration.

- **Built-in localization.** Out-of-the-box translations of the banner and preference center into many languages, matching your storefront's localizations.

- **Native GTM integration (Consent Mode).** Tags managed in GTM can be configured to fire only after the matching consent category is granted, with Google Consent Mode signals handled automatically. This gives you reliable, centralized control over which scripts run, without custom code.

The combination of GTM for tag management plus a partner CMP for consent is the cleanest path to granular, region-aware, maintainable consent.

B. Specialized CMP without Google Tag Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you are not using GTM, a specialized CMP is still the recommended approach. The same solutions listed above generally also operate in a "direct" mode without GTM: the CMP script is added directly to the storefront and manages/blocks the relevant third-party scripts itself. You keep nearly all the benefits from option A, such as automatic scanning and categorization, legal templates, geolocation variations, and localization, with the exception of the GTM-specific Consent Mode wiring. This is the right choice when you inject third-party JavaScript directly rather than through GTM.

C. Native OroCommerce or Custom Banner
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As an alternative, you can extend the built-in OroCommerce native banner, or build your own custom one, to collect consent for additional cookie categories and use that signal to control which third-party scripts are embedded. In this approach you customize the banner to present category choices and add the logic so that a given third-party script is loaded only when its category has been accepted.

Consider this option when:

- you have a small, stable set of third-party services,
- you want to avoid adding a separate CMP vendor, and
- you have development resources to build and **maintain** the categorization and script-gating logic over time.

Trade-offs versus a CMP: you take on responsibility for keeping cookie categorization accurate, for the legal wording, for any geolocation logic, for translations, and for correctly blocking/unblocking scripts. These are exactly the things a specialized CMP automates, which is why a CMP is generally preferred once you go beyond strictly necessary cookies.

Summary & Decision Guide
------------------------

.. csv-table::
   :header: "Your Situation", "Recommended Approach"
   :widths: 45, 55

   "Default install, only strictly necessary cookies","Native OroCommerce banner (notice + policy link) is generally sufficient"
   "Adding third-party tags via GTM","A - Specialized CMP from Google's CMP Partner Program, integrated with GTM Consent Mode"
   "Adding third-party scripts directly (no GTM)","B - Specialized CMP in direct mode"
   "Few, stable third-party services, legal and development teams available for the initial implementation and ongoing maintenance, prefer no extra vendors","C - Customize the native banner or build your own custom banner to capture categories and gate scripts"

In all cases, once you introduce non-essential cookies, make sure your chosen mechanism actually **prevents those cookies/scripts from loading until the matching consent is given**, and confirm the approach with your legal/privacy advisors.

.. include:: /include/include-links-user.rst
   :start-after: begin
