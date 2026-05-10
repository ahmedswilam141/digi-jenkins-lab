<?php

namespace App;

class SubscriptionManager
{
    public function calculateRemainingDays($totalDays, $daysUsed)
    {
        return $totalDays - $daysUsed;
    }
}
