<div class="administrator-dashboard">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Users Card -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <h5 class="card-title">Total Users</h5>
                    <!-- Link -->
                    <a href="{{ route('superuser.users.index') }}" class="btn btn-dark">View All</a>
                </div>
                <div class="card-body">
                    <!-- Card content -->
                    <div class="d-flex align-items-center">
                        <!-- User icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="28" height="28"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5 22v-2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v2" />
                        </svg>
                        <!-- User count -->
                        <h3 class="card-number ml-2">{{ $users }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <h5 class="card-title">Total Products</h5>
                    <!-- Link -->
                    <a href="{{ route("superuser.products.index") }}" class="btn btn-dark">View All</a>
                </div>
                <div class="card-body">
                    <!-- Card content -->
                    <div class="d-flex align-items-center">
                        <!-- Product icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="28" height="28"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="2" y="7" width="20" height="14" rx="2" />
                            <line x1="7" y1="11" x2="17" y2="11" />
                            <line x1="7" y1="15" x2="17" y2="15" />
                        </svg>
                        <!-- Product count -->
                        <h3 class="card-number ml-2">{{ $products }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
