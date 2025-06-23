<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioShowController extends Controller
{
    public function show($id)
    {
        $portfolio = Portfolio::with('images')->find($id);

        if (!$portfolio) {
            return response()->json(['message' => 'العنصر غير موجود'], 404);
        }
        return new PortfolioResource($portfolio);
    }
}
