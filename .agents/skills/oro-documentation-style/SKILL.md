---
name: oro-documentation-style
description: Write and review Oro product documentation following the Oro Documentation standards. Use when creating, updating, or reviewing .rst documentation files.
---

# Oro Documentation Skill

Use this skill when creating, updating, or reviewing Oro product documentation.

The authoritative standards live in four reference documents in this repository.
Read the ones relevant to your task **in full** before you start — do not rely on
this summary alone, and do not restate their rules from memory:

- **[CONTRIBUTING.md](../../../CONTRIBUTING.md)** — repository structure, topic organization, file naming, `toctree`, contribution workflow.
- **[STYLE-GUIDE.md](../../../STYLE-GUIDE.md)** — writing style, terminology, UI formatting, capitalization, screenshots, headings.
- **[RST-SYNTAX.md](../../../RST-SYNTAX.md)** — reStructuredText directives, tables, images, internal/external links, build-error troubleshooting.
- **[BUILD.md](../../../BUILD.md)** — Docker and local builds, and the isolated per-file syntax check for verifying edits quickly.

These documents are the single source of truth. If this file disagrees with a
reference document, follow the reference document.

**Never invent product details.** Do not state UI labels, navigation paths, product
behavior, configuration options, or terminology unless verifiably true about the
product. When unsure, flag it rather than guess.

## When writing or updating documentation

1. Read CONTRIBUTING.md to place the page correctly (folder, `index.rst`/`toctree`, file name).
2. Follow STYLE-GUIDE.md for terminology, UI references, navigation paths, capitalization, and headings.
3. Follow RST-SYNTAX.md for all markup.
4. Match the structure and conventions of existing nearby documentation.

Oro-specific conventions that are easy to miss (see the reference documents for details):

- External links use **named references** defined in the `include/` folder at the documentation root, not inline RST links (RST-SYNTAX.md).
- Use an em dash written as `---` between an item name and its description (STYLE-GUIDE.md).
- Highlight screenshots with `#B48C50`, and prefer native UI highlighting where possible (STYLE-GUIDE.md).

## When reviewing documentation

- Verify page placement and structure against CONTRIBUTING.md.
- Check style, terminology, and formatting against STYLE-GUIDE.md.
- Validate RST markup against RST-SYNTAX.md.
- Correct style violations directly in the file.
- Distinguish editorial issues (style, clarity, grammar) from technical inaccuracies
  (wrong product behavior or terminology); flag the latter rather than guessing.
- When a reference document conflicts with existing documentation, follow the reference
  document unless the existing page clearly reflects a newer approved convention.
