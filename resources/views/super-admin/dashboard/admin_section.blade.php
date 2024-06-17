<div class="col-md-6 col-xl-6">
    <div class="card Active-visitor">
        <div class="card-block text-center">
        <h5 class="mb-3">Active Users</h5>
        <i class="fas fa-users f-30 text-c-blue"></i>
        <h2 class="f-w-300 mt-3">{{ $total_users }}</h2>
        <div class="mt-4 m-b-40">
            <hr>
        </div>
        <div class="row card-active">
            <div class="col-md-4 col-4">
                <a href="{{ route('user.index') }}">
                    <h4>{{ $total_admin }}</h4>
                    <span class="text-muted"> Admin</span>      
                </a>
            </div>
            <div class="col-md-4 col-4">
                <a href="{{ route('staff.index') }}">
                    <h4>{{ $total_staff }}</h4>
                    <span class="text-muted"> Staff</span>      
                </a>
            </div>
            <div class="col-md-4 col-4">
                <a href="{{ route('client.index') }}">
                    <h4>{{ $total_clients->count() }}</h4>
                    <span class="text-muted"> Client</span>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>