<x-app-layout>
    @include('partials.navbar')

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

    @include('partials.footer')
</x-app-layout>
