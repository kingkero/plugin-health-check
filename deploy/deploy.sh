#!/usr/bin/env bash

# 1. Clone complete SVN repository to separate directory
svn co $SVN_REPOSITORY ../svn

# 2. Copy git repository contents to SVN trunk/ directory
cp -R ./* ../svn/trunk/
cp ./.distignore ../svn/trunk/

# 3. Switch to SVN repository
cd ../svn/trunk/

# 4. Move assets/ to SVN /assets/
mv ./assets/ ../assets/

# 5. Clean up unnecessary files
while IFS= read -r line
do
    if [[ -d $line ]]; then
        rm -rf $line
    elif [[ -f $line ]]; then
        rm -f $line
    fi
done < "./.distignore"

# 6. Go to SVN repository root
cd ../

# 7. Create SVN tag
svn cp trunk tags/$TRAVIS_TAG

# 8. Push SVN tag
svn ci  --message "Release $TRAVIS_TAG" \
        --username $SVN_USERNAME \
        --password $SVN_PASSWORD \
        --non-interactive