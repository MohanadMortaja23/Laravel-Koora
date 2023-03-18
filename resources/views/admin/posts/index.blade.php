@extends('layouts.admin')


@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> المنشورات</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">لوحة التحكم</li>
            <li class="breadcrumb-item active"><a href="#">المنشورات</a></li>
        </ul>

        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary"> اضافة منشور جديد</a>
        </div>
    </div>
    <div class="col-md-12">


        <div class="row">

            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="tile">

                        <div class="tile-body container">
                            <div class="row">

                                <h5 class="title">{{ $post->details }}</h5>


                            </div>

                        </div>
                        @if ($post->image)
                            <div class="tile-title-w-btn">
                                <img class="" style="height:150px ; width:100%; object-fit: cover"
                                    src="{{ asset('storage/' . $post->image) }}">
                            </div>
                        @else
                            @php
                                $vote = $post->vote()->count();
                                if ($vote > 0) {
                                    $percantage = ($vote / $post->Vote->count()) * 100;
                                } else {
                                    $percantage = 0;
                                }
                            @endphp
                            <div class="tile-title-w-btn">
                                @foreach ($post->Options as $option)
                                    <div class="d-flex flex-column align-items-center img-thumbnail img-circle"
                                        style="width: 50%">
                                        <img class="img-thumbnail img-circle"
                                            style="height:150px ; width:100%; object-fit: cover"
                                            src="{{ asset('storage/' . $option->image) }}">

                                        <div>
                                            <p>{{ $percantage }}%</p>
                                            <p> {{ $vote }} صوت</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif

                        <hr>
                        


                        <div class="d-flex align-items-center justify-content-between  actions">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-2">عدد الاعجابات
                                   : 10 
                                </p>
                                <p class="m-2"> 
                                    عدد التعليقات
                                    : 10 
                                </p>
                            </div>
                            <div class="toggle lg">
                                <label>
                                    <input name="status" type="checkbox" checked
                                        value="{{ $post->status == 1 ? '1' : '0' }}"><span class="button-indecator"></span>
                                </label>
                            </div>
                            <div class="actions">
                           
                            <a href="javascript:void(0)" class="btn btn-danger delete"><i class="fa fa-lg fa-trash"></i></a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info"><i
                                    class="fa fa-lg fa-edit"></i></a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('delete')

                            </form>
                            </div>
                        </div>



                    </div>
                </div>
            @endforeach


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
