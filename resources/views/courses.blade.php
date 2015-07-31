<ul class="collapsible" data-collapsible="accordion">
    @foreach ($lists as $list)
        <?php $courseId = substr($list->children(3)->children(0)->children(0)->href, strpos($list->children(3)->children(0)->children(0)->href, '=') + 1); ?>
        <li>
            <div class="collapsible-header" style="height: auto;" data-course-sidebar data-course-id="{{ $courseId }}">
                <ul class="collection" style="margin: 0; border: 0;">
                    <li class="collection-item avatar">
                        <i class="material-icons circle green">insert_chart</i>
                        <p class="title">{{ $list->children(3)->plaintext }}</p>
                        <small>{{ $list->children(4)->plaintext }}</small><br>
                        <small>{{ $list->children(1)->plaintext }}</small>
                        <a href="#course-news-modal" class="secondary-content waves-effect waves-light btn modal-trigger" data-course-id="{{ $courseId }}">{{ $list->children(5)->plaintext }} news</a>
                    </li>
                </ul>
            </div>
            <div class="collapsible-body" style="background-color: #e3f2fd;">
                <div class="row" data-loading style="padding-top: 20px;">
                    <div class="col s4 offset-s4 m4 offset-m5">
                        <div class="preloader-wrapper big active">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" data-body style="display: none;">
                    <?php $str_random = str_random(4); ?>
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s6"><a class="active" href="#grade-{{ $str_random }}">成績查詢</a></li>
                            <li class="tab col s6"><a href="#others-{{ $str_random }}">檔案下載</a></li>
                        </ul>
                    </div>
                    <div id="grade-{{ $str_random }}" class="col s10 offset-s1" data-course-grades style="max-height: 500px; overflow: auto; margin-top: 1em; background-color: #fff;"></div>
                    <div id="others-{{ $str_random }}" class="col s10 offset-s1" data-course-files style="margin-top: 1em; background-color: #fff;"></div>
                </div>
            </div>
        </li>
    @endforeach
</ul>


<script>
    (function($)
    {
        $(function()
        {
            $('.collapsible').collapsible({accordion : false});

            $('ul.tabs').tabs();

            initializeModal({complete: function() {$('div[data-course-news]').empty(); $('div[data-loading]').show();}});

            $('div[data-course-sidebar]').click(function()
            {
                var contentBody = $(this).closest('li').find('div.collapsible-body');
                var courseId = $(this).data('course-id');

                insertHtmlContent(contentBody.find('div[data-course-grades]'), 'course-grades-' + courseId, '/course-grades/' + courseId, function()
                {
                    insertHtmlContent(contentBody.find('div[data-course-files]'), 'course-files-' + courseId, '/course-files/' + courseId, function()
                    {
                        contentBody.find('div[data-loading]').remove();
                        contentBody.find('div[data-body]').show();
                        contentBody.find('a.active').click();
                    });
                });

                $(this).removeAttr('data-course-sidebar');
            });
        });
    })(jQuery);
</script>