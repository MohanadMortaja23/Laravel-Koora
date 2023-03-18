@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i>  الفيديوهات القصيرة -الريلز </h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#"> الفيديوهات القصيرة -الريلز</a></li>
        </ul>
    </div>
    <div class="col-md-12">


        <div class="tile">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="tile-body">
                <div class="col-md-12 p-2 m-2 row ">
                    <div class="col-md-6 justify-content-end align-items-center">
                        <h5 class="h5"><i class="fa fa-table"></i><strong>جدول الفيديوهات</strong></h5>
                    </div>
                  
                </div>
                {{-- <input style="width: 100%; padding:5px ; margin-bottom:5px;" type="text" name="search"
                    placeholder="Search..."> --}}

                <div class="table-responsive">
                    <table class="table table-hover table-bordered w-100" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>العضو</th>
                                <th>الفيديو</th>
                              
                                <th>التعديلات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reals as $key => $real)
                                <tr>
                                    <th style="width: 70px">{{ $key + 1 }}</th>
                                    <th  style="width: 70px">
                                        <div class="d-flex align-items-center">
                                        <div title="{{ $real->User->name ?? 'مستخدم كورة' }}" class="img-thumbnail img-rounded"
                                        style="background-image: url({{$real->User->image_path ?? asset('imgs/avatar.png')}}) ; height: 50px; width:50px; background-size:cover">
                                        </div>

                                        {{ $real->User->name ?? 'مستخدم كورة' }}
                                        </div>
                                    </th>
                                    <th style="width: 150px">
                                        <a href="{{route('reals.show' , $real->id)}}" target="_blank">
                                        <svg style="height: 40px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM176 168V344C176 352.7 180.7 360.7 188.3 364.9C195.8 369.2 205.1 369 212.5 364.5L356.5 276.5C363.6 272.1 368 264.4 368 256C368 247.6 363.6 239.9 356.5 235.5L212.5 147.5C205.1 142.1 195.8 142.8 188.3 147.1C180.7 151.3 176 159.3 176 168V168z"/></svg>
                                        </a>
                                    </th>
                                    
                                    <th style="width: 250px">
                                        <div style="display: row;" class="row">
                                          
                                            <form action="{{ route('reals.destroy', $real->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa fa-lg fa-trash"></i></button>
                                            </form>
                                           
                                        </div>

                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        {{$reals->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#sampleTable').dataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers.index') }}",
                columns: [

                    {
                        data: 'id',
                        name: 'id',

                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'image',
                        name: 'image'
                    },

                    {
                        data: 'department_id',
                        name: 'department_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                        {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection --}}
