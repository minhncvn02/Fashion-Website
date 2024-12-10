@extends('layouts.app')
@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">{{$getBlog->title}}</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('blog')}}">Tin tức</a></li>
                <li class="breadcrumb-item" style="text-transform:none">{{$getBlog->title}}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{$getBlog->getImg()}}" alt="{{$getBlog->title}}">
                        </figure>

                        <div class="entry-body">
                            <div class="entry-meta">
                                {{date('d/m/Y', strtotime($getBlog->created_at))}}
                            </div>

                            <div class="entry-content editor-content">
                                {!! $getBlog->description !!}
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main>
@endsection

@section('script')

@endsection



