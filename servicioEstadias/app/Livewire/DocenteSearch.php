<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
class DocenteSearch extends Component
{
    public $search = '';

    public function render()
    {
        $docentes = User::where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.docente-search', compact('docentes'));
    }
}
