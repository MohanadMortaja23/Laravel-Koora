@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i>جدول الفرق المحلية</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">الفرق المحلية</a></li>
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
                        <h5 class="h5"><i class="fa fa-table"></i><strong>جدول الفرق المحلية</strong></h5>
                    </div>
                    <div class="row col-md-6 justify-content-end">
                        <a style="height: 30px; width:130px;" href="{{ route('locl-teams.create') }}"
                            class="btn btn-primary d-flex justify-content-center align-items-center ml-1"><i
                                class="fa fa-plus "></i><small>اضافة فرق محلية </small></a>
                    </div>


                </div>
                {{-- <input style="width: 100%; padding:5px ; margin-bottom:5px;" type="text" name="search"
                    placeholder="Search..."> --}}

                <div class="table-responsive">

                    <table class="table table-hover table-bordered w-100" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الفريق</th>
                                <th>الصورة</th>
                                <th>الحالة</th>
                                <th>التعديلات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($local as $loc)
                                    <tr>
                                        <th>{{ $loc->id }}</th>
                                        <th>{{ $loc->name }}</th>
                                        <th>
                                            <div class="img-thumbnail"
                                                style="background-image: url({{ asset('storage/' . $loc->image) }}) ; height: 75px; width:75px; background-size:cover">
                                            </div>
                                        </th>
                                        <th>
                                            @if ($loc->status)
                                                <strong>
                                                    <span class="text-success text-end m-2">مفعل</span>
                                                </strong>
                                            @else
                                                <strong>
                                                    <span class="text-danger text-end">قيد الانتظار</span>
                                                </strong>
                                            @endif
                                        </th>
                                        <th style="width: 200px">
                                            <div style="display: row" class="row actions">
                                                <a href="{{ route('locl-teams.edit', $loc->id) }}" class="btn btn-info m-2"><i class="fa fa-lg fa-edit"></i></a>
                                                <a href="javascript::void(0)"  class="btn btn-danger delete m-2"><i class="fa fa-lg fa-trash"></i></a>
                                                <a href="{{route('locl-teams.show' , $loc->Conversation->id)}}"  class="btn btn-info m-2"><i class="fa fa-lg fa-eye"></i></a>
                                                <form action="{{ route('locl-teams.destroy', $loc->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                {{-- <div class="toggle lg">
                                                    <label>
                                                        <input name="status" type="checkbox" checked value="{{ $loc->status == 1 ? '1' : '0' }}"><span
                                                            class="button-indecator"></span>
                                                    </label>
                                                </div> --}}
                                            </div>
                                        </th>
                                    </tr>
                            @endforeach
                        </tbody>

                        {{$local->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
<script>
    $('.delete').on('click', function(e) {
       
        e.preventDefault();
        let element = $(this).parent('.actions').find('form');
        Swal.fire({
                title: 'هل انت متأكد من الحذف ؟',
                text: "سيتم الحذف بشكل نهائي   ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، قم بالحذف',
                cancelButtonText: 'الغاء',

            })
            .then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(

                        'تم الحذف بنجاح!',
                        'تهانينا',
                        'success'
                    )

                    $(element).submit();
                }
            })

    });
</script>
@endsection