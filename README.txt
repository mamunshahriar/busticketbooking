Quick Start (InfinityFree)
1) Create MySQL DB and note host/user/pass/name.
2) Upload all files to htdocs/ (or extract the ZIP there).
3) Import db.sql via phpMyAdmin (or run db_migration_add_mobile.sql if you already had the old schema).
4) Edit db_connect.php with your DB credentials.
5) Upload a logo named green_university_logo.png into the same folder.
6) Browse your site and test booking (seat uniqueness, ticket shows time).

Cache tip: CSS uses ?v=5 to bust cache. Increase the number if you still see old styles.
