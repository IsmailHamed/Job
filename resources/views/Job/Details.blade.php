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
    <div class="form-group row">
        <label for="jobTitle" class="col-sm-2 col-form-label">{{ __('allResources.Job title') }}</label>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control {{ $errors->has('jobTitle')? 'has-error':'' }}"
                   name="jobTitle" id="jobTitle"
                   placeholder="{{ __('allResources.Job title') }}" value="{{$Job->jobTitle}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="jobContent"
               class="col-sm-2 col-form-label">{{ __('allResources.Job content') }}</label>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control {{ $errors->has('jobContent')? 'has-error':'' }}"
                   name="jobContent" id="jobContent"
                   placeholder="{{ __('allResources.Job content') }}"
                   value="{{$Job->jobContent}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="caregoryId"
               class="col-sm-2 col-form-label">{{ __('allResources.Category name') }}</label>

        <div class="col-sm-8">
            <input disabled type="text" class="form-control {{ $errors->has('caregoryId')? 'has-error':'' }}"
                   name="caregoryId" id="caregoryId"
                   placeholder="{{ __('allResources.Category name') }}"
                   value="{{$Job->category->categoryName }}">
        </div>
    </div>
    @if ($Job->jobImage != null)
        <div class="form-group row">
            <label for="jobImage"
                   class="col-sm-2 col-form-label">{{ __('allResources.Job image') }}</label>
            <div class="col-sm-8">
                <img src="/storage/{{ $Job->jobImage}}"
                     class="rounded-circle z-depth-0"
                     alt="avatar image" height="35">
            </div>
        </div>
    @endif
    <a href="{{route("Job.ApplyJob",['id'=>$Job->id])}}">{{__('allResources.Apply job')}}</a> |

@endsection