@extends('layouts.admin')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>المحادثة </h1>

        </div>

    </div>
    <div class="col-md-12">


        <div class="tile">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="tile-body">
                <div class="col-md-12 p-2 m-2 row ">
                    <div class="col-md-6 justify-content-start align-items-center">
                        <h5 class="h5">
                          
                            {{-- <img style="height: 60px" src="{{ $messages->image_path }}" />
                            <strong>{{ $team->name }}</strong> --}}
                        </h5>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="tile">

                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover">
                                <tbody>

                                    @foreach ($messages as $message)
                                        <tr>
                                            <td><img style="height: 30px"
                                                    src="{{ $message->User->image_path ?? asset('imgs/avatar.png') }}" />
                                            </td>
                                            <td><a href="#">{{ $message->User->name ?? 'مستخدم كورة' }}</a></td>
                                            <td class="mail-subject">
                                                {{ $message->message }}
                                            </td>
                                            <td class="mail-subject">
                                                {{ $message->message }}
                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <a href="javascript::void(0)" class="btn btn-danger delete "><i
                                                            class="fa fa-lg fa-trash"></i></a>

                                                    <form action="{{ route('messages.destroy', $message->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{$messages->links()}}
                                </tbody>
                               
                            </table>
                        </div>

                    </div>
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
