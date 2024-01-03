@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<div>hello</div>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>

@endsection
