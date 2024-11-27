<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TestPermissionMiddleware;
use App\Models\QuestionModel;
use App\Models\QuestionOptionModel;
use App\Models\ResultModel;
use App\Models\TestModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class StudentTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $test_id = $id;
        $questions = QuestionModel::getTestQuestion($test_id);
        $test = TestModel::where('test_id', $test_id)->first();
        $result = ResultModel::where('test_id', $test_id)->where('id', Auth::user()->id)->first();


        if (!ResultModel::isEnteredTest(Auth::user()->id, $test_id)) {
            // $reult = ResultModel::create([
            //     'test_id' =>  $id,
            //     'id' => Auth::user()->id
            // ]);

            ResultModel::where('test_id', $test_id)->where('id', Auth::user()->id)
                ->update([
                    'enter_time' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
                ]);
        }


        $curent = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

        $enter = $result->enter_time ?? $curent;


        $curent_time = Carbon::createFromFormat('Y-m-d H:i:s', $curent)->timezone('Asia/Ho_Chi_Minh');
        $enter_time = Carbon::createFromFormat('Y-m-d H:i:s', $enter)->timezone('Asia/Ho_Chi_Minh');

        $time_passed = -$curent_time->diffInSeconds($enter_time);
        
        
        return view('dashboard.student.test.show', data: compact('questions', 'test', 'result', 'time_passed'));
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
