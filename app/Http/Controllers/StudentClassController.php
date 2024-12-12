<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClassPermissionMiddleware;
use App\Models\ClassDetailModel;
use App\Models\ClassModel;
use App\Models\ResultModel;
use App\Models\TestDeliveryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class StudentClassController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware(ClassPermissionMiddleware::class, only: ['show', 'edit', 'update', 'create', 'destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $classes = ClassDetailModel::getStudentClasses(Auth::user()->id);

        return view('dashboard.student.class.index', compact('classes'));
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
        // store in class_detail
        if (ClassModel::where('invite_code', $request->invite_code)->exists()) {

            $class = ClassModel::where('invite_code', $request->invite_code)->first();

            if (ClassDetailModel::where('class_id', $class->class_id)->where('id', Auth::user()->id)->exists()) {
                return response(['status' => 'user has invited this class']);
            } else {
                $class_detail = ClassDetailModel::create([
                    'class_id' => $class->class_id,
                    'id' => Auth::user()->id
                ]);

                $class = ClassModel::where('class_id',  $class_detail->class_id)->first();

                $testDelivery = TestDeliveryModel::where('class_id',  $class->class_id)->get();

                foreach($testDelivery as $test) {
                    ResultModel::create([
                        'test_id' => $test->test_id,
                        'id' => Auth::user()->id, // id người dùng
                        'mark' => 0, // Điểm ban đầu
                        'elapsed_time' => 0, // Thời gian ban đầu
                        'enter_time' => null, // Thời gian vào bài thi
                        'number_of_correct' => 0, // Số câu đúng ban đầu
                        'number_of_tab_switches' => 0, // Số lần chuyển tab ban đầu
                        'submitted' => 0, // Bài thi chưa nộp
                    ]);
                }
            }
            
            // return response(['status' => 'ok']);
            return response(['class' => $class]);
        } else {
            return response(['status' => 'not find invite code']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return $id;
        $class_id = $id;
        $tests = ClassModel::getTestOfClass($class_id);
        $class = ClassModel::where('class_id', $class_id)->first();
        $is_entered_test = [];
        $isOverTime = [];
        $submitted = [];
        foreach ($tests as $test) {
            $is_entered_test[$test->test_id] = ResultModel::isEnteredTest(Auth::user()->id, $test->test_id);
            $submitted[$test->test_id] = ResultModel::submitted(Auth::user()->id, $test->test_id);

            $result = ResultModel::where('test_id', $test->test_id)->where('id', Auth::user()->id)->first();

            $curent = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();


            // $enter = $result->enter_time;

            $enter = $result->enter_time ?? $curent;


            $curent_time = Carbon::createFromFormat('Y-m-d H:i:s', $curent)->timezone('Asia/Ho_Chi_Minh');
            $enter_time = Carbon::createFromFormat('Y-m-d H:i:s', $enter)->timezone('Asia/Ho_Chi_Minh');

            $time_passed = -$curent_time->diffInSeconds($enter_time);
            
            if ($test->time_do_test * 60 - $time_passed < 0) {
                $isOverTime[$test->test_id] = true;
            }
        }
        return view('dashboard.student.class.show', compact(
            'tests', 'class', 'is_entered_test', 'isOverTime', 'submitted'
        ));
        // return json_encode($isOverTime);

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
