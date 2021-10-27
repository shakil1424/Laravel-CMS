<x-admin-master>
    @section('content')
        @if(session()->has('permission-updated'))
            <div class="alert alert-success">
                {{session('permission-updated')}}
            </div>
        @endif
        <h1 class="h3 mb-4 text-gray-800">Edit Permission: {{$permission->name}}</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permission.update',$permission->id)}}">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$permission->name}}">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info btn-block" name="submit">Update</button>
                    </div>

                </form>
            </div>
        </div>
       {{-- <hr>
        <div class="row-">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions:</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Status</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                                   @foreach($role->permissions as $role_permission)
                                                   @if($role_permission->slug==$permission->slug)
                                                   checked
                                                @endif
                                                @endforeach
                                            >
                                        </td>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form method="post" action="{{route('role.permission.attach',$role)}}">
                                                @csrf
                                                @method('PUT')
                                                <input name="permission" type="hidden" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-success"
                                                        @if($role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                >Attach
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('role.permission.detach',$role)}}">
                                                @csrf
                                                @method('PUT')
                                                <input name="permission" type="hidden" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                        @if(!$role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                >Detach
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>--}}
    @endsection
</x-admin-master>
