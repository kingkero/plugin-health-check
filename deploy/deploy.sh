#!/usr/bin/env bash

# Clone complete SVN repository to separate directory
svn co $SVN_REPOSITORY ../svn

# Copy git repository contents to SVN trunk/ directory
cp -R ./* ../svn/trunk/
cp ./.distignore ../svn/trunk/

# Switch to SVN repository
cd ../svn/trunk/

# Only use needed dependencies
rm -rf vendor
composer install --no-dev --optimize-autoloader

# Move assets/ to SVN /assets/
mv ./assets/ ../assets/

# Clean up unnecessary files
while IFS= read -r line
do
    if [[ -d $line ]]; then
        rm -rf $line
    elif [[ -f $line ]]; then
        rm -f $line
    fi
done < "./.distignore"

# Go to SVN repository root
cd ../

# Create SVN tag
svn cp trunk tags/$TRAVIS_TAG

# Push SVN tag
svn ci  --message "Release $TRAVIS_TAG" \
        --username $SVN_USERNAME \
        --password $SVN_PASSWORD \
        --non-interactive