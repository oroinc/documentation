# Building Oro Documentation

This guide explains how to build the Oro documentation and how to verify your changes before submitting a pull request.

For repository structure, file naming conventions, and the contribution workflow, see [CONTRIBUTING.md](CONTRIBUTING.md).

For writing and formatting conventions, see [STYLE-GUIDE.md](STYLE-GUIDE.md) and [RST-SYNTAX.md](RST-SYNTAX.md).


## Choose a Build Method

| Method | What it verifies | When to use |
|---|---|---|
| **[Docker build](#full-build-with-docker)** | Everything, with the same pinned dependency versions used to publish the site. This is the authoritative build. | Before submitting a pull request, and whenever you change navigation, references, or redirects. |
| **[Local Sphinx build](#local-build-without-docker)** | The same content and the same Oro extensions, but with whatever dependency versions your environment resolves. | While iterating. The first build is slow, but later rebuilds take seconds. |
| **[Isolated file check](#quick-syntax-check-of-edited-files)** | RST syntax, indentation, and in-page references of the files you edited. | While editing, as a fast check before running a full build. |

Approximate durations, measured on a 1643-file build using the commands in this guide:

| Build | Duration |
|---|---|
| Isolated check, two files | 1 second |
| Local build, rebuild after editing one file | 4 seconds |
| Local build, first run with an empty cache | 5 minutes |
| `docker bake --load` | 6 minutes |

The first local build is slow because Sphinx reads every source file, and passing individual file names does not avoid that. Later builds reuse the cached environment and only reprocess what changed, so the edit-and-rebuild loop stays fast once the first build is done.

The Docker build has no such incremental mode. Running it after any change rebuilds everything, reinstalling the dependencies before it starts building, so it always costs the full duration and is the slowest option. Use a local build or the isolated check while you iterate, and Docker to confirm the result.

A local `orohtml` build writes about 1.3 GB to `_build/orohtml`, and the Docker build writes about 562 MB to `_build/html`.

> **Note:** The Docker build replaces the whole `_build/` directory with the artifacts from the container, which removes the cached environment a local build keeps there. Run a Docker build after a local one and the next local build starts cold again, taking minutes rather than seconds. Build to a separate output directory if you want to keep both.


## Full Build with Docker

Install Docker, then run the following command from the documentation repository:

```bash
docker bake --load
```

To see the full build log, run the command with plain progress output:

```bash
docker buildx bake --progress plain --load
```

The build produces a Docker image and writes the built documentation to `_build/`.

By default, this command builds only the current branch.

### Build Multiple Versions

To build the documentation as it appears on the website, including version selection in the index, set the `MAINTENANCE_BRANCHES` variable to a pipe-separated list of branch names:

```bash
MAINTENANCE_BRANCHES="5.1|6.0|6.1|7.0|master" docker bake --load
```

The value must match the branch names in the repository you are building from. In the documentation repository on GitHub, the branches are named after the version.

> **Note:** For Oro internal builds, the branch names carry a `maintenance/` prefix, so use `MAINTENANCE_BRANCHES="maintenance/5.1|maintenance/6.0|maintenance/6.1|maintenance/7.0|master"`.

The variable is inserted into the `smv_branch_whitelist` regular expression in `conf.py`, which defines the maintained set and is the source of truth when the example above falls behind. A name that does not match a real branch is silently skipped rather than reported as an error.

When `MAINTENANCE_BRANCHES` is set, the build uses `sphinx-multiversion` and reads the branches from the `origin` remote, so make sure the branches you list are pushed and up to date.

When the variable is empty, a single-version build runs instead.

### Build Markdown Instead of HTML

To generate documentation in Markdown format, set the `BUILDER` variable:

```bash
BUILDER="markdown" docker bake --load
```

Supported values are `html` (default) and `markdown`.

### Preview the Result

Launch the built image as an instance and open it in a browser:

```bash
docker run --rm -p 80:80 ocir.eu-frankfurt-1.oci.oraclecloud.com/frecfpcrj6gd/oro-product-development/doc-application:latest
```


## Local Build without Docker

The Oro Sphinx extensions live in the repository under `sphinx/` and are added to the Python path by `conf.py`, so a local build works once the dependencies are installed.

`requirements.txt` does not pin Sphinx, so a local environment installs the current release, while the Dockerfile pins Sphinx 7.4.7. The two can therefore behave differently, and the Docker build is the one that matches the published site. Use a local build to iterate, and confirm the result with Docker before you submit.

1. Create a virtual environment in the documentation repository:

   ```bash
   python3 -m venv .venv
   ```

2. Install the dependencies:

   ```bash
   .venv/bin/pip install -r requirements.txt
   ```

   `requirements.txt` includes two packages installed from Git rather than PyPI, so the machine needs network access to GitHub.

3. Build the documentation:

   ```bash
   .venv/bin/python -m sphinx -b orohtml -W --keep-going -D nitpicky=1 -j auto . _build/orohtml
   ```

   The `-W`, `--keep-going`, `nitpicky`, and `-j auto` options match the single-version Docker build, so a local build that passes also passes in Docker. Drop the first three for a more forgiving build while you are still editing.

   Pass `nitpicky` as `1`, not `True`. Sphinx 9 rejects `-D nitpicky=True` with a configuration error, while the Dockerfile still accepts `True` because of its pinned version.

You can also use the supplied `Makefile`, `make.sh`, or `make.bat` wrappers. Activate the environment first with `source .venv/bin/activate`, because the wrappers call `sphinx-build` from the path:

| Target | Result |
|---|---|
| **`html`** | Standalone HTML files. |
| **`orohtml`** | Standalone HTML files with Oro requirements, with the internal search disabled. This is the builder used for the website. |
| **`orohtml-dev`** | The same as `orohtml`, with every file suffixed with `.html`. |
| **`linkcheck`** | Checks all external links for integrity. |
| **`clean`** | Removes previously generated files. |

Run `make clean` when you need to clear all build records and rebuild from scratch.


## Quick Syntax Check of Edited Files

To check the RST syntax of specific files without running a full build, build just those files in a throwaway minimal project.

This validates:

- Section title underline lengths, and list and indentation structure.
- Directives such as `code-block`, `note`, `important`, `tip`, and `include`.
- In-page references, for example ``` `Email Template Metadata`_ ```.

It does **not** exercise the Oro-specific directives, the integrity check, or PHP domain API links, and cross-page references to other documents do not resolve. Because the shared includes are stubbed, icons inserted through substitutions do not render either, so a page can look broken in the isolated check while being correct. For an authoritative check, run a full build.

### Prepare the Environment

The isolated check needs Sphinx, but not the full Oro toolchain:

```bash
python3 -m venv .venv
.venv/bin/pip install sphinx sphinxcontrib-phpdomain sphinxcontrib-jquery sphinx-copybutton
```

If you have already created `.venv` for a local build, it contains everything required.

### Run the Check

Set `FILES` to the RST files you edited, using paths relative to `documentation/`, and run the block from the documentation repository:

```bash
DOC="$PWD"
SB="$(mktemp -d)/docbuild"                 # throwaway build dir
FILES=(
  "bundles/platform/EmailBundle/email-templates-migrations.rst"
  "bundles/platform/EmailBundle/commands.rst"
)

# --- scaffold a minimal project containing only the edited files ---
mkdir -p "$SB/include"
for f in "${FILES[@]}"; do
  cp "$DOC/$f" "$SB/$(basename "$f")"
done

# minimal config: just enough to parse the directives the files use
cat > "$SB/conf.py" <<'PY'
project = 'isolated'
extensions = ['sphinxcontrib.phpdomain']
# satisfy the |business-to-business eCommerce| substitution used in some pages
rst_prolog = '.. |business-to-business eCommerce| replace:: B2B eCommerce\n'
exclude_patterns = ['_build']
PY

# stub for the shared SEO include (`.. include:: /include/include-links-seo.rst`
# with `:start-after: begin`) so isolation does not trip on it
printf '.. begin\n\nStub link section.\n' > "$SB/include/include-links-seo.rst"

# index with a toctree; also define any cross-page label the files :ref: to,
# so those references resolve in isolation (add more `.. _label:` lines as needed)
cat > "$SB/index.rst" <<'RST'
Test
====

.. _bundle-docs-platform-email-bundle-templates-attachments:

Attachments stub
----------------

.. toctree::

   email-templates-migrations
   commands
RST

# --- build and report ---
"$DOC/.venv/bin/sphinx-build" -q -b html "$SB" "$SB/_build" 2>&1 | tee "$SB/out.log"
echo "sphinx exit: ${PIPESTATUS[0]}"
echo "warnings: $(grep -cE 'WARNING|ERROR|CRITICAL' "$SB/out.log")"
```

A clean result is exit code 0 and a warning count of 0. The exit code alone is not enough: without `-W`, Sphinx reports warnings and still exits 0, so always read the warning count.

The check deliberately omits `-W`, because cross-page references cannot resolve in an isolated project and would fail the build for reasons unrelated to your edits.

If your files reference cross-page labels, either add matching `.. _label:` targets to the generated `index.rst`, or ignore warnings whose line numbers fall outside the lines you actually edited. Pre-existing cross-references do not resolve in isolation.


## Interpreting Build Output

A single-version Docker build runs Sphinx in nitpicky mode and treats warnings as errors (the `-W` flag), so a warning that a local build run without these flags ignores fails the build that publishes the site. Resolve warnings rather than ignoring them.

The same command also passes `--keep-going`, so the build reports every warning and fails at the end instead of stopping at the first one. A failing build therefore lists all the problems to fix in a single run.

Multi-version builds do not pass `-W`, so they do not fail on warnings. Use a single-version build when you want the strict check.

When a warning appears, it specifies the file name and the line number. If you do not find the error on that line, check the rows nearby — the problem may be there.

For the most common build failures and how to fix them, see [Troubleshooting Build Errors](RST-SYNTAX.md#troubleshooting-build-errors).
