{{-- resources/views/books/index.blade.php --}}
@include('partials.navbar')

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
        <a href="{{ route('books.create') }}" style="width: 15%;height: 25%" class="btn btn-info">Kitap Ekle</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Kitap Adı</th>
            <th>Durumu</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        <!-- Burada kitapların listesi olacak, her kitap için bir satır -->
        <tr>
            <td>Kitap Adı 1</td>
            <td>Durumu 1</td>
            <td>
                <!-- Düzenleme linki -->
                <a href="{{ route('books.edit', 1) }}" class="btn btn-primary">Düzenle</a>
                <!-- Silme formu -->
                <form action="{{ route('books.destroy', 1) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sil</button>
                </form>
                <!-- Detay butonu -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal">Detay</button>
            </td>
        </tr>
        <!-- Diğer kitaplar için benzer satırlar -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Kitap Detayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Kitap adı: Kitap Adı 1<br>
                Kitap durumu: Durumu 1<br>
                Kitap Hangi Öğrencide

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@include('partials.footer')
