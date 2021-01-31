@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{route('Permission.Create')}} method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('allResources.Name') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('name')? 'has-error':'' }}" name="name" id="name"
                       placeholder="{{ __('allResources.Name') }}" value="{{Request::old('name')}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">{{ __('allResources.description') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('description')? 'has-error':'' }}"
                       name="description" id="description"
                       placeholder="{{ __('allResources.description') }}"
                       value="{{Request::old('description')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Save permission') }}</button>
        </div>
    </form>
@endsection