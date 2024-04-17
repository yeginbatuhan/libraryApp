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
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>@forelse($student->books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>
                            <!-- Modal tetikleyici buton -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bookDetailModal{{ $book->id }}">Detay</button>

                            <!-- Modal -->
                            <div class="modal fade" id="bookDetailModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="bookDetailModalLabel{{ $book->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bookDetailModalLabel{{ $book->id }}">Kitap Detayları</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Kitap Adı: {{ $book->title }}</p>
                                            <p>Ödünç Alınma Tarihi: {{ $book->borrowed_at ? $book->borrowed_at->format('d.m.Y H:i') : 'Bilgi Yok' }}</p>
                                            <p>İade Tarihi: {{ $book->returned_at ? $book->returned_at->format('d.m.Y H:i') : 'Bilgi Yok' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Bu öğrencinin aldığı kitap yok.</td>
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
