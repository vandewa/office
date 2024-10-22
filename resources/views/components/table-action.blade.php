<div class="dropdown">
    <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
        <i class="icon-menu9"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @php
            $edit =
                '<li><a href="#" class="dropdown-item" wire:click.prevent="add(\'' .
                Crypt::encrypt($row->id) .
                '\')"><i class="icon-clipboard3"></i> Edit</a></li>';
            $hapus =
                '<li><a href="#" class="dropdown-item" wire:click.prevent="delete(\'' .
                Crypt::encrypt($row->id) .
                '\')"><i class="icon-clipboard3"></i> Delete</a></li>';
        @endphp

        {!! $edit . $hapus !!}
    </ul>
</div>
