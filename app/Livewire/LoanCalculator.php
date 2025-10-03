<?php

namespace App\Livewire;

use Livewire\Component;

class LoanCalculator extends Component
{
 public $loanAmount = 0;
    public $loanTenure = 0;
    public $interestRate = 0;

    public $eligibleAmount = 0;
    public $addedInterest = 0;
    public $monthlyAmount = 0;

    public function calculate()
    {
        // Calculate the total eligible amount
        $this->eligibleAmount = $this->loanAmount + ($this->loanAmount * $this->interestRate / 100);

        // Calculate the added interest
        $this->addedInterest = $this->loanAmount * $this->interestRate / 100;

        // Calculate monthly amount
        if ($this->loanTenure > 0) {
            $this->monthlyAmount = $this->eligibleAmount / $this->loanTenure;
        } else {
            $this->monthlyAmount = 0;
        }
    }

    public function render()
    {
        return view('livewire.loan-calculator');
    }
}