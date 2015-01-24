<?php

if(!@mysql_connect("$DB_SERVER", "$DB_USER","$DB_PASS"))
        die("error while connect...");

mysql_query("SET NAMES $DB_CHAR");
if(!@mysql_select_db("$DB_NAME"))
        die("cannot use selected database");
?>