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
    <form action={{route('User.Create')}} method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('allResources.Name') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('name')? 'has-error':'' }}" name="name" id="name"
                       placeholder="{{ __('allResources.Name') }}" value="{{Request::old('name')}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{ __('allResources.E-Mail Address') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('email')? 'has-error':'' }}"
                       name="email" id="description"
                       placeholder="{{ __('allResources.E-Mail Address') }}"
                       value="{{Request::old('email')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="password"
                   class="col-sm-2 col-form-label">{{ __('allResources.Password') }}</label>

            <div class="col-sm-8">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       required autocomplete="new-password">
            </div>
        </div>
        <div class="form-group row">
            <label for="password-confirm"
                   class="col-sm-2 col-form-label">{{ __('allResources.Confirm Password') }}</label>

            <div class="col-sm-8">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="form-group row">
            <label for="user-type"
                   class="col-sm-2 col-form-label">{{ __('allResources.User Type') }}</label>

            <div class="col-sm-8">
                <select name="user-type" id="user-type" class="form-control" required>
                    <option value="" disabled
                            selected>{{ __('allResources.User Type') }}</option>
                    <option value="Publisher">{{ __('allResources.Publisher') }}</option>
                    <option value="Seeker">{{ __('allResources.Seeker') }}</option>
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label for="permissions"
                   class="col-sm-2 col-form-label">{{ __('allResources.Permissions') }}</label>
        </div>
        @foreach ($Roles as $role)
            <div class="form-group row">
                <input type="checkbox" class="form-check-input" name="roles[]"
                       value={{ $role->id }} >
                <label class="form-check-label" for="exampleCheck1">{{$role->description}}</label>
            </div>
        @endforeach
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Save') }}</button>
        </div>
    </form>
@endsection