<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Sol Kart -->
                        <div class="border-l-4 p-4">
                            <p class="font-bold">Öğrenci Sayısı</p>
                            <p>{{ $studentCount }} öğrenci mevcut.</p>
                        </div>
                        <!-- Sağ Kart -->
                        <div class="border-l-4 p-4">
                            <p class="font-bold">Kitap Sayısı</p>
                            <p>{{ $bookCount }} kitap mevcut.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grafik için bir canvas elementi -->
            <canvas id="studentBooksChart"></canvas>
            <script>
                var ctx = document.getElementById('studentBooksChart').getContext('2d');
                var studentBooksChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! $students->pluck('name')->toJson() !!},
                        datasets: [{
                            label: 'Okunan Kitap Sayısı',
                            data: {!! $students->pluck('books_count')->toJson() !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgb(54,160,235)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>
    @include('partials.footer')
</x-app-layout>
