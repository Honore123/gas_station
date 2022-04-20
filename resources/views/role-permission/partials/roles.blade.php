<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Manage Roles</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Option</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{$loop->iteration++}}</td>
                        <td>{{$role->name}}</td>
                        <td> <button class="btn btn-info btn-sm dropdown-toggle btn-flat" data-toggle="dropdown" aria-expanded="false">More</button>
                            <div class="dropdown-menu">
                                <a href="{{route('permission.role',$role->id)}}" class="dropdown-item">Permissions</a>
                                <a href="" class="dropdown-item">Remove</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No roles</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @include('role-permission.partials.add')
            <button class="btn mt-3 btn-flat btn-info w-100" data-toggle="modal" data-target="#add-role-modal">New Role</button>
        </div>
    </div>
</div>
