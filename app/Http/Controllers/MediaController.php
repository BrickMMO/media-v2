<?php

namespace App\Http\Controllers;

use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all(); // Fetch all data from the 'media' table
        return view('media.index', ['data' => $media]);
    }
    
}
