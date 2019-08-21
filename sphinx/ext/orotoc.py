# -*- encoding: utf-8 -*-
#
# Copyright © 2012 New Dream Network, LLC (DreamHost)
#
# Author: Doug Hellmann <doug.hellmann@dreamhost.com>
#
# Licensed under the Apache License, Version 2.0 (the "License"); you may
# not use this file except in compliance with the License. You may obtain
# a copy of the License at
#
#      http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
# WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
# License for the specific language governing permissions and limitations
# under the License.


from sphinx import addnodes


def html_page_context(app, pagename, templatename, context, doctree):
    """Event handler for the html-page-context signal.

     Modifies the context directly.

     - Replaces the 'toctree' function with one that uses the entire
       document structure, ignores the maxdepth argument, and uses
       only prune and collapse.
    """

    if "toctree" not in context:
        # json builder doesn't use toctree func, so nothing to replace
        return

    def make_toctree(collapse=True, maxdepth=-1, includehidden=True, titles_only=True):
        return get_rendered_toctree(app.builder,
                                    pagename,
                                    prune=True,
                                    collapse=collapse,
                                    maxdepth=maxdepth,
                                    includehidden=includehidden,
                                    titles_only=titles_only
                                    )

    context['toctree'] = make_toctree


def get_rendered_toctree(builder, docname, **kwargs):
    """Build the toctree relative to the named document,
    with the given parameters, and then return the rendered
    HTML fragment.
    """
    fulltoc = get_toctree_for(builder,
                              docname,
                              **kwargs
                              )
    rendered_toc = builder.render_partial(fulltoc)['fragment']
    return rendered_toc


def get_toctree_for(builder, docname, **kwargs):
    """Return a single toctree starting from docname containing all
    sub-document doctrees.

    It filters toctree and shows only subdocuments
    """
    env = builder.env
    doctree = env.get_doctree(env.config.master_doc)
    toctrees = []
    documentation_set = docname.split('/')[0]
    for toctreenode in doctree.traverse(addnodes.toctree):
        for e in toctreenode['entries']:
            ref = str(e[1])
            ref_set = ref.split('/')[0]
            if ref_set != documentation_set:
                toctreenode['entries'].remove(e)
        toctree = env.resolve_toctree(docname, builder, toctreenode, **kwargs)
        if toctree is not None:
            toctrees.append(toctree)

    if not toctrees:
        return None
    result = toctrees[0]
    for toctree in toctrees[1:]:
        if toctree:
            result.extend(toctree.children)
    env.resolve_references(result, docname, builder)
    return result


def setup(app):
    app.connect('html-page-context', html_page_context)
