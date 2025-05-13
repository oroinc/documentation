FROM sphinxdoc/sphinx:7.1.2 AS build

RUN apt-get -y update && \
    apt-get -y install git && \
    apt-get clean

WORKDIR /documentation

COPY . .

RUN pip3 install -r requirements.txt

RUN rm -rf _build/html && sphinx-build -T -W --keep-going -j auto -b html . _build/html

FROM scratch AS build_artifacts
WORKDIR /
COPY --from=build /documentation/_build/ .

FROM nginx:stable-alpine-slim AS runtime

LABEL org.opencontainers.image.title="Oro Documentation" \
    org.opencontainers.image.description="Docker image for building and serving Sphinx documentation" \
    org.opencontainers.image.authors="ORO Inc." \
    org.opencontainers.image.vendor="ORO Inc."

COPY --from=build /documentation/_build/html /usr/share/nginx/html
