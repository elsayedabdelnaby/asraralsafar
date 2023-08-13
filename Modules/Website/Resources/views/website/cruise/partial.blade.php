@foreach ($cruises as $cruise)
                                <div class="trend-full bg-white rounded box-shadow overflow-hidden p-4 mb-4">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="trend-item2 rounded">
                                                <a href="#"
                                                    style="
background-image: url({{global_asset('website') }}/images/destination/d1.jpg);
background-size: cover;
background-repeat: no-repeat;
"></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <div class="trend-content">
                                                <p class="mb-0"> {{ $cruise->name }}</p>
                                                <h4 class="mb-2 border-b pb-2">
                                                    <a href="#" class=""> {{ $cruise->description }}
                                                    </a>
                                                </h4>
                                                <ul
                                                    class="featured-meta border-b pb-2 mb-2 d-flex flex-sm-row flex-column gap-3 align-items-center justify-content-between">
                                                    <li>
                                                        <strong class="d-block"> تاريخ الرحلة</strong>
                                                        {{ $cruise->date }}
                                                    </li>
                                                    <li>
                                                        <strong class="d-block"> المغادرة</strong>
                                                        {{ $cruise->take_off_location }}
                                                    </li>
                                                </ul>


                                                <div
                                                    class="entry-author d-flex flex-sm-row flex-column align-items-center justify-content-between gap-3">
                                                    <a href="#" class="nir-btn-black py-1">احجز الآن</a>
                                                    <p class="mb-0">
                                                        تبدأ من :
                                                        <span class="theme fw-bold fs-6">{{ $cruise->start_from_price }}
                                                            {{ getCurrentLanguage()->id == 1 ? 'EGP' : 'ج.م' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
