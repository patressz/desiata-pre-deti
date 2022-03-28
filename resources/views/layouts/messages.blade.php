@if ( session('status') )
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert" id="alert">
                    <ul class="list-group">
                        <li class="list-unstyled">{{ session('status') }}</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
@endif
