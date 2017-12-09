#!/usr/bin/env bash

#This script converts all mds from /home/oroinc/Documents/laboro/dev/package/* to rst and copies them to dev_guide/md_docs directory in commerce.

BASEDIR=$(echo ${PWD} | rev | cut -d'/' -f5- | rev)

# Configure the path to the directory where to store output rst files
OUTPUTDIR=$BASEDIR/documentation/commerce/dev_guide/md_docs/

#Currently, all path are transformed to the one rep for test purposes. Will be changed to reflect actual rep after basic testing.
GITPATH=https://github.com/oroinc/platform/tree/master/

INDEXHEADER="MD Documentation
================

.. toctree::
   :titlesonly:
"

mkdir -p ${OUTPUTDIR} && chmod 777 ${OUTPUTDIR}

# return path to all md files excluding files case-insensitive named like upgrade, changelog, incompatibilities.
find $BASEDIR/package/* \( -name "*.md" ! -iname "*UPGRADE*.md" ! -iname "*CHANGELOG*.md" ! -iname "*incompatibilities*.md" ! -iname "*LICENSE*.md" ! -iname "*OroCRMOutlookAddIn*.md" \) | while read -r f ; do

  echo $f
  # Extract file extension
  extension="${f##*.}"

  # Extract file base (path+file name without extension)
  filebase="${f%.*}"

  #Extract file name
  filename=$(basename "$f" .md)

  #Extract directory path
  dir="${filebase%$filename}"

  #Extract Bundle name
  bundle="$(echo $f | sed -n 's|.*\/\(.*Bundle\)\/.*|\1_|p')"

  #Extract Bridge
  bridge="$(echo $f | sed -ne 's|.*\(Bridge\)\/\([[:alpha:]-]*\)\/.*|\2\1_|p')"

  #Extract Component
  component="$(echo $f | sed -ne 's|.*\(Component\)\/\([[:alpha:]-]*\)\/.*|\2\1_|p')"

  #Extract repository name
  rep="$(echo $f | sed -ne 's|.*package\/\([[:alpha:]-]*\)\/.*|\1_|p')"

  # Copy original files so that they can be restored intact
  echo "Creating copies of the original files..."
  cp $f $f.bak

  # Find the place for the docs inside the rst documentation strucrtre

  while IFS=, read OROBUNDLE DOCDIR GITREP
  do
    if $OROBUNDLE == $bundle
    then
      $NEWDIR=$DOCDIR
      $GITPATH=$GITREP
    fi
  done < bundlestr.csv

  # Will be used in the future for reflecting structure
  # OUTPUTDIR=$BASEDIR/documentation/commerce/dev_guide/$NEWDIR
  # mkdir -p ${OUTPUTDIR} && chmod 777 ${OUTPUTDIR}

  # Replace relative links with absoulute links to GITPATH
  # 1. Finds links that start with "../" or "./.." in the file.
  # 2. Finds absolute path based on the found relative link.
  # 3. Transforms found path by replacing everything above src/ directory with GITPATH.
  # 4. Replaces original link in the file with the result of transformation.
  echo "Replacing relative Github links with absolute..."
  grep -Eo "[^(]*\/*\.\.\/[^)]*" $f | while read -r line ; do
     #replace link for github only for files that are not images or md, i.e. for php, yml, etc.
     lineextension="${f##*.}"
     if [ $lineextension !="png" ] && [ $lineextension !="jpg" ] && [ $lineextension !="md" ]
     then
        # dirline : with line we get a path relative to the path of the processed file. dir is the path of the related file.
        newpath=$(echo $(readlink -f $dir$line) | sed "s|.*\(src\)|$GITPATH\1|g")
        perl -i -pe "s|\\Q$line|$newpath|g" $f
     fi
  done

  # Convert files from md to rst with the pandoc utility. Do not forget to install pandoc: sudo apt install pandoc. -f markdown-raw_tex excludes corresponding extension that treats \ as raw-latex, causing a lot of issues.
  echo "Converting $f to $dir$rep$bridge$bundle$component$filename.rst"
  `pandoc $f -f markdown-raw_tex+lists_without_preceding_blankline -t rst --columns=500 -o $dir$rep$bridge$bundle$component$filename.rst`

  chmod 777 $dir$rep$bundle$filename.rst

  echo "Removing transformed .md file..."
  rm $f

  echo "Restoring original .md file..."
  mv $f.bak $f

  # move created rst files to the OUTPUTDIR
  echo "Moving $dir$rep$bridge$bundle$component$filename.rst to OUTPUTDIR"
  mv $dir$rep$bridge$bundle$component$filename.rst $OUTPUTDIR

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

echo "Replacing code:: markdown with code-block:: none"
# grep -q -rl 'code:: markdown' ./* | xargs sed -i "s/code:: markdown/code:: /g"
sed -i "s/code:: markdown/code:: /g" ./*
echo "Replacing code:: yml with code:: yaml ..."
# grep -q -rl 'code:: yml' ./* | xargs sed -i "s/code:: yml/code-block:: yaml/g"
sed -i "s/code:: yml/code:: yaml/g" ./*

