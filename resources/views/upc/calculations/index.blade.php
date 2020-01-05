@extends('layouts.upc')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="mt-3 mb-5 pl-3">
                @if($paginator->count() != 0)
                    Комунальні платежі по місяцях користувача {{ $user->name }}
                @else
                    {{ $user->name }}, розпочніть роботу, натиснувши зелену кнопку...
                @endif
            </h3>
            <div class="col-md-6 justify-content-start">

                <a href="{{ route('upc.user.calculation.create') }}" class="btn btn-success">Створити розрахунок</a>
                <a href="{{ route('upc.user.tariffs.index') }}" class="btn btn-info">Тарифи</a>

                @if($paginator->count() >= 2)
                    <a href="{{ route('user.chart.index') }}" class="btn btn-light">Статистика</a>
                @endif
            </div>
            <div class="col-md-6">
                {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $id]]) !!}
                <button class="btn btn-danger float-right mr-1"
                        onclick="return confirm('Видалити Ваш акаунт та всі записи?')
                         ">Видалити акаунт
                </button>
                {!! Form::close() !!}
                <a class="btn btn-primary float-right mr-2" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Виxід
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
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
                            <td>Дата / час</td>
                            {{--<td>User Name</td>--}}
                            <td>Електрика (кВт/Грн)</td>
                            <td>Газ (м³/Грн)</td>
                            <td>Вода (м³/Грн)</td>
                            <td>Опалення (Грн)</td>
                            <td>Компослуги (Грн)</td>
                            <td>Домофон (Грн)</td>
                            <td>Усього (Грн)</td>
                            <td>Дії</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $item)
                            <tr>
                                <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at )->format
                                    ('d/m/Y H:i') :''}}</td>
                                {{--                            <td>{{ $item->user->name }}</td>--}}
                                <td>{{ $item->electricity }}</td>
                                <td>{{ $item->gaz }}</td>
                                <td>{{ $item->water }}</td>
                                <td>{{ $item->heat }}</td>
                                <td>{{ $item->utilities }}</td>
                                <td>{{ $item->intercom }}</td>
                                <td>{{ $item->total }}</td>
                                <td>
                                    <div class="icons__item">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['upc.user.calculation.destroy',$item->id]]) !!}
                                        <button class="btn-list" style="background: transparent"
                                                onclick="return confirm('Видалити запис, створений  {{ $item->created_at ?
                                        \Carbon\Carbon::parse($item->created_at )->format
                                    ('d/m/Y H:i') :''}}?')
                                                        "><i class="fa fa-trash d-flex" style="color: #ffffff;"></i>
                                        </button>
                                        {!! Form::close() !!}
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
        <br>
    </div>
@endsection
