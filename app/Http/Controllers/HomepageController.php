<?php

namespace App\Http\Controllers;
use App\Models\ModelInventaris;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function show($id)
    {
        $inventaris = ModelInventaris::findOrFail($id);
        return view('home.inventaris_detail', compact('inventaris'));
    }
}