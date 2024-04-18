{{-- resources/views/students/index.blade.php --}}
@include('partials.navbar')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Listesi</title>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Öğrenci Listesi</h1>
        <a href="{{ route('students.create') }}" style="display: flex;justify-content: center;align-items: center;" class="btn btn-info">Yeni Öğrenci Ekle</a>
    </div>
    <table class="table text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Sınıfı</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surname }}</td>
                <td>{{ $student->classroom }}</td>
                <td>
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">Göster</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Düzenle</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Öğrenciyi silmek istediğinizden emin misiniz?')">Sil</button>
                    </form>
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
