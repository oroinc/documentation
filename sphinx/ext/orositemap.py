import os
import xml.etree.ElementTree as ET
from datetime import datetime

NS = "http://www.sitemaps.org/schemas/sitemap/0.9"
ET.register_namespace('', NS)


def clean_current_sitemap(app, sitemap_path):
    """Formats URLs in sitemap.xml to use clean trailing slashes and handles empty LTS release paths."""
    if not os.path.exists(sitemap_path):
        return

    release = app.config.release.strip() if app.config.release else ''
    current_version = getattr(app.config, 'smv_current_version', '')

    tree = ET.parse(sitemap_path)
    root = tree.getroot()

    for elem in root.findall(f'{{{NS}}}url/{{{NS}}}loc'):
        if elem.text:
            # If release is empty (LTS version), strip current_version prefix from the URL
            if not release and current_version and f'/{current_version}/' in elem.text:
                elem.text = elem.text.replace(f'/{current_version}/', '/')

            # Replace index.html -> /
            if elem.text.endswith('index.html'):
                elem.text = elem.text[:-10]
            # Replace page.html -> page/
            elif elem.text.endswith('.html'):
                elem.text = elem.text[:-5] + '/'

    tree.write(sitemap_path, encoding='utf-8', xml_declaration=True)


def build_sitemap_index(app):
    """
    Locates the root build directory (_build/html) and generates sitemap_index.xml,
    aggregating all existing version-specific sitemap.xml files.
    """
    outdir = app.outdir  # e.g., _build/html/6.1 or _build/html

    # If building a specific version branch, navigate up to the root build dir
    if getattr(app.config, 'smv_current_version', None):
        root_dir = os.path.abspath(os.path.join(outdir, '..'))
    else:
        root_dir = outdir

    base_url = app.config.html_baseurl.rstrip('/')
    sitemaps = []

    # 1. Check for sitemap.xml in the root directory (LTS version)
    root_sitemap = os.path.join(root_dir, 'sitemap.xml')
    if os.path.exists(root_sitemap):
        sitemaps.append(f"{base_url}/sitemap.xml")

    # 2. Check for sitemap.xml in each version subdirectory
    if os.path.exists(root_dir):
        for entry in os.listdir(root_dir):
            entry_path = os.path.join(root_dir, entry)
            if os.path.isdir(entry_path):
                v_sitemap = os.path.join(entry_path, 'sitemap.xml')
                if os.path.exists(v_sitemap):
                    sitemaps.append(f"{base_url}/{entry}/sitemap.xml")

    if not sitemaps:
        return

    # 3. Assemble the root sitemap_index.xml
    urlset = ET.Element('sitemapindex', xmlns=NS)
    now = datetime.utcnow().strftime('%Y-%m-%dT%H:%M:%S+00:00')

    for sitemap_url in sorted(set(sitemaps)):
        sitemap_node = ET.SubElement(urlset, 'sitemap')
        loc = ET.SubElement(sitemap_node, 'loc')
        loc.text = sitemap_url
        lastmod = ET.SubElement(sitemap_node, 'lastmod')
        lastmod.text = now

    tree = ET.ElementTree(urlset)
    if hasattr(ET, 'indent'):
        ET.indent(tree, space="  ", level=0)

    index_path = os.path.join(root_dir, 'sitemap_index.xml')
    tree.write(index_path, encoding='utf-8', xml_declaration=True)


def on_build_finished(app, exception):
    if exception is not None:
        return

    # 1. Clean up URLs in current sitemap.xml
    current_sitemap = os.path.join(app.outdir, 'sitemap.xml')
    clean_current_sitemap(app, current_sitemap)

    # 2. Update sitemap_index.xml in root
    build_sitemap_index(app)


def setup(app):
    # priority=999 ensures this hook executes AFTER sphinx-sitemap has generated sitemap.xml
    app.connect('build-finished', on_build_finished, priority=999)

    return {
        'version': '1.0',
        'parallel_read_safe': True,
        'parallel_write_safe': True,
    }