<?php


/* store seeds in array */
$seeds = [];


/* populate with Faker data */
for ( $i=0; $i < 10 ; $i++ ) { 
    
    $seeds[$i]['uuid'] = $faker->unique()->uuid;

    $seeds[$i]['name'] = $faker->unique()->domainWord;

    $seeds[$i]['price'] = $faker->randomFloat( 2 , 3 , 10 );

    $seeds[$i]['created_at'] = $faker->dateTime( 'now' )->format('Y-m-d H:i:s');

}


/* export seeds to main script */
return $seeds;