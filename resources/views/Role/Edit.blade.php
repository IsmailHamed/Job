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
    <form action={{route('Role.Edit',["id"=> $Role->id])}} method="POST">
        @csrf
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">{{ __('allResources.Name') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('Name')? 'has-error':'' }}"
                       name="Name" id="Name"
                       placeholder="{{ __('allResources.Name') }}" value="{{$Role->name}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="description"
                   class="col-sm-2 col-form-label">{{ __('allResources.description') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('description')? 'has-error':'' }}"
                       name="description" id="description"
                       placeholder="{{ __('allResources.description') }}"
                       value="{{$Role->description}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="permissions"
                   class="col-sm-2 col-form-label">{{ __('allResources.Permissions') }}</label>
        </div>
        @foreach ($Permissions as $permission)
            <div class="form-group row">
                <input type="checkbox" class="form-check-input" name="permissions[]"
                       value={{ $permission->id }} {{ $Role->permissions->contains('id',$permission->id )? "checked" : "" }}>
                <label class="form-check-label" for="exampleCheck1">{{$permission->display_name}}</label>
            </div>
        @endforeach
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Save edit') }}</button>
        </div>
    </form>
@endsection