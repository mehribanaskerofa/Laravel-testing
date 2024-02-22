
    <?php  $routeName='products' ?>
{{--    <a class="btn btn-primary my-1" href="{{route($routeName.'.create')}}">Add</a>--}}
{{--    <br>--}}

{{--@if(auth()->guard('admin')->user()->is_admin)--}}
    <a class="btn btn-primary my-1" href="{{route($routeName.'.create')}}">Add</a>
{{--@endif--}}
    <div class="card ">
        <div class="card-body">
            <table class="table table-bordered" style="text-align: center">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                </thead>
                <tbody>
                @foreach($models  as $model)
                    <tr>
                        <td>{{$model->id}}</td>
                        <td>{{$model->name}}</td>
                        <td>{{$model->price}}</td>
                        <td>
                            <a href="{{route($routeName.'.edit',$model->id)}}" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <form class="delete-form" action="{{ route($routeName.'.destroy',$model->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            {{$models->links('pagination::bootstrap-4')}}
        </div>
    </div>
