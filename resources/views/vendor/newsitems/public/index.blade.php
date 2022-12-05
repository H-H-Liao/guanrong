@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'news'])
	<!-- Blog -->
	<div class="savoye-blog section-padding">
		<div class="container">
            @foreach ($list as $key =>$item)
                @if($key%2 == 0)
                <div class="row mb-30">
                    <div class="col-md-6">
                        <div class="img left">
                            <a href="{{ $item->url() }}"><img src="{{ $item->present()->image() }}" alt="{{$item->title}}"></a>
                        </div>
                    </div>
                    <div class="col-md-6 valign">
                        <div class="content">
                            <div class="date">
                                <h1>{{ $item->show_date->format('d') }}</h1>
                                <h6>{{ $item->show_date->format('M Y') }}</h6>
                            </div>
                            <div class="cont">
                                <h5>{{$item->title}}</h5> <a href="{{$item->url()}}" class="more" data-splitting=""><span>閱讀更多</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row mb-30">
                    <div class="col-md-6 order2 valign animate-box" data-animate-effect="fadeInLeft">
                        <div class="content">
                            <div class="date">
                                <h1>{{ $item->show_date->format('d') }}</h1>
                                <h6>{{ $item->show_date->format('M Y') }}</h6>
                            </div>
                            <div class="cont">

                                <h5>{{$item->title}}</h5> <a href="{{$item->url()}}" class="more" data-splitting=""><span>閱讀更多</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order1 animate-box" data-animate-effect="fadeInRight">
                        <div class="img left">
                            <a href="{{$item->url()}}"><img src="{{ $item->present()->image() }}" alt="{{$item->title}}"></a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach


            {!! $list->links('template.pagination') !!}

		</div>
	</div>
	<!-- hr -->

@endsection
