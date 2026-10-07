---
name: oro-documentation-style
description: Write and review Oro product documentation following the Oro Documentation standards. Use when creating, updating, or reviewing .rst documentation files.
---

# Oro Documentation Skill

Use this skill when creating, updating, rewriting, or reviewing Oro product documentation.

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
product. When unsure, flag the detail rather than guess.

## When writing or updating documentation

1. Read CONTRIBUTING.md to place the page correctly (folder, `index.rst`/`toctree`, file name).
2. Follow STYLE-GUIDE.md for writing style, terminology, UI references, navigation paths, capitalization, and headings.
3. Follow RST-SYNTAX.md for all markup.
4. Match the structure and conventions of existing nearby documentation.

Oro-specific conventions that are easy to miss (see the reference documents for details):

- Write one idea per sentence. Split sentences that join several facts with colons, semicolons, or dashes (STYLE-GUIDE.md, Core Writing Principles).
- Replace the words listed in Product Terms and Word Usage, such as *serve*, *ship*, *land*, and *tarball*, with the recommended plain terms (STYLE-GUIDE.md).
- Write full command names, such as `pnpm preview`, not `preview`, and name the object type, such as *the `.output` directory* (STYLE-GUIDE.md, Commands, Code, and Files).
- External links use **named references** defined in the `include/` folder at the documentation root, not inline RST links (RST-SYNTAX.md).
- Use an em dash written as `---` between an item name and its description (STYLE-GUIDE.md).
- In a notice that describes a problem, state what happens, why, and what the reader must do (STYLE-GUIDE.md, Notices and Supporting Content).
- Highlight screenshots with `#B48C50`, and prefer native UI highlighting where possible (STYLE-GUIDE.md).


## When reviewing or rewriting documentation

- Verify page placement and structure against CONTRIBUTING.md.
- Check style, terminology, and formatting against STYLE-GUIDE.md.
- Validate RST markup against RST-SYNTAX.md.
- Correct style violations directly in the file.
- Read the result as a first-time reader. If a sentence needs re-reading, rewrite it.
- Search the text for the words listed in Product Terms and Word Usage.
- Check that commands, flags, types, and imports in code examples are correct. Flag a code example that does not work rather than silently changing its behavior.
- Check that versions, file names, and descriptions match across related documents, and flag mismatches.
- Distinguish editorial issues (style, clarity, grammar) from technical inaccuracies
  (wrong product behavior, commands, or terminology). Flag technical inaccuracies rather than guessing.
- When a reference document conflicts with existing documentation, follow the reference
  document unless the existing page clearly reflects a newer approved convention.
