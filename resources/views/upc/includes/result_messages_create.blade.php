@if($errors->any())
    <div class="col-md-6">
        <div class="alert alert-red" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">X</span>
            </button>
            @foreach($errors->all() as $errorTxt)
                <li>{{$errorTxt}}</li>
            @endforeach
        </div>
    </div>
@endif

