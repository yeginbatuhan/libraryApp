<!-- resources/views/books/index.blade.php -->
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
        <!-- Veritabanından kitapları listeleme -->
        @foreach($books as $book)
            <tr>
                <td class="text-center">{{ $book->title }}</td>
                <td class="text-center">{{ $book->quantity }}</td> <!-- Kitap adedi eklendi -->
                <td class="text-center">{{ $statusOptions[$book->status] }}</td>
                <td class="text-center">
                    <!-- Düzenleme linki -->
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Düzenle</a>
                    <!-- Silme formu -->
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bu kitabı silmek istediğinizden emin misiniz?')">Sil</button>
                    </form>
                    <!-- Detay butonu -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $book->id }}">Detay</button>
                </td>
            </tr>
            <!-- Kitap detay modalı -->
            <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $book->id }}">Kitap Detayı</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left"> <!-- Text-align left -->
                            <p><strong>Kitap adı:</strong> {{ $book->title }}</p>
                            <p><strong>Kitap adedi:</strong> {{ $book->quantity }}</p>
                            <p><strong>Kitap durumu:</strong> {{ $statusOptions[$book->status] }}</p>
                            <!-- Kitabın hangi öğrencide olduğu veya başka detaylar buraya eklenebilir -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ödünç ver modalı -->
            <div class="modal fade" id="lendModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="lendModalLabel{{ $book->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="lendModalLabel{{ $book->id }}">Ödünç Ver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('books.lend', $book->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="student_id">Öğrenci Adı Soyadı</label>
                                    <select name="student_id" class="form-control">
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Ödünç Ver</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS ve diğer bağımlılıklar -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('partials.footer')
