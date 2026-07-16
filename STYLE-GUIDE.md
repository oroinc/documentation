# Oro Documentation Style Guide

This guide defines the writing and formatting standards for Oro documentation.

Use this guide when creating, updating, or reviewing documentation.

For repository structure, file naming conventions, and contribution workflow, see [CONTRIBUTING.md](CONTRIBUTING.md).

For reStructuredText syntax and markup examples, see [RST-SYNTAX.md](RST-SYNTAX.md).

## Writing Principles

Follow these principles when writing Oro documentation:

- Use clear, concise language.
- Use consistent terminology.
- Prefer active voice where possible.
- Avoid unnecessary words and repetition.
- Write directly for the user.
- Do not invent product behavior, UI labels, navigation paths, or configuration options.
- Follow existing documentation patterns when introducing new content.

## Interface Elements

Use **bold** formatting when referring to UI elements.

Examples:

- Click **Save**.
- Open the **Settings** tab.
- Select **Create New User**.

## Navigation Paths

Use the `>` symbol to separate menu levels.

Format menu routes in **bold**.

Example:

```
Navigate to **System > Channels**.
```

## Terminology

Use the following terminology consistently.

### Back-office

Use **back-office** when referring to the Oro administration interface.

Example:

> Configure the settings in the back-office.

### Storefront

Use **storefront** when referring to the customer-facing interface.

Example:

> Customers can manage their orders in the storefront.

### Items with Descriptions

Use an em dash (`---`) between the item name and its description.

Example:

```rst
- **Inbox** --- Contains newly delivered emails.
- **Sent Mail** --- Contains sent emails.
```

## Capitalization

Capitalize:

- Proper nouns
- Product names
- Brand names
- Company names
- Organizations
- Days and months
- Abbreviations (URL, CSV)

Do not capitalize:

- General terms
- Concepts
- Feature names unless they are official product names

Avoid unnecessary capitalization in the middle of sentences.

## Images and Alt Text

Always provide meaningful alternative text for images.

Example:

```rst
.. image:: ../img/entity_management/entity_create1.png
   :alt: A new entity creation page
```

The alt text should describe the image content in a human-readable way.

## Headings

Use meaningful headings.

Follow the existing heading structure in the documentation.

Avoid numbered headings, for example:

```
1.2.4 Creating Users
```

Use descriptive headings instead:

```
Create Users
```

## Meta Titles and Descriptions

Use page titles and descriptions to improve documentation searchability.

Example:

```rst
:title: Activities Management in OroCommerce and OroCRM

.. meta::
   :description: Tasks, calls, cases, calendar events, and contact requests management guides for OroCommerce back-office users
```

## Local Table of Contents

The documentation supports a local table of contents on the right side of the page.

To hide it, add:

```rst
:oro_show_local_toc: false
```

## Screenshots

When adding screenshots:

- Keep the screenshot focused on the relevant UI.
- Avoid unnecessary empty space.
- Highlight important UI elements using the standard Oro highlight color: `#B48C50`.
- Prefer native UI highlighting where possible.

## Testing Documentation

Before submitting documentation changes:

- Review the page for consistency with this style guide.
- Check terminology and capitalization.
- Verify UI references and navigation paths.
- Check links and references.
- Search for common style issues before submitting the pull request.
