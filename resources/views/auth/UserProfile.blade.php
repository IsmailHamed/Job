@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{route('UserProfile')}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="UserName" class="col-sm-2 col-form-label">{{__("allResources.Name")}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="UserName" id="UserName"
                       placeholder="{{ __('allResources.UserName') }}" value="{{$user->name}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{__("allResources.E-Mail Address")}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email" id="email"
                       placeholder="{{ __('allResources.E-Mail Address') }}" value="{{$user->email}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="user-type"
                   class="col-sm-2 col-form-label">{{ __('allResources.User Type') }}</label>

            <div class="col-sm-8">
                <select name="user-type" id="user-type" class="form-control" required>
                    <option value="Publisher" {{ $user->type == "Publisher" ? "Selected" : "" }}>{{ __('allResources.Publisher') }}</option>
                    <option value="Seeker" {{ $user->type == "Seeker" ? "Selected" : "" }}>{{ __('allResources.Seeker') }}</option>
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label for="user-type"
                   class="col-sm-2 col-form-label">{{ __('allResources.User image') }}</label>

            <div class="col-sm-8">
                <input type="file" class="custom-file-input" id="user-image" name="user-image"
                       aria-describedby="user-image">
                <label class="custom-file-label" for="inputGroupFile01">{{ __('allResources.Choose file') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Save edit') }}</button>
        </div>
    </form>

@endsection