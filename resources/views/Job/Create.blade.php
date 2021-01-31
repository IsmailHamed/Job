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
    <form action={{route('Job.Create')}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="jobTitle" class="col-sm-2 col-form-label">{{ __('allResources.Job title') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('jobTitle')? 'has-error':'' }}"
                       name="jobTitle" id="jobTitle"
                       placeholder="{{ __('allResources.Job title') }}" value="{{Request::old('jobTitle')}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="jobContent"
                   class="col-sm-2 col-form-label">{{ __('allResources.Job content') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control {{ $errors->has('jobContent')? 'has-error':'' }}"
                       name="jobContent" id="jobContent"
                       placeholder="{{ __('allResources.Job content') }}"
                       value="{{Request::old('jobContent')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="caregoryId"
                   class="col-sm-2 col-form-label">{{ __('allResources.Category name') }}</label>

            <div class="col-sm-8">
                <select name="caregoryId" id="caregoryId" class="form-control" required>
                    @foreach ($caregories as $caregory)
                        <option value={{ $caregory->id }}>{{ $caregory->categoryName }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label for="jobImage"
                   class="col-sm-2 col-form-label">{{ __('allResources.Job image') }}</label>

            <div class="col-sm-8">
                <input type="file" class="custom-file-input" id="jobImage" name="jobImage"
                       aria-describedby="jobImage">
                <label class="custom-file-label" for="inputGroupFile01">{{ __('allResources.Choose file') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Save job') }}</button>
        </div>
    </form>
@endsection