@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i>جدول المستخدمون</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">المستخدمون</a></li>
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
                        <h5 class="h5"><i class="fa fa-table"></i><strong>جدول المستخدمون</strong></h5>
                    </div>
                    <div class="row col-md-6 justify-content-end">

                    </div>


                </div>
                {{-- <input style="width: 100%; padding:5px ; margin-bottom:5px;" type="text" name="search"
                    placeholder="Search..."> --}}

                <div class="table-responsive">

                    <table class="table table-hover table-bordered w-100" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>الصورة</th>
                                <th>الفريق العالمي</th>
                                <th>الفريق المحلي</th>
                                <th>المنتخب</th>
                                <th>النقاط</th>
                                <th>التعديلات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $key => $us)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <th>{{ $us->name ?? 'مستخدم جديد' }}</th>
                                    <th>{{ $us->email ?? 'مستخدم جديد' }}</th>
                                    <th>
                                        <div class="img-thumbnail"
                                            style="background-image: url({{  $us->image_path }}) ; height: 75px; width:75px; background-size:cover">
                                        </div>
                                    </th>
                                    <th>{{ $us->Global->name ?? 'فارغ' }}</th>
                                    <th>{{ $us->Local->name ?? 'فارغ' }}</th>
                                    <th>{{ $us->National->name ?? 'فارغ' }}</th>
                                    <th>{{ $us->points ?? 'فارغ' }}</th>
                                    <th class="actions">

                                        <a href="javascript:void(0)" class="btn btn-danger delete"><i
                                                class="fa fa-lg fa-trash"></i></a>
                                        <form action="{{ route('users.destroy', $us->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <div class="toggle lg">
                                            <label>
                                                <input data-id="{{ $us->id }}" class="sts-fld" name="status"
                                                    type="checkbox" checked value="{{ $us->status == 1 ? '1' : '0' }}"><span
                                                    class="button-indecator"></span>
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach

                            {{$users->links()}}
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

    <script>
        $(document).on('click', '.sts-fld', function(e) {

        
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
            const id = $(this).data('id');
            const checkedValue = $(this).is(":checked");
            $.ajax({
                type: "POST",
                url: "{{ route('user.status') }}",
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.type === 'yes') {
                        $(this).prop("checked", checkedValue);
                    } else if (data.type === 'no') {
                        $(this).prop("checked", !checkedValue);
                    }
                    Swal.fire(
                        'تم الحظر بنجاح!',
                        '',
                        'success'
                    )

                }
            });
        });
    </script>
@endsection
