<?php

namespace App\Services\v1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private PortfolioService $portfolioService)
    {
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleRegister($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if (!empty($data['portfolio'])) {
            $portfolio = $this->portfolioService->handleAdd($data['portfolio'], $user);

            if ($portfolio->getStatusCode() === 422) {
                return response()->json(['message' => 'User registered. Wrong symbol for data set. Please, add correct portfolio'], 422);
            }
        }
        return response()->json(['message' => 'Registration is successful! Log in please.']);
    }
}
