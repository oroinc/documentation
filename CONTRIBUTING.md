# Contributing to Oro Documentation

Thank you for contributing to the Oro documentation.

Documentation source files are maintained in the Oro documentation repository.

This guide explains the documentation repository structure, topic organization, file naming conventions, and workflow for creating and updating documentation.

For writing conventions and formatting rules, see:

- [STYLE-GUIDE.md](STYLE-GUIDE.md) — writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
- [RST-SYNTAX.md](RST-SYNTAX.md) — reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.


## Before You Begin

Before submitting documentation changes:

1. Make sure you have access to the documentation repository.
2. Fork the repository.
3. Clone your fork locally.
4. Review this guide, [STYLE-GUIDE.md](STYLE-GUIDE.md), and [RST-SYNTAX.md](RST-SYNTAX.md).

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](LICENSE) license.

Before submitting documentation changes in a pull request, sign the [Contributor License Agreement (CLA)](https://oroinc.com/b2b-ecommerce/contributor-license-agreement/). The CLA must be signed for any code or documentation changes to be accepted.


## Documentation Structure and Topic Organization

The documentation is organized into a tree hierarchy of sections using the `toctree` directive in `index.rst`.

Sections of the same level reside in the same folder, which simplifies navigation and sibling references.

Example file structure:

```
user/
├── index.rst
├── back-office/
│   ├── topic-1.rst
│   ├── topic-2.rst
│   ├── topic-3.rst
│   └── index.rst
├── storefront/
└── img/
    ├── create_accounts.png
    └── lead_statistics.png

backend/
├── index.rst
├── integration/
│   ├── email.rst
│   └── LDAP.rst
└── api/
    ├── firewall-authenticators.rst
    └── request-types.rst

index.rst
```

When adding new documentation:

- Identify the most appropriate location in the existing documentation hierarchy.
- Keep related topics together.
- Avoid creating new top-level sections unless required.
- Follow the structure of existing documentation nearby.


## File Naming Conventions

Follow these recommendations when naming new documentation files:

- Use a topic-based approach.

  Example:

  ```
  user-management-permissions-organization.rst
  ```

- Use lowercase letters and Arabic numbers only.
- Separate multiple words with a dash (`-`), not an underscore (`_`).
- Avoid special symbols (`/`, `$`, `#`, etc.).
- Save documentation source files with the `.rst` extension.

Examples:

Recommended:

```
file-naming-conventions.rst
payment-rules.rst
customer-groups.rst
```

Avoid:

```
File_Naming_Conventions.rst
payment_rules.rst
payment-rules!.rst
```


## Add a New Topic

To add a new documentation topic:

1. Create the topic content using reStructuredText format.
2. Save the file following the file naming conventions.
3. Add the topic to the appropriate location in the documentation hierarchy.

When creating a new page:

- Choose the correct folder based on the topic and audience.
- Add the file reference to the appropriate `index.rst` file using the `toctree` directive.

Example:

Before:

```rst
.. toctree::
   :maxdepth: 1

   price-attributes

   price-list-management
```

After:

```rst
.. toctree::
   :maxdepth: 1

   price-attributes

   price-list-management

   additional-pricelist-management-info
```

If you are adding several related topics, consider grouping them into a folder.

For better navigation, create an `index.rst` file in the new folder with an overview and references to the topics using the `toctree` directive.

Then add the new folder index to the appropriate location in the documentation hierarchy.


## Building Documentation

Build and test the documentation before submitting a pull request to make sure you have not accidentally introduced layout or formatting issues.

- Set up a local build environment by installing Docker.
- Run the following command from the documentation repository:

```bash
docker bake --load
```

By default, this command builds only the current branch.

To build documentation as it appears on the website, including version selection in the index, set the appropriate `MAINTENANCE_BRANCHES` variable.

To generate documentation in Markdown format instead of HTML, set:

```bash
BUILDER="markdown"
```

## Submit Documentation Updates

Once you are ready, create a pull request in the Oro documentation repository with changes from your forked repository.

Before submitting:

- Review your changes.
- Build and test the documentation.
- Check that links and references work correctly.
- Ensure your changes follow the [STYLE-GUIDE.md](STYLE-GUIDE.md).

After documentation review, your changes will be merged into the Oro documentation and published on the documentation website.