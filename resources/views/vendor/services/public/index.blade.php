@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'service'])
    <!-- Services -->
    <div class="services-feat section-padding">
        <div class="container">
            <div class="row">
                @foreach ($list as $item)
                <div class="col-md-4">
                    <div class="square-flip">
                        <div class="square bg-img" data-background="{{ $item->present()->image() }}">
                            <div class="square-container d-flex align-items-end justify-content-end">
                                <div class="box-title text-vertical">
                                    <h4>{{$item->title}}</h4>
                                </div>
                            </div>
                            <div class="flip-overlay"></div>
                        </div>
                        <div class="square2">
                            <div class="square-container2">
                                <h4>{{$item->title}}</h4>
                                <p>{{$item->summary}}</p>
                                <div class="btn-line"><a href="{{ $item->url() }}">{{ __('Read more') }}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- hr -->
@endsection
