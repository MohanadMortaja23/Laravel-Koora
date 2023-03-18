@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i>جدول الابلاغات</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">الابلاغات</a></li>
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
                        <h5 class="h5"><i class="fa fa-table"></i><strong>جدول الابلاغات</strong></h5>
                    </div>
                

                </div>
                {{-- <input style="width: 100%; padding:5px ; margin-bottom:5px;" type="text" name="search"
                    placeholder="Search..."> --}}

                <div class="table-responsive">

                    <table class="table table-hover table-bordered w-100" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> المرسل</th>
                                <th>الشكوى</th>
                                <th> المشكو عليه</th>
                                <th> بريد المشكو عليه</th>

                                <th> المحتوى المخالف </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($flags as $key => $loc)
                                    <tr>
                                        <th>{{ $key++ }}</th>
            
                                        <th>
                                            <div class="img-thumbnail"
                                                style="background-image: url({{ $loc->User->image_path ?? asset('imgs/avatar.png') }}) ; height: 75px; width:75px; background-size:cover">
                                            </div>
                                            {{ $loc->User->name ?? 'مستخدم كورة' }}
                                        </th>
                                    
                                       


                                        <th>
                                            {{ $loc->desc }}
                                        </th>

                                        <th>
                                            @if($loc->content_type == Comment::class)
                                            @php
                                                $user = \App\Models\Comment::where('id' , $loc->content_id)->first() ;
                                            @endphp
                                            {{ $user->User->name ?? 'مستخدم كورة' }}
                                            @else
                                            @php
                                                $user = \App\Models\Message::where('id' , $loc->content_id)->first() ;
                                            @endphp
                                            {{ $user->User->name ?? 'مستخدم كورة' }}
                                            @endif
                                        </th>
                                        <th>
                                            @if($loc->content_type == Comment::class)
                                            @php
                                                $user = \App\Models\Comment::where('id' , $loc->content_id)->first() ;
                                            @endphp
                                            {{ $user->User->email ?? '---' }}
                                            @else
                                            @php
                                                $user = \App\Models\Message::where('id' , $loc->content_id)->first() ;
                                            @endphp
                                            {{ $user->User->email ?? '---' }}
                                            @endif
                                        </th>

                                        <th>
                                            @if($loc->content_type == Comment::class)
                                            {{ \App\Models\Comment::where('id' , $loc->content_id)->first()->comment ?? 'مستخدم كورة' }}
                                            @else
                                            {{ \App\Models\Message::where('id' , $loc->content_id)->first()->message ?? 'مستخدم كورة' }}
                                            @endif
                                        </th>
                                       
                                    </tr>
                            @endforeach
                        </tbody>

                        {{$flags->links()}}
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