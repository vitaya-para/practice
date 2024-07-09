@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="site-bl-courses">
        <div class="site-bl-course-item">
            <div class="site-bl-cI">
                @foreach($data as $semester)
                    <div class="site-bl-cI-1">{{$semester['short_name']}}</div>
                    <div class="site-bl-cI-2 site-bl-cI-box">{{$semester['full_name']}}</div>
                    <div class="site-bl-cI-3 site-bl-cI-box">
                        <div class="site-bl-cI-3-close"></div>
                        @foreach($semester['courses'] as $course)
                            <div class="site-bl-cI-3-block">
                                <div class="site-bl-cI-3-b1">{{$course['name']}}</div>
                                <div class="site-bl-cI-3-b2">Преподаватель: {{$course['teacher']}}</div>
                                <div class="site-bl-cI-3-b3">Дата экзамена: {{$course['exam']}}</div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.site-bl-cI-2').click(function() {
                if (!$(this).parent().parent().hasClass('active')) {
                    $('.site-bl-course-item').removeClass('active');
                    $(this).parent().parent().addClass('active');
                }
            });
            $('.site-bl-cI-3-close').click(function() {
                $('.site-bl-course-item').removeClass('active');
            });
        });
    </script>
@endpush
