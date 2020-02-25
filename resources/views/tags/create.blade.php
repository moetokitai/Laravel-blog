@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header"><?php echo isset($tag)? 'Edit Tag' : 'New Tag'?></div>

                <div class="card-body">
                  @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="list-group">
                      @foreach($errors->all() as $error)
                      <li class="list-group-item">{{$error}}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                   <form action="{{isset($tag)?   route('tag.update',['id'=>$tag->id])  :  route('tag.store') }} " method="post" >
                  @csrf

                  @if(isset($tag))
                    @method('PUT')
                  @endif

                  
                  <div class="form-group">
                    <label>Tag Name</label>
                    <input type="text" name="name" class="form-control" value="{{isset($tag)? $tag->name:''}}">
                  </div>
                  
                  
                
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">{{isset($tag)? 'Update Tag':'Store Tag'}}</button>
              
                  
                  </div>
                     
                </div>
            </div>
        
@endsection
