FROM sphinxdoc/sphinx:7.4.7 AS build

ARG MAINTENANCE_BRANCHES

RUN apt-get -y update && \
    apt-get -y dist-upgrade && \
    apt-get -y install git && \
    apt-get clean

COPY . /documentation
RUN <<EOT bash
    set -ex
    cd /documentation
    rm -rf _build/html ||:
    pip3 install -r requirements.txt
    # Build documentation
    if [[ -n "${MAINTENANCE_BRANCHES}" ]] && git rev-parse --is-inside-work-tree > /dev/null 2>&1; then
        echo "Building multi-version documentation for branches: ${MAINTENANCE_BRANCHES}"
        sphinx-multiversion . _build/html -T -P -b orohtml -D 'smv_remote_whitelist=^origin$' -D "smv_branch_whitelist=^(${MAINTENANCE_BRANCHES})$" -D 'nitpicky=True' -j auto
    else
        echo "Building single version documentation..."
        sphinx-build -T -W -D 'nitpicky=True' --keep-going -j auto -b html . _build/html
    fi
    find _build/html \\( -type d -name .doctrees -or -name .buildinfo -or -name objects.inv \\) -print0 | xargs -0 -r rm -rf
    echo "Build artifacts summary:"
    du -sh _build/html
    find _build/html -type f | wc -l | xargs echo "Total files:"
EOT

FROM scratch AS build_artifacts
WORKDIR /
COPY --link --from=build /documentation/_build/ .

FROM nginx:stable AS runtime

LABEL org.opencontainers.image.title="Oro Documentation" \
    org.opencontainers.image.description="Docker image for building and serving Sphinx documentation" \
    org.opencontainers.image.authors="ORO Inc." \
    org.opencontainers.image.vendor="ORO Inc."

COPY --link --from=build /documentation/_build/html /usr/share/nginx/html
