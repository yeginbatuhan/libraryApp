<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Öğrenci Ekle</title>
        <!-- Bootstrap CSS ekleme -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Öğrenci Ekle') }}
            </h2>
        </x-slot>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Öğrenci Adı</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Öğrenci Adı" required>
            </div>
            <div class="form-group">
                <label for="surname">Öğrenci Soyadı</label>
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Öğrenci Soyadı"
                       required>
            </div>
            <div class="form-group">
                <label for="classroom">Öğrenci Sınıfı</label>
                <input type="number" class="form-control" id="classroom" name="classroom" placeholder="Öğrenci Sınıfı"
                       required min="1" max="8">
            </div>
            <button type="submit" class="btn btn-primary">Ekle</button>
        </form>
    </div>
    <!-- Bootstrap JS ve bağımlılıklarını ekleme -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @include('partials.footer')
    </body>
    </html>
</x-app-layout>
