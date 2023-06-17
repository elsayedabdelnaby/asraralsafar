@extends('website::website.layouts.master')

@if (!empty($metaPage))
    @php
        $metaPageTitle = !empty($metaPage->first()->meta_page_title) ? $metaPage->first()->meta_page_title : '';
        $metaPageDescription = !empty($metaPage->first()->meta_page_description) ? $metaPage->first()->meta_page_description : '';
        $imageUrl = !empty($metaPage->first()->image_url) ? $metaPage->first()->image_url : '';
        
    @endphp
    @section('meta_page')
        <meta property="og:title" content="{{ $metaPageTitle }}">
        <meta property="og:description" content="{{ $metaPageDescription }}">
        <meta name="description" content="{{ $metaPageDescription }}">
        <meta property="og:image" content="{{ $imageUrl }}">
    @endsection
@endif

@section('content')
<section class="blog">
    <div class="container">
        <div class="listing-inner">
            <div class="row">
                <div class="col-12 text-sm-start text-center">
                    <h1 class="fs-2 fw-bold">المقالات و الأخبار</h1>
                </div>
                <div class="col-lg-12">
                    <div class="list-results d-flex align-items-center justify-content-between">
                        <div class="list-results-sort">
                            <p class="m-0">عرض 1 - 30 من النتائج</p>
                        </div>
                        <div class="click-menu d-flex align-items-center justify-content-between">
                            <div class="change-list f-active me-2 rounded overflow-hidden"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12"> 
                    @foreach ($blogs as $blog)
                    <div class="blog-full mb-4 border-b bg-white box-shadow p-4 rounded border-all">
                        <div class="row">
                            <div class="col-lg-5 col-md-4 blog-height">
                                <div class="blog-image rounded">
                                    <img src="{{ $blog->image_url }}" alt="">
                                    {{-- <a href="{{ route('blog.show', $blog->id) }}" style="background-image: url({{ $blog->image_url }})"></a> --}}
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8">
                                <div class="blog-content">
                                    <h5 class="mb-1 badge bg-info rounded-pill">{{ $blog->category }}</h5>
                                    <h3 class="mb-2">
                                        <a href="{{ route('blog.show', $blog->id) }}" class="fs-4">{{ $blog->blog_title }}</a>
                                    </h3>
                                    <p class="date-cats mb-2">
                                        <span class="me-2"><i class="fa fa-calendar-alt"></i> {{ !empty($blog->created_at) ? $blog->created_at->format('M d, Y') : '' }}</span>
                                        {{-- <span><i class="fa fa-eye"></i> {{ $blog->views }} مشاهدة</span> --}}
                                    </p>
                                    <p class="text-muted mb-0">{{ $blog->blog_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pagination-main text-center">
                <ul class="pagination">
                    <li>
                        <a href="#" class="page-link">
                            <i class="fa fa-angle-double-left mirror-ar" aria-hidden="true"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                        <li class="{{ $blogs->currentPage() == $i ? 'active' : '' }}">
                            <a href="{{ $blogs->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endfor
                    <li>
                        <a href="#" class="page-link">
                            <i class="fa fa-angle-double-right mirror-ar" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
    </div>
</section>

@endsection