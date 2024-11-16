<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\TestModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.test.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.test.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validatedata = $request->validate([
            'test_name' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'time_do_test' => 'required|integer|min:1',
        ]);

        // $data['creator_id'] = Auth::user()->id;
        $data['created_on'] = Carbon::now()->toDateTimeString();


        $test = TestModel::create($data);

        return response(['test_id' => $test->test_id], 200);
        // return redirect()->route('question.create', ['test' => $test->id])
        //              ->with('success', 'Test created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
