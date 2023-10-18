@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <!-- Add form fields for creating a new user -->
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $users->name }}" class="form-control" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $users->email }}" class="form-control" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                    @foreach($levels as $key => $level)
                        <option value="{{ $key }}">
                            {{ $level }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Chỉnh sửa người dùng </button>
        </div>
    </form>
@endsection
