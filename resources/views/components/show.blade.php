<label class="col-form-label col-md-1">Show</label>
<div class="col-md-2">
    <div class="dropdown ms-lg-3">
        <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
            <span class="flex-1">
                {{ $limit }}
                items
            </span>
        </a>

        <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">
            <a class="dropdown-item" href="#" wire:click.prevent="limits('30')">30
                items</a>
            <a class="dropdown-item" href="#" wire:click.prevent="limits('50')">50
                items</a>
            <a class="dropdown-item" href="#" wire:click.prevent="limits('100')">100
                items</a>
        </div>
    </div>
</div>
