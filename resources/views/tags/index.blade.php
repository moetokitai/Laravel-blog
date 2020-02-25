@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">All Tags</div>

                <div class="card-body">
                   <table class="table table-bordered">
                     <thead>
                       <th>Name</th>                  
                       <th colspan=3>Action</th>                  
                     </thead>

                     <tbody>
                       @if($tags->count()>0)
                       @foreach($tags as $tag)
                       <tr>
                         
                         <td>{{$tag->name}}</td>
                          <td><a href="{{route('tag.edit',['id'=>$tag->id])}}" class="btn btn-sm btn-primary">Edit</td>
                            <td><form action="{{route('tag.destroy',['id'=>$tag->id])}}" method="POST" >
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>
                        
                          </td>

                       </tr>
                       @endforeach
                       @else
                       <tr>
                         <th colspan=3 class="text-center">No tags yet!</th>
                       </tr>
                       @endif
                     </tbody>
                    </table>
                </div>
            </div>
       
@endsection
