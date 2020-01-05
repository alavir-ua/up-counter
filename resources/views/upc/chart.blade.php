@extends('layouts.upc')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#total" role="tab">Усього</a>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#elect" role="tab">Електрика</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#water" role="tab">Вода</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#gaz" role="tab">Газ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#heat" role="tab">Опалення</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" style="background: transparent">
                        <div class="tab-pane active" id="total" role="tabpanel" >
                            <chart-total-component></chart-total-component>
                        </div>
                        <div class="tab-pane" id="elect" role="tabpanel">
                            <chart-elect-component></chart-elect-component>
                        </div>
                        <div class="tab-pane" id="water" role="tabpanel">
                            <chart-water-component></chart-water-component>
                        </div>
                        <div class="tab-pane" id="gaz" role="tabpanel">
                            <chart-gaz-component></chart-gaz-component>
                        </div>
                        <div class="tab-pane" id="heat" role="tabpanel">
                            <chart-heat-component></chart-heat-component>
                        </div>
                    </div>
                </div>
            </div><br>
            <a class="btn btn-primary" href="{{ route('upc.user.calculation.index') }}"
            >Назад</a>
        </div>
    </div>
</div>
@endsection



