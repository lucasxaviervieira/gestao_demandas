<?php

class PredictedDates
{
    protected $predictStartList = array(
        'APR_PRO' => 5,
        'PAR_CON_AMB' => 7,
        'ANA_AMB' => 10,
        'MAT_LIC' => 12,
        'CON_PEN' => 24,
        'MAT_CON' => 38,
        'OFI' => 64,
    );

    protected $predictEndList = array(
        'ANA_AMB' => 15,
        'APR_PRO' => 8,
        'MAT_LIC' => 12,
        'MAT_CON' => 26,
        'REL_CON' => 30,
        'OFI' => 7,
        'VIS' => 0,
        'CON_PEN' => 2,
        'OKR' => 90,
    );

    public function dateToStart($activity)
    {
        $array = $this->predictStartList;
        $currentDate = date('Y-m-d');
        if (array_key_exists($activity, $array)) {
            $appendDays = $array[$activity];
            return date('Y-m-d', strtotime("$currentDate + $appendDays days"));
        } else {
            return $currentDate;
        }
    }

    public function dateToEnd($predictedStart, $activity)
    {
        $array = $this->predictEndList;
        if (array_key_exists($activity, $array)) {
            $appendDays = $array[$activity];
            return date('Y-m-d', strtotime("$predictedStart + $appendDays days"));
        } else if ($activity == 'PAR_CON_AMB') {
            return $this->lastDayOnMonth();
        } else {
            return null;
        }
    }
    private function lastDayOnMonth()
    {
        $currentDate = date('Y-m-d');
        $dateString = strtotime($currentDate);
        $day = date("j", $dateString);
        if ($day >= 6) {
            $newDate = date("Y-m-t", strtotime("+1 month", $dateString));
        } else {
            $newDate = date("Y-m-t", $dateString);
        }
        return $newDate;
    }
}
