# OroCommerce Documentation Source

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](./LICENSE) license.

The documentation is published at https://doc.oroinc.com/.

A Markdown export of the documentation is available at https://github.com/oroinc/documentation-markdown.

For recommendations on how to set up your local environment to build documentation, follow the community guide on the [Oro Inc documentation website](https://doc.oroinc.com/master/community/contribute/documentation/).

Before contributing, see:

- [CONTRIBUTING.md](CONTRIBUTING.md) — repository structure, topic organization, file naming, and the contribution workflow.
- [STYLE-GUIDE.md](STYLE-GUIDE.md) — writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
- [RST-SYNTAX.md](RST-SYNTAX.md) — reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.
- [BUILD.md](BUILD.md) — building the documentation, multi-version and Markdown builds, and verifying changes before submitting them.

## Build

To build the documentation, install Docker and run the following command from this directory:

```bash
docker bake --load
```

The build produces a Docker image and writes the built documentation to `_build/`.

For multi-version builds, Markdown output, local builds without Docker, previewing the result, and troubleshooting build failures, see [BUILD.md](BUILD.md).
