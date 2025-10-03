<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;
use App\Models\Agent;

class DashboardUsersChart extends Component
{
    public $labels = ['Members', 'Agents'];
    public $data = [];

    public function mount()
    {
        $membersCount = Member::count();
        $agentsCount = Agent::count();

        $this->data = [$membersCount, $agentsCount];
    }

    public function render()
    {
        return view('livewire.dashboard-users-chart');
    }
}