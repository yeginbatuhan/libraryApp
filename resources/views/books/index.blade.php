<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kitap Listesi</title>
        <!-- Bootstrap CSS ekleme -->
        <!-- Bootstrap CSS ekleme -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kitap Listesi') }}
            </h2>
        </x-slot>
        <div class="d-flex justify-content-right mb-3">
            <a href="{{ route('books.create') }}"
               style="height: 38px;width: 148px;display: flex;justify-content: center;align-items: center;"
               class="btn btn-info">Yeni Kitap Ekle</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">Kitap Adı</th>
                <th class="text-center">Kitap Adedi</th>
                <th class="text-center">Mevcut</th>
                <th class="text-center">Verilen</th>
                <th class="text-center">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td class="text-center">{{ $book->title }}</td>
                    <td class="text-center">{{ $book->quantity }}</td>
                    <td class="text-center">{{ $statusOptions[$book->status] }} Adet: {{($book->quantity ) - ($book->borrowed_count) }}</td>
                    <td class="text-center">Ödünç Verilen Adet: {{$book->borrowed_count }}</td>
                    <td class="text-center">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Düzenle</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bu kitabı silmek istediğinizden emin misiniz?')">Sil
                            </button>
                        </form>
                        @if($book->borrowed_count > 0)
                            <a href="{{ route('books.lend.payment')}}">
                                <button type="submit" class="btn btn-warning">İade İşlemleri</button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end align-items-center">
            {{ $books->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Bootstrap JS ve diğer bağımlılıklar -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS ekleme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @include('partials.footer')
    </body>
    </html>
</x-app-layout>
