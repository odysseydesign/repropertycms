@extends('admin.layouts.default')
@section('content')
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Add / Edit Page</h5>
    </div>
    <div class="template-body">
        @php
            if(isset($page)){
            $data = ['id' => $page->id];
            $title = $page->title;
            $content = $page->content;
            }else{
            $data = "";
            $title =old('title');
            $content = old('content');
            }
        @endphp
        <form action="{{route('admin.pages.add', $data)}}" method="post">
            @csrf
            <div class="input-group-outline input-group my-3">
                <span>Title* : </span>
                <input type="text" id="title" name="title" class="form-control" value="{{ $title }}" maxlength="50" style="border:2px solid lightgrey;"/>
                <small id="title_help" class="form-text text-red-700 ">@error('title'){{$message}}@enderror</small>
            </div>
            <div class="">
                <textarea id="content" name="content" class="summernote">{{$content}}</textarea>
                <small id="content_help" class="form-text text-red-700 ">@error('content'){{$message}}@enderror</small>
            </div>
            <button class="button button-green button-sm mt-3 mr-3">Save</button>
            <a class="button button-green button-sm mt-3" data-ripple-light="true" href="{{url()->previous()}}">
                Back
            </a>
        </form>
    </div>


@stop