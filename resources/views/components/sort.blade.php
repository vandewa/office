<label class="col-form-label col-md-1">Sort By</label>
<div class="col-md-2">
    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <span class="flex-1">
                @if ($order == 'ASC')
                    Latest added
                @else
                    Oldest added
                @endif
            </span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
            <a class="dropdown-item" href="#" wire:click.prevent="sort('ASC')">Latest
                added</a>
            <a class="dropdown-item" href="#" wire:click.prevent="sort('DESC')">Oldest
                added</a>
        </div>
    </div>
</div>
