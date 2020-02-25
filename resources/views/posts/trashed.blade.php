@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Trashed Posts</div>

                <div class="card-body">
                   <table class="table table-bordered">
                     <thead>
                       <th>Image</th>
                       <th>Title</th>                  
                       <th colspan=3>Action</th>                  
                     </thead>
                     <tbody>
                       @if($posts->count()>0)
                       @foreach($posts as $post)
                       <tr>
                         <td>
                           <img src="{{$post->featured_image}}" alt="{{$post->title}}" width="60px" height="50px" >
                         </td>
                         <td>{{$post->title}}</td>
                         <td><a href="{{route('post.show',['id'=>$post->id])}}" class="btn btn-sm btn-info">View</td>
                          <td><a href="{{route('post.restore',['id'=>$post->id])}}" class="btn btn-sm btn-warning">Restore</td>
                            <td><form action="{{route('post.kill',['id'=>$post->id])}}" method="POST" >
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        
                          </td>

                       </tr>
                       @endforeach
                       @else
                       <tr>
                         <th colspan=3 class="text-center">No trashed posts yet!</th>
                       </tr>
                       @endif
                     </tbody>
                    </table>
                </div>
            </div>
       
@endsection
