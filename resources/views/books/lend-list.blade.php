<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Ödünç Verilen Kitaplar</title>
        <!-- Bootstrap CSS ekleme -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ödünç Verilen Kitaplar') }}
            </h2>
        </x-slot>
        <div class="d-flex justify-content-right mb-3">
            <a href="{{ route('books.lend.form') }}" style="height: 38px;width: 148px;display: flex;justify-content: center;align-items: center;" class="btn btn-info">Kitap Ödünç Ver</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Kitap Başlığı</th>
                <th>Öğrenci Adı Soyadı</th>
                <th>Ödünç Tarihi</th>
                <th>İade Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->student->name }} {{ $loan->student->surname }}</td>
                    <td>{{ $loan->borrowed_at }}</td>
                    <td>{{ $loan->returned_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS ve bağımlılıklarını ekleme -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @include('partials.footer')
    </body>
    </html>
</x-app-layout>
