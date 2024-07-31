<div>
    <style>
        .custom-select-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-select-search {
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            box-sizing: border-box;
        }

        .custom-select-options {
            position: absolute;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            background-color: #fff;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            display: none;
        }

        .custom-select-option {
            padding: .375rem .75rem;
            cursor: pointer;
        }

        .custom-select-option:hover {
            background-color: #f1f1f1;
        }

        .custom-select-options.show {
            display: block;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2>Form Surat Undangan</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('sekretariat')
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unggah Dokumen</label>
                                <div class="col-lg-9">
                                    {{-- <form action="{{ route('unggah-dokumen.storekeluar') }}" method="POST"
                                        enctype="multipart/form-data"> --}}
                                    {{-- @if ($metodeTtd === 'ttd_offline') --}}
                                    @if (request()->routeIs('suratkeluar-verifikasi'))
                                        <form action="{{ route('documents.upload', $suratkeluar->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <input type="file" name="dok_surat" class="form-control"
                                                            id="file" required>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @if (request()->routeIs('suratkeluar-verifikasi') && $suratkeluar->documents)
                                <div class="col-6">
                                    <h2>Preview Dokumen</h2>
                                    @foreach ($suratkeluar->documents as $document)
                                        @if (Str::endsWith($document->dok_surat, '.pdf'))
                                            <embed src="{{ asset($document->dok_surat) }}" width="100%" height="600px"
                                                type="application/pdf" />
                                        @elseif (Str::endsWith($document->dok_surat, '.docx'))
                                            <div>
                                                <a href="{{ asset('storage/' . $document->dok_surat) }}" download>
                                                    Download {{ $document->dok_surat }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @php $formColClass = 'col-6'; @endphp
                            @else
                                @php $formColClass = 'col-12'; @endphp
                            @endif

                            <div class="{{ $formColClass }}">
                                <form action="" wire:submit='save'>
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">nomor_surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                            @else
                                            {{ $readonly ? 'disabled' : '' }} @endif
                                                name="nomor_surat" wire:model='form.nomor_surat'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tanggal_surat" wire:model='form.tanggal_surat'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Perihal</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="perihal" wire:model='form.perihal'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tujuan</label>
                                        <div class="col-lg-9 custom-select-container">
                                            <input type="text" class="form-control custom-select-search"
                                                placeholder="Cari..." id="opd-search">
                                            <input type="hidden" name="opd_id" wire:model='form.opd_id'>
                                            <div class="custom-select-options">
                                                @foreach ($opdOptions as $id => $opd)
                                                    <div class="custom-select-option" data-value="{{ $opd }}"
                                                        data-label="{{ $opd }}">
                                                        {{ $opd }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tempat tujuan</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tempat_tujuan" wire:model='form.tempat_tujuan'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pembukaan Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pembukaan" wire:model='form.pembukaan'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Isi Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                       @else
                                           {{ $readonly ? 'disabled' : '' }} @endif
                                                name="isi" wire:model.defer='form.isi'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">hari Acara</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="hari" wire:model='form.hari'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Acara</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tanggal" wire:model='form.tanggal'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jam Acara</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pukul_mulai" wire:model='form.pukul_mulai'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jam Acara</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pukul_selesai" wire:model='form.pukul_selesai'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">tempat Acara</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tempat_acara" wire:model='form.tempat_acara'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Penutup Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="penutup"
                                                wire:model='form.penutup'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                @else
                                                {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        @if (request()->routeIs('suratkeluar-verifikasi'))
                                            @can('view-status-surat')
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Perlu Revisi</label>
                                                    <div class="col-lg-9">
                                                        <div class="form-check">
                                                            <input type="radio" id="radioRevisi"
                                                                class="form-check-input" name="revisi" value="revisi"
                                                                wire:model="formTindakLanjut.revisi"
                                                                @if (Gate::allows('sekre-staff', Auth::user())) {{ $readonly ? 'disabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'enabled' : '' }} @endif>
                                                            <label class="form-check-label" for="radioRevisi">Ya</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" id="radioTidakRevisi"
                                                                class="form-check-input" name="revisi"
                                                                value="tidak_revisi" wire:model="formTindakLanjut.revisi"
                                                                @if (Gate::allows('sekre-staff', Auth::user())) {{ $readonly ? 'disabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'enabled' : '' }} @endif>
                                                            <label class="form-check-label"
                                                                for="radioTidakRevisi">Tidak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">komentar</label>
                                                <div class="col-lg-9">
                                                    @if (Gate::allows('add-disposisi', Auth::user()))
                                                        <textarea type="text" class="form-control" name="deskripsi" wire:model='formTindakLanjut.deskripsi'
                                                            {{ $readonly ? 'enabled' : '' }}></textarea>
                                                    @else
                                                        <div class="form-group">
                                                            <span class="form-control">
                                                                {{ $tindakLanjut->deskripsi ?? '-' }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @can('kepala_dinas')
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Tanda tangan</label>
                                                    <select name="metode_ttd" wire:model='formTindakLanjut.metode_ttd'
                                                        id="" class="form-input">Metode Tanda Tangan
                                                        <option value="ttd_online">Tanda Tangan Online</option>
                                                        <option value="ttd_offline">Tanda Tangan Offline</option>
                                                    </select>
                                                </div>
                                            @endcan
                                            <div class="form-group row">
                                                <div class="col-lg-9">
                                                    @can('sekretariat')
                                                        <button type="button" wire:click="distribusikan"
                                                            class="btn btn-primary">Distribusikan</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @can('view-status-surat')
                                        <div class="text-right">
                                            <button type="submit"
                                                class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Buat SUrat keluar Baru' }}<i
                                                    class="icon-paperplane ml-2"></i></button>
                                        </div>
                                    @else
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Kembali<i
                                                    class="icon-paperplane ml-2"></i></button>
                                        </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#opd-search');
        const optionsContainer = document.querySelector('.custom-select-options');
        const optionsList = Array.from(document.querySelectorAll('.custom-select-option'));

        // Menampilkan opsi saat input fokus
        searchInput.addEventListener('focus', function() {
            optionsContainer.classList.add('show');
        });

        // Menyaring opsi berdasarkan input pencarian
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            optionsList.forEach(option => {
                const label = option.dataset.label.toLowerCase();
                option.style.display = label.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Menangani klik pada opsi
        optionsList.forEach(option => {
            option.addEventListener('click', function() {
                searchInput.value = option.dataset.label; // Menampilkan nama yang dipilih
                const hiddenInput = document.querySelector('input[name="opd_id"]');
                hiddenInput.value = option.dataset.value; // Menyimpan ID ke hidden input

                // Memicu pembaruan Livewire
                hiddenInput.dispatchEvent(new Event('input'));

                optionsContainer.classList.remove('show');
            });
        });

        // Menutup dropdown saat klik di luar elemen dropdown
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.custom-select-container')) {
                optionsContainer.classList.remove('show');
            }
        });
    });
</script>
