"""
    sphinxcontrib.redirects
    ~~~~~~~~~~~~~~~~~~~~~~~

    Generate redirects for moved pages when using the HTML builder.

    See the README file for details.

    :copyright: Copyright 2017 by Stephen Finucane <stephen@that.guru>
    :license: BSD, see LICENSE for details.

    License file location:
    https://github.com/sphinx-contrib/redirects/blob/c25afdc3d812c983560750916c9616f4cb6f98eb/LICENSE

    This is modified version of sphinxcontrib.redirects extension from
    https://github.com/sphinx-contrib/redirects

    It works not only with SingleFileHTMLBuilder, but with other builders as well.
"""

import os

TEMPLATE = """<html>
  <head><meta http-equiv="refresh" content="0; url=%s"/></head>
</html>
"""


def generate_redirects(app):

    path = os.path.join(app.srcdir, app.config.redirects_file)
    if not os.path.exists(path):
        app.info("Could not find redirects file at '%s'" % path)
        return

    get_target_uri = app.builder.get_target_uri
    get_outfilename = app.builder.get_outfilename

    with open(path) as redirects:
        for line in redirects.readlines():
            from_path, to_path = line.rstrip().split(' ')

            app.debug("Redirecting '%s' to '%s'" % (from_path, to_path))

            redirected_filename = get_outfilename(from_path)
            redirected_directory = os.path.dirname(redirected_filename)
            if not os.path.exists(redirected_directory):
                os.makedirs(redirected_directory)

            with open(redirected_filename, 'w') as f:
                f.write(TEMPLATE % get_target_uri(to_path))


def setup(app):
    app.add_config_value('redirects_file', 'redirects', 'env')
    app.connect('builder-inited', generate_redirects)
