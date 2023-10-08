@extends('admin.main')


@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>level</label>
                        <select class="form-control" name="level">
                            @foreach($levels as $key => $level)
                                <option value="{{ $key }}">
                                    {{ $level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" >
                </div>
            </div>


            <!-- Add fields for other user-related information here -->
            <!-- For example, you can add fields for 'level', 'active', etc. -->

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add User</button>
        </div>
        @csrf
    </form>

@endsection
