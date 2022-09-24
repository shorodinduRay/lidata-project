@extends('front.master')
@section('metaDescription')
@endsection
@section('title')
      Pricing for small and large companies | Li Data
@endsection

@section('main')

  <!-- START BREADCRUMB -->
  <hr class="mt-lg-0 mt-5 text-secondary" />
      <div class="container">
        <div class="row">
          <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Pricing
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- END BREADCRUMB -->
      <!-- START SECTION HEADER -->
      <section class="section-header u-padding-lg pb-3 text-center">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="heading">Upgrade Your Plan</h1>
              <h2 class="heading--sub">
                Pricing for small and large companies
              </h2>
            </div>
          </div>
        </div>
      </section>
      <!-- END SECTION HEADER -->

      <!-- START PACKAGES -->
  <section
          class="section-packages u-padding-lg pt-5 px-sm-0 d-flex justify-content-center"
  >
    <div class="container mx-md-5 px-md-5">
      <div class="row mx-lg-5 mb-md-5 justify-content-center">
        @foreach($packages as $package)
          <div class="col-md-4 col-sm-6 col-9">
          <div class="pricingTable">
            <div class="pricingTable-header">
              <i class="bi "></i>
              <div class="price-value">
                ${{ $package->price }} <span class="month">per month</span>
              </div>
            </div>
            <h3 class="heading">{{ $package->plan }}</h3>
            <div class="pricing-content">
              <ul>
                <li><i class="bi bi-check2"></i>{{ $package->creditConvert }} Credits</li>
                <li><i class="bi bi-check2"></i>{{ $package->dataViewsConvert }} Data Views</li>
                <li><i class="bi bi-check2"></i>{{ $package->dataFilter }}</li>
                <li><i class="bi bi-check2"></i>{{ $package->csvExport }}</li>
              </ul>
            </div>
            <div class="pricingTable-signup">
              @guest
                <a href="{{ route('user.register') }}" class="btn btn-default">sign up</a>
              @else
                <a href="{{ route('billingRequest', $package->id) }}" class="btn btn-default">sign up</a>
              @endguest
            </div>
          </div>
        </div>
        @endforeach

        <div class="row mx-lg-5 mt-md-5 justify-content-center">
          <div class="col-md-4 col-sm-6 col-9 mt-3">
            <div class="pricingTable red">
              <div class="pricingTable-header">
                <i class="bi bi-handbag-fill"></i>
                <div class="price-value">
                  Talk to Sales<span class="month">&nbsp;</span>
                </div>
              </div>
              <h3 class="heading">Custom</h3>
              <div class="pricing-content">
                <ul>
                  <li><i class="bi bi-check2"></i>Unlimited Credits</li>
                  <li><i class="bi bi-check2"></i>Unlimited Data Views</li>
                  <li><i class="bi bi-check2"></i>Data Filters</li>
                  <li><i class="bi bi-check2"></i>CSV Export</li>
                </ul>
              </div>
              <div class="pricingTable-signup">
                <button class="btn btn-default">contact us</button>
              </div>
            </div>
        </div>
      </div>
      </div>
    </div>
  </section>


      <!-- END PACKAGES -->

  <!-- START Frequently Asked Questions -->
      <section class="section-packages-faq my-5">
        <div class="container">
          <div class="row">
            <div class="card u-box-shadow-2 rounded-3 border-0 p-5">
              <div class="card-title text-center pt-5">
                Frequently Asked Questions
              </div>

              <div class="card-body">
                <div class="faq" id="faq">
                  <!-- FAQ 01 -->
                  <div class="faq-item my-4 bg-tranparent">
                    <h4 class="faq-header" id="headingOne">
                      <button
                        class="faq-button d-flex align-items-center"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                      >
                        <i class="bi bi-caret-down-square-fill"></i>
                        <span>
                          How many different types of data do I receive?
                        </span>
                      </button>
                    </h4>
                    <div
                      id="collapseOne"
                      class="faq-collapse collapse"
                      aria-labelledby="headingOne"
                      data-bs-parent="#faq"
                    >
                      <div class="faq-body">
                        Lidata provides you with name, title, phone number,
                        location related to each and everyone of the contacts.
                      </div>
                    </div>
                  </div>
                  <!-- FAQ 02 -->
                  <div class="faq-item my-4 bg-tranparent">
                    <h4 class="faq-header" id="headingTwo">
                      <button
                        class="faq-button d-flex align-items-center"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo"
                        aria-expanded="true"
                        aria-controls="collapseTwo"
                      >
                        <i class="bi bi-caret-down-square-fill"></i>
                        <span>
                          How many different types of data do I receive?
                        </span>
                      </button>
                    </h4>
                    <div
                      id="collapseTwo"
                      class="faq-collapse collapse"
                      aria-labelledby="headingTwo"
                      data-bs-parent="#faq"
                    >
                      <div class="faq-body">
                        Lidata provides you with name, title, phone number,
                        location related to each and everyone of the contacts.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- END  Frequently Asked Questions -->

      @endsection