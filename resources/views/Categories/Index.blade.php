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
        <a href="{{route("Categories.Create")}}">{{__('allResources.Add new category')}}</a>
    </p>
    <table class="table">
        <tr>
            <th>
                {{ __('allResources.Category name') }}
            </th>
            <th>
                {{ __('allResources.Category description') }}
            </th>
            <th></th>
        </tr>
        @foreach ($Categories as $category)
            <tr>
                <td>
                    {{ $category->categoryName }}
                </td>
                <td>
                    {{ $category->categoryDescription }}
                </td>
                <td>
                    <a href="{{route("Categories.Edit",['id'=>$category->id])}}">{{__('allResources.Edit')}}</a> |
                    <a href="{{route("Categories.Details",['id'=>$category->id])}}">{{__('allResources.Details')}}</a> |
                    <a href="{{route("Categories.Delete",['id'=>$category->id])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach


    </table>
@endsection
