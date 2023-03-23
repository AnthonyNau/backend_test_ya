<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\LoginRequest;
use App\Http\Requests\v1\RegisterRequest;
use App\Services\v1\UserService;

/**
 * @group User registration and auth
 *
 */
class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register new user
     *
     * @param RegisterRequest $registerRequest
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function register(RegisterRequest $registerRequest): \Illuminate\Http\JsonResponse|string
    {
        return $this->userService->handleRegister($registerRequest->validated());
    }

    /**
     * Login user. Get a JWT via given credentials.
     *
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest): \Illuminate\Http\JsonResponse
    {
        $credentials = $loginRequest->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unregistered'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @hideFromAPIDocumentation
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
