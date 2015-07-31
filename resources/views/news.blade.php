<ul class="collapsible" data-collapsible="accordion" data-course-id="{{ $courseId }}">
    @forelse ($news as $new)
        <li>
            <div class="collapsible-header">{{ $new->children(0)->plaintext }} - {{ $new->children(2)->plaintext }}</div>
            <?php $onclick = $new->children(2)->children(0)->children(0)->children(0)->attr['onclick']; ?>
            <div class="collapsible-body" data-news-id="{{ substr($onclick, strpos($onclick, 'a_id') + 5, strpos($onclick, 'system') - strpos($onclick, 'a_id') - 6) }}"><p></p></div>
        </li>
    @empty
        <li>
            <div class="collapsible-header">似乎沒有公告可以顯示呦~</div>
            <div class="collapsible-body"><p>空空如也！</p></div>
        </li>
    @endforelse
</ul>

<script>
    (function($)
    {
        $(function()
        {
            $('div[data-news-id]').each(function()
            {
                var courseId = $(this).closest('ul').data('course-id');
                var newsId = $(this).data('news-id');

                insertHtmlContent($(this).find('p'), courseId + '-' + newsId, '/course-news/' + courseId + '/' + newsId);
            });

            $('.collapsible').collapsible({accordion : false});
        });
    })(jQuery);
</script>