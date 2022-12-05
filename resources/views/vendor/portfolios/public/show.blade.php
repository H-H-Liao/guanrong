@extends('pages::public.master')

@section('title',$model->meta_title==""?$model->title:$model->meta_title)
@section('keywords',$model->meta_keywords)
@section('description',$model->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'profile'])
    <!-- Project -->
    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $model->body !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Prev-Next Projects -->
    <div class="projects-prev-next">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="savoye-post-prev-next-left">
                            @if($prev)
                            <a href="{{ $prev->url() }}"> <i class="ti-arrow-left"></i> 上一則</a>
                            @endif
                        </div>
                        <a hidden href="{{$page->title}}"><i class="ti-layout-grid3-alt"></i></a>
                        <div class="savoye-post-prev-next-right">
                            @if($next)
                            <a href="{{$next->url()}}">下一則 <i class="ti-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
