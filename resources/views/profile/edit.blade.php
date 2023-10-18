<div class="tab-pane active" id="update">
    <form action="" method="POST">
        @include('admin.alert')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Enter email">
            </div>
            <div class="col-md-6">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
            </div>
            <div class="col-md-6">
                <label>Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" >
            </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Chỉnh sửa người dùng</button>
        </div>
    </form>
</div>
