@extends('pages::public.master')


@push('css')
    <!-- $$$ Single CSS $$$ -->
    <link rel="stylesheet" href="/project/css/wrapper.min.css" />
@endpush

@push('js')
    <!-- $$$ Single JS $$$ -->
    <script>
        $currentpage = "SEARCH"
    </script>
@endpush

@section('content')
<section>

    <div class="wrapper-A wrapper-search">
        <div class="container">
            <div class="flexCC">
                <div class="templeset">
                    <img class="templeset__temple lazyload" src="/project/images/temple-wrapper.png" alt="寺廟圖案">
                    <img class="templeset__leftcloud lazyload" src="/project/images/leftcloud.png" alt="左邊的雲">
                    <img class="templeset__rightcloud lazyload" src="/project/images/rightcloud.png" alt="右邊的雲">
                </div>
            </div>
            <div class="flexCCC">
                <h1 class="heading">{{$page->title}}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ TypiCMS::homeUrl() }}">{{Pages::getHomeTitle()}}</a></li>
                        <li aria-current="page" class="breadcrumb-item active">{{$page->title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container-lg">
            <div class="block-productslist">

                <div class="productbox-group">
                    @foreach ($list as $item)
                    <div class="productbox wow fadeIn">
                        <div class="productbox__pic">
                            <div class="productbox__pic-inner" style="background-image: url('{{ $item->getFirstImage() }}');"></div>
                        </div>
                        <div class="productbox__info">
                            <div class="productbox__title">{{$item->title}}</div>
                            <div class="productbox__cate">{{$item->cate}}</div>
                            <div class="productbox__price-group">
                                <div class="productbox__oldprice">NT.{{ $item->getOriginalPrice() }}</div>
                                <div class="productbox__price">NT.{{$item->getPrice()}}</div>
                            </div>
                        </div>
                        <a href="{{ $item->url() }}" class="productbox__btn">
                            前往選購
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
