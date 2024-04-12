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
        $totalDebt = Debt::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->sum('amount');

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
