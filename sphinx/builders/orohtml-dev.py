# -*- coding: utf-8 -*-
"""
    Oro HTML builder with out_suffix .html for local development
    It allows to start any webserver on  _build/html directory and use it
    Custom HTML builder which based on StandaloneHTMLBuilder
    This builder disables building search index and search page as we don't use it
"""
import sphinx

from sphinx.builders.html import DirectoryHTMLBuilder


class OroHTMLDevBuilder(DirectoryHTMLBuilder):
    name = 'orohtml-dev'
    search = False  # Disable search for oro
    out_suffix = '.html'
    link_suffix = ''


def setup(app):
    # builders
    app.add_builder(OroHTMLDevBuilder)

    return {
        'version': sphinx.__display_version__,
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }