<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Vanguard\Country;
use Vanguard\Services\Logging\UserActivity\Activity;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Industry;
use Vanguard\ExperienceRole;
use Vanguard\News;
use Vanguard\ProfilePosition;
use Vanguard\TypeSharedSearch;
use Vanguard\TypeInvolvedSearch;
use Vanguard\TypeSharedOpportunity;
use Vanguard\TypeInvolvedOpportunity;

$factory->define(Vanguard\User::class, function (Faker\Generator $faker, array $attrs) {

    $countryId = isset($attrs['country_id'])
        ? $attrs['country_id']
        : $faker->randomElement(Country::lists('id')->toArray());

    return [
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'country_id' => $countryId,
        'status' => UserStatus::ACTIVE,
        'code' => $faker->code,
        'is_active' => $faker->is_active
    ];
});

$factory->define(Vanguard\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(5),
        'display_name' => implode(" ", $faker->words(2)),
        'description' => $faker->paragraph,
        'removable' => true,
    ];
});

$factory->define(Vanguard\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(5),
        'display_name' => implode(" ", $faker->words(2)),
        'description' => $faker->paragraph,
        'removable' => true
    ];
});

$factory->define(Activity::class, function (Faker\Generator $faker, array $attrs) {

    $userId = isset($attrs['user_id'])
        ? $attrs['user_id']
        : factory(\Vanguard\User::class)->create()->id;

    return [
        'user_id' => $userId,
        'description' => $faker->paragraph,
        'ip_address' => $faker->ipv4,
        'user_agent' => $faker->userAgent
    ];
});

$factory->define(Country::class, function (Faker\Generator $faker) {
    return [
        'country_code' => $faker->countryCode,
        'iso_3166_2' => strtoupper($faker->randomLetter . $faker->randomLetter),
        'iso_3166_3' => $faker->countryISOAlpha3,
        'name' => $faker->country,
        'region_code' => 123,
        'sub_region_code' => 123
    ];
});

$factory->define(News::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => 1,
        'title'       => 'Title test ' . str_random(3),
        'section'     => 'General',
        'description' => $faker->paragraph,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now()
    ];
});

$factory->defineAs(Industry::class, 'es', function (Faker\Generator $faker) {

    return [
        'value_id'    => function () {
            return Industry::where('language_id', '1')->count()+1;
        },
        'name'        => 'Industria test ' . str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(Industry::class, 'en', function (Faker\Generator $faker) {

    return [
        'value_id'    => function () {
            return Industry::where('language_id', '2')->count()+1;
        },
        'name'        => 'Industry test ' . str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(ExperienceRole::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return ExperienceRole::where('language_id', '1')->count()+1;
        },
        'name'        => 'Rol de experiencia test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(ExperienceRole::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return ExperienceRole::where('language_id', '2')->count()+1;
        },
        'name'        => 'Experience role test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(ProfilePosition::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return ProfilePosition::where('language_id', '1')->count()+1;
        },
        'name'        => 'Posición del perfil test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(ProfilePosition::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return ProfilePosition::where('language_id', '2')->count()+1;
        },
        'name'        => 'Profile Position test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeSharedSearch::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeSharedSearch::where('language_id', '1')->count()+1;
        },
        'name'        => 'Tipo SS test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeSharedSearch::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeSharedSearch::where('language_id', '2')->count()+1;
        },
        'name'        => 'Type SS test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeInvolvedSearch::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeInvolvedSearch::where('language_id', '1')->count()+1;
        },
        'name'        => 'Tipo IS test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeInvolvedSearch::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeInvolvedSearch::where('language_id', '2')->count()+1;
        },
        'name'        => 'Type IS test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeSharedOpportunity::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeSharedOpportunity::where('language_id', '1')->count()+1;
        },
        'name'        => 'Tipo SO test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeSharedOpportunity::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeSharedOpportunity::where('language_id', '2')->count()+1;
        },
        'name'        => 'Type SO test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeInvolvedOpportunity::class, 'es', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeInvolvedOpportunity::where('language_id', '1')->count()+1;
        },
        'name'        => 'Tipo IO test '.str_random(5),
        'language_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(TypeInvolvedOpportunity::class, 'en', function (Faker\Generator $faker) {
    return [
        'value_id'    => function () {
            return TypeInvolvedOpportunity::where('language_id', '2')->count()+1;
        },
        'name'        => 'Type IO test '.str_random(5),
        'language_id' => 2,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});
