# Copyright (c) 2013 Michael Dowling <mtdowling@gmail.com>
# Copyright (c) 2017 Jared Dillard <jared.dillard@gmail.com>
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.

# This is modified version of sphinx-sitemap extension(https://github.com/jdillard/sphinx-sitemap) for generating
# sitemapindex.xml file when using sphinx-versioning

import os
import xml.etree.ElementTree as ET


def html_page_context(app, pagename, templatename, context, doctree):
    save_is_root_build(app, context)
    save_versions_from_context(app, context)


def save_is_root_build(app, context):
    if app.sitemap_index_is_root_build is not None:
        return

    if 'scv_is_root' not in context:
        return

    app.sitemap_index_is_root_build = context['scv_is_root']


def save_versions_from_context(app, context):
    if app.sitemap_index_is_root_build is not True:
        return

    if 'versions' not in context:
        return

    for name, human_readable_name, path, root_dir in context['versions'].branches:
        app.sitemap_index_root_dirs.add(root_dir)

    for name, human_readable_name, path, root_dir in context['versions'].tags:
        app.sitemap_index_root_dirs.add(root_dir)


def create_sitemap_index(app, exception):
    """
    Generates the sitemapindex.xml according to the "versions" received from a page context when using sphinx-versioning
    """

    if app.sitemap_index_is_root_build is not True:
        print("sitemap-index notice: Skip building sitemapindex.xml for non-root versions")
        return

    site_url = app.builder.config.site_url or app.builder.config.html_baseurl
    if not site_url:
        print("sitemap-index error: neither html_baseurl nor site_url "
              "are set in conf.py. Sitemapindex not built.")
        return

    ET.register_namespace('xhtml', "http://www.w3.org/1999/xhtml")

    root = ET.Element("sitemapindex")
    root.set("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9")

    # Handle root version
    create_et_element(root, site_url + 'sitemap.xml')

    # Handle versions
    for root_dir in app.sitemap_index_root_dirs:
        create_et_element(root, site_url + root_dir + '/sitemap.xml')

    filename = app.outdir + "/sitemapindex.xml"
    ET.ElementTree(root).write(filename,
                               xml_declaration=True,
                               encoding='utf-8',
                               method="xml")
    print("sitemapindex.xml was generated for URL %s in %s" % (site_url, filename))


def create_et_element(root, doc_url):
    url = ET.SubElement(root, "sitemap")
    ET.SubElement(url, "loc").text = doc_url


def setup(app):
    app.connect('html-page-context', html_page_context)
    app.connect('build-finished', create_sitemap_index)
    app.sitemap_index_root_dirs = set()
    app.sitemap_index_is_root_build = None
