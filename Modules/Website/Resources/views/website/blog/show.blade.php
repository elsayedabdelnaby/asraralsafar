@extends('website::website.layouts.master')

@section('content')
    <div class="page-cover py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8 pe-lg-5">
                    <div class="row align-items-center">
                        <div class="col-12 mb-4">
                            <div class="box-shadow p-3 rounded">
                                <img src="{{ $blog->image_url }}" alt="Image" class="w-100 rounded" />
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="cover-content text-center text-md-start">
                                <div class="author-detail mb-2">
                                    <span
                                        class="tag white bg-theme py-1 px-3 me-2 rounded-pill">{{ $blog->category }}</span>
                                </div>
                                <h1 class="fs-3 fw-bold">
                                    {{ $blog->blog_title }}
                                </h1>
                                <div class="author-detail d-flex align-items-center mb-4">
                                    <span class="me-3"><span><i class="far fa-clock"></i>
                                            {{ $blog->created_at }}</span></span>
                                    <span class="me-3"><span><i class="far fa-user"></i> Admin</span></span>
                                    <span><span><i class="far fa-eye"></i> {{ $blog->views_number }}</span></span>
                                </div>
                                <div class="blog-content mb-4">
                                    <p class="mb-3">
                                        {{ $blog->translation->description }}
                                    </p>
                                </div>
                                <!-- blog review -->
                                <div class="single-add-review mb-5">
                                    <h4 class="mb-3">اكتب تعليقك هنا</h4>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <input type="text" name="name" placeholder="الإسم كاملاً" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <input type="text" name="email" placeholder="البريد الإلكترونى" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-1">
                                                <div class="form-group">
                                                    <textarea>التعليق</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-btn text-end">
                                                    <a href="#" class="nir-btn">إرسال التعليق</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- blog comment list -->
                                <div class="single-comments single-box mb-4">
                                    <h4 class="mb-4">الآراء و التعليقات (16)</h4>
                                    @foreach ($blog->comments as $comment)
                                        <div class="comment-box">
                                            <div class="comment-image mt-2">
                                                <img src="{{ $comment->author->profile_image }}" width="80"
                                                    alt="image" />
                                            </div>
                                            <div class="comment-content rounded">
                                                <h4 class="mb-1">{{ $comment->author->name }}</h4>
                                                <p class="comment-date">{{ $comment->created_at->format('F d, Y') }}</p>
                                                <p class="mb-2">{{ $comment->content }}</p>
                                                <a href="#" class="btn btn-link">رد</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-sticky">
                        <div class="list-sidebar">
                            <div class="author-news mb-4 box-shadow p-5 text-center border-all rounded">
                                <div class="author-news-content">
                                    <div class="author-thumb mb-1">
                                        <img src="{{ global_asset('website/') }}/images/icon.png" alt="Asrar Altayar" />
                                    </div>
                                    <div class="author-content">
                                        <h3 class="title mb-1"><a href="#">أسرار الطيار</a></h3>
                                        <p class="mb-2">
                                            قم بمشاركة المقال على وسائل التواصل الإجتماعى مع معارفك
                                            و أصدقائك من أجل وصولنا اليهم و تقديم خدمات مميزه لهم
                                        </p>
                                        <div class="header-social">
                                            <ul>
                                                <li class="me-1">
                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li class="me-1">
                                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-item mb-4">
                                <h4 class="">تصنيفات المقالات</h4>
                                <ul class="sidebar-category d-flex flex-wrap gap-1">
                                    <li><a href="#">كل المقالات</a></li>
                                    <li><a href="#">الأحدث</a></li>
                                    <li><a href="#">الأكثر مشاهدة</a></li>
                                    @foreach ($blog->categories as $category)
                                        <li class="{{ $category->id == $blog->category->id ? 'active' : '' }}"><a
                                                href="#"> {{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="popular-post sidebar-item">
                                <div class="sidebar-tabs">
                                    <div class="post-tabs">
                                        <h4 class="mb-3">تصنيفات المقالات</h4>
                                        <article class="post mb-3 border-b pb-3">
                                            <div class="s-content d-flex align-items-center justify-space-between">
                                                <div class="sidebar-image w-25 me-3">
                                                    <a href="#"><img src="{{ global_asset('website/') }}/images/blog/b2.jpg"
                                                            alt="Blog title" /></a>
                                                </div>
                                                <div class="content-list w-75">
                                                    <h5 class="mb-1">
                                                        <a href="#">طريقة استخراج الرخص الدولية</a>
                                                    </h5>
                                                    <div class="date">10 أبريل ، 2023</div>
                                                </div>
                                            </div>
                                        </article>
                                        <article class="post mb-3 border-b pb-3">
                                            <div class="s-content d-flex align-items-center justify-space-between">
                                                <div class="sidebar-image w-25 me-3">
                                                    <a href="#"><img
                                                            src="{{ global_asset('website/') }}/images/blog/b1.jpg"
                                                            alt="Blog title" /></a>
                                                </div>
                                                <div class="content-list w-75">
                                                    <h5 class="mb-1">
                                                        <a href="#">طريقة استخراج الرخص الدولية</a>
                                                    </h5>
                                                    <div class="date">23 أبريل ، 2023</div>
                                                </div>
                                            </div>
                                        </article>
                                        <article class="post mb-3">
                                            <div class="s-content d-flex align-items-center justify-space-between">
                                                <div class="sidebar-image w-25 me-3">
                                                    <a href="#"><img
                                                            src="{{ global_asset('website/') }}/images/blog/b2.jpg"
                                                            alt="Blog title" /></a>
                                                </div>
                                                <div class="content-list w-75">
                                                    <h5 class="mb-1">
                                                        <a href="#">طريقة استخراج التأشيرات 2023</a>
                                                    </h5>
                                                    <div class="date">10 مايو ، 2023</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-item mb-4">
                                <h4 class="">الكلمات المفتاحية</h4>
                                <ul class="sidebar-tags">
                                    <li><a href="#">رحلة سياحية</a></li>
                                    <li><a href="#">رحلات جوية</a></li>
                                    <li><a href="#">رحلات بحرية</a></li>
                                    <li><a href="#">حجز طيران</a></li>
                                    <li><a href="#">تأشيرات</a></li>
                                    <li><a href="#">رخص جوية</a></li>
                                    <li><a href="#">أسرار الطيار</a></li>
                                    <li><a href="#">القاهرة</a></li>
                                    <li><a href="#">رحلات رخيصة</a></li>
                                    <li><a href="#">رحلات مميزة</a></li>
                                    <li><a href="#">السفر</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
