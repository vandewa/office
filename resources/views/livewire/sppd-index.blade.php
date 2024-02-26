<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    SPPD</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">SPPD</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <div class="p-0 breadcrumb-elements-item dropdown">
                        <a href="{{ route('sppd') }}" class="btn btn-primary">
                            <i class="mr-2 icon-file-plus"></i>
                            Add Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content">
        <!-- Striped rows -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Striped rows</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                Example of a table with <code>striped</code> rows. Use <code>.table-striped</code> added to the base
                <code>.table</code> class to add zebra-striping to any table odd row within the
                <code>&lt;tbody&gt;</code>. This styling doesn't work in IE8 and lower as <code>:nth-child</code> CSS
                selector isn't supported in these browser versions. Striped table can be combined with other table
                styles.
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Eugene</td>
                            <td>Kopyov</td>
                            <td>@Kopyov</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Victoria</td>
                            <td>Baker</td>
                            <td>@Vicky</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>James</td>
                            <td>Alexander</td>
                            <td>@Alex</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Franklin</td>
                            <td>Morrison</td>
                            <td>@Frank</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /striped rows -->
    </div>
</div>
