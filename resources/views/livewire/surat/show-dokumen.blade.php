<!DOCTYPE html>
<html>
<head>
    {{-- <title>Tampilkan Dokumen</title> --}}
</head>
<body>
    {{-- <h1>Tampilkan Dokumen</h1> --}}
    @if (isset($documentUrl))
        <embed src="{{ $documentUrl }}" width="100%" height="600px" type="application/pdf" />
    @endif
</body>
</html>
