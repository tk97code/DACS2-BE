<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller {
    public function index() {
        $total_class = Auth::user()->class->count();
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.class', compact('total_class', 'classes'));
    }
    
    public function handleCreateclass() {
        $data = request()->all();
        ClassModel::query()->create($data);
        return response(['current_total_class' => Auth::user()->class->count(), 'new_class' => $data]);
    }
}
