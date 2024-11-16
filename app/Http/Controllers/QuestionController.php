<?php

namespace App\Http\Controllers;

use App\Models\QuestionModel;
use App\Models\TestDetailModel;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $request->validate([
            'questions_arr' => 'required|string', // Phải là chuỗi JSON hợp lệ
        ]);

        $questionArray = json_decode($request->input('questions_arr'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }

        foreach ($questionArray as $question) {
            // Lưu câu hỏi vào cơ sở dữ liệu
            $savedQuestion = QuestionModel::create([
                'question_content' => $question['question_content']
            ]);
    
            // Lưu các lựa chọn (options) nếu có
            foreach ($question['question_options'] as $option) {
                $savedQuestion->options()->create([
                    'option_content' => $option,
                    'is_answer' => $option === $question['answer'] ? 1 : 0, // Đánh dấu câu trả lời đúng
                ]);
            }

            TestDetailModel::create([
                'test_id' => $request->input('test_id'),
                'question_id' => $savedQuestion->question_id
            ]);
        }

        return response(['question' => $questionArray], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
