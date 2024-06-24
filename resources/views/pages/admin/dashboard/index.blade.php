<x-admin-layout>
    <div class="row">
        <!-- four widgets   -->
        <!-- total views   -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <a href="/admin/user" class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Pengguna</h5>
                        <h3 class="mb-0">{{ $qty['user'] }}</h3>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-info"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- end total views   -->
        <!-- total followers   -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <a href="/admin/event" class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Acara</h5>
                        <h3 class="mb-0">{{ $qty['event'] }}</h3>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fa fa-eye fa-fw fa-sm text-primary"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- end total followers   -->
        <!-- partnerships   -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <a href="/admin/review" class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Reviews</h5>
                        <h3 class="mb-0">{{ $qty['review'] }}</h3>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                        <i class="fa fa-comments fa-fw fa-sm text-secondary"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- end partnerships   -->
        <!-- total earned   -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <a href="/admin/transaction" class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Pendapatan</h5>
                        <h3 class="mb-0">{{ formatRupiah($qty['transaction']) }}</h3>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                        <i class="fa fa-money-bill-alt fa-fw fa-sm text-brand"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- end total earned   -->

    </div>
</x-admin-layout>
