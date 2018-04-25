<?php

  require_once './vendor/autoload.php';

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

  for ( $i=0; $i < 50000; $i++ ) {
    $result = file_get_contents( 'http://127.0.0.1:2010/endpoint.php', false, stream_context_create( [
      'http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( [ 'data' => newUser($faker) ] )
      ]
    ] ) );
    echo $i . ' | ' . $result;
    echo "\n";
  }