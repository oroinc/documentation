# OroCommerce Documentation Source

The use of the documentation is subject to the [CC-BY-NC-SA 4.0](./LICENSE) license.

Documentation is published at https://doc.oroinc.com/.

For the recommendations on how to setup your local environment to build documentation and how to use reStructuredText markup language to write documentation, follow the community guide on the [Oro Inc documentation website](https://doc.oroinc.com/master/community/contribute/documentation/):

## Build

```
docker buildx bake --progress plain --load
```

As a result, an image and a ./_build folder will be created where the built documentation will be located.

## Check

The image can be launched as an instance and opened in a browser.

```
docker run --rm -p 80:80 ocir.eu-frankfurt-1.oci.oraclecloud.com/frecfpcrj6gd/oro-product-development/doc-application:latest
```
