# Contributing to Oro Documentation

Thank you for contributing to the Oro documentation.

The documentation source files are maintained in the [Oro documentation repository](https://github.com/oroinc/documentation/).

This guide explains the documentation repository structure, topic organization, file naming conventions, and workflow for creating and updating documentation.

For writing conventions, formatting rules, and build instructions, see:

- [STYLE-GUIDE.md](STYLE-GUIDE.md) — writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
- [RST-SYNTAX.md](RST-SYNTAX.md) — reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.
- [BUILD.md](BUILD.md) — Docker and local builds, multi-version and Markdown output, and a fast syntax check of individual files.


## Before You Begin

Complete the following steps:

1. Make sure you have access to the documentation repository.
2. Fork the repository.
3. Clone your fork locally.
4. Review this guide, [STYLE-GUIDE.md](STYLE-GUIDE.md), [RST-SYNTAX.md](RST-SYNTAX.md), and [BUILD.md](BUILD.md).

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](LICENSE) license.

Sign the [Contributor License Agreement (CLA)](https://oroinc.com/b2b-ecommerce/contributor-license-agreement/) before you submit a pull request. The CLA must be signed for any code or documentation changes to be accepted.


## Documentation Structure and Topic Organization

The documentation is organized into a tree hierarchy of sections using the `toctree` directive in `index.rst`.

Sections of the same level reside in the same folder, which simplifies navigation and sibling references.

Example file structure:

```text
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
│   └── ldap.rst
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

  ```text
  user-management-permissions-organization.rst
  ```

- Use lowercase letters and Arabic numerals only.
- Separate multiple words with a dash (`-`), not an underscore (`_`).
- Avoid special symbols (`/`, `$`, `#`, etc.).
- Save documentation source files with the `.rst` extension.

Examples:

Recommended:

```text
file-naming-conventions.rst
payment-rules.rst
customer-groups.rst
```

Not recommended:

```text
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


## Build Documentation

Build and test the documentation before submitting a pull request to make sure you have not accidentally introduced layout or formatting issues.

To build the full documentation, install Docker and run the following command from the documentation repository:

```bash
docker bake --load
```

For multi-version builds, Markdown output, local builds without Docker, and a fast syntax check of individual files, see [BUILD.md](BUILD.md).


## Submit Documentation Updates

When your changes are ready, create a pull request in the Oro documentation repository with changes from your forked repository.

Before submitting:

- Review your changes.
- Build and test the documentation.
- Check that links and references work correctly.
- Make sure your changes follow [STYLE-GUIDE.md](STYLE-GUIDE.md).

If your pull request contains more than one commit, keep the history linear and give each commit a clear, descriptive message that explains what it changes. Rebase your branch on the base branch instead of merging the base branch into it, and squash intermediate commits such as "fix" or "review comments" into the commit they belong to.

After documentation review, your changes will be merged into the Oro documentation and published on the documentation website.