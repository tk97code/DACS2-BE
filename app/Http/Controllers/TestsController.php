<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function index() {
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.create-test', compact('classes'));
    }

    public function handleCreateTest() {
        $data = request()->all();

        // TestModel::query()->create();


        return response(['status' => 'ok', 'request' => request()->all()]);
    }

}
