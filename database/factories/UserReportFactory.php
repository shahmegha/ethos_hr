<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserReport>
 */
class UserReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = sprintf("%02d", rand(7, 12)).":".sprintf("%02d", rand(0,59)).":".sprintf("%02d", rand(0,59));
        $endTime = sprintf("%02d", rand(13, 24)).":".sprintf("%02d", rand(0,59)).":".sprintf("%02d", rand(0,59));
        $breakStartTime1 = $this->rand_date($startTime,( date("H:i:s", strtotime($endTime) - (6 * 60 * 60) )) );
        $breakEndTime1 = $this->rand_date($breakStartTime1,( date("H:i:s", strtotime($endTime) - (6 * 60 * 60) )));

        $breakStartTime2 = $this->rand_date($breakEndTime1,( date("H:i:s", strtotime($endTime) - (4 * 60 * 60) )) );
        $breakEndTime2 = $this->rand_date($breakStartTime2,( date("H:i:s", strtotime($endTime) - (4 * 60 * 60) )));

        $breakTime = array(array("start_time"=>$breakStartTime1,"end_time"=>$breakEndTime1),array("start_time"=>$breakStartTime2,"end_time"=>$breakEndTime2));

        $breakTotalTime = $this->getTotalBreakTime($breakTime);

        $totalTime = date("H:i:s",(strtotime($startTime) - strtotime($endTime) - strtotime($breakTotalTime)));
        $report_date = $this->randomDate("Y-m-d");
        return [
            'report_date'=>$report_date,
            'log_in' => $startTime,
            'log_out' => $endTime,
            'breaks' => json_encode($breakTime),
            'break_total' => $breakTotalTime ,
            'total_time'=> $totalTime
        ];
    }

    private function randomDate($sFormat = 'Y-m-d H:i:s')
    {
        $sStartDate = "2014-01-01";
        $sEndDate = date("Y-m-d");
        // Convert the supplied date to timestamp
        $fMin = strtotime($sStartDate);
        $fMax = strtotime($sEndDate);

        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);

        // Convert back to the specified date format
        return date($sFormat, $fVal);
    }

    private function getTotalBreakTime($breakTime){
        $totalTime = 0;
        
        foreach($breakTime as $btime){
            $timediff = (strtotime($btime['end_time']) - strtotime($btime['start_time']));
            $totalTime = ($totalTime + $timediff);
        }
        $totalTime = date("H:i:s",$totalTime);
        return $totalTime;
    }

    private function rand_date($min_date, $max_date) {
        /* Gets 2 dates as string, earlier and later date.
           Returns date in between them.
        */

        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);

        $rand_epoch = rand($min_epoch, $max_epoch);

        return date('H:i:s', $rand_epoch);
    }
}
