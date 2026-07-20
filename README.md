# OroCommerce Documentation Source

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](./LICENSE) license.

Documentation is published at https://doc.oroinc.com/.

For the recommendations on how to set up your local environment to build documentation, follow the community guide on the [Oro Inc documentation website](https://doc.oroinc.com/master/community/contribute/documentation/):

For writing conventions and formatting rules, see:

- [STYLE-GUIDE.md](STYLE-GUIDE.md) — writing style, terminology, UI formatting, screenshots, capitalization, links, and editorial conventions.
- [RST-SYNTAX.md](RST-SYNTAX.md) — reStructuredText syntax, directives, metadata, images, tables, notes, references, and other markup used throughout the documentation.

## Build

```
docker buildx bake --progress plain --load
```

As a result, an image and a ./_build folder will be created where the built documentation will be located.

> **Troubleshooting:**
> 
> The build process uses the `-W` flag (treat warnings as errors) in the Dockerfile. If the build fails, you may temporarily remove the `-W` flag from the `sphinx-build` command in the Dockerfile and re-run the build to see all issues.
>
> After fixing the problems, restore the `-W` flag and run the build again to ensure a clean result.

## Check

The image can be launched as an instance and opened in a browser.

```
docker run --rm -p 80:80 ocir.eu-frankfurt-1.oci.oraclecloud.com/frecfpcrj6gd/oro-product-development/doc-application:latest
```
