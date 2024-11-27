<?php

namespace App\Http\Controllers;

use App\Models\ResultDetailModel;
use App\Models\ResultModel;
use App\Models\TestDetailModel;
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
        $correct = $resultDetails->filter(function ($detail) {
            return $detail->choosedOption && $detail->choosedOption->is_answer;
        })->count();

        $number_of_question = TestDetailModel::getNumberOfQuestion($data['test_id']);

        $score = round((10 / $number_of_question) * $correct, 2);

        ResultModel::where('result_id', $result->result_id)
        ->update([
            'score' => $score,
            'number_of_correct' => $correct,
            'submitted' => 1
        ]);

        // $score = ()

        // return response(['status' => 'ok']);
    }

    public function getSubmittedStatus() {
        $data = request()->all();
        $submitted = ResultModel::submitted(Auth::user()->id, $data['test_id']);
        return response(['submitted' => $submitted]);
    }

    public function getResult(string $test) {
        $score = ResultModel::where('test_id', $test)->where('id', Auth::user()->id)->first()->score;
        return view('dashboard.student.test.result.index', compact('score'));
    }
}
