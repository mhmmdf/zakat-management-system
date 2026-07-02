<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanZakat;

class DashboardController extends Controller
{
    public function index()
    {
        $items = PengumpulanZakat::all();

        return view('pages.backend.index', [
            'items' => $items
        ]);
    }
}
