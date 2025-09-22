<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::included()
            ->filter()
            ->paginate();

        return response()->json($businesses);
    }
}
