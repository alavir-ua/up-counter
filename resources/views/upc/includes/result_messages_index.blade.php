
@if(session('success'))
    <div class="col-md-12">
        <div class="alert alert-green" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">X</span>
            </button>
            {{session()->get('success')}}
        </div>
    </div>
@endif
@if($errors->any())
    <div class="col-md-12">
        <div class="alert alert-red" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">X</span>
            </button>
            @foreach($errors->all() as $errorTxt)
                <li>{{$errorTxt}}</li>
            @endforeach
        </div>
    </div>
@endif