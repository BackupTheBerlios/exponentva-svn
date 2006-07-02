#!/bin/bash

echo "Developer CVS File Update Tool"
echo ""
echo "by James Hunt"
echo ""
echo ""
echo "This tool restores sanity to the file and"
echo "directory structures in Exponent, and is"
echo "intended to be run by developers checking"
echo "out fresh CVS sources"
echo ""

cd ..

ROOT=`pwd`;

echo "Exponent files root set to $ROOT";

if [ ! -d $ROOT/conf/profiles ]; then
	mkdir $ROOT/conf/profiles
fi
chmod 777 $ROOT/conf/profiles

echo "*" > $ROOT/files/.cvsignore

if [ ! -d $ROOT/tmp/uploads ]; then
	mkdir $ROOT/tmp/uploads
fi
chmod 777 $ROOT/tmp/uploads

if [ ! -f $ROOT/conf/config.php ]; then
	touch $ROOT/conf/config.php;
fi
chmod 777 $ROOT/conf/config.php

(
echo "config.php";
echo ".cvsignore";
)> $ROOT/conf/.cvsignore
echo "*" > $ROOT/conf/profiles/.cvsignore


if [ ! -d $ROOT/files ]; then
	mkdir $ROOT/files
fi
chmod -R 777 $ROOT/files

echo "*" > $ROOT/files/.cvsignore

if [ ! -d $ROOT/tmp/views_c ]; then
	mkdir $ROOT/tmp/views_c
fi
chmod -R 777 $ROOT/tmp/views_c

echo "*" > $ROOT/tmp/views_c/.cvsignore


echo "Finished setting up Exponent Environment.";
echo "";
echo "";
echo "======================================";
echo "============ IMPORTANT ==============="
echo "======================================";
echo "";
echo "Don't forget to change the line in pathos_version.php";
echo "that defines the DEVELOPMENT constant.  Strange things";
echo "may happen with regards to CVS directories if it is not.";
echo "set to 1 or true.";

cd sdk
