@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i>جدول الزبائن</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">الفرق العالمية</a></li>
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
                        <h5 class="h5"><i class="fa fa-table"></i><strong>جدول الفرق المقترحة</strong></h5>
                    </div>
                   
                </div>
                {{-- <input style="width: 100%; padding:5px ; margin-bottom:5px;" type="text" name="search"
                    placeholder="Search..."> --}}

                <div class="table-responsive">
                    <table class="table table-hover table-bordered w-100" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الفريق</th>
                                <th>الصورة</th>
                                <th>النوع</th>
                                <th>الاحداث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all as $glo)
                               
                                <tr>
                                    <th>{{ $glo->id }}</th>
                                    <th>{{ $glo->name }}</th>
                                    <th>
                                        <div class="img-thumbnail"
                                            style="background-image: url({{ asset('storage/' . $glo->image) }}) ; height: 75px; width:75px; background-size:cover">

                                        </div>
                                    </th>
                                    <th>
                                        @if (class_basename($glo) == 'GlobalTeam')
                                            <strong>
                                                <span class=" text-end">الفريق العالمي</span>
                                            </strong>
                                        @elseif (class_basename($glo) == 'LocalTeam')
                                            <strong>
                                                <span class=" text-end">الفريق المحلي</span>
                                            </strong>
                                        @else
                                             <strong>
                                                 <span class=" text-end">المنتخب </span>
                                             </strong>
                                        @endif
                                    </th>
                                    <th style="width: 250px">
                                        <div style="display: row;" class="row p-2 actions">
                                            <a data-id="{{$glo->id}}"  data-type="{{class_basename($glo)}}" class="btn btn-info sts-fld"><i
                                                    class="fa fa-lg fa-edit"></i>
                                                    موافقة
                                                </a>
                                                <a data-id="{{$glo->id}}"  data-type="{{class_basename($glo)}}"  class="btn btn-danger delete">
                                                    <i class="fa fa-lg fa-edit"></i>
                                                    رفض
                                                </a>
                                        </div>

                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.sts-fld', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const id = $(this).data('id');
        const type = $(this).data('type');

        const checkedValue = $(this).is(":checked");
        
        $.ajax({
            type: "POST",
            url: "{{ route('suggests.status') }}",
            data: {
                'id': id ,
                'type': type
            },
            success: function(data) {
                if (data.type === 'yes') {
                    $(this).prop("checked", checkedValue);
                } else if (data.type === 'no') {
                    $(this).prop("checked", !checkedValue);
                }
                Swal.fire({
                    title: 'تمت الموافقة بنجاح',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'تم',
                   

              
                }).then((result) => {
                    location.reload();
                })

            }
        });
    });
</script>

    
<script>
    $('.delete').on('click', function(e) {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const id = $(this).data('id');
        const type = $(this).data('type');

        const checkedValue = $(this).is(":checked");
        
        $.ajax({
            type: "POST",
            url: "{{ route('suggests.refuse') }}",
            data: {
                'id': id ,
                'type': type
            },
            success: function(data) {
                if (data.type === 'yes') {
                    $(this).prop("checked", checkedValue);
                } else if (data.type === 'no') {
                    $(this).prop("checked", !checkedValue);
                }
                Swal.fire({
                    title: 'تمت الرفض بنجاح',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'تم',
                   

              
                }).then((result) => {
                    location.reload();
                })

            }
        });
    });
</script>
@endsection
