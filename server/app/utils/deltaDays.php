<?php

class DeltaDays
{
    protected $status;

    public function __construct($status = "ATIVO")
    {
        $this->status = $status;
    }

    private function verifyStatus()
    {
        return $this->status == 'ATIVO' ? true : false;
    }

    public function daysToStart($createdDate, $startDate)
    {
        if ($this->verifyStatus()) {
            if (isset($startDate)) {
                $createdDate = new DateTime($createdDate);
                $startDate = new DateTime($startDate);
                return $startDate->diff($createdDate)->days;
            }
        }
        return 0;
    }
    public function daysToFinish($startDate, $completionDate)
    {
        if ($this->verifyStatus()) {
            if (isset($completionDate)) {
                $startDate = new DateTime($startDate);
                $completionDate = new DateTime($completionDate);
                return $completionDate->diff($startDate)->days;
            }
        }
        return 0;
    }
    public function daysLate($predictedEnd, $completionDate)
    {
        if ($this->verifyStatus()) {
            if (isset($completionDate)) {
                $completionDate = new DateTime($completionDate);
                $predictedEnd = new DateTime($predictedEnd);
                if ($completionDate > $predictedEnd)
                    return $completionDate->diff($predictedEnd)->days;
            }
        }
        return 0;
    }
    public function daysLimit($completionDateLimit, $completionDate)
    {
        if ($this->verifyStatus()) {
            if (isset($completionDateLimit) && !isset($completionDate)) {
                $currentDate = new DateTime();
                $completionDateLimit = new DateTime($completionDateLimit);
                return $completionDateLimit->diff($currentDate)->days;
            }
        }
        return 0;
    }
}