<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaravelApp</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light text-center"
     style="background-color: rgba(0, 51, 87, 0.85); border-radius: 0 0 15% 15%;">
    <a class="navbar-brand" href="#" style="color: white;">LaravelApp</a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/books" style="color: white;">Kitaplar<span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/students" style="color: white;">Öğrenciler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/books/create" style="color: white;">Kitap Ekle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/books/lend" style="color: white;">Ödünç Ver</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
<!-- Bootstrap JS ve diğer bağımlılıklar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.navbar-toggler').click(function(){
            $('.navbar-collapse').toggle('show');
        });
    });
</script>
</body>
</html>
