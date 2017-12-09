#!/usr/bin/env bash

BASEDIR=$(echo ${PWD} | rev | cut -d'/' -f5- | rev)

NEWDIR=$BASEDIR/documentation/commerce/dev_guide/

OUTPUTDIR=$BASEDIR/documentation/commerce/dev_guide/

# return path to all md files excluding files case-insensitive named like upgrade, changelog, incompatibilities.
find $BASEDIR/package/platform/src/Oro/Bundle/ActionBundle $BASEDIR/package/platform/src/Oro/Bundle/ActivityBundle -name "*.md" | while read -r f ; do

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
  bundle="$(echo $f | sed -n 's|.*\/\(.*Bundle\)\/.*|\1|p')"

  # Find the place for the docs inside the rst documentation strucrtre

  while IFS=, read OROBUNDLE DOCDIR GITREP
    do
      if [ $OROBUNDLE == ${bundle} ]
      then
        NEWDIR=$BASEDIR/documentation/commerce/dev_guide/$DOCDIR
      fi
    done < bundlestr.csv
  echo $NEWDIR


  mkdir -p ${NEWDIR} && chmod 777 ${NEWDIR}


  cp $dir$filename.md $NEWDIR/$filename.md

done