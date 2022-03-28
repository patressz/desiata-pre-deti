@if ( $errors->any() )
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" id="alert">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-unstyled">{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
@endif
