@include('partials.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Detayları</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1>Aldığı Kitaplar</h1>
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>Kitap Adı</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @forelse($student->books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#bookDetailModal"
                                    data-title="{{ $book->title }}"
                                    data-borrowed="{{ $book->borrowed_at instanceof \Carbon\Carbon ? $book->borrowed_at->format('d.m.Y H:i') : 'Bilgi Yok' }}"
                                    data-returned="{{ $book->returned_at instanceof \Carbon\Carbon ? $book->returned_at->format('d.m.Y H:i') : 'Bilgi Yok' }}">
                                Detay
                            </button>
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

<!-- Modal -->
<div class="modal fade" id="bookDetailModal" tabindex="-1" role="dialog" aria-labelledby="bookDetailModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookDetailModalLabel">Kitap Detayları</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kitap Adı: <span id="modalBookTitle"></span></p>
                <p>Ödünç Alınma Tarihi: <span id="modalBorrowedDate"></span></p>
                <p>İade Tarihi: <span id="modalReturnedDate"></span></p>
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
<script>
    $('#bookDetailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var borrowed = button.data('borrowed');
        var returned = button.data('returned');

        var modal = $(this);
        modal.find('.modal-title').text(title + ' Detayları');
        modal.find('#modalBookTitle').text(title);
        modal.find('#modalBorrowedDate').text(borrowed);
        modal.find('#modalReturnedDate').text(returned);
    });
</script>
@include('partials.footer')
</body>
</html>
