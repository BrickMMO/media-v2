<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaDownload;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaDownloadController extends Controller
{
    public function store(Request $request)
    {
        $media = Media::find($request->media_id);

        if (!$media) {
            return response()->json(['message' => 'Media not found'], 404);
        }

        // Store the download record
        MediaDownload::create([
            'media_id' => $request->media_id,
            'user_id' => Auth::id() ?? null, // Use authenticated user ID or NULL if guest
        ]);

        return response()->json(['message' => 'Download tracked successfully']);
    }
}
