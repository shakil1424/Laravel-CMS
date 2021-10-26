<x-admin-master>
    @section('content')
        <h1 class="h3 mb-4 text-gray-800">Edit Post</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form  method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
           @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="" aria-describedby=""
                       placeholder="Enter Title" value="{{$post->title}}">
            </div>

            <div class="form-group">
                <div><img height="50px" src="{{$post->post_image}}" alt=""></div>
                <label for="title">File</label>
                <input type="file" name="post_image" class="file-control" id="" aria-describedby="" >
            </div>
            <div>
                <textarea class="form-control" name="body" id="" cols="30" rows="10">{{$post->body}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    @endsection
</x-admin-master>
