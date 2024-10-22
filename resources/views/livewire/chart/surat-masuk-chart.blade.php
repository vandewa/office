<div>
    <div class="card mt-3 shadow rounded">
        <div class="border-0 card-header">
            <div class="d-flex justify-content-between row">
                <div class="col-md-6">
                    <h5 class="card-title">Surat Masuk</h5>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="selectedYear" id="selectedYear" class="form-control">
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="col-md-12" style="height: 40vh">
                <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel" />
            </div>
        </div>
        <div class="card-footer">
            <div>
                <b>Total : {{ $total ?? '' }}</b>
            </div>
        </div>
    </div>
</div>
