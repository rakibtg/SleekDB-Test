<?php

  require_once './vendor/autoload.php';
  require_once './SleekDB/SleekDB.php';

  $faker = Faker\Factory::create();

  function newUser( $faker ) {
    $fakeUser = [
      'name' => $faker->name,
      'email' => $faker->email,
      'sex' => mt_rand(0,30) > 15 ? 'male' : 'female',
      'age' => mt_rand( 5, 100 ),
      'bio' => $faker->text(mt_rand(500, 10000)),
      'location' => [
        'streetAddress' => $faker->streetAddress,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'state' => $faker->state,
        'country' => $faker->country
      ]
    ];
    return $fakeUser;
  }


  // print_r( newUser( $faker ) );

  $usersDB = new SleekDB( 'users' );

  for ($i=0; $i < 1000000; $i++) { 
    $usersDB->insert( newUser($faker) );
    sleep( 0.2 );
  }
