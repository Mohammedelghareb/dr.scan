<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;






class PhotoController extends Controller
{
    public function uploadPhoto(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'result' => 'required|string',
        ]);

        $photo = $request->file('path');
        $response = Http::attach('path', $photo);
        $photo = \Illuminate\Support\Str::random(32) . "." . $request->path->getClientOriginalExtension();
        $save = new photo([
            'path' => $photo,
            'result' => $request->get('result'),
        ]);
        // to save image in storage folder
        Storage::disk('public')->put($photo, file_get_contents($request->path));
        $save->user_id = $user->id;
        $save->save();
        return response()->json(['message' => 'photo and prossing  saved Successfully']);
    }
    public function show(){
        $save = Photo::orderBy('id', 'desc')->get();

        return response()->json($save, 200);
    }
}
