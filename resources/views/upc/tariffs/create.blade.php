@extends('layouts.upc')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Встановити тарифи</h3>
            </div>
        </div>
        <br>
        <div class="row">
            @include('upc.includes.result_messages_create')
        <div class="col-md-6"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <small>(Використовуйте крапку замість коми, якщо число не ціле)</small>
                <form method="POST" action="{{ route('upc.user.tariffs.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="elect_before" class="font-weight-bold">Електрика до 100 (кВт/Грн)</label>
                        <input name="elect_before" class="form-control" value="{{ old('elect_before', $item->elect_before)
                         }}"
                               id="elect_before"
                               type="text"><br>

                        <label for="elect_under" class="font-weight-bold">Електрика понад 100 (кВт/Грн)</label>
                        <input name="elect_under" class="form-control" value="{{ old('elect_under', $item->elect_under)
                         }}"
                               id="elect_under"
                               type="text"><br>

                        <label for="gaz_t" class="font-weight-bold">Газ (м³/Грн)</label>
                        <input name="gaz_t" class="form-control" value="{{ old('gaz_t', $item->gaz_t) }}" id="gaz_t"
                               type="text"><br>

                        <label for="water_t" class="font-weight-bold">Вода (м³/Грн)</label>
                        <input name="water_t" class="form-control" value="{{ old('water_t', $item->water_t) }}"
                               id="water_t"
                               type="text"><br>
                    </div>
                    <button class="btn btn-success">Надіслати</button>
                    <a href="{{ route('upc.user.tariffs.index') }}" class="btn btn-primary">Назад</a>
                </form>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection
