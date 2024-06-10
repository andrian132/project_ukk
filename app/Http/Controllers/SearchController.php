<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Kategori::search($query); // Use the search method from the model

        return view('v_kategori.relasi', ['rsetKategori' => $results]);
    }

}