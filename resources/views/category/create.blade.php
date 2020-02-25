@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header"><?php echo isset($category)? 'Edit Category' : 'New Category'?></div>

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
                   <form action="{{isset($category)?   route('category.update',['id'=>$category->id])  :  route('category.store') }} " method="post" >
                  @csrf

                  @if(isset($category))
                    @method('PUT')
                  @endif

                  
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{isset($category)? $category->name:''}}">
                  </div>
                  
                  
                
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">{{isset($category)? 'Update Category':'Store Category'}}</button>
              
                  
                  </div>
                     
                </div>
            </div>
        
@endsection
