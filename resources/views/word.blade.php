{{-- <form method="POST" action="{{route ('word.index')}}">
    @csrf
    <label for="nama">nama</label>
    <input type="text" name="nama">

    <label for="kelas">kelas</label>
    <input type="text" name="kelas">

    <input type="submit" value="submit" />
    </form> --}}

    {{-- <form method="POST" action="{{ route('word.convert') }}">
        @csrf
        <input type="submit" value="Convert to PDF">

        <embed src="{{ $pdfPath }}" type="application/pdf" width="100%" height="600px" />

    </form> --}}


    <!-- resources/views/word/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload HTML Document</title>
</head>
<body>
    <h2>Upload HTML Document to Convert to PDF</h2>
    <form action="{{ route('word.convert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="html_file">Choose HTML file:</label>
        <input type="file" id="html_file" name="html_file" accept=".html">
        <button type="submit">Convert to PDF</button>
    </form>
</body>
</html>

