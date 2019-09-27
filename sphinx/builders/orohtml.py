# -*- coding: utf-8 -*-
"""
    Oro HTML builder

    Custom HTML builder which based on StandaloneHTMLBuilder
    This builder disables building search index and search page as we don't use it
"""
import sphinx

from sphinx.builders.html import DirectoryHTMLBuilder


class OroHTMLBuilder(DirectoryHTMLBuilder):
    name = 'orohtml'
    search = False  # Disable search for oro
    out_suffix = ''
    link_suffix = ''


def setup(app):
    # builders
    app.add_builder(OroHTMLBuilder)

    return {
        'version': sphinx.__display_version__,
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }
