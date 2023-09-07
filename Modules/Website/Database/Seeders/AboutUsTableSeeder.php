<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\AboutUsTranslation;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutUs =  AboutUs::create([
            'id' => 1,
            'is_active' => true,
            'display_order' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);;

        $translations = [
            [
                'title' => 'البدايه',
                'description' => '<section
                class="about-us pt-6"
                style="
                  background-image: url(/public/website/images/background_pattern.png);
                  background-position: bottom right;
                "
              >
                <div class="container">
                  <div class="about-image-box">
                    <div class="row d-flex align-items-center justify-content-between">
                      <div class="col-lg-6 ps-4">
                        <div class="about-content text-center text-lg-start">
                          <h4 class="theme d-inline-block mb-0">أسرار الطيار</h4>
                          <h2 class="border-b mb-2 pb-1">نبذة عن تاريخ الشركة</h2>
                          <p class="border-b mb-2 pb-2">
                            تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                            الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم
                            أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                            الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                            الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                          </p>
                          <div class="about-listing">
                            <ul class="d-flex justify-content-between">
                              <li class="fs-14">
                                <i class="fa fa-binoculars theme me-1"></i> باقات متميزة
                              </li>
                              <li class="fs-14">
                                <i class="fa fa-dollar-sign me-1"></i> أسعار تنافسية
                              </li>
                              <li class="fs-14">
                                <i class="fa fa-shield-alt me-1"></i> ثقة و مصداقية
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 mb-4 pe-4">
                        <div
                          class="about-image"
                          style="animation: none; background: transparent"
                        >
                          <img src="/public/website/images/travel.png" alt="" />
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <!-- Counter -->
                        <div
                          class="counter-main w-75 float-start z-index3 position-relative"
                        >
                          <div
                            class="counter p-4 pb-0 box-shadow bg-white rounded mt-minus"
                          >
                            <div class="row">
                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">20</h2>
                                    <span class="m-0">سنة من الخبرة</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">530</h2>
                                    <span class="m-0">باقة سياحية</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">850</h2>
                                    <span class="m-0">عميل راضٍ</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">10</h2>
                                    <span class="m-0">جوائز</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Counter -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="white-overlay"></div>
              </section>',
                'language_id' => 2,
                'about_us_id' => $aboutUs->id
            ],
            [
                'title' => 'Start',
                'description' => '<section
                class="about-us pt-6"
                style="
                  background-image: url(/public/website/images/background_pattern.png);
                  background-position: bottom right;
                "
              >
                <div class="container">
                  <div class="about-image-box">
                    <div class="row d-flex align-items-center justify-content-between">
                      <div class="col-lg-6 ps-4">
                        <div class="about-content text-center text-lg-start">
                          <h4 class="theme d-inline-block mb-0">أسرار الطيار</h4>
                          <h2 class="border-b mb-2 pb-1">نبذة عن تاريخ الشركة</h2>
                          <p class="border-b mb-2 pb-2">
                            تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                            الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم
                            أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                            الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                            الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                          </p>
                          <div class="about-listing">
                            <ul class="d-flex justify-content-between">
                              <li class="fs-14">
                                <i class="fa fa-binoculars theme me-1"></i> باقات متميزة
                              </li>
                              <li class="fs-14">
                                <i class="fa fa-dollar-sign me-1"></i> أسعار تنافسية
                              </li>
                              <li class="fs-14">
                                <i class="fa fa-shield-alt me-1"></i> ثقة و مصداقية
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 mb-4 pe-4">
                        <div
                          class="about-image"
                          style="animation: none; background: transparent"
                        >
                          <img src="/public/website/images/travel.png" alt="" />
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <!-- Counter -->
                        <div
                          class="counter-main w-75 float-start z-index3 position-relative"
                        >
                          <div
                            class="counter p-4 pb-0 box-shadow bg-white rounded mt-minus"
                          >
                            <div class="row">
                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">20</h2>
                                    <span class="m-0">سنة من الخبرة</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">530</h2>
                                    <span class="m-0">باقة سياحية</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item border-end pe-4">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">850</h2>
                                    <span class="m-0">عميل راضٍ</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="counter-item">
                                  <div class="counter-content">
                                    <h2 class="value mb-0 theme">10</h2>
                                    <span class="m-0">جوائز</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Counter -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="white-overlay"></div>
              </section>',
                'language_id' => 1,
                'about_us_id' => $aboutUs->id
            ]

        ];

        AboutUsTranslation::insert($translations);

        $aboutUs =  AboutUs::create([
            'id' => 2,
            'is_active' => true,
            'display_order' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);;

        $translations = [
            [
                'title' => 'البدايه',
                'description' => '<section
                class="about-us pb-6 pt-6"
                style="
                  background-image: url(/public/website/images/shape4.png);
                  background-position: center;
                "
              >
                <div class="container">
                  <div class="section-title mb-6 w-50 mx-auto text-center">
                    <h4 class="mb-1 theme1">أسرار الطيار</h4>
                    <h2 class="mb-1">
                      <span class="theme">إختيارك الأمثل فى مصر</span>
                    </h2>
                    <p>
                      تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                      البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                    </p>
                  </div>

                  <!-- why us starts -->
                  <div class="why-us">
                    <div class="why-us-box">
                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/easy.svg"
                                  alt="Easy"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">السهولة و المرونة</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                يمكنك إجراء الحجز الخاص بك بسهولة من خلال موقعنا على
                                الإنترنت.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/trust.svg"
                                  alt="Trusted"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">الثقة و المصداقية</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار هي شركة موثوق بها من قبل جميع عملائها ، اكتشف
                                الشهادات.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/customer-review.svg"
                                  alt="Review"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">التركيز على العميل</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار تركز بشكل رئيسي على رضا العميل و سعادة.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/customer-service.svg"
                                  alt="customer service"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">دعم 24 ساعة يومياً</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار تدعم العملاء 24 ساعة في اليوم & 7 أيام
                                أسبوعياً.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- why us ends -->
                </div>
                <div class="white-overlay"></div>
              </section>',
                'language_id' => 2,
                'about_us_id' => $aboutUs->id
            ],
            [
                'title' => 'Start',
                'description' => '<section
                class="about-us pb-6 pt-6"
                style="
                  background-image: url(/public/website/images/shape4.png);
                  background-position: center;
                "
              >
                <div class="container">
                  <div class="section-title mb-6 w-50 mx-auto text-center">
                    <h4 class="mb-1 theme1">أسرار الطيار</h4>
                    <h2 class="mb-1">
                      <span class="theme">إختيارك الأمثل فى مصر</span>
                    </h2>
                    <p>
                      تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                      البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                    </p>
                  </div>

                  <!-- why us starts -->
                  <div class="why-us">
                    <div class="why-us-box">
                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/easy.svg"
                                  alt="Easy"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">السهولة و المرونة</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                يمكنك إجراء الحجز الخاص بك بسهولة من خلال موقعنا على
                                الإنترنت.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/trust.svg"
                                  alt="Trusted"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">الثقة و المصداقية</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار هي شركة موثوق بها من قبل جميع عملائها ، اكتشف
                                الشهادات.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/customer-review.svg"
                                  alt="Review"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">التركيز على العميل</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار تركز بشكل رئيسي على رضا العميل و سعادة.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                          <div
                            class="why-us-item text-center p-4 py-5 border rounded bg-white h-100"
                          >
                            <div class="why-us-content">
                              <div class="why-us-icon mb-3">
                                <img
                                  src="./images/icons/customer-service.svg"
                                  alt="customer service"
                                  width="70"
                                />
                              </div>
                              <h4>
                                <a href="#">دعم 24 ساعة يومياً</a>
                              </h4>
                              <p class="mb-0 fs-14">
                                أسرار الطيار تدعم العملاء 24 ساعة في اليوم & 7 أيام
                                أسبوعياً.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- why us ends -->
                </div>
                <div class="white-overlay"></div>
              </section>',
                'language_id' => 1,
                'about_us_id' => $aboutUs->id
            ]

        ];

        AboutUsTranslation::insert($translations);
    }
}
