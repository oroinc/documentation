#!/usr/bin/env bash

bundle="ActivityBundle"

while IFS=, read OROBUNDLE DOCDIR GITREP
    do
        echo $OROBUNDLE
        echo $DOCDIR
        echo $GITREP

    if [ $OROBUNDLE == ${bundle} ]
    then
       echo ${OROBUNDLE}2
    fi
    done < bundlestr.csv