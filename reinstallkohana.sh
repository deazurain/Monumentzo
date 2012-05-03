# 1. haal zelf submodule entries weg uit .git/config
# 2. haal zelf submodule entries weg uit .gitmodules

rm -rf modules
rm -rf system
git rm -r --cached modules
git rm -r --cached system

git commit -m 'removed all kohana modules'

git submodule add git://github.com/kohana/core.git system

git submodule add git://github.com/kohana/database.git modules/database
git submodule add git://github.com/kohana/image.git modules/image
git submodule add git://github.com/kohana/codebench.git modules/codebench
git submodule add git://github.com/kohana/unittest.git modules/unittest
git submodule add git://github.com/kohana/cache.git modules/cache
git submodule add git://github.com/kohana/auth.git modules/auth
git submodule add git://github.com/kohana/userguide.git modules/userguide
git submodule add git://github.com/kohana/orm.git modules/orm

git commit -m 'added all kohana modules'

git submodule update --init
