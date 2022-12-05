@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'profile'])
    <!-- Project -->
    <div class="project section-padding">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6 project-masonry-wrapper-padding">
                    @foreach ($list as $key => $item)
                    @if($key%2 == 0)
                    <div class="portfolio-item-wrapp">
                        <div class="portfolio-item">
                            <div class="project-masonry-wrapper">
                                <a href="{{ $item->url() }}" class="project-masonry-item-img-link"> <img src="{{ $item->present()->image() }}" alt="" />
                                    <div class="project-masonry-item-img"></div>
                                    <div class="project-masonry-item-content">
                                        <h4 class="project-masonry-item-title">{{ $item->title }}</h4>
                                        <div class="project-masonry-item-category">{{ $item->sub_title }}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="col-12 col-md-6 project-masonry-wrapper-padding">
                    @foreach ($list as $key => $item)
                    @if($key%2  == 1)
                    <div class="portfolio-item-wrapp">
                        <div class="portfolio-item">
                            <div class="project-masonry-wrapper">
                                <a href="{{ $item->url() }}" class="project-masonry-item-img-link"> <img src="{{ $item->present()->image() }}" alt="" />
                                    <div class="project-masonry-item-img"></div>
                                    <div class="project-masonry-item-content">
                                        <h4 class="project-masonry-item-title">{{ $item->title }}</h4>
                                        <div class="project-masonry-item-category">{{ $item->sub_title }}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- hr -->


@endsection
