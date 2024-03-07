<div>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Preview Dokumen</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lampiran</label>
                            <div class="col-lg-9">
                                <div class="uniform-uploader">
                                    <input type="file" class="form-input-styled" data-fouc="">
                                    <span class="filename" style="user-select: none;"><input type="file" id="myFile" name="filename"></span>
                                    <span class="action btn bg-pink-400" style="user-select: none;">Choose File</span>
                                </div>
                                <span class="form-text text-muted">Accepted formats: PDF</span>
                            </div>
                        </div>
                    <embed src=".pdf" type="application/pdf" width="100%" height="600px" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Form Surat Masuk</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="sendMessage">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nomor Surat</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal Surat Masuk</label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal Surat Diterima</label>
                            <div class="col-lg-9">
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Perihal</label>
                            <div class="col-lg-9">
                                <select class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tujuan</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Isi Surat</label>
                            <div class="col-lg-9">
                                <textarea rows="5" cols="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lampiran</label>
                            <div class="col-lg-9">
                                <div class="uniform-uploader"><input type="file" class="form-input-styled"
                                        data-fouc=""><span class="filename" style="user-select: none;">No file
                                        selected</span><span class="action btn bg-pink-400"
                                        style="user-select: none;">Choose File</span></div>
                                <span class="form-text text-muted">Accepted formats: PDF</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Status Surat</label>
                            <div class="col-lg-9">
                                <select class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tingkat Urgensi</label>
                            <div class="col-lg-9">
                                <select class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Disposisi</label>
                            <div class="col-lg-9">
                                <div>
                                    <input type="radio" id="Ya" name="disposisi" value="Ya">
                                    <label for="Ya">Ya</label><br>
                                </div>
                                <div>
                                    <input type="radio" id="Tidak" name="disposisi" value="Tidak">
                                    <label for="Tidak">Tidak</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Teruskan Kepada</label>
                            <div class="col-lg-9">
                                <select class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-3 col-form-label">Nomor</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" wire:model="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="col-lg-3 col-form-label">Pesan</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" wire:model="message">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
