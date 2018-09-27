@extends('layouts.app')

@php
    $errors = session('errors');
@endphp

@if (false === empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif

@section('content')
    @if (false === empty($form))
        <div class="container mt-5">
            <h1>Nieuw lid</h1>
            <form method="POST" name="addMemberForm" action="/members">
                {{ csrf_field() }}
            @foreach ($form as $key => $value)
                @if (false === in_array($key, $required, true))
                    @continue
                @endif

                <div class="form-group">
                    @if (false === stristr($key, 'captcha'))
                        <label for="Input{{$key}}">{{ucfirst($key)}}</label>
                    @endif

                    @if (true === isset($errors) && false === empty($errors->first($key)))
                        <div class="alert alert-danger">
                            {{$errors->first($key)}}
                        </div>
                    @endif

                @switch ($key)
                    @case ('geslacht')
                        <select
                            class="form-control"
                            id="Input{{$key}}"
                            name="{{$key}}"
                        >
                        @foreach ($value as $option)
                            @php
                                $selected =
                                    (true === $option['selected']) ||
                                    (null !== ($userInputValue = old($key)) && $option['value'] === $userInputValue)
                                ? ' selected' : '';
                            @endphp
                            <option
                                value="{{$option['value']}}"
                                {{$selected}}
                            >
                                {{$option['name']}}
                            </option>
                        @endforeach
                        </select>
                    @break
                    @case ('captcha')
                        <img src="data:image/png;base64,{{{$value}}}">
                        <input
                            class="form-control"
                            name="{{$key}}"
                            placeholder="Neem de beveiligingscode over"
                            type="text"
                            value="{{old($key)}}"
                        >
                    @break
                    @case ('captchaimagestring')
                        <input
                            name="{{$key}}"
                            type="hidden"
                            value="{{$value}}"
                        >
                    @break
                    @default
                        <input
                            class="form-control"
                            name="{{$key}}"
                            id="Input{{$key}}"
                            placeholder="Vul uw {{$key}} in"
                            type="{{{$type = 'email' === $key ? $key : 'text'}}}"
                            value="{{old($key)}}"
                        >
                    @break
                @endswitch
                </div>
            @endforeach
                <div class="form-group">
                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Verstuur
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
