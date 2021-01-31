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
    <form action={{route("Job.ApplyJob",['id'=>$Job->id])}} method="POST">
        @csrf
        <div class="form-group row">
            <label for="jobTitle" class="col-sm-2 col-form-label">{{ __('allResources.Job title') }}</label>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control {{ $errors->has('jobTitle')? 'has-error':'' }}"
                       name="jobTitle" id="jobTitle"
                       placeholder="{{ __('allResources.Job title') }}" value="{{$Job->jobTitle}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="message" class="col-sm-2 col-form-label">{{ __('allResources.Message') }}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control"
                       name="message"
                       placeholder="{{ __('allResources.Message') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2"></div>
            <button type="submit"
                    class="col-sm-8 btn btn-outline-primary waves-effect">{{ __('allResources.Apply job') }}</button>
        </div>
    </form>

@endsection