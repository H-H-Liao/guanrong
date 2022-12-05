@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)



@push('js')
    {!! htmlScriptTagJsApi() !!}
@endpush

@section('content')
        @include('template.banner',['page_name'=>'contact'])
        <!-- Contact -->
        <div class="contact section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mb-30">
                       {!! $page->body !!}
                    </div>
                    <div class="col-md-6 offset-md-1 mb-30">
                        <h5>留下訊息</h5>
                        {!! BootForm::open()->action(route($lang.'::store-contact'))->multipart()->addClass('contact__form') !!}
                        {!! Honeypot::generate('my_name', 'my_time') !!}
                        {!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}
                                <!-- Form message -->
                                @if (Session::has('errors'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg">
                                            @foreach ($errors->all() as $error)
                                            {{$error}}<br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- Form elements -->
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input name="title" value="{{ old('title') }}" type="text" placeholder="姓名 *" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" value="{{ old('email') }}" type="email" placeholder="Email *" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="phone" value="{{ old('phone') }}" type="text" placeholder="聯絡電話 *" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input name="subject" type="text"  value="{{ old('subject') }}" placeholder="主旨 *" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <textarea name="message" id="message" cols="30" rows="4" placeholder="訊息 *" required>{{old('message')}}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        {!! htmlFormSnippet() !!}
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit"  value="傳送訊息">
                                    </div>
                                </div>
                                {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
