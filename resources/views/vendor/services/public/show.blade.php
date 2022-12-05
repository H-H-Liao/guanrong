@extends('pages::public.master')

@section('title',$model->meta_title==""?$model->title:$model->meta_title)
@section('keywords',$model->meta_keywords)
@section('description',$model->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'service'])
    <!-- Services -->
    <div class="section-padding">
        <div class="container">
            <div class="row">
               <!-- Content -->
                <div class="col-md-8">
                    {!! $model->body !!}
                </div>
                <!-- Sidebar -->
                <div class="col-md-4 sidebar-side">
                    <aside class="sidebar blog-sidebar">
                        <div class="sidebar-widget services">
                            <div class="widget-inner">
                                <div class="sidebar-title">
                                    <h5>所有服務項目</h5>
                                </div>
                                <ul>
                                    @foreach (Services::list() as $item)
                                    <li @if($model->id == $item->id )class="active" @endif><a href="{{ $item->url() }}">{{$item->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div hidden class="sidebar-widget help">
                            <div class="widget-inner">
                                <div class="sidebar-title">
                                    <h5>Need Savoye Help?</h5>
                                </div>
                                <p>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions. info@savoye.com</p>
                                <div class="phone"><a href="tel:+11234560606"><i class="icon ti-tablet"></i>+1 123-456-0606</a></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- hr -->
@endsection
