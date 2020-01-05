@if(session('success'))
    <div class="col-md-8">
        <div class="alert alert-green" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">X</span>
            </button>
            {{__(session()->get('success'))}}
        </div>
    </div>
@endif


