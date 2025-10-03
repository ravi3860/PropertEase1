<div>
    <canvas id="propertiesChart"></canvas>

    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('propertiesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Properties Added',
                        data: @json($data),
                        backgroundColor: 'rgba(253, 224, 71, 0.7)',
                        borderColor: 'rgba(253, 224, 71, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: { beginAtZero: true, precision: 0 }
                    }
                }
            });
        });
    </script>
</div>
