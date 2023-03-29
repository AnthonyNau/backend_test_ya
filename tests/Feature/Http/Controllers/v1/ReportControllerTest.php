<?php

use App\Imports\DataSetImport;
use App\Models\User;
use App\Models\Portfolio;
use Maatwebsite\Excel\Facades\Excel;

it('get report by date and symbol', function () {
    $user = User::factory()->create();
    $portfolio = Portfolio::factory()->state(['user_id' => $user->id])->create();
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [
        "symbol" => $portfolio->symbol,
        "date" => '2022-01-03',
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/report/get', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        $portfolio->symbol,
        'portfolio_value',
    ]);
});

it('get report without date and symbol', function () {
    $user = User::factory()->create();
    $portfolio = Portfolio::factory()->state(['user_id' => $user->id])->create();
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/report/get', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        $portfolio->symbol,
        'portfolio_value',
    ]);
});

it('get report with date, without symbol', function () {
    $user = User::factory()->create();
    $portfolio = Portfolio::factory()->state(['user_id' => $user->id])->create();
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [
        "date" => '2022-01-03',
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/report/get', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        $portfolio->symbol,
        'portfolio_value',
    ]);
});

it('get report with symbol, without date', function () {
    $user = User::factory()->create();
    $portfolio = Portfolio::factory()->state(['user_id' => $user->id])->create();
    Excel::import(new DataSetImport, 'data_set_example.csv');
    $token = auth()->login($user);
    $data = [
        "symbol" => $portfolio->symbol
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/report/get', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        $portfolio->symbol,
        'portfolio_value',
    ]);
});
