<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClassPermissionMiddleware;
use App\Models\ClassDetailModel;
use App\Models\ClassModel;
use App\Models\ResultModel;
use App\Models\TestDeliveryModel;
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
        foreach ($tests as $test) {
            $is_entered_test[$test->test_id] = ResultModel::isEnteredTest(Auth::user()->id, $test->test_id);
        }
        return view('dashboard.student.class.show', compact('tests', 'class', 'is_entered_test'));

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
