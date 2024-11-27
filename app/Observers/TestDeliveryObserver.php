<?php

namespace App\Observers;

use App\Models\ClassDetailModel;
use App\Models\ResultModel;
use App\Models\TestDeliveryModel;

class TestDeliveryObserver
{
    /**
     * Handle the TestDeliveryModel "created" event.
     */
    public function created(TestDeliveryModel $testDeliveryModel): void
    {
        $userInClass = ClassDetailModel::where('class_id', $testDeliveryModel->class->class_id)->get();
    
        foreach ($userInClass as $user) {
            ResultModel::create([
                'test_id' => $testDeliveryModel->test_id,
                'id' => $user->id, // id người dùng
                'mark' => 0, // Điểm ban đầu
                'elapsed_time' => 0, // Thời gian ban đầu
                'enter_time' => null, // Thời gian vào bài thi
                'number_of_correct' => 0, // Số câu đúng ban đầu
                'number_of_tab_switches' => 0, // Số lần chuyển tab ban đầu
                'submitted' => 0, // Bài thi chưa nộp
            ]);
        }
    }

    /**
     * Handle the TestDeliveryModel "updated" event.
     */
    public function updated(TestDeliveryModel $testDeliveryModel): void
    {
        //
    }

    /**
     * Handle the TestDeliveryModel "deleted" event.
     */
    public function deleted(TestDeliveryModel $testDeliveryModel): void
    {
        //
    }

    /**
     * Handle the TestDeliveryModel "restored" event.
     */
    public function restored(TestDeliveryModel $testDeliveryModel): void
    {
        //
    }

    /**
     * Handle the TestDeliveryModel "force deleted" event.
     */
    public function forceDeleted(TestDeliveryModel $testDeliveryModel): void
    {
        //
    }
}
