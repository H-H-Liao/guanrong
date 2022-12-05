@extends('pages::public.master')



@section('content')
        @include('template.banner',['page_name'=>'error'])
        <!-- Not found 404 -->
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center"> <img src="/project/img/404-image.png" class="mb-30" alt="">
                        <h2>Sorry we can't find that page!</h2>
                        <p>The page you are looking for was moved, removed, renamed or never existed.</p>
                        <div hidden class="error-form">
                            <form method="post" action="blog.html">
                                <div class="form-group clearfix">
                                    <input type="search" name="text" value="" placeholder="Search here" required="">
                                    <button type="submit" class="theme-btn"><span class="ti-search"></span></button>
                                </div>
                            </form>
                        </div>
                        <a href="{{ TypiCMS::homeUrl() }}" class="btn mt-30 text-center"><span><i class="ti-arrow-left"></i> Back to home</span></a>
                    </div>
                </div>
            </div>
        </div>
@endsection
