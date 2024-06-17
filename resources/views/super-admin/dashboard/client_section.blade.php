<div class="col-md-6 col-xl-6">
    <div class="card Active-visitor">
        <div class="card-block text-center">
            <h5 class="mb-3">File Management</h5>
            <a href="{{ route('file.index') }}">
                <i class="fas fa-file f-30 text-c-blue"></i>
                <h2 class="f-w-300 mt-3"></h2>
                <span class="text-muted">View All Files</span>
            </a>
            <div class="mt-4 m-b-40">
            <hr>
            </div>
            <div class="row card-active">
                <div class="col-md-6 col-6">
                    <h4>{{ $filesByKS }}</h4>
                    <span class="text-muted">
                        Files by {{ SITE_TITLE }}
                    </span>
                </div>
                <div class="col-md-6 col-6">
                    <h4>{{ $myFiles }} </h4>
                    <span class="text-muted">
                        My Files 
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
