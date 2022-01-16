<div class="newsListItem">

    <div id=""
         class="newsImage pull-right " style="width: 100%">

        <a id=""
           title="{{ str_slug_fa($data->title) }}"
           href="{{ route('news.show', [$data->id , str_slug_fa($data->title)]) }}"
           target="_parent">
            <img
                    id=""
                    title="{{ str_slug_fa($data->title) }}" class="img-responsive img-thumbnail"
                    src="{{ image_url($data->image_url , 235,100 ,true) }}"
                    alt="{{ str_slug_fa($data->title) }}" style="border-width:0px;/*width: 100%*/"/></a>

    </div>

    <div id=""
         class="newsListTitle">

        <h3>
            <a id=""
               title="{{ jDate::forge($data->created_at)->format('%d %B %Y') }}"
               href="{{ route('news.show', [$data->id , str_slug_fa($data->title)]) }}"
               target="_parent">{{ $data->title }}</a>

        </h3>

    </div>
    <div id=""
         class="newsListLead lead">

                                    <span id=""
                                          class="leadContent">
                                        {{ $data->descr }}
                                    </span>
        <a id=""
           title="..." class="newsLeadMore"
           href="{{ route('news.show', [$data->id , str_slug_fa($data->title)]) }}"
           target="_parent">...</a>

    </div>


</div>
