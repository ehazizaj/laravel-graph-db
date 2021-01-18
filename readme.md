# Running the project

Please after cloning this repo, to make it work do as following:
- run "composer install"
- generate .env file and set up database
- run neo4j (graph version 3.5.22)
- update neo4j credentials at config/database.php
- run: php artisan neo4j:migrate
- run: php artisan db:seed  
