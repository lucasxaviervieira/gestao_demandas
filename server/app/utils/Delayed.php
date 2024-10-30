<?php

class Delayed
{

    public function isLate($predictedEnd, $completionDateLimit, $completionDate)
    {
        if (isset($completionDate)) {
            return $this->dateToReceive($completionDate, $predictedEnd, $completionDateLimit);
        }
        return $this->dateToReceive(null, $predictedEnd, $completionDateLimit);
    }

    private function dateToReceive($completionDate, $predictedEnd, $completionDateLimit)
    {
        $completionDate = new DateTime($completionDate);
        if (isset($completionDateLimit)) {
            $completionDateLimit = new DateTime($completionDateLimit);
            return $completionDate > $completionDateLimit ? true : false;
        }
        $predictedEnd = new DateTime($predictedEnd);
        return $completionDate > $predictedEnd ? true : false;
    }
}
