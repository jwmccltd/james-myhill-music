@extends('layouts.main')

@section('content')

    <div class="d-none d-lg-block">
        @include('layouts.slides')
    </div>
    <div class="d-lg-none">
        @include('layouts.static-top')
    </div>
    @include('layouts.release')
    @include('layouts.selected-tracks')
    @include('layouts.portfolio')

@endsection

@push('scripts')
    <script type="module">
        $("#goto-intro").click(function() {
            $('#intro').addClass('active');
        });    

        $("#goto-selected-compositions").click(function() {
            //Remove to handle first click afer page load
            $('#intro').removeClass('active');

            $([document.documentElement, document.body]).animate({
                scrollTop: $("#selected-compositions").offset().top - 100
            }, 300);
        });
        $("#goto-latest").click(function() {
            //Remove to handle first click afer page load
            $('#intro').removeClass('active');

            $([document.documentElement, document.body]).animate({
                scrollTop: $("#latest").offset().top - 100
            }, 300);
        });
        $("#goto-portfolio").click(function() {
            //Remove to handle first click afer page load
            $('#intro').removeClass('active');

            $([document.documentElement, document.body]).animate({
                scrollTop: $("#portfolio").offset().top - 100
            }, 300);
        });
    </script>
@endpush