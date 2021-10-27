<x-admin-master>
    @section('content')
        @if(session()->has('role-updated'))
            <div class="alert alert-success">
                {{session('role-updated')}}
            </div>
        @endif
        <h1 class="h3 mb-4 text-gray-800">Edit Role: {{$role->name}}</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('role.update',$role->id)}}">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">
                        <labrl for="name">Name</labrl>
                        <input type="text" id="name" name="name" class="form-control" value="{{$role->name}}">
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
    @endsection
</x-admin-master>
