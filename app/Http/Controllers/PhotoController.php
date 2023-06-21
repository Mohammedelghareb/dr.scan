<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Str;
use Flysystem\GoogleDrive\GoogleDriveAdapter;
use Spatie\Backup\Helpers\File;



class PhotoController extends Controller
{
    public function uploadPhoto(Request $request, $user_id)
    {
        $user = Auth::user();
        $user = User::find($user_id);
        $this->validate($request, [

            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'result' => 'required|string',
        ]);

        $photo = $request->file('path');
        $response = Http::attach('path', $photo);
        $photo = \Illuminate\Support\Str::random(32) . "." . $request->path->getClientOriginalExtension();
        $photos = Photo::where('user_id', $user_id)->get();
        $save = new photo([
            'path' => $photo,
            'result' => $request->get('result'),
            'user_id' => $photos->get('id'),
        ]);
        // to save image in storage folder
        Storage::disk('public')->put($photo, file_get_contents($request->path));
        $save->user_id = $user->id;
        $save->save();

        return response()->json([$save]);
    }
}
