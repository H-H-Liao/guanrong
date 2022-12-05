@extends('pages::public.master')

@section('title',$model->meta_title==""?$model->title:$model->meta_title)
@section('keywords',$model->meta_keywords)
@section('description',$model->meta_description)


@section('content')
    @include('template.banner',['page_name'=>'news'])
    <!-- Post -->
    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-30">Quisque pretium fermentum quam, sit amet cursus ante sollicitudin vel. Morbi consequat risus consequat, porttitor orci sit amet, iaculis nisl. Integer quis sapien nec elit ultrices euismod sit amet id lacus. Sed a imperdiet erat. Duis eu est dignissim lacus dictum hendrerit quis vitae mi. Fusce eu nulla ac nisi cursus tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer tristique sem eget leo faucibus porttitor.</p>
                    <img src="img/slider/2.jpg" class="mb-30" alt="">
                    <p>Nulla vitae metus tincidunt, varius nunc quis, porta nulla. Pellentesque vel dui nec libero auctor pretium id sed arcu. Nunc consequat diam id nisl blandit dignissim. Etiam commodo diam dolor, at scelerisque sem finibus sit amet. Curabitur id lectus eget purus finibus laoreet. Nam eget lectus ac sem luctus hendrerit sed nec magna. Maecenas vulputate magna sed nunc pellentesque, in consectetur nisi condimentum.</p>
                </div>
            </div>
            <div hidden class="savoye-comment-section">
                <div class="row">
                    <!-- Comment -->
                    <div class="col-md-7">
                        <div class="savoye-post-comment-wrap">
                            <div class="savoye-user-comment"> <img src="img/team/1.jpg" alt=""> </div>
                            <div class="savoye-user-content">
                                <h6>Robert Misse<span> 29 October 2022</span></h6>
                                <p>Photography ultricies nibh non dolor maximus scee the inte molliser faubs neque nec tincidunte aliquam erat volutpat. Praeser tem malade. </p> <a class="savoye-repay" href="#">Reply<i class="ti-back-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Form -->
                    <div class="col-md-4 offset-md-1">
                        <h6>Leave a Reply</h6>
                        <form method="post" class="row">
                            <div class="col-md-12">
                                <input type="text" name="name" id="name" placeholder="Full Name *" required="">
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" placeholder="Email Address *" required="">
                            </div>
                            <div class="col-md-12">
                                <textarea name="message" id="message" cols="40" rows="4" placeholder="Your Comment *" required=""></textarea>
                            </div>
                            <div class="col-md-12">
                            <button class="btn float-btn flat-btn mt-15">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Prev-Next Post -->
    <div class="savoye-post-prev-next">
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
