<div class="toolbar-custom">
    <input id="game-id" hidden value="{{ $game_id }}"/>
    <div class="float-left cold-12 col-sm-6 p-l-0 p-r-10">
        <div class="form-group input-icon-right mb-3">
            <i class="fa fa-search"></i>
            <input type="text" id="title-blog-search" class="form-control search-game"
                   placeholder="Search Blog...">
        </div>
    </div>
    <div class="dropdown float-left">
        <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true"><span id="span-platform">All Platform</span></span><i
                    class="fa fa-caret-down"></i></button>
        <div class="dropdown-menu">
            <a class="dropdown-item drop-platform active" data-id="0" href="javascript:void(0)">All
                Platform</a>
            @foreach($platforms_all as $plat)
                <a class="dropdown-item drop-platform" data-id="{{ $plat->id }}"
                   href="javascript:void(0)">{{ $plat->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="btn-group float-right m-l-5 hidden-sm-down" role="group">
        <a onclick="gridView()" class="btn btn-default btn-icon" href="javascript:void(0)"
           role="button"><i
                    class="fa fa-th-large"></i></a>
        <a onclick="listView()" class="btn btn-default btn-icon" href="javascript:void(0)"
           role="button"><i class="fa fa-bars"></i></a>
    </div>

    <div class="dropdown float-right">
        <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true"><span id="span-sort">Popular</span><i
                    class="fa fa-caret-down"></i></button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item drop-sort active" data-id="{{ \App\Model\Blog::BEST }}"
               href="javascript:void(0)">Popular</a>
            <a class="dropdown-item drop-sort" data-id="{{ \App\Model\Blog::NEWEST }}"
               href="javascript:void(0)">Newest</a>
            <a class="dropdown-item drop-sort" data-id="{{ \App\Model\Blog::OLDEST }}"
               href="javascript:void(0)">Oldest</a>
        </div>
    </div>
</div>