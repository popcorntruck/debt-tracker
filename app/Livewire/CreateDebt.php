<?php

namespace App\Livewire;

use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateDebt extends Component
{
    use InteractsWithBanner;

    #[Validate('required|min:1|max:40')]
    public string $whosInDebt = '';

    #[Validate('required|numeric|min:.1')]
    public float $amount = 0;

    #[Validate('max:500')]
    public string $comments = '';

    public function render()
    {
        return view('livewire.create-debt');
    }

    public function create()
    {
        $this->validate();
        $userId = Auth::id();

        Debt::create(
            [
                'whos_in_debt' => $this->whosInDebt,
                'amount' => $this->amount,
                'comment' => $this->comments,
                'user_id' => $userId
            ]
        );

        $this->banner("Debt added!");
        $this->dispatch('debts-updated');
        $this->reset();
    }
}
