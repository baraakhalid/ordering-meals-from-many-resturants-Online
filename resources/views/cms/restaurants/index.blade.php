@extends('cms.parent')

@section('title',__('cms.restaurants'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.restaurants'))
@section('page-md',__('cms.index'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.restaurants')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.image')}}</th>                               
                                    <th>{{__('cms.name')}}</th>   
                                    <th>{{__('cms.permissions')}}</th>                            
                                    <th>{{__('cms.email')}}</th>
                                    <th>{{__('cms.mobile')}}</th>
                                    <th>{{__('cms.telephone')}}</th>
                                    <th>{{__('cms.address')}}</th>
                                    <th>{{__('cms.city')}}</th>
                                   <th>{{__('cms.created_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurants as $restaurant)
                                <tr>
                                    <td>{{$restaurant->id}}</td>
                                    <td>
                                        <img height="80" src="{{Storage::url($restaurant->image ?? '')}}" />
                                    </td>
                                    <td>{{$restaurant->name}}</td>
                                    <td>
                                        <a href="{{route('resturant.edit-permissions',$restaurant->id)}}"
                                            class="btn btn-app bg-info">
                                            <i class="fas fa-envelope"></i> {{$restaurant->permissions_count}}
                                        </a>
                                    </td>
                                    <td>{{$restaurant->email}}</td>
                                    <td>{{$restaurant->mobile}}</td>
                                    <td>{{$restaurant->telephone}}</td>
                                    <td>{{$restaurant->address}}</td>
                                    <td>{{$restaurant->city_id}}</td>   
                                    <td>{{$restaurant->created_at->diffForhumans()}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('resturants.edit',$restaurant->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$restaurant->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/admin/resturants/'+id)
        .then(function (response) {
            console.log(response);
            // toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            // toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }
    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }

</script>
@endsection