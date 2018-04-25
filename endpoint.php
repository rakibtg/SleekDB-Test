<?php

  require_once './SleekDB/SleekDB.php';
  $usersDB = new SleekDB( 'users' );
  $usersDB->insert( $_POST[ 'data' ] );
  echo 'Data inserted: ' . $_POST['data']['name'];