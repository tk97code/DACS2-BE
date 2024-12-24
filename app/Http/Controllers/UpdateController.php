<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function updateClass(string $id)
    {
        $class = ClassModel::find($id);
        // dd(request()->all());
        $class->class_name = request()->class_name;
        $class->class_note = request()->class_note;
        $class->save();

        return response()->json([
            'updated_class' => $class,
        ]);
    }

}
