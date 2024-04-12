<?php

namespace App\Livewire;

use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class DebtList extends Component
{
    use InteractsWithBanner;

    #[Url(as: 'q')]
    public string $search = '';


    public function render()
    {
        $query = Debt::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if (!empty($this->search)) {
            $query = $query->where('whos_in_debt', 'LIKE', '%' . $this->search . '%')
                ->orWhere('amount', 'LIKE', '%' . $this->search . '%')
                ->orWhere('comment', 'LIKE', '%' . $this->search . '%');
        }

        $debts = $query->get();

        return view('livewire.debt-list', [
            'debts' => $debts
        ]);
    }

    public function delete(int $id)
    {
        $debt = Debt::findOrFail($id);
        $userId = Auth::id();

        if ($debt->user_id != $userId) {
            $this->dangerBanner('You cannot delete this debt entry!');
            return;
        }

        $debt->delete();

        $this->banner('Deleted debt entry');
        $this->dispatch('debts-updated');
    }

    #[On("debts-updated")]
    public function debtsUpdated()
    {
        $this->dispatch('$refresh');
    }
}
