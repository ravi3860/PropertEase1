<div wire:ignore>
    <canvas id="usersChart"></canvas>
</div>

<script>
document.addEventListener('livewire:load', function () {
    function renderChart() {
        const ctx = document.getElementById('usersChart').getContext('2d');

        // Destroy old chart if exists
        if (window.usersChartInstance) {
            window.usersChartInstance.destroy();
        }

        window.usersChartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Users',
                    data: @json($data),
                    backgroundColor: ['rgba(253,224,71,0.7)', 'rgba(251,191,36,0.7)'],
                    borderColor: ['rgba(253,224,71,1)', 'rgba(251,191,36,1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    renderChart(); // initial render

    Livewire.hook('message.processed', (message, component) => {
        renderChart(); // re-render after any DOM update
    });
});
</script>
