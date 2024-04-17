@include('partials.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Listesi</title>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Kitap Listesi</h1>
        <a href="{{ route('books.create') }}" class="btn btn-info">Yeni Kitap Ekle</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th class="text-center">Kitap Adı</th>
            <th class="text-center">Kitap Adedi</th>
            <th class="text-center">Durumu</th>
            <th class="text-center">İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td class="text-center">{{ $book->title }}</td>
                <td class="text-center">{{ $book->quantity }}</td>
                <td class="text-center">{{ $statusOptions[$book->status] }}</td>
                <td class="text-center">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Düzenle</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bu kitabı silmek istediğinizden emin misiniz?')">Sil</button>
                    </form>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $book->id }}">Detay</button>
                    @if($book->status == 'checked_out')
                        <form action="{{ route('books.return', $book->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning">İade Et</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS ve diğer bağımlılıklar -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('partials.footer')
</body>
</html>
