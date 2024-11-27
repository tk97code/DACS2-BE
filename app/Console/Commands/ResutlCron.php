<?php

namespace App\Console\Commands;

use App\Models\ResultModel;
use Illuminate\Console\Command;

class ResutlCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'result:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $results = ResultModel::where('submitted', 0)->get();
        foreach ($results as $result) {
            ResultModel::checkAndUpdateSubmission($result->result_id);
        }
    }
}
