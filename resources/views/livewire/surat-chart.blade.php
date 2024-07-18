<!-- surat-chart.blade.php -->
<!-- surat-chart.blade.php -->
<style>
    #myChart {
        height: 100%;
        width: 100%;
    }
</style>

<div style="height: 200px; width: 100%;">
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Surat Masuk', 'Surat Keluar'],
        datasets: [{
            // label: 'Jumlah Surat',
            data: [{{ $suratMasukCount }}, {{ $suratKeluarCount }}],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)', // Warna untuk Surat Masuk
                'rgba(255, 99, 132, 0.2)' // Warna untuk Surat Keluar
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true, // Memungkinkan responsivitas (menggunakan ukuran kontainer)
        maintainAspectRatio: false, // Menonaktifkan rasio aspek default
        plugins: {
            legend: {
                position: 'top', // Menetapkan posisi legenda di atas grafik
            },
            tooltip: {
                enabled: true // Mengaktifkan tooltip
            }
        },
        scales: {
            y: {
                beginAtZero: true // Mulai sumbu Y dari angka nol
            }
        }
    }
});

</script>
