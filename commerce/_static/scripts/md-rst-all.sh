#!/usr/bin/env bash

# This script:
# - converts all md files from the INPUTDIR directory to the rst files
# - replaces relative links to the application files to the links to corresponding files in the github GITPATH repository
# - moves rst files to the OUTPUTDIR directory
# - adds index.rst the OUTPUTDIR directory and creates toctree
#
# Before using this script, define:
# - OUTPURDIR ( line 19)
# - INPUTDIR (line 22)
# - GITPATH (line 25)
# - index file title and level (line 28-33).

# BASEDIR variable stores the path to the git project home. If you move this script to another level, please adjust the cut part.
BASEDIR=$(echo ${PWD} | rev | cut -d'/' -f5- | rev)

# Configure the path to the directory where to store output rst files
OUTPUTDIR=$BASEDIR/documentation/commerce/dev_guide/web_api/api_docs/

# Configure the path to the directory with the input md files
INPUTDIR=$BASEDIR/package/platform/src/Oro/Bundle/ApiBundle/Resources/doc/

# For links conversion, configure the path to the public repository
GITPATH=https://github.com/oroinc/platform/tree/master/

# Define the title and toc parameters of the index.rst
INDEXHEADER="API Documentation
=================

.. toctree::
   :titlesonly:
"

echo "Creating $OUTPUTDIR..."
mkdir -p ${OUTPUTDIR} && chmod 777 ${OUTPUTDIR}

cd ${INPUTDIR}

FILES=*.md
for f in $FILES
do
  # Extract file extension
  #extension="${f##*.}"

  # Extract file name
  filename="${f%.*}"

  # Copy original files so that they can be restored intact
  echo "Creating copies of the original files..."
  cp $filename.md $filename.md.bak

  # Replace relative links with absoulute links to GITPATH
  # 1. Finds links that start with "../" or "./.." in the file.
  # 2. Finds absolute path based on the found relative link.
  # 3. Transforms found path by replacing everything above src/ directory with GITPATH.
  # 4. Replaces original link in the file with the result of transformation.
  echo "Replacing relative Github links with absolute..."
  grep -Eo "[^(]*\/\.\.\/[^)]*" $filename.md | while read -r line ; do
     newpath=$(echo $(readlink -f $line) | sed "s|.*\(src\)|$GITPATH\1|g")
     perl -i -pe "s|\\Q$line|$newpath|g" $filename.md
  done

  # Convert files from md to rst with the pandoc utility. Do not forget to install pandoc: sudo apt install pandoc
  echo "Converting $f to $filename.rst"
  `pandoc $f -t rst --columns=500 -o $filename.rst`

  chmod 777 $filename.rst

  echo "Removing transformed .md file..."
  rm $f

  echo "Restoring original $filename.md file..."
  mv $filename.md.bak $filename.md

  # move created rst files to the OUTPUTDIR
  echo "Moving $filename.rst to OUTPUTDIR"
  mv $filename.rst $OUTPUTDIR

done

cd $OUTPUTDIR

echo "Creating index.rst in OUTPUTDIR"
rm index.rst
echo "$INDEXHEADER" >> index.rst

chmod 777 index.rst


 FILES=*.rst
 for f in $FILES
 do
  filename="${f%.*}"
  if [ "$filename" != "index" ]
  then
   echo "Adding $f to index.rst toctree"
   echo "   $filename" >> index.rst
  fi
 done

echo "Replacing code:: markdown with code:: ..."
# grep -q -rl 'code:: markdown' ./* | xargs sed -i "s/code:: markdown/code:: /g"
sed -i "s/code:: markdown/code:: /g" ./*
echo "Replacing code:: yml with code:: yaml ..."
# grep -q -rl 'code:: yml' ./* | xargs sed -i "s/code:: yml/code:: yaml/g"
sed -i "s/code:: yml/code:: yaml/g" ./*






