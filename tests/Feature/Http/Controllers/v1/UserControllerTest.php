<?php

use App\Imports\DataSetImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use function Pest\Faker\fake;


it('register new user without portfolio', function () {
    $data = [
        "name" => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'password' => fake()->regexify('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$'),
    ];

    $response = $this->postJson('/api/v1/user/register', $data);

    $response->assertStatus(200);
    $response->assertJson([
        "message"=>  "Registration is successful! Log in please."
    ]);
});

it('register new user with incorrect portfolio', function () {
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $data = [
        "name" => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'password' => fake()->regexify('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$'),
        "portfolio" => [
            [
                "symbol" => fake()->name(),
                "number_of_shares" => fake()->randomFloat(5, 0, 9),
            ],
            [
                "symbol" => "GOOGL",
                "number_of_shares" => fake()->randomFloat(5, 0, 9),
            ]
        ]
    ];

    $response = $this->postJson('/api/v1/user/register', $data);

    $response->assertStatus(422);
    $response->assertJson([
        "message" => "User registered. Wrong symbol for data set. Please, add correct portfolio"
    ]);
});

it('register new user with portfolio', function () {
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $data = [
        "name" => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'password' => fake()->regexify('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$'),
        "portfolio" => [
            [
                "symbol" => "AMZN",
                "number_of_shares" => fake()->randomFloat(5, 0, 9),
            ],
            [
                "symbol" => "GOOGL",
                "number_of_shares" => fake()->randomFloat(5, 0, 9),
            ]
        ]
    ];

    $response = $this->postJson('/api/v1/user/register', $data);

    $response->assertStatus(200);
    $response->assertJson([
        "message"=>  "Registration is successful! Log in please."
    ]);
});

it('log in user', function () {
    $user = User::factory()->create();

    $data = [
        'email' => $user->email,
        'password' => 'TestPassword123',
    ];
    $response = $this->postJson('/api/v1/user/login', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'access_token',
        'token_type',
        'expires_in',
    ]);
});

it('get user', function () {
    $user = User::factory()->create();

    $token = auth()->login($user);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/v1/user');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'id',
        'name',
        'email',
        'created_at',
        'updated_at',
    ]);
});

it('log out user', function () {
    $user = User::factory()->create();

    $token = auth()->login($user);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/v1/user/logout');

    $response->assertStatus(200);
    $response->assertJson([
        "message"=>  "Successfully logged out"
    ]);
});
