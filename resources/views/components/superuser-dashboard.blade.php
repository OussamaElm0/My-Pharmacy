<div class="statistics">
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

        <!-- Pharmacies Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <h5 class="card-title">Total Pharmacies</h5>
                    <!-- Link -->
                    <a href="{{ route('pharmacies.index') }}" class="btn btn-dark">View All</a>
                </div>
                <div class="card-body">
                    <!-- Card content -->
                    <div class="d-flex align-items-center">
                        <!-- Pharmacy icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-store" width="28" height="28"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="6" cy="19" r="2" />
                            <circle cx="17" cy="19" r="2" />
                            <path d="M17 17h-11v-14h14l-2 6" />
                            <path d="M15 6h-6" />
                        </svg>
                        <!-- Pharmacy count -->
                        <h3 class="card-number ml-2">{{ $pharmacies }}</h3>
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

        <!-- Types Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <h5 class="card-title">Total Types</h5>
                    <!-- Link -->
                    <a href="{{ route('types.index') }}" class="btn btn-dark">View All</a>
                </div>
                <div class="card-body">
                    <!-- Card content -->
                    <div class="d-flex align-items-center">
                        <!-- Type icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="28" height="28"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="7" cy="7" r="3" />
                            <circle cx="17" cy="7" r="3" />
                            <circle cx="7" cy="17" r="3" />
                            <circle cx="17" cy="17" r="3" />
                            <line x1="7" y1="10" x2="7" y2="14" />
                            <line x1="17" y1="10" x2="17" y2="14" />
                            <line x1="10" y1="7" x2="14" y2="7" />
                            <line x1="10" y1="17" x2="14" y2="17" />
                        </svg>
                        <!-- Type count -->
                        <h3 class="card-number ml-2">{{ $types }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <h5 class="card-title">Total Categories</h5>
                    <!-- Link -->
                    <a href="{{ route('categories.index') }}" class="btn btn-dark">View All</a>
                </div>
                <div class="card-body">
                    <!-- Card content -->
                    <div class="d-flex align-items-center">
                        <!-- Category icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack" width="28" height="28"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <polyline points="12 4 4 8 12 12 20 8 12 4" />
                            <polyline points="4 12 12 16 20 12" />
                            <polyline points="4 16 12 20 20 16" />
                        </svg>
                        <!-- Category count -->
                        <h3 class="card-number ml-2">{{ $categories }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
