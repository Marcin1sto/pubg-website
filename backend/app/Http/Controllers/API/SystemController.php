<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PlayerStat;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class SystemController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function clearPlayerStats(Request $request): JsonResponse
    {
        // TODO: authorization
        PlayerStat::all()->delete();

        return response()->json([
            'valid' => true,
            'done' => true
        ]);
    }
}
