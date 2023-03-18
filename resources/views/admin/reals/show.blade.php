@extends('layouts.admin')


@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> مشاهدة الفيديو</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">الفيديو</a></li>
        </ul>

       
    </div>
    <div class="col-md-12 d-flex justify-content-center align-items-center">


       

           
                
                    <video width="850" height="500" style=" border-radius : 15px ;" controls>
                        <source src="{{$reals->video_path}}" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                      Your browser does not support the video tag.
                      </video>
                
          


        
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
