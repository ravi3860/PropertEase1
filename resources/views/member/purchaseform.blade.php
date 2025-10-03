<x-app-layout>
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Purchase Property</h2>

        <!-- Property Info -->
        <div class="p-6 bg-gray-50 rounded-xl mb-6 shadow-inner">
            <h3 class="text-2xl font-semibold mb-2">{{ $property->title }}</h3>
            <p class="text-gray-700 mb-1"><strong>Price:</strong> LKR {{ number_format($property->price, 2) }}</p>
            <p class="text-gray-700 mb-1"><strong>Type:</strong> {{ $property->property_type }}</p>
            <p class="text-gray-700"><strong>Location:</strong> {{ $property->address }}, {{ $property->city }}</p>
        </div>

        <!-- Purchase Form -->
        <form id="purchaseForm" class="grid grid-cols-1 gap-6">
            @csrf
            <input type="hidden" name="property_id" value="{{ $property->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deposit Percent (%)</label>
                    <input type="number" min="0.01" max="100" step="0.01" name="deposit_percent" id="depositPercent"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deposit Amount (LKR)</label>
                    <input type="number" min="0.01" step="0.01" name="deposit_amount" id="depositAmount"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
            </div>

            <!-- Dynamic Payment Display -->
            <div class="text-gray-700 font-semibold text-lg">
                Payment Amount: <span id="paymentAmount">0.00</span> LKR
            </div>

            <!-- Contact Request -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="contact_requested" id="contactRequested" class="mr-2">
                    <span class="text-gray-700 font-medium">Request contact from seller</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-yellow-400 to-yellow-300 text-black font-bold rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all flex items-center gap-2">
                    <i class="fas fa-shopping-cart"></i> Initiate Purchase
                </button>
            </div>
        </form>
    </div>

    <script>
        const price = {{ $property->price }};
        const depositPercentInput = document.getElementById('depositPercent');
        const depositAmountInput = document.getElementById('depositAmount');
        const paymentAmountDisplay = document.getElementById('paymentAmount');
        const form = document.getElementById('purchaseForm');
        const contactRequested = document.getElementById('contactRequested');

        function updatePaymentAmount() {
            const percent = parseFloat(depositPercentInput.value) || 0;
            const amount = parseFloat(depositAmountInput.value) || 0;

            if (percent > 0) {
                const calcAmount = (percent / 100) * price;
                depositAmountInput.value = calcAmount.toFixed(2);
                paymentAmountDisplay.textContent = calcAmount.toFixed(2);
            } else if (amount > 0) {
                const calcPercent = (amount / price) * 100;
                depositPercentInput.value = calcPercent.toFixed(2);
                paymentAmountDisplay.textContent = amount.toFixed(2);
            } else {
                paymentAmountDisplay.textContent = "0.00";
            }
        }

        depositPercentInput.addEventListener('input', updatePaymentAmount);
        depositAmountInput.addEventListener('input', updatePaymentAmount);

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append('property_id', {{ $property->id }});
            formData.append('deposit_percent', depositPercentInput.value);
            formData.append('deposit_amount', depositAmountInput.value);
            formData.append('contact_requested', contactRequested.checked ? 1 : 0);

            try {
                const response = await fetch("{{ route('member.purchases.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Purchase Initiated!',
                        text: data.message || 'Deposit pending. You can confirm it now.',
                    }).then(() => {
                        window.location.href = "{{ route('member.purchases.index') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to initiate purchase.',
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unexpected error occurred!',
                });
            }
        });
    </script>
</x-app-layout>
