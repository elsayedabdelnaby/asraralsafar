<div id="#flight-list">
    @foreach ($flights as $flight)
        <div class="item mb-2 border-all p-3 px-4 rounded">
            <div class="row g-lg-2 g-3 d-flex align-items-center justify-content-between">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="item-inner-image text-start">
                        <img src="{{ global_asset("storage/website/$flight->image") }}" width="60"
                            alt="image" />
                        <h5 class="mb-0"> {{ $flight->company_name }}</h5>
                        <small> {{ $flight->from_location }} - {{ $flight->to_location }}</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="item-inner">
                        <div class="content">
                            <h6 class="mb-0">
                                {{ $flight->day }}
                                <br />
                                {{ Carbon\Carbon::parse($flight->traveling_date)->format('d F Y') }}

                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="item-inner">
                        <div class="content">
                            <h5 class="mb-0">{{ $flight->arrival_time }}</h5>
                            <p class="mb-0 text-uppercase">{{ $flight->destination_slug }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="item-inner text-end">
                        <p class="theme2 fs-4 fw-bold fs-18">{{ $flight->price }}
                            {{ $flight->price_currency }}</p>
                        <a href="#" class="nir-btn-black">احجز الآن</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr class="mt-1 mb-1" />
                </div>
                <div class="col-12">
                    <ul class="list-inline d-flex flex-wrap">
                        <li class="list-inline-item">
                            <span class="badge bg-danger rounded-2 px-2 fs-12">{{ $flight->type }}
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <span class="badge bg-success rounded-2 px-2 fs-12">Airbus 320</span>
                        </li>
                        <li class="list-inline-item">
                            <span class="badge bg-secondary rounded-2 px-2 fs-12">وجبات طازجة</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
