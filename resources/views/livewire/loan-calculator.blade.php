<div>
    <div class="max-w-xl mx-auto text-center mt-10 mb-10">
        <h2 class="text-3xl text-gray-900 font-extrabold">Loan Calculator</h2>
    </div>

    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl border-2 border-yellow-300 p-6 mb-[100px]">
        <div class="grid grid-cols-2 gap-6 mb-6">
            
            <!-- Loan amount input -->
            <div>
                <label class="block text-gray-800 text-sm font-semibold">Loan Amount</label>
                <input type="number" wire:model="loanAmount" placeholder="Enter loan amount"
                    class="w-full mt-1 p-3 border border-yellow-300 rounded-lg bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    min="0" step="any" />
            </div>

            <!-- Eligible amount display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-800 text-sm font-semibold">Total Amount</label>
                <h2 class="text-xl font-semibold text-gray-900 mt-2">
                    Rs: {{ number_format($eligibleAmount, 2) }}
                </h2>
            </div>

            <!-- Loan tenure input -->
            <div>
                <label class="block text-gray-800 text-sm font-semibold">Loan Tenure (Months)</label>
                <input type="number" wire:model="loanTenure" placeholder="Enter tenure"
                    class="w-full mt-1 p-3 border border-yellow-300 rounded-lg bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    min="1" />
            </div>

            <!-- Added interest display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-800 text-sm font-semibold">Added Interest</label>
                <h2 class="text-xl font-semibold text-gray-900 mt-2">
                    Rs: {{ number_format($addedInterest, 2) }}
                </h2>
            </div>

            <!-- Interest rate input -->
            <div>
                <label class="block text-gray-800 text-sm font-semibold">Interest Rate (%)</label>
                <input type="number" wire:model="interestRate" placeholder="Enter interest rate"
                    class="w-full mt-1 p-3 border border-yellow-300 rounded-lg bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    min="0" step="any" />
            </div>

            <!-- Monthly amount display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-800 text-sm font-semibold">Monthly Amount</label>
                <h2 class="text-xl font-semibold text-gray-900 mt-2">
                    Rs: {{ number_format($monthlyAmount, 2) }}
                </h2>
            </div>
        </div>

        <!-- Calculate button -->
        <div class="flex justify-center">
            <button class="bg-yellow-400 text-gray-900 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-yellow-500 hover:shadow-lg transition"
                wire:click="calculate">
                Calculate
            </button>
        </div>
    </div>
</div>
