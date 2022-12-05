@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)

@section('content')
    @include('template.banner',['page_name'=>'about'])

    {!! $page->body !!}
    @if(count(Mainservices::list())>0)
    <!-- Clients -->
    <div class="clients section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-15">
                    <div class="section-title">主要服務客群</div>
                </div>
            </div>
            <div class="row no-gutters clients-wrap clearfix">
                @foreach (Mainservices::list() as $item)
                <div class="col-md-3">
                    <a href="{{ $item->link }}" style="width: 100%">
                        <div class="client-logo" >
                            <div >
                                <div style="margin: auto;text-align:center;">
                                   {!! $item->icon !!}
                                <div class="mt-2">
                                {{$item->title}}
                                </div>
                            </div>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection
