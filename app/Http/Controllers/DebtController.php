<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function show(Request $request)
    {
        $userId = Auth::id();

        $debts = Debt::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalDebt = $debts->sum(fn ($debt) => $debt->amount);

        return view("debt", [
            'debts' => $debts,
            'totalDebt' => $totalDebt
        ]);
    }

    public function delete(Debt $debt)
    {
        $userId = Auth::id();

        if ($debt->user_id != $userId) {
            return redirect()->route('debt')->dangerBanner('You cannot delete this debt entry!');
        }

        $debt->delete();

        return redirect()->route('debt')->banner('Deleted debt entry');
    }
}
