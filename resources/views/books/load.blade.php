@include('partials.navbar')

@section('content')
    <div class="container">
        <h1>Kitaplar</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Kitap Adı</th>
                <th>Yazar</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->status }}</td>
                    <td>
                        @if($book->status === 'available')
                            <form action="/books/{{ $book->id }}/borrow" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Ödünç Al</button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>Ödünç Alınamaz</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@include('partials.footer')
