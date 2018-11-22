.. _dev-cookbook-front-ui-css-remove-files:

How to Remove Unnecessary Oro Files in Storefront
=================================================

Remove all ``scss/css``: all themes use styles registered in this theme
and from parent themes. You cannot change this behavior without changes
in assets build logic. To remove all assets, override the
``oro_layout.assetic.layout_resource`` service in your bundle and
customize assets collect logic.
