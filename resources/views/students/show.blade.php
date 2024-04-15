{{-- resources/views/students/show.blade.php --}}
@include('partials.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Detayları</title>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <!-- Aldığı Kitaplar -->
        <div class="col-md-8">
            <h1>Aldığı Kitaplar</h1>
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>Kitap Adı</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @forelse($student->books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->status }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">Detay</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Bu öğrencinin aldığı kitap yok.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS ve bağımlılıklarını ekleme -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@include('partials.footer')
