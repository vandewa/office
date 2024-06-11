<form method="POST" action="{{route ('word.index')}}">
    @csrf
    <label for="nama">nama</label>
    <input type="text" name="nama">

    <label for="kelas">kelas</label>
    <input type="text" name="kelas">

    <input type="submit" value="submit" />
    </form>

    <form method="POST" action="{{ route('word.convert') }}">
        @csrf
        <input type="submit" value="Convert to PDF">

        {{-- <embed src="{{ $pdfPath }}" type="application/pdf" width="100%" height="600px" /> --}}

    </form>
