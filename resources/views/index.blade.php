@extends('layouts.master')

@section('main')
    <div class="hide course-navbar" data-navbar>
        <img src="{{ asset('logo.svg') }}">

        <a href="{{ route('signOut') }}" class="waves-effect waves-light btn" title="登出"><i class="material-icons">input</i></a>
    </div>

    <div class="full-height" data-course-lists>
        <div class="row vertical-middle">
            <div class="col s2 offset-s5">
                @include('layouts.loading')
            </div>
        </div>
    </div>

    <div id="course-news-modal" class="modal">
        <div class="modal-content">
            <h4 data-modal-heading>公告</h4>

            <div data-course-news></div>

            <div class="row" data-loading style="margin-top: 3em;">
                <div class="col s4 offset-s4 m4 offset-m5">
                    @include('layouts.loading')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($)
        {
            $(function()
            {
                $(document).on('click', '.modal-trigger[data-course-id]', function()
                {
                    var courseID = $(this).data('course-id');

                    $('h4[data-modal-heading]').text($(this).closest('li').find('p.title').text());

                    insertHtmlContent($('div[data-course-news]'), courseID, '/course-news/' + $(this).data('course-id'), function() {$('div[data-loading]').hide();});
                });

                insertHtmlContent($('div[data-course-lists]'), 'course-lists', '/course-lists', function()
                {
                    $('div[data-course-lists]').removeClass('full-height');
                    $('div[data-navbar]').removeClass('hide');
                });
            });
        })(jQuery);
    </script>
@endsection