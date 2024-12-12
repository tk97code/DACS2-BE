<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\TestDeliveryModel;
use App\Models\TestModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = TestModel::where('creator_id', Auth::id())->get();

        return view('dashboard.teacher.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.teacher.test.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /*
            test_name
            class_id[]
            creator_id
            start
            end
            time_do_test
            created_on
            note
        */

        // $data = $request->all();

        $testData = $request->validate([
            'test_name' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'time_do_test' => 'required|integer|min:1',
            'creator_id' => '',
            'allow_show_answer' => '',
            'allow_show_mark' => '',
            'is_shuffle' => ''
        ]);

        // $data['creator_id'] = Auth::user()->id;
        $testData['created_on'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();


        $test = TestModel::create($testData);

        $class_id_arr = explode(',', $request->input('class_id'));

        foreach($class_id_arr as $class_id) {
           TestDeliveryModel::create(['class_id' => $class_id, 'test_id' => $test->test_id]);
        }

        return response(['test_id' => $test->test_id], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        

        return view('dashboard.teacher.test.show');
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
        TestModel::where('test_id', $id)->delete();
        return response('ok', '200');
    }
}
