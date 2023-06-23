<?php

namespace App\Http\Controllers;


use App\Models\Diagnosis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnoses = Diagnosis::orderBy('id', 'desc')->get();

        return response()->json($diagnoses, 200);
    }

   
    public function create(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'diagnosis' => 'required|array',
            'symptoms' => 'required|array',
        ]);
        $user = Auth::user();
        $diagnosis = new Diagnosis;
        $diagnosis->date = $request->date;
        $diagnosis->time = $request->time;
        $diagnosis->diagnosis = $request->diagnosis;
        $diagnosis->symptoms = $request->symptoms;
        $diagnosis->user_id = $user->id;
        $diagnosis->save();


        return response()->json([
            'message' => 'Diagnosis saved Successfully'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     */
    public function show(Diagnosis $diagnosis, $user_id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
}
