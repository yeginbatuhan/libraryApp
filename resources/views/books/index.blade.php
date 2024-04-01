{{-- resources/views/books/index.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kitap Listesi</title>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Kitap Listesi</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Kitap Ekle</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Kitap Adı</th>
            <th>Yazar</th>
            <th>ISBN</th>
            <th>Yayın Tarihi</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->publishDate }}</td>
                <td>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary">Düzenle</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS ve bağımlılıklarını ekleme -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
