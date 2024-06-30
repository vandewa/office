<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="createDocument" class="btn btn-primary">Buat Dokumen</button>

    @if (Storage::disk('public')->exists($filename))
        <a href="{{ Storage::url($filename) }}" class="btn btn-success" download>Unduh Dokumen Word</a>
    @endif

    @if (Storage::disk('public')->exists($pdfFilename))
        <a href="{{ Storage::url($pdfFilename) }}" class="btn btn-success" download>Unduh Dokumen PDF</a>
    @endif
</div>
