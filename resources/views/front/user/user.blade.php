@extends('front.master')

@section('metaDescription')
  {{ $data->person_name }}'s Contact Details with mobile number and address from Phone List
@endsection


@section('title')
  {{ $data->person_name }}'s Contact Details | Phone List
  @endsection

  @section('main')

    <!-- START BREADCRUMB -->
    <hr class="mt-lg-0 mt-5 text-secondary" />
    <div class="container">
      <div class="row">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data->person_name }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- END BREADCRUMB -->
    <!-- START SEARCH BARS -->
    <section class="section-searchbar pt-md-5 pb-md-4 py-2 mt-md-0 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-6 ms-md-auto">
            <div class="row">
              <form action="{{ route('userSearch') }}">
                @csrf
                <div class="col-12">
                  <input  type="text" name="searchPeople" id="searchPeopleName"
                          class="searchBar bg-white border-5 text-dark fw-normal col-md-9 col-8"
                          placeholder="Search by Name..." onkeyup="searchPeople()" autocomplete="off"  />
                  <button type="submit" class="btn btn-blue">Apply</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="row">
              <form action="{{ route('company.search') }}">
                @csrf
                <div class="col-12">
                  <input  type="text" name="searchCompany" id="searchCompany"
                          class="searchBar bg-white border-5 text-dark fw-normal col-md-9 col-8"
                          placeholder="Search by Company..." onkeyup="searchCompany()" autocomplete="off"  />
                  <button type="submit" class="btn btn-blue">Apply</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END SEARCH BARS -->

    <!-- START PERSON SHORT DETAILS -->
    <section class="section-person-details user-div mt-4 px-0 pb-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card u-box-shadow-1">
              <div class="card-body">
                <h1 class="card-title">{{ $data->person_name }}</h1>
                <h2 class="card-text">
                  {{ $data->person_title}}  at
                  <a href="{{ route('user-company', ['id' => $data->id, 'name'=> $data->person_name]) }}" style="color: #2495eb"
                  >{{ $data->organization_name }}</a
                  >
                </h2>
              </div>

              <div class="card-footer">
                <div class="nav">
                  <ul class="d-flex flex-row">
                    <li class="nav-item active">
                      <a href="#professionalContact" class="nav-link">
                        Professional Contact
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#companyDetails" class="nav-link">
                        Company Details
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END PERSON SHORT DETAILS -->

    <div class="container">
      <div class="row">
        <div class="col-lg-8 my-5">
          <!-- START PERSON Professional Contact Details -->
          <section
                  class="section-contact user-details-div"
                  id="professionalContact"
          >
            <div class="card user-details-div__card u-box-shadow-1">
              <h3 class="card-title">
                {{ $data->person_name }}''s Professional Contact Details
              </h3>
              <div class="card-body">
                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-envelope-fill"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-5 col-sm-6 mb-2"
                    >
                      <span>Email (Verified)</span>
                      <a href="#"> s**@seoexparte.com </a>
                    </div>


                    <button
                            type="button"
                            class="contact-details--btn btn btn-grad col-lg-4 col-md-3 col-sm-5 col-8"
                    >
                      Get Email Address
                    </button>
                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-telephone-fill"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-5 col-sm-6 mb-2"
                    >
                      <span>Mobile Number</span>
                      <a href="#"> (XXX) XXX-XXXX</a>
                    </div>

                    <button
                            type="button"
                            class="contact-details--btn btn btn-grad col-lg-4 col-md-3 col-sm-5 col-8"
                    >
                      Get Mobile Number
                    </button>
                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-telephone-fill"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>HQ</span>
                      <p style="color: #5d6a7e">
                        @if(!empty( $data->organization_phone ))
                          {{ $data->organization_phone}}
                        @else
                          N/A
                        @endif


                      </p>
                    </div>

                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-linkedin"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>LinkedIn Profile</span>
                      <a href="{{ $data->person_linkedin_url}}">
                        @if(!empty( $data->person_linkedin_url))
                          {{ $data->person_linkedin_url}}
                        @else
                          N/A
                        @endif

                      </a>
                    </div>

                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-pin-map-fill"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>City</span>
                      <p style="color: #5d6a7e">
                        @if(!empty( $data->person_location_city))
                          {{ $data->person_location_city}}
                        @else
                          N/A
                      @endif
                    </div>

                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-map-fill"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>State</span>
                      <p style="color: #5d6a7e">
                        @if(!empty( $data->person_location_state))
                          {{ $data->person_location_state}}
                        @else
                          N/A
                        @endif
                      </p>
                    </div>

                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-globe2"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>Country</span>
                      <p style="color: #5d6a7e">
                        @if(!empty( $data->person_location_country))
                          {{ $data->person_location_country}}
                        @else
                          N/A
                        @endif
                      </p>
                    </div>

                    <div class="col-lg-3"></div>
                  </div>
                </div>

                <div class="contact-details__box row mt-5">
                  <div
                          class="contact-details--icon col-lg-1 col-md-1 col-sm-2 col-2"
                  >
                    <div class="circle-element">
                      <i class="bi bi-building"></i>
                    </div>
                  </div>

                  <div
                          class="contact-details--content row col-md-10 col-sm-6 col-9 ps-md-5 ps-4"
                  >
                    <div
                            class="contact-details--text col-lg-5 col-md-7 col-sm-6 mb-2"
                    >
                      <span>Company</span>
                      <a href="{{ route('user-company', ['id' => $data->id, 'name'=> $data->person_name]) }}">
                        @if(!empty( $data->organization_name))
                          {{ $data->organization_name}}
                        @else
                          N/A
                        @endif
                      </a>
                    </div>

                    <div class="col-lg-3 col-md-3"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- END PERSON Professional Contact Details -->

          <!-- START PERSON Current Company Details -->
          <section
                  class="section-company user-details-div mt-5"
                  id="companyDetails"
          >
            <div class="card user-details-div__card u-box-shadow-1">
              <h3 class="card-title">
                @if(!empty( $data->person_name))
                  {{ $data->person_name}}
                @else
                  N/A
                @endif
                's Current Company Details
              </h3>

              <div class="card-body">
                <div class="company-details__box">
                  <div class="company-details--title-box py-5">
                    <img
                            class="company-logo"
                            src="../assets/images/companyLogo--01.png"
                            alt="logo"
                    />

                    <div
                            class="company-title--box d-flex flex-column align-items-start"
                    >
                      <h4 class="company-title">{{ $data->organization_name}}</h4>

                      <span class="company-subtitle"
                      >  @if(!empty( $data->organization_hq_location_city))
                          {{ $data->organization_hq_location_city}}
                        @else
                          N/A
                        @endif,  @if(!empty( $data->organization_hq_location_country))
                          {{ $data->organization_hq_location_country}}
                        @else
                          N/A
                        @endif.
                          <span> @if(!empty( $data->organization_num_current_employees))
                              {{ $data->organization_num_current_employees}}
                            @else
                              N/A
                            @endif</span>
                        </span>
                      <span class="company-industry">@if(!empty( $data->organization_industries))
                          {{ $data->organization_industries}}
                        @else
                          N/A
                        @endif</span>
                      <div class="company-social-links">
                        <a href="{{ $data->organization_website_url}}">
                          <i class="bi bi-globe"></i>
                        </a>
                        <a href="{{ $data->organization_linkedin_numerical_urls}}">
                          <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="{{ $data->organization_twitter_url}}">
                          <i class="bi bi-twitter"></i>
                        </a>
                        <a href="{{ $data->organization_facebook_url}}">
                          <i class="bi bi-facebook"></i>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="company-details--content mb-5">
                    <p>
                      Our company, the Latest Mailing Database Digital
                      Marketing Services is the most trusted website upon the
                      internet businesses. We are the largest data source
                      provider that our lead generation experts collected and
                      researched the data to over 200 websites with
                      permission-based. Therefore, our database is more
                      authentic and reliable than the other data service
                      provider. Furthermore, we started the business since
                      year 2012, with physical office that located in Bacolod
                      City, Negros Occidental, Philippines with an offshore
                      Virtual Officers in Bangladesh. As we operate with
                      complete License documents so we can run legally to
                      assure the clients that our business is safe
                      <span id="dots">...</span>
                      <span id="more">
                          and secure. Moreover, our team is determined to follow
                          all the anti-spam rules to provide high-quality
                          service to help the client promote their online
                          business more effectively. We deliver our products and
                          services with confidence. By providing the smarter
                          data solutions to help businesses reach their goals.
                          Wherefore, our team for customer support closely
                          assists the client to help their marketing department
                          on how to promote their products and services to their
                          target leads. As, we implement our company’s mission
                          to convert the specific leads into a potential
                          customer. In conclusion, we built trust. We nurture
                          our customers by giving them excellent services to
                          make them satisfied and grateful. We are helping the
                          client’s business remain on top of the online market.
                          We built a good relationship with the customers to
                          make them our regular clients as they also trusted our
                          company.
                        </span>
                    </p>
                    <button onclick="readMore()" id="seeMoreBtn">
                      See more
                    </button>
                  </div>

                  <div class="btn btn-light company-tag">
                    {{ $data->organization_industries}}
                  </div>

                  <div class="row">
                    <div class="col-lg-8 col-md-10">
                      <a
                              class="company-details--btn btn"
                              href="{{ route('user-company', ['id' => $data->id, 'name'=> $data->person_name]) }}"
                      >Discover More About {{ $data->organization_name}}</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- END PERSON Current Company Details -->

          <!-- START PERSON Frequently Asked Questions -->
          <section class="section-faq user-details-div mt-5 mb-lg-4">
            <div class="card user-details-div__card u-box-shadow-1">
              <h3 class="card-title">
                Frequently Asked Questions about {{ $data->person_name}}
              </h3>

              <div class="card-body">
                <div class="faq" id="faq">
                  <!-- FAQ 01 -->
                  <div class="faq-item my-4">
                    <h2 class="faq-header" id="headingOne">
                      <button
                              class="faq-button"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#collapseOne"
                              aria-expanded="true"
                              aria-controls="collapseOne"
                      >
                        <i class="bi bi-caret-down-square-fill"></i>
                        <span>
                            What company does {{ $data->person_name}} work for?
                          </span>
                      </button>
                    </h2>
                    <div
                            id="collapseOne"
                            class="faq-collapse collapse"
                            aria-labelledby="headingOne"
                            data-bs-parent="#faq"
                    >
                      <div class="faq-body">
                        {{ $data->person_name}} works {{ $data->organization_industries}}.
                      </div>
                    </div>
                  </div>

                  <!-- FAQ 02 -->
                  <div class="faq-item my-4">
                    <h2 class="faq-header" id="headingTwo">
                      <button
                              class="faq-button"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#collapseTwo"
                              aria-expanded="true"
                              aria-controls="collapseTwo"
                      >
                        <i class="bi bi-caret-down-square-fill"></i>

                        <span>What is {{ $data->person_name}}'s email address? </span>
                      </button>
                    </h2>
                    <div
                            id="collapseTwo"
                            class="faq-collapse collapse"
                            aria-labelledby="headingTwo"
                            data-bs-parent="#faq"
                    >
                      <div class="faq-body">
                        {{ $data->person_name}}'s email address is  {{ $data->person_email}}.
                      </div>
                    </div>
                  </div>

                  <!-- FAQ 03 -->
                  <div class="faq-item my-4">
                    <h2 class="faq-header" id="headingThree">
                      <button
                              class="faq-button"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#collapseThree"
                              aria-expanded="true"
                              aria-controls="collapseThree"
                      >
                        <i class="bi bi-caret-down-square-fill"></i>
                        <span>
                            What {{ $data->person_name}}'s business email address?
                          </span>
                      </button>
                    </h2>
                    <div
                            id="collapseThree"
                            class="faq-collapse collapse"
                            aria-labelledby="headingThree"
                            data-bs-parent="#faq"
                    >
                      <div class="faq-body">
                        {{ $data->person_name}}'s business email address is
                        {{ $data->person_email}}.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- END PERSON Current Company Details -->
        </div>

        <div class="col-lg-4">
          <!-- START PERSON Colleagues Details -->
          <section
                  class="section-colleagues user-details-div ms-lg-4 mt-lg-5 mt-0 mb-lg-0 mb-5"
          >
            <div class="card user-details-div__card u-box-shadow-1">
              <h3 class="card-title mb-2">
                Colleagues at
                <a href="{{ route('user-company', ['id' => $data->id, 'name'=> $data->person_name]) }}">{{ $data->organization_name }}</a>
              </h3>

              <div class="card-body p-0">
                @foreach($userData->take(4) as $userFetchData)
                  <div class="colleagues-details__box pt-5">
                    <a class="colleagues-details--name" href="{{ route('user', ['id' => $userFetchData->id, 'name'=>$userFetchData->person_first_name_unanalyzed."-".$userFetchData->person_last_name_unanalyzed ]) }}"
                    >{{ $userFetchData->person_name}}</a
                    >
                    <p class="colleagues-details--job">
                      <!-- foreach($userFetchData AS $organization_name){
                       $searuser = $userFetchData->organization_name;
                       return $searuser;
                        -->

                      @if(!empty( $userFetchData-> organization_name))
                        {{ $userFetchData-> organization_name}}
                      @else

                        N/A
                      @endif

                    </p>
                    <div class="colleagues-details--contact">
                      <a
                              class="colleagues-details--contact-phone"
                              href="{{ route('packages') }}"
                      >
                        <i class="bi bi-telephone-fill"></i>Phone
                      </a>
                      <a
                              class="colleagues-details--contact-email ms-5"
                              href="{{ route('packages') }}"
                      >
                        <i class="bi bi-envelope-fill"></i>Email
                      </a>
                    </div>
                  </div>


                @endforeach
              </div>
            </div>
          </section>
          <!-- END PERSON Colleagues Details -->
        </div>
      </div>
    </div>






    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>

    <script type="text/javascript">
      let route = "{{ url('/autocomplete-search') }}";
      $('#searchPeopleName').typeahead({
        source: function (query, process) {
          return $.get(route, {
            query: query
          }, function (data) {
            return process(data);
          });
        }
      });
    </script>
    <script type="text/javascript">
      let route_user_company = "{{ url('/autocomplete-company-search') }}";
      $('#searchCompany').typeahead({
        source: function (term, process) {
          return $.get(route_user_company, {
            term: term
          }, function (data) {
            return process(data);
          });
        }
      });
    </script>

  @endsection


<script>
    function handleName(e){
        if(e.key === "Enter"){
            //alert("Enter was just pressed.");
        }

        return false;
    }
</script>


