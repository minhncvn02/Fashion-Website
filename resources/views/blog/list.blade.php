@extends('layouts.app')
@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Tin tức</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item" style="text-transform:none"><a href="{{url('blog')}}">Tin tức</a></li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-container max-col-3" data-layout="fitRows">
                        @foreach ($getBlog as $value)
                        <div class="entry-item col-sm-4">
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="{{url('blog/'.$value->slug)}}">
                                        <img src="{{$value->getImg()}}" style="height:300px;width:100%;object-fit:cover">
                                    </a>
                                </figure>

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        {{date('d/m/Y', strtotime($value->created_at))}}
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{url('blog/'.$value->slug)}}">{{$value->title}}</a>
                                    </h2><!-- End .entry-title -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div>
                        @endforeach

                    </div>

                    {!! $getBlog->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')

@endsection



