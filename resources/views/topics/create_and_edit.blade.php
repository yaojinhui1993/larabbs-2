@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 offset-md-1">
        <div class="card ">
            <div class="card-body">
                <h2 class="">
                    <i class="far fa-edit"></i>
                    @if($topic->id)
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>

                <hr>

                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="post" accept-charset="UTF-8">
                        @method('put')
                @else
                    <form action="{{ route('topics.store', $topic->id) }}" method="post" accept-charset="UTF-8">
                @endif
                        @csrf

                        @include('shared._error')

                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title', $topic->title) }}" placeholder="请填写标题" required/>
                        </div>

                        <div class="form-group">
                            <select name="category_id" class="form-control" required>
                                <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                                @foreach($categories as $value)
                                    <option value="{{ $value->id }}" {{ $topic->category_id === $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="body" id="editor"  rows="6" class="form-control" placeholder="请填写至少三个字符的内容。" required>{{ old('body', $topic->body) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save mr-2" aria-hidden="true"></i>保存
                            </button>
                        </div>

                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/simditor.css') }}" type="text/css">
@endsection

@section('scripts')
    <script src="{{ asset('js/module.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/hotkeys.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/uploader.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/simditor.js') }}" type="text/javascript"></script>
    <script>
        var editor = new Simditor({
            textarea: $('#editor'),
            upload: {
                url: "{{ route('topics.uploadImage') }}",
                params: {
                    _token: "{{ csrf_token() }}",
                },
                fileKey: 'uploadFile',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭页面将取消上传。',
            },
            pasteImage: true,
        });
    </script>
@endsection
