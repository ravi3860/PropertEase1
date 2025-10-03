<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class DashboardPropertiesChart extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        // Get properties count grouped by month
        $properties = Property::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Prepare labels and data
        $this->labels = $properties->pluck('month')->map(fn($m) => date("F", mktime(0,0,0,$m,1)))->toArray();
        $this->data = $properties->pluck('count')->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard-properties-chart');
    }
}