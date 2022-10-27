import time


# This extension adds current timestamp in html page context event to invalidate assets in templates
#

def html_page_context(app, pagename, templatename, context, doctree):
    context['oro_assets_timestamp'] = app.current_timestamp


def setup(app):
    app.current_timestamp = time.time()
    app.connect('html-page-context', html_page_context)
