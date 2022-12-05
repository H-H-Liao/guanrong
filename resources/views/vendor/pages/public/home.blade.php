@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)


@section('content')
    @foreach ($page->sections as $section)

    @if($section->section == 'jumbotron')
    @if(count(Banners::list()) > 0)
    <!-- Slider -->
    <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number".You can change it using the numbers 0-9. -->
            @foreach (Banners::list() as $item)
            <div class="text-left item bg-img" data-overlay-dark="3" data-background="{{ $item->present()->image() }}">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 mt-30">
                                <div class="o-hidden">
                                    <h6>{{$item->sub_title}}</h6>
                                    <h1>{{ $item->title }}</h1>
                                    <p>{!! $item->summary !!}</p>
                                    @if($item->button_text)
                                    <a href="{{ $item->button_link }}" class="btn float-btn flat-btn">{{$item->button_text}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- <div class="text-left item bg-img" data-overlay-dark="3" data-background="/project/img/slider/2.jpg">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 mt-30">
                                <div class="o-hidden">
                                    <h6>Residental</h6>
                                    <h1>One Stone House</h1>
                                    <p>Architecture viverra tellus nec massa dictum the blackspace euismoe.<br>Curabitur viverra the posuere hose aukue velition.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-left item bg-img" data-overlay-dark="4" data-background="/project/img/slider/3.jpg">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 mt-30">
                                <div class="o-hidden">
                                    <h6>Residental</h6>
                                    <h1>Collin Bea House</h1>
                                    <p>Architecture viverra tellus nec massa dictum the blackspace euismoe.<br>Curabitur viverra the posuere hose aukue velition.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </header>
    @endif
    @endif
    @if($section->section == 'about')
    <!-- About -->
    <div class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $section->body !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($section->section == 'project')
    <!-- Projects -->
    <div class="savoye-project section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title">{{ $section->title }}</div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        @foreach (Homeprojects::list() as $key => $item)
                        <div class="projects3 @if($key %2 ==1) left @endif animate-box" data-animate-effect="fadeInUp">
                            <figure><a @if($item->button_link) href="{{ $item->button_link }}" @endif><img src="{{ $item->present()->image() }}" alt="" class="img-fluid"></a></figure>
                            <div class="caption">
                                <h6>{{$item->sub_title}}</h6>
                                <h4>{{ $item->title }}</h4>
                                <p>{!! $item->body !!}</p>
                                @if($item->button_text)
                                <a href="{{ $item->button_link }}" class="btn float-btn flat-btn">{{$item->button_text}}</a>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
        </div>
    </div>
    @endif
    @if($section->section == 'news')
    <!-- Blog -->
    <div class="blog section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">{{ $section->title }}</div>
                </div>
            </div>
            <div class="row">
                @foreach (Newsitems::list(3) as $item)
                <div class="col-md-4">
                    <div class="item">
                        <div class="post-img">
                            <a href="{{ $item->url() }}"><div class="img"> <img src="{{ $item->present()->image() }}" alt=""> </div></a>
                        </div>
                        <div class="cont">
                            <h4><a href="{{ $item->url() }}">{{ $item->title }}</a></h4>
                            <div class="info"><a>{{ $item->show_date->format('M,d') }}</a> </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @endforeach
@endsection
