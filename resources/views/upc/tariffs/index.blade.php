@extends('layouts.upc')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3 mt-3">
                    @if($paginator->count() != 0)
                        Встановлені тарифи користувача {{ $user->name }}
                    @else
                        {{ $user->name }}, встановіть перший тариф, натиснувши зелену кнопку...
                    @endif
                </h3>
                <a href="{{ route('upc.user.tariffs.create') }}" class="btn btn-success">Встановити тарифи</a>
                <a href="{{ route('upc.user.calculation.index') }}" class="btn btn-primary">Назад</a>
            </div>
        </div>
        <br>
        <div class="row">
            @include('upc.includes.result_messages_index')
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                @if($paginator->count() != 0)
                    <table class="table table-bordered text-light">
                        <thead>
                        <tr class="font-weight-bold">
                            <td>Дата / час створення (оновлення)</td>
                            {{--<td>User Name</td>--}}
                            <td>Електрика до 100 (кВт/Грн)</td>
                            <td>Електрика понад 100 (кВт/Грн)</td>
                            <td>Газ (м³/Грн)</td>
                            <td>Вода (м³/Грн)</td>
                            <td>Дії</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $item)
                            <tr>
                                <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at )->format
                                    ('d/m/Y H:i') :''}}</td>
                                {{--                            <td>{{ $item->user->name }}</td>--}}
                                <td>{{ $item->elect_before }}</td>
                                <td>{{ $item->elect_under }}</td>
                                <td>{{ $item->gaz_t }}</td>
                                <td>{{ $item->water_t }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="icons__item">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['upc.user.tariffs.destroy',
                                   $item->id]]) !!}
                                            <button class="btn-list" style="background: transparent"
                                                    onclick="return confirm('Видалити тариф, створений (оновлений) {{
                                                $item->created_at ?
                                        \Carbon\Carbon::parse($item->created_at )->format
                                    ('d/m/Y H:i') :''}}?')
                                                            "><i class="fa fa-trash" style="color: #ffffff;"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>

                                        <div class="icons__item">
                                            <a href="{{ route('upc.user.tariffs.edit', $item->id) }}" class="btn-list"
                                               style="background: transparent"><i class="fa fa-pencil"
                                                                                  style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card" style="background-color:transparent">
                        <div class="card-body">
                            {{$paginator->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
