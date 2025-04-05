<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HelloController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['message' => 'Hello, world!']);
    }
}
