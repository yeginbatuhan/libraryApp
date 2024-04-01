{{-- resources/views/books/edit.blade.php --}}
@include('partials.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kitap Düzenle</title>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Kitap Düzenle</h1>
    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT') <!-- Form methodunu PUT olarak ayarla -->
        <div class="form-group">
            <label for="title">Kitap Adı</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Kitap Adedi</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $book->quantity }}"
                   required min="1">
        </div>
        <div class="form-group">
            <label for="status">Durum</label>
            <select class="form-control" id="status" name="status" required>
                @foreach($statusOptions as $key => $value)
                    <option value="{{ $key }}" @if($book->status == $key) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<!-- Bootstrap JS ve bağımlılıklarını ekleme -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@include('partials.footer')
