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
            <div class="row">
                <div class="col-12 col-md-7">
                    <h1>Nieuw lid</h1>
                    <form method="POST" name="addMemberForm" action="/members">
                        {{ csrf_field() }}
                    @foreach ($form as $key => $value)
                        @if (false === in_array($key, $required, true))
                            @continue
                        @endif

                        <div class="form-group">
                            @if ('opmerkingen' === $key)
                                <label for="Input{{$key}}">Toestemming foto/videomateriaal</label>
                            @elseif (false === stripos($key, 'captcha'))
                                <label for="Input{{$key}}">{{ucfirst($key)}}</label>
                            @endif

                            @if (true === isset($errors) && false === empty($errors->first($key)))
                                <div class="alert alert-danger">
                                    {{$errors->first($key)}}
                                </div>
                            @endif

                        @switch ($key)
                            @case ('geslacht')
                            @case ('bondssporten')
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
                            @case ('opmerkingen')
                                <div class="form-group form-check">
                                    <input
                                        name="{{$key}}"
                                        type="checkbox"
                                        class="form-check-input"
                                        id="Input{{$key}}"
                                        value="yes"
                                    >
                                    <label class="form-check-label" for="Input{{$key}}">
                                        Als nieuw lid geef ik de vereniging toestemming voor het gebruik van foto/videomateriaal - waarop ik herkenbaar in beeld ben - voor de website, sociale mediakanalen en drukwerk (magazine, flyers, etc.). Ik kan de vereniging ten alle tijden verzoeken dit foto- of videomateriaal te verwijderen.
                                    </label>
                                </div>
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
                        <div class="form-group form-check">
                            @if (true === isset($errors) && false === empty($errors->get($generalTermsErrorKey = 'generalterms')))
                                <div class="alert alert-danger">
                                    {{ $errors->get($generalTermsErrorKey)[0] }}
                                </div>
                            @endif
                            <input
                                name="generalterms"
                                type="checkbox"
                                class="form-check-input"
                                id="generalterms"
                                value="yes"
                            >
                            <label class="form-check-label" for="generalterms">
                                Ik verklaar bekend te zijn met de voorwaarden die horen bij het lidmaatschap van KZ/Thermo4U. Deze zijn hier na te lezen.
                            </label>
                        </div>
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
                <div class="col-12 col-md-5 pt-5 pt-md-0">
                    @include('members.moreinfo')
                </div>
            </div>
        </div>
    @endif
@endsection
