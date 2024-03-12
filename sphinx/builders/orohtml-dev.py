# -*- coding: utf-8 -*-
"""
    Oro HTML builder with out_suffix .html for local development
    It allows to start any webserver on  _build/html directory and use it

    Custom HTML builder which based on StandaloneHTMLBuilder
    This builder disables building search index and search page as we don't use it
"""
import sphinx
import posixpath

from sphinx.builders.dirhtml import DirectoryHTMLBuilder
from sphinx.util.osutil import SEP, os_path
from docutils import nodes
from docutils.nodes import Node
from os import path


class OroHTMLDevBuilder(DirectoryHTMLBuilder):
    name = 'orohtml-dev'
    search = False  # Disable search for oro
    out_suffix = '.html'
    link_suffix = ''


    def post_process_images(self, doctree: Node) -> None:
        """Pick the best candidate for an image and link down-scaled images to
        their high res version.
        """
        super().post_process_images(doctree)

        if self.config.html_scaled_image_link and self.html_scaled_image_link:
            for node in doctree.findall(nodes.image):
                # Override original conditions to make all images clickable by default
                if isinstance(node.parent, nodes.reference):
                    # A image having hyperlink target
                    continue
                if 'no-scaled-link' in node['classes']:
                    # scaled image link is disabled for this node
                    continue

                uri = node['uri']
                reference = nodes.reference('', '', internal=True)
                if uri in self.images:
                    reference['refuri'] = posixpath.join(self.imgpath,
                                                         self.images[uri])
                else:
                    reference['refuri'] = uri
                node.replace_self(reference)
                reference.append(node)


def setup(app):
    # builders
    app.add_builder(OroHTMLDevBuilder)

    return {
        'version': sphinx.__display_version__,
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }
