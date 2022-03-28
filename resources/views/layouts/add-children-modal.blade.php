<!-- Modal - add children form -->
<div class="modal fade" id="create_children" tabindex="-1" aria-labelledby="create_childrenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="create_childrenLabel">Pridať dieťa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form class="row g-3" action="{{ route('childrens.store') }}" method="POST" id="store_children">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Meno a priezvisko</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="class" class="form-label">Trieda</label>
                    <input type="text" class="form-control" id="class" name="class" value="{{ old('class') }}">
                    @error('class')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="school" class="form-label">Škola</label>
                    <select class="form-select" class="form-control" id="school" name="school">
                        @foreach ($schools as $school)
                            <option value="{{ $school->title }}">{{ $school->title }}</option>
                        @endforeach
                    </select>
                    @error('school')
                        <div class="invalid-feedback d-inline-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Zrušiť</button>
            <button type="button" class="btn btn-primary" onclick="this.disabled=true;this.innerText='Ukladá sa, počkajte prosím...';$('#store_children').submit();">Pridať</button>
        </div>
    </div>
    </div>
</div>




