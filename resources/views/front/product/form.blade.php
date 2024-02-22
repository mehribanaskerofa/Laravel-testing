@extends('admin.layouts.admin',['title'=>'Product'])


@section('content')
    <?php  $routeName='products' ?><br>
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($model) ? route($routeName.'.update',$model->id) :  route($routeName.'.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($model)
                    @method('PUT')
                @endisset


                <div class="row">

                    <div class="form-group col-3">
                        <label>Name</label>
                        <input type="text"  name="name" class="form-control" value="{{$model->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label>Price</label>
                        <input type="text"  name="price" class="form-control" value="{{$model->price}}">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                </div>

                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection


