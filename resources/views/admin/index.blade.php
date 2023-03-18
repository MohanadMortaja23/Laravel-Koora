@extends('layouts.admin')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> لوحة التحكم</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">

                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path
                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-48 0l-.003-.282-26.064 22.741-62.679-58.5 16.454-84.355 34.303 3.072c-24.889-34.216-60.004-60.089-100.709-73.141l13.651 31.939L256 139l-74.953-41.525 13.651-31.939c-40.631 13.028-75.78 38.87-100.709 73.141l34.565-3.073 16.192 84.355-62.678 58.5-26.064-22.741-.003.282c0 43.015 13.497 83.952 38.472 117.991l7.704-33.897 85.138 10.447 36.301 77.826-29.902 17.786c40.202 13.122 84.29 13.148 124.572 0l-29.902-17.786 36.301-77.826 85.138-10.447 7.704 33.897C442.503 339.952 456 299.015 456 256zm-248.102 69.571l-29.894-91.312L256 177.732l77.996 56.527-29.622 91.312h-96.476z" />
                </svg>
                <div class="info">
                    <h4>عدد الفرق المحلية
                    </h4>
                    <p><b>{{ $locals }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path
                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-48 0l-.003-.282-26.064 22.741-62.679-58.5 16.454-84.355 34.303 3.072c-24.889-34.216-60.004-60.089-100.709-73.141l13.651 31.939L256 139l-74.953-41.525 13.651-31.939c-40.631 13.028-75.78 38.87-100.709 73.141l34.565-3.073 16.192 84.355-62.678 58.5-26.064-22.741-.003.282c0 43.015 13.497 83.952 38.472 117.991l7.704-33.897 85.138 10.447 36.301 77.826-29.902 17.786c40.202 13.122 84.29 13.148 124.572 0l-29.902-17.786 36.301-77.826 85.138-10.447 7.704 33.897C442.503 339.952 456 299.015 456 256zm-248.102 69.571l-29.894-91.312L256 177.732l77.996 56.527-29.622 91.312h-96.476z" />
                </svg>
                <div class="info">
                    <h4>عدد الفرق العالمية
                    </h4>
                    <p><b>{{ $globals }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path
                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-48 0l-.003-.282-26.064 22.741-62.679-58.5 16.454-84.355 34.303 3.072c-24.889-34.216-60.004-60.089-100.709-73.141l13.651 31.939L256 139l-74.953-41.525 13.651-31.939c-40.631 13.028-75.78 38.87-100.709 73.141l34.565-3.073 16.192 84.355-62.678 58.5-26.064-22.741-.003.282c0 43.015 13.497 83.952 38.472 117.991l7.704-33.897 85.138 10.447 36.301 77.826-29.902 17.786c40.202 13.122 84.29 13.148 124.572 0l-29.902-17.786 36.301-77.826 85.138-10.447 7.704 33.897C442.503 339.952 456 299.015 456 256zm-248.102 69.571l-29.894-91.312L256 177.732l77.996 56.527-29.622 91.312h-96.476z" />
                </svg>
                <div class="info">
                    <h4>عدد المنتخبات
                    </h4>
                    <p><b>{{ $nationals }}</b></p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M480 32H128C110.3 32 96 46.33 96 64v336C96 408.8 88.84 416 80 416S64 408.8 64 400V96H32C14.33 96 0 110.3 0 128v288c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V64C512 46.33 497.7 32 480 32zM272 416h-96C167.2 416 160 408.8 160 400C160 391.2 167.2 384 176 384h96c8.836 0 16 7.162 16 16C288 408.8 280.8 416 272 416zM272 320h-96C167.2 320 160 312.8 160 304C160 295.2 167.2 288 176 288h96C280.8 288 288 295.2 288 304C288 312.8 280.8 320 272 320zM432 416h-96c-8.836 0-16-7.164-16-16c0-8.838 7.164-16 16-16h96c8.836 0 16 7.162 16 16C448 408.8 440.8 416 432 416zM432 320h-96C327.2 320 320 312.8 320 304C320 295.2 327.2 288 336 288h96C440.8 288 448 295.2 448 304C448 312.8 440.8 320 432 320zM448 208C448 216.8 440.8 224 432 224h-256C167.2 224 160 216.8 160 208v-96C160 103.2 167.2 96 176 96h256C440.8 96 448 103.2 448 112V208z" />
                </svg>
                <div class="info">
                    <h4>عدد الاخبار المنشورة
                    </h4>
                    <p><b>{{ $posts }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M384 112v288c0 26.51-21.49 48-48 48h-288c-26.51 0-48-21.49-48-48v-288c0-26.51 21.49-48 48-48h288C362.5 64 384 85.49 384 112zM576 127.5v256.9c0 25.5-29.17 40.39-50.39 25.79L416 334.7V177.3l109.6-75.56C546.9 87.13 576 102.1 576 127.5z" />
                </svg>
                <div class="info">
                    <h4>عدد الفيديوهات القصيرة
                    </h4>
                    <p><b>{{ $reals }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M319.9 320c57.41 0 103.1-46.56 103.1-104c0-57.44-46.54-104-103.1-104c-57.41 0-103.1 46.56-103.1 104C215.9 273.4 262.5 320 319.9 320zM369.9 352H270.1C191.6 352 128 411.7 128 485.3C128 500.1 140.7 512 156.4 512h327.2C499.3 512 512 500.1 512 485.3C512 411.7 448.4 352 369.9 352zM512 160c44.18 0 80-35.82 80-80S556.2 0 512 0c-44.18 0-80 35.82-80 80S467.8 160 512 160zM183.9 216c0-5.449 .9824-10.63 1.609-15.91C174.6 194.1 162.6 192 149.9 192H88.08C39.44 192 0 233.8 0 285.3C0 295.6 7.887 304 17.62 304h199.5C196.7 280.2 183.9 249.7 183.9 216zM128 160c44.18 0 80-35.82 80-80S172.2 0 128 0C83.82 0 48 35.82 48 80S83.82 160 128 160zM551.9 192h-61.84c-12.8 0-24.88 3.037-35.86 8.24C454.8 205.5 455.8 210.6 455.8 216c0 33.71-12.78 64.21-33.16 88h199.7C632.1 304 640 295.6 640 285.3C640 233.8 600.6 192 551.9 192z"/></svg>
                <div class="info">
                    <h4>عدد المستخدمين
                    </h4>
                    <p><b>{{ $users }}</b></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M511.1 63.1v287.1c0 35.25-28.75 63.1-64 63.1h-144l-124.9 93.68c-7.875 5.75-19.12 .0497-19.12-9.7v-83.98h-96c-35.25 0-64-28.75-64-63.1V63.1c0-35.25 28.75-63.1 64-63.1h384C483.2 0 511.1 28.75 511.1 63.1z" />
                </svg>
                <div class="info">
                    <h4>عدد الرسائل الكلي
                    </h4>
                    <p><b>{{ $msgs }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">

                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z" />
                </svg>

                <div class="info">
                    <h4>عدد التعليقات الكلي
                    </h4>
                    <p><b>{{ $comments }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon">
                <svg class="icon bg-white border border-primary" style="height: 80px; color:white"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z" />
                </svg>
                <div class="info">
                    <h4>عدد تفاعلات الفيديو
                    </h4>
                    <p><b>{{ $reals_reactions }}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
