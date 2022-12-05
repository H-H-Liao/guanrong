@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'parner'])
    <!-- Clients -->
    <div class="clients section-padding">
        <div class="container">
            <div class="row no-gutters clients-wrap clearfix">
                @foreach ($list as $item)
                <div class="col-md-3">
                    <a href="{{ $item->link }}" target="__blank">
                        <div class="client-logo"> <img src="{{ $item->present()->image() }}" alt="{{ $item->title }}"> </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- hr -->

@endsection
