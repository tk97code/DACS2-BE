<?php

namespace App\Http\Controllers;

use App\Models\ResultDetailModel;
use App\Models\ResultModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentResultController extends Controller
{
    public function updateElapsedTime() {
        $data = request()->all();
        $result = ResultModel::where('test_id', $data['test_id'])
            ->where('id', $data['id'])
            ->update(['elapsed_time' => $data['elapsed_time']]);
        return 'ok';
    }

    public function getTimePassed() {
        $data = request()->all();

        $result = ResultModel::where('test_id', $data['test_id'])->where('id', Auth::user()->id)->first();

        $curent = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

        $enter = $result->enter_time;


        $curent_time = Carbon::createFromFormat('Y-m-d H:i:s', $curent)->timezone('Asia/Ho_Chi_Minh');
        $enter_time = Carbon::createFromFormat('Y-m-d H:i:s', $enter)->timezone('Asia/Ho_Chi_Minh');

        $time_passed = -$curent_time->diffInSeconds($enter_time);

        return response(['time_passed' => $time_passed]);
    }

    public function storeResult() {

        $data = request()->all();
        $result = ResultModel::where('test_id', $data['test_id'])->where('id', Auth::user()->id)->first();

        $choosedOptionArr = json_decode($data['choosed_option_arr']);

        foreach ($choosedOptionArr as $choosed_option) {
            
            $choosed_option = json_decode($choosed_option);

            ResultDetailModel::create([
                'result_id' => $result->result_id,
                'question_id' => $choosed_option[0],
                'choosed_option_id' => $choosed_option[1]
            ]);
        }

        $resultDetails = ResultDetailModel::with('choosedOption')
        ->where('result_id', $result->result_id)
        ->get();

        // Tính số câu trả lời đúng
        $score = $resultDetails->filter(function ($detail) {
            return $detail->choosedOption && $detail->choosedOption->is_answer;
        })->count();

        // return response(['status' => 'ok']);
    }
}
