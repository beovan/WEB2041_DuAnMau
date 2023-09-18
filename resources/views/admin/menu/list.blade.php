@extends('admin.main')



@section('content')
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Active</td>
                <td>Update</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
        {!! \App\Helpers\Helper::menu() !!}
        </tbody>
    </table>
@endsection


