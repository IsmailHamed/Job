@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    <h2>قائمة أنواع الوظائف</h2>

    <p>
        <a href="{{route("Job.Create")}}">{{__('allResources.Add new category')}}</a>
    </p>
    <table class="table">
        <tr>
            <th>
                {{ __('allResources.Job title') }}
            </th>
            <th>
                {{ __('allResources.Job content') }}
            </th>
            <th>
                {{ __('allResources.Category name') }}
            </th>
            <th>
                {{ __('allResources.Job image') }}
            </th>
            <th></th>
        </tr>
        @foreach ($jobs as $job)
            <tr>
                <td>
                    {{ $job->jobTitle}}
                </td>
                <td>
                    {{ $job->jobContent}}
                </td>
                <td>
                    {{ $job->category->categoryName}}
                </td>
                <td>
                    @if ($job->jobImage != null)
                        <img src="/storage/{{ $job->jobImage}}"
                             class="rounded-circle z-depth-0"
                             alt="avatar image" height="35">
                    @endif
                </td>
                <td>
                    <a href="{{route("Job.Edit",['id'=>$job->id])}}">{{__('allResources.Edit')}}</a> |
                    <a href="{{route("Job.Details",['id'=>$job->id])}}">{{__('allResources.Details')}}</a> |
                    <a href="{{route("Job.Delete",['id'=>$job->id])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach


    </table>
@endsection
