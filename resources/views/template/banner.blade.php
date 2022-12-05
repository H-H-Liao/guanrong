@if(Pagebanners::getImage($page_name))
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="{{ Pagebanners::getImage($page_name) }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption mt-90">
                    <h1>{{$model->title ?? $page->title ?? 'error'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- hr -->

@endif
