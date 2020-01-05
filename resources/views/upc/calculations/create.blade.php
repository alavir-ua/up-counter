@extends('layouts.upc')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="ml-3">Створити місячний розрахунок</h3>
        </div>
        <div class="row">
            @include('upc.includes.result_messages_create')
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <small>(Використовуйте крапку замість коми, якщо число не ціле)</small>
                <form method="POST" action="{{ route('upc.user.calculation.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="electricity" class="font-weight-bold">Електрика (кВт)</label>
                        <input name="electricity" class="form-control" value="{{ old('electricity', $item->electricity)
                         }}"
                               id="electricity"
                               type="text">

                        <label for="gaz" class="font-weight-bold">Газ (м³)</label>
                        <input name="gaz" class="form-control" value="{{ old('gaz', $item->gaz) }}" id="gaz"
                               type="text">

                        <label for="water" class="font-weight-bold">Вода (м³)</label>
                        <input name="water" class="form-control" value="{{ old('water', $item->water) }}" id="water"
                               type="text">

                        <label for="heat" class="font-weight-bold">Опалення (Грн)</label>
                        <input name="heat" class="form-control" value="{{ old('heat', $item->heat) }}" id="heat"
                               type="text">

                        <label for="utilities" class="font-weight-bold">Компослуги (Грн)</label>
                        <input name="utilities" class="form-control" value="{{ old('utilities', $item->utilities) }}"
                               id="utilities" type="text">

                        <label for="intercom" class="font-weight-bold">Домофон (Грн)</label>
                        <input name="intercom" class="form-control" value="{{ old('intercom', $item->intercom) }}"
                               id="intercom"
                               type="text">
                    </div>
                    <button class="btn btn-success">Надіслати</button>
                    <a href="{{ route('upc.user.calculation.index') }}" class="btn btn-primary">Назад</a>
                </form>
            </div>
            <div class="col-md-6">
                <h4>Буде розраховано по тарифу</h4>
                <div class="form-group">
                    <label for="updated_at">Тариф створено (оновлено)</label>
                    <input id="updated_at" type="text" value="{{ $tariff->updated_at ? \Carbon\Carbon::parse
                    ($tariff->updated_at
                     )->format
                                    ('d/m/Y H:i') :''}}"
                           class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="elect_before">Електрика до 100 (кВт/Грн)</label>
                    <input id="elect_before" type="text" value="{{$tariff->elect_before}}"
                           class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="elect_under">Електрика понад 100 (кВт/Грн)</label>
                    <input id="elect_under" type="text" value="{{$tariff->elect_under}}" class="form-control"
                           disabled>
                </div>

                <div class="form-group">
                    <label for="gaz">Газ (м³/Грн)</label>
                    <input id="gaz" type="text" value="{{$tariff->gaz_t}}" class="form-control"
                           disabled>
                </div>

                <div class="form-group">
                    <label for="water">Вода (м³/Грн)</label>
                    <input id="water" type="text" value="{{$tariff->water_t}}" class="form-control"
                           disabled>
                </div>
            </div>
        </div>
    </div>
@endsection
