@php
    $pages = ceil($filter['movieCount'] / $filter['recordsOnPage']);
    $page = $filter['pageNumber'];
    $link = '?searchPhrase=' . $filter['searchPhrase'] . '&' . 'recordsOnPage=' . $filter['recordsOnPage'] . '&' . 'page=' ;
@endphp

<ul class="pager pager--footer">
    <li class="previous <?= ($page == 1) ? 'disabled' : ''?> "><a href="{{ $link }}{{ $page - 1 }}">Previous</a></li>
    <li class="next <?= ($page >= $pages) ? 'disabled' : ''?> "><a href="{{ $link }}{{ $page + 1 }}">Next</a></li>
</ul> 
