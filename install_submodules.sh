git submodule init
git submodule update
git submodule foreach 'git checkout 3.2/master && git pull origin 3.2/master'
