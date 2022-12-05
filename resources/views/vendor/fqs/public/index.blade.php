@extends('pages::public.master')

@section('content')
    @include('template.banner',['page_name'=>'qa'])
        <!-- Faqs -->
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($list as $item)
                            <ul class="accordion-box clearfix">
                                <li class="accordion block @if($loop->index == 0)active-block @endif">
                                    <div class="acc-btn  @if($loop->index == 0)active @endif"><span class="count">{{$loop->index+1}}.</span>{{ $item->title }}</div>
                                    <div class="acc-content  @if($loop->index == 0)current @endif">
                                        <div class="content">
                                            <div class="text">{!! $item->body !!}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
