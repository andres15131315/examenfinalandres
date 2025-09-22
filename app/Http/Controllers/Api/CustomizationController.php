<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::included()->filter()->get();
        return response()->json($customizations);
    }
}
