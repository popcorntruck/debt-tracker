<?php

namespace App\Livewire;

use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TotalDebt extends Component
{
    public function render()
    {
        $userId = Auth::id();

        $debts = Debt::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalDebt = $debts->sum(fn ($debt) => $debt->amount);

        return view('livewire.total-debt', [
            'totalDebt' => $totalDebt
        ]);
    }

    #[On("debts-updated")]
    public function debtsUpdated()
    {
        $this->dispatch('$refresh');
    }
}
