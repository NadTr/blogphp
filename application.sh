#!/bin/bash

printf "username: "
read user

# create the connexion with the servor, clone the repository and start changes for server deploy
ssh $user@jepsen.local << EOF
rm -rf public_html
git clone https://github.com/marween/blogphp.git public_html
cd public_html
composer install
cd public
mv index.php ..
mv .htaccess ..
cd ..
sed -i 's/localhost/jepsen.local/' src/settings.php
sed -i 's/becode/'$user'/' src/settings.php
sed -i 's/blogDb/'$user'/' src/settings.php
sed -i 's/\/..\//\//' index.php
sed -i 's/ href=\"\/css/ href=\"\/\~'$user'\/public\/css/' app/views/layout.twig
sed -i 's/ href=\"\/css/ href=\"\/\~'$user'\/public\/css/' app/views/layoutAdmin.twig
sed -i 's/ src=\"\/img/ src=\"\/\~'$user'\/public\/img/' app/views/layout.twig
sed -i 's/ src=\"\/img/ src=\"\/\~'$user'\/public\/img/' app/views/layoutAdmin.twig
EOF

#connect and start database
ssh $user@jepsen.local "psql -f blog-database.sql"


echo 'Piece of cake'
