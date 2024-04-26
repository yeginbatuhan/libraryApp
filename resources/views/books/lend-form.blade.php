<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Kitap Ekle</title>
        <!-- Bootstrap CSS ekleme -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <h1>Kitap Ödünç Ver</h1>
        <form action="{{ route('books.lend.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="book_id">Kitap Seç</label>
                <select class="form-control" id="book_id" name="book_id">
                    @foreach($books as $book)
                        <!-- Kitap adet sayısı 0 olmadığı sürece listelenir -->
                        @if($book->quantity != 0)
                            <option value="{{ $book->id }}">{{ $book->title }} <span class="float-right">({{ $book->quantity }})</span></option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="student_id">Öğrenci Seç</label>
                <select class="form-control" id="student_id" name="student_id">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} {{ $student->surname }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ödünç Ver</button>
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
