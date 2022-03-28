@if ( now()->gt( $twooclock ) )
    <div class="alert alert-warning alert-dismissible fade show my-3" role="alert" id="alert">
        <ul class="list-group">
            <li class="list-unstyled">Momentálne prebieha <strong data-bs-toggle="tooltip" data-bs-placement="right" title="Uzavierka prebieha každý deň od {{ \Carbon\Carbon::parse($twooclock)->format("H:i") }} hodiny.">uzavierka</strong> systému pre tento deň!</li>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
