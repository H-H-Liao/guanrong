@if($item=Pagebanners::getValue($target))
    <div class="banner banner-pages u-overhidden" style="background-image: url('{{ $item->present()->image() }}')">
        <h1 class="BIGheading  banner__BIGheading u-text-center">{{$item->title}}
            <div class="BIGheading__eng">{{ $item->sub_title }}</div>
            <div class="BIGheading__bg"></div>
        </h1>
    </div>
@endif
