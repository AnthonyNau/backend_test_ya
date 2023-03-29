<?php

use App\Imports\DataSetImport;
use App\Models\User;
use App\Models\Portfolio;
use Maatwebsite\Excel\Facades\Excel;

it('add portfolio', function () {
    $user = User::factory()->create();
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [
        [
            "symbol" => "AMZN",
            "number_of_shares" => fake()->randomFloat(5, 0, 9),
        ],
        [
            "symbol" => "GOOGL",
            "number_of_shares" => fake()->randomFloat(5, 0, 9),
        ]
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/portfolio/add', $data);

    $response->assertStatus(200);
    $response->assertJson([
        "message"=>  "Portfolio added"
    ]);
});

it('get portfolio', function () {
    $user = User::factory()->create();
    Portfolio::factory()->state(['user_id' => $user->id])->create();
    $token = auth()->login($user);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/v1/portfolio');

    $response->assertStatus(200);

    $response->assertJsonStructure([
        '*' => [
            'id',
            'user_id',
            'symbol',
            'number_of_shares',
            'created_at',
            'updated_at',
        ]
    ]);
});

it('update portfolio', function () {
    $user = User::factory()->create();
    $portfolio = Portfolio::factory()->state(['user_id' => $user->id])->create();

    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [
        "symbol" => "AMZN",
        "number_of_shares" => fake()->randomFloat(5, 0, 9),
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->putJson('/api/v1/portfolio/update/' . $portfolio->id, $data);

    $response->assertStatus(200);
    $response->assertJson([
        "message"=>  "Portfolio modified"
    ]);
});
