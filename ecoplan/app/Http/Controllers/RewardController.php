<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::where('is_active', true)->get();
        return view('rewards.index', compact('rewards'));
    }

    public function redeem(Request $request, Reward $reward)
    {
        $user = auth()->user();

        if ($user->points < $reward->points_required) {
            return back()->with('error', 'Insufficient points');
        }

        DB::transaction(function () use ($user, $reward) {
            // Deduct points
            $user->decrement('points', $reward->points_required);

            // Record transaction
            PointTransaction::create([
                'user_id' => $user->id,
                'points' => -$reward->points_required,
                'transaction_type' => 'redeem',
                'description' => "Redeemed reward: {$reward->name}"
            ]);
        });

        return back()->with('success', 'Reward redeemed successfully');
    }
}
