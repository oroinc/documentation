#!/bin/bash

# @ECHO OFF

function usage() {
  echo "  Please use 'make ^<target^>' where ^<target^> is one of"
  echo "  html       to make standalone HTML files"
  echo "  dirhtml    to make HTML files named index.html in directories"
  echo "  singlehtml to make a single large HTML file"
  echo "  pickle     to make pickle files"
  echo "  json       to make JSON files"
  echo "  htmlhelp   to make HTML files and a HTML help project"
  echo "  qthelp     to make HTML files and a qthelp project"
  echo "  devhelp    to make HTML files and a Devhelp project"
  echo "  epub       to make an epub"
  echo "  latex      to make LaTeX files, you can export PAPER=a4 or PAPER=letter"
  echo "  text       to make text files"
  echo "  man        to make manual pages"
  echo "  texinfo    to make Texinfo files"
  echo "  gettext    to make PO message catalogs"
  echo "  changes    to make an overview over all changed/added/deprecated items"
  echo "  linkcheck  to check all external links for integrity"
  echo "  doctest    to run all doctests embedded in the documentation if enabled"
  echo "  clean      remove previously generated files"
}

case "$1" in 
  clean|gettext|htmlhelp|qthelp|html|dirhtml|singlehtml|pickle|json|epub|latex|text|man|texinfo|changes|linkcheck|doctest)
  #do nothing
  ;;
    *)
    usage
    exit 0
  ;;
esac

# Command file for Sphinx documentation

if [ -z "$SPHINXBUILD" ]; then 
  export SPHINXBUILD='sphinx-build'
fi

export BUILDDIR=_build
export ALLSPHINXOPTS="-d $BUILDDIR/doctrees $SPHINXOPTS ."
export I18NSPHINXOPTS="$SPHINXOPTS"

if [ -n "$PAPER" ]; then
  export ALLSPHINXOPTS="-D latex_paper_size=$PAPER $ALLSPHINXOPTS ."
  export I18NSPHINXOPTS="-D latex_paper_size=$PAPER $I18NSPHINXOPTS ."
fi

if [ "$1" = "clean" ]; then
  rm -rf $BUILDDIR
  res=$?
elif [ "$1" = "gettext" ]; then
  $SPHINXBUILD  -b gettext $I18NSPHINXOPTS  $BUILDDIR /locale
  res=$?
  echo "Build finished. The message catalogs are in $BUILDDIR /locale."
elif [ "$1" = "htmlhelp" ]; then
  $SPHINXBUILD  -b htmlhelp $ALLSPHINXOPTS  $BUILDDIR /htmlhelp
  res=$?
  echo "Build finished; now you can run HTML Help Workshop with the \n.hhp project file in $BUILDDIR /htmlhelp."
elif [ "$1" = "qthelp" ]; then
  $SPHINXBUILD  -b qthelp $ALLSPHINXOPTS  $BUILDDIR /qthelp
  res=$?
  echo "Build finished; now you can run 'qcollectiongenerator' with the \n.qhcp project file in $BUILDDIR /qthelp, like this:"
  echo "\n > qcollectiongenerator $BUILDDIR\qthelp\TheOroPlatform.qhcp"
  echo "\n To view the help file:"
  echo "\n ^> assistant -collectionFile $BUILDDIR\qthelp\TheOroPlatform.ghc"
else 
  exec_cmd="$SPHINXBUILD  -b $1 $ALLSPHINXOPTS  $BUILDDIR/$1"
  $exec_cmd
  res=$?
  echo "executed: $exec_cmd"
  echo "result: $res"
fi
  exit $res