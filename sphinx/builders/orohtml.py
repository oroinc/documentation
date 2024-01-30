# -*- coding: utf-8 -*-
"""
    Oro HTML builder

    Custom HTML builder which based on StandaloneHTMLBuilder
    This builder disables building search index and search page as we don't use it
"""
import sphinx

from sphinx.builders.dirhtml import DirectoryHTMLBuilder
from sphinx.util.osutil import SEP, os_path
from os import path


class OroHTMLBuilder(DirectoryHTMLBuilder):
    name = 'orohtml'
    search = False  # Disable search for oro
    out_suffix = '.html'
    link_suffix = ''

    def get_outfilename(self, pagename: str) -> str:
        if pagename == 'index' or pagename.endswith(SEP + 'index') or pagename == '404':
            outfilename = path.join(self.outdir, os_path(pagename) +
                                    self.out_suffix)
        else:
            outfilename = path.join(self.outdir, os_path(pagename),
                                    'index' + self.out_suffix)

        return outfilename


def setup(app):
    # builders
    app.add_builder(OroHTMLBuilder)

    return {
        'version': sphinx.__display_version__,
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }
