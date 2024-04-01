@include('partials.navbar')
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
    <h1>Kitap Ekle</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Kitap Adı</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Kitap Adı" required>
        </div>

        <!-- Kitap adedi için yeni alan -->
        <div class="form-group">
            <label for="quantity">Kitap Adedi</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Kitap Adedi" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Ekle</button>
    </form>
</div>

<!-- Bootstrap JS ve bağımlılıklarını ekleme -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@include('partials.footer')
