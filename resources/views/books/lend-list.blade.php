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
    <h1>Ödünç Verilen Kitaplar</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Kitap Başlığı</th>
            <th>Öğrenci Adı Soyadı</th>
            <th>Ödünç Tarihi</th>
            <th>İade Tarihi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lendings as $lending)
            <tr>
                <td>{{ $lending->book->title }}</td>
                <td>{{ $lending->student->name }} {{ $lending->student->surname }}</td>
                <td>{{ $lending->borrow_date }}</td>
                <td>{{ $lending->return_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Bootstrap JS ve bağımlılıklarını ekleme -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('partials.footer')
</body>
</html>
