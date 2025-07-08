<?php

namespace App\Models\Traits;

use App\Models\PointTransaction;

trait HasPoints
{
    public function addPoints($amount, $description)
    {
        $this->increment('points', $amount);

        PointTransaction::create([
            'user_id' => $this->id,
            'points' => $amount,
            'transaction_type' => 'earn',
            'description' => $description
        ]);
    }

    public function deductPoints($amount, $description)
    {
        if ($this->points >= $amount) {
            $this->decrement('points', $amount);

            PointTransaction::create([
                'user_id' => $this->id,
                'points' => -$amount,
                'transaction_type' => 'redeem',
                'description' => $description
            ]);

            return true;
        }
        return false;
    }

    public function getPointsHistoryAttribute()
    {
        return $this->pointTransactions()
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
