<x-admin-master>
    @section('content')
        @if(session()->has('permission-deleted'))
            <div class="alert alert-danger">
                {{session('permission-deleted')}}
            </div>
        @endif
        <h1 class="h3 mb-4 text-gray-800">Permissions</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permission.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info btn-block" name="submit">Submit</button>
                    </div>

                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions:</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td><a href="{{route('permission.edit',$permission->id)}}">{{$permission->name}}</a></td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form method="post" action="{{route('permission.destroy',$permission->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
        </div>
    @endsection
</x-admin-master>
