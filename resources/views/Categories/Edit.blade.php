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
    <form action={{route('Categories.Edit',["id"=> $Category->id])}} method="POST">
        @csrf
        <div class="form-group row">
            <label for="categoryName" class="col-sm-2 col-form-label">{{ __('allResources.Category name') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="categoryName" id="categoryName"
                       placeholder="{{ __('allResources.Category name') }}" value="{{ $Category->categoryName }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="categoryDescription" class="col-sm-2 col-form-label">{{ __('allResources.Category description') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="categoryDescription" id="categoryDescription"
                       placeholder="{{ __('allResources.Category description') }}" value="{{ $Category->categoryDescription }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button  type="submit" class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Edit') }}</button>
        </div>
    </form>
@endsection