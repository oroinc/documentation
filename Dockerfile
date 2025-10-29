FROM sphinxdoc/sphinx:7.4.7 AS build

# Used for run in multi-version documentation builds for doc.oroinc.com
# Pipe separated list of branch names, e.g. "5.1|6.0|6.1|master"
ARG MAINTENANCE_BRANCHES
#  Possible values for BUILDER: html, markdown
ARG BUILDER=html

RUN apt-get -y update && \
    apt-get -y install git && \
    apt-get clean

COPY . /documentation
RUN <<EOT bash
    set -ex
    cd /documentation
    rm -rf _build/${BUILDER} ||:
    pip3 install -r requirements.txt
    # Build documentation
    if [[ -n "${MAINTENANCE_BRANCHES}" ]] && git rev-parse --is-inside-work-tree > /dev/null 2>&1; then
        echo "Building multi-version documentation for branches: ${MAINTENANCE_BRANCHES}"
        sphinx-multiversion . _build/html -T -P -b orohtml -D 'smv_remote_whitelist=^origin$' -D "smv_branch_whitelist=^(${MAINTENANCE_BRANCHES})$" -D 'nitpicky=True' -j auto
    else
        echo "Building single version documentation..."
        sphinx-build -T -W -D 'nitpicky=True' --keep-going -j auto -b ${BUILDER} . _build/${BUILDER}
    fi
    find _build/${BUILDER} \\( -type d -name .doctrees -or -name .buildinfo -or -name objects.inv \\) -print0 | xargs -0 -r rm -rf
    echo "Build artifacts summary:"
    du -sh _build/${BUILDER}
    find _build/${BUILDER} -type f | wc -l | xargs echo "Total files:"
EOT

FROM scratch AS build_artifacts
WORKDIR /
COPY --from=build /documentation/_build/ .

FROM nginx:stable-alpine-slim AS runtime

LABEL org.opencontainers.image.title="Oro Documentation" \
    org.opencontainers.image.description="Docker image for building and serving Sphinx documentation" \
    org.opencontainers.image.authors="ORO Inc." \
    org.opencontainers.image.vendor="ORO Inc."

COPY --link --from=build /documentation/_build /usr/share/nginx
