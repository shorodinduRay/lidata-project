<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta
            name="description"
            content="Displaying all data related to people from Li Data's Database"
    />
    <meta name="keywords" content="li data," />


    <title>Companies | Li Data</title>

    <!-- Bootstrap CSS -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />

    <!-- Bootstrap Icons -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
            rel="stylesheet"
    />

    <!-- Animate CSS -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}adminAsset/assets/css/style.css" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />

</head>

<body>
    <!-- START PRELOADER -->
    <section class="section-preloader">
        <div class="preloader" id="preloaders">
        <div class="preloader__square"></div>
        <div class="preloader__square"></div>
        <div class="preloader__square"></div>
        <div class="preloader__square"></div>
        </div>
    </section>
    <!-- END PRELOADER -->
    <section class="section-content d-none">
        <header>
            <!-- START NAVBAR -->
            <nav
                    class="navbar navbar--user navbar-expand-md navbar-light"
                    id="user-nav"
            >
                <div class="container-fluid justify-content-end">
                    <a class="navbar-brand" href="{{ route('/') }}">
                        <img
                                class="img-fluid"
                                src="{{ asset('/') }}adminAsset/assets/images/logo.svg"
                                alt="li data"
                        />
                    </a>

                    <button
                            class="navbar-toggler me-auto"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
                        <i class="bi bi-list"></i>
                    </button>



                    <div
                            class="collapse navbar-collapse justify-content-between"
                            id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item pl-4">
                                <a class="nav-link" aria-current="page" href="{{ route('loggedInUser') }}">
                                    <i class="bi bi-house-door"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block" id="search">
                                <a class="nav-link nav-link__search active" href="{{ route('company') }}">
                                    <i class="bi bi-search"></i>
                                    Data Search
                                </a>



                                <!-- Show element on hover  -->
                                <div class="search__details hide">
                                    <a href="{{ route('people') }}">
                                        <div class="search__details--left d-flex">
                                            <div class="search__details--icon-box">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="search__details--text">
                                                <div
                                                        class="fw-bold heading--sub d-flex justify-content-between"
                                                >
                                                    People
                                                    <i class="bi bi-arrow-right animate-arrow"></i>
                                                </div>
                                                <p>
                                                    Search for hyper-targeted lists of people using
                                                    filters.
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('company') }}">
                                        <div class="search__details--right d-flex">
                                            <div class="search__details--icon-box">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div class="search__details--text">
                                                <div
                                                        class="fw-bold heading--sub d-flex justify-content-between"
                                                >
                                                    Companies
                                                    <i class="bi bi-arrow-right animate-arrow"></i>
                                                </div>
                                                <p>
                                                    Search for targeted lists of companies using filters.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item d-md-none d-lg-none">
                                <a class="nav-link" href="{{ route('people') }}">
                                    <i class="bi bi-send px-2"></i>
                                    People
                                </a>
                            </li>
                            <li class="nav-item d-md-none d-lg-none">
                                <a class="nav-link" href="{{ route('company') }}">
                                    <i class="bi bi-building px-2"></i>
                                    Companies
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('upgrade') }}">
                                    <i class="bi bi-box-seam px-2"></i>
                                    Products
                                </a>
                            </li>
                        </ul>
                    </div>




                    <!-- update lidata code last -->




                    <!-- START SHOW ELEMENT ON CLICKING USER -->
                    <div class="user-div hide u-box-shadow-1">
                        <h4 class="px-4 pt-5"></h4>
                        <div class="user--label mx-4">
                            <span>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                        </div>

                        <div class="user--menu">
                            <a class="user--menu-item" href="{{ route('account') }}">
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                            <a class="user--menu-item" href="{{ route('upgrade') }}">
                                <i class="bi bi-trophy"></i>
                                <span>Upgrade Plan</span>
                            </a>

                            <a class="user--menu-item mb-3" href="{{ route('userLogout') }}">
                                <i class="bi bi-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                    <!-- END SHOW ELEMENT ON CLICKING USER -->
                </div>

                <!-- START RIGHT NAV ITEMS -->
                <div class="d-flex align-items-center nav-right__box">
                    <a class="btn btn-blue mx-4" href="{{ route('upgrade') }}"
                    >Get unlimited leads
                    </a>
                    <button type="button" class="btn">
                        <a href="#">
                            <i class="bi bi-telephone phone-btn"></i>
                        </a>
                    </button>

                    <!-- Link to Blog site -->
                    <a class="btn" href="http://help.phonelist.io/">
                        <i class="bi bi-question-circle"></i>
                    </a>

                    <button type="button" class="btn notification-btn">
                        <i class="bi bi-bell"></i>
                    </button>
                    <button
                            type="button"
                            id="userBtn"
                            class="user user-btn circle-element mx-3"
                    >

                        <p class="user-name">{{ $firstStringCharacter = substr(Auth::user()->firstName, 0, 1) }}{{ $firstStringCharacter = substr(Auth::user()->lastName, 0, 1) }}</p>
                    </button>
                </div>
                <!-- END RIGHT NAV ITEMS -->
            </nav>
            <!-- END NAVBAR -->

            <!-- START SECOND NAVBAR -->
            <div class="navbar02 u-border-bottom">
                <a href="{{ route('people') }}">
                    <div class="navbar02--left">
                        <h2 class="nav-item fs-4">
                            <i class="bi bi-people pe-2"></i>
                            People
                        </h2>
                    </div>
                </a>

                <a href="{{ route('company') }}">
                    <div class="navbar02--right">
                        <h2 class="nav-item nav-item--colored fs-4">
                            <i class="bi bi-building pe-2"></i>
                            Companies
                        </h2>
                    </div>
                </a>
            </div>
            <!-- END SECOND NAVBAR -->

            <!-- FIXME hide when clicked somewhere else -->
            <!-- START SHOW WHEN CLICKED ON PHONE -->
            <div class="u-box-shadow-1 phone-call__div hide">
                <div class="phone-call--icon">
                    <i class="bi bi-telephone-outbound text-primary"></i>
                </div>
                <div class="phone-call--text">
                    Instantly click-to-call prospects from anywhere.
                </div>
                <div class="phone-call--button btn-blue">Upgrade to Professional</div>
                <a class="phone-call--link"> Learn more </a>
            </div>
            <!-- END SHOW WHEN CLICKED ON PHONE -->

            <!-- START SHOW WHEN CLICKED ON NOTIFICATION -->
            <div
                    class="u-box-shadow-1 notification__sidebar hide animate__animated animate__fadeInRightBig"
            >
                <div class="notification--header">
                    <div class="notification--header-title">
                        <h5>NOTIFICATIONS</h5>
                    </div>
                    <div class="notification--header-icons">
                        <div class="btn"><i class="bi bi-arrow-clockwise"></i></div>
                        <div class="btn close-btn">
                            <i class="bi bi-x-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="notification--body"></div>
            </div>
            <!-- END SHOW WHEN CLICKED ON NOTIFICATION -->

            <!-- START SHOW WHEN CLICKED ON NOTIFICATION -->
            <!-- <div
                class="u-box-shadow-1 notification__sidebar hide animate__animated animate__fadeInRightBig"
            >
                <div class="notification--header">
                    <div class="notification--header-title">
                        <h5>NOTIFICATIONS</h5>
                    </div>
                    <div class="notification--header-icons">
                        <div class="btn"><i class="bi bi-arrow-clockwise"></i></div>
                        <div class="btn close-btn">
                            <i class="bi bi-x-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="notification--body"></div>
            </div> -->
            <!-- END SHOW WHEN CLICKED ON NOTIFICATION -->

        </header>

        <main id="companyData">
            <section class="section-user-dashboard">
                <!-- START SIDEBAR -->
                <section class="section-user-dashboard--sidebar">
                    <div class="heading--sub py-3 ps-4 u-border-bottom">Filters</div>
                    {{-- <form id="search" action="{{ route('company.name.search') }}">
                        <div class="search-bar py-3 ps-4 u-border-bottom">
                            @if(isset($countries))
                                <input
                                    type="text"
                                    id='searchPeopleFromPhoneList'
                                    name="name"
                                    class="bg-transparent"
                                    onkeypress="handle()"
                                    placeholder="Search Companies..."
                                    autocomplete="off"
                                    value="{{ $countries }}"
                                />
                            @else
                                <input
                                    type="text"
                                    id='searchPeopleFromPhoneList'
                                    name="name"
                                    class="bg-transparent"
                                    onkeypress="handle()"
                                    placeholder="Search Companies..."
                                    autocomplete="off"
                                />
                            @endif
                        </div>
                    </form> --}}
                    <form id="search" action="{{ route('company.search.combination') }}">
                        <!-- INPUT COMPANY NAME -->
                        <div class="input-company u-border-bottom py-4 px-4">
                            <div class="input-title pb-2">
                                <i class="bi bi-building pe-2"></i>
                                Company
                            </div>
                            @if(isset($company))
                                <input
                                        type="text"
                                        name="company"
                                        id="company"
                                        placeholder="Enter companies..."
                                        onkeypress="handle()"
                                        autocomplete="off"
                                        value="{{ $company }}"
                                />
                            @else
                                <input
                                        type="text"
                                        name="company"
                                        id="company"
                                        placeholder="Enter companies..."
                                        onkeypress="handle()"
                                        autocomplete="off"
                                />
                            @endif
                            <button type="submit" class="btn btn-blue rounded-1 w-100 submitBtn">
                                Apply
                            </button>
                        </div>

                        <!-- INPUT CITY -->
                        <div class="input-city u-border-bottom py-4 px-4">
                            <div class="input-title pb-2">
                                <i class="bi bi-pin-map-fill"></i>
                                City
                            </div>
                            @if(isset($city))
                                <input
                                        type="text"
                                        name="city"
                                        id="city"
                                        placeholder="Enter city"
                                        onkeypress="handle()"
                                        autocomplete="off"
                                        value="{{ $city }}"
                                />
                            @else
                                <input
                                        type="text"
                                        name="city"
                                        id="city"
                                        placeholder="Enter city"
                                        onkeypress="handle()"
                                        autocomplete="off"
                                />
                            @endif
                            <button type="submit" class="btn btn-blue rounded-1 w-100 submitBtn">
                                Apply
                            </button>
                        </div>

                        <!-- INPUT STATE -->
                        <div class="input-state u-border-bottom py-4 px-4">
                            <div class="input-title pb-2">
                                <i class="bi bi-map-fill"></i>
                                State
                            </div>
                            @if(isset($state))
                                <input
                                        type="text"
                                        name="state"
                                        id="state"
                                        placeholder="Enter state"
                                        onkeypress="handle()"
                                        autocomplete="off"
                                        value="{{ $state }}"
                                />
                            @else
                                <input
                                        type="text"
                                        name="state"
                                        id="state"
                                        placeholder="Enter state"
                                        onkeypress="handle()"
                                        autocomplete="off"
                                />
                            @endif
                            <button type="submit" class="btn btn-blue rounded-1 w-100 submitBtn">
                                Apply
                            </button>
                        </div>
                        <!-- INPUT COUNTRY -->
                        <div class="input-country u-border-bottom py-4 px-4">
                            <div class="input-title pb-2">
                                <i class="bi bi-globe2 pe-2"></i>
                                Country
                            </div>
                            <div class="dropdown" id="searchCountry">
                                @if (isset($countries))
                                    <input
                                            class="searchBar col-12"
                                            id="countryInput"
                                            type="text"
                                            name="country"
                                            placeholder="Search by Country..."
                                            data-toggle="dropdown"
                                            data-bs-toggle="dropdown"
                                            autocomplete="off"
                                            value="{{ $countries }}"
                                    />
                                @else ()
                                    <input
                                            class="searchBar col-12"
                                            id="countryInput"
                                            type="text"
                                            name="country"
                                            placeholder="Search by Country..."
                                            data-toggle="dropdown"
                                            data-bs-toggle="dropdown"
                                            autocomplete="off"
                                    />


                                @endif
                                <span class="caret"></span>

                                <ul class="dropdown-menu p-3" aria-labelledby="countryDropdown">
                                    @foreach($country as $countryName)
                                        <button  class="dropdown-item submitBtn" id="countryBtn{{ $countryName->id }}"
                                                type="submit" onclick="getCountryName({{ $countryName->id }})"
                                                value="{{ $countryName->countryname }}" >{{ $countryName->countryname }}
                                            ({{ $countryName->countrycode }})
                                        </button>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- INPUT INDUSTRY NAME -->
                        <div class="input-industry py-4 px-4">
                            <div class="input-title pb-2">
                                <i class="bi bi-tools pe-2"></i>
                                Industry
                            </div>
                            @if(isset($industry))
                                <input
                                        type="text"
                                        name="industry"
                                        id="industry"
                                        placeholder="Search industries..."
                                        onkeypress="handle()"
                                        autocomplete="off"
                                        value="{{ $industry }}"
                                />
                            @else
                                <input
                                        type="text"
                                        name="industry"
                                        id="industry"
                                        placeholder="Search industries..."
                                        onkeypress="handle()"
                                />
                            @endif
                            <button type="submit" class="btn btn-blue rounded-1 w-100 submitBtn">
                                Apply
                            </button>
                        </div>
                    </form>
                </section>
                <!-- END SIDEBAR -->

                <!-- START MAIN DASHBOARD -->
                    <section class="section-user-dashboard--main">
                        <div class="container">
                            <div class="row">
                                <!-- START TABLE -->
                                <div
                                        class="section-table table-scrollable mx-5 mb-2"
                                        style="width: 75vw; overflow: auto; max-height: 72vh"
                                >
                                    <div class="container">
                                        <div class="row">
                                            <table
                                                    class="table table-hover table-bordered table-responsive list"
                                                    id="peopleTable"
                                            >
                                            <form action="{{ route('custom.company.export') }}" enctype="multipart/form-data" method="get">
                                                @csrf
                                                <thead>
                                                    <tr>
                                                        @if(isset($company) != null || isset($city) != null || isset($state) != null|| isset($countries) != null || isset($industry) != null)
                                                            @if(isset($company))<input type="text"  name="company" value="{{ $company }}" hidden />@endif
                                                            @if (isset($city)) <input type="text"name="city" value="{{ $city }}" hidden />@endif
                                                            @if (isset($state))<input type="text" name="state" value="{{ $state }}" hidden />@endif
                                                            @if(isset($countries)) <input type="text" name="country" value="{{ $countries }}" hidden />@endif
                                                            @if (isset($industry)) <input type="text" name="industry" value="{{ $industry }}" hidden />@endif
                                                            <th class="px-4">
                                                                <input id="checkAll" type="button" class="selectAll" value="Select All"/>
                                                                <div class="dropdown open">
                                                                    <button
                                                                            class="btn btn-blue dropdown-toggle rounded"
                                                                            type="button"
                                                                            id="triggerId"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"
                                                                    >
                                                                        Download Filtered Data
                                                                    </button>
                                                                    <div
                                                                            class="dropdown-menu"
                                                                            aria-labelledby="triggerId"
                                                                    >
                                                                        <button type="submit" class="dropdown-item select">
                                                                            Download All Filtered Data
                                                                        </button>
                                                                        <hr>
                                                                        <span class="dropdown-item select">Download
                                                                        <input name="limit" class="select-input" type="number" />
                                                                        Datas
                                                                        </span>
                                                                        <button class="btn btn-blue mx-auto" type="submit">
                                                                            Apply Download
                                                                        </button>
                                                                    </div>
                                                                </div>  
                                                            </th>
                                                            @else
                                                            <th>
                                                                <input id="checkAll" type="button" class="selectAll" value="Select All"/>
                                                            </th>
                                                        @endif
                                                        <th>Company</th>
                                                        <th>Quick Actions</th>
                                                        <th>Employees</th>
                                                        <th>Industry</th>
                                                        <th>Company Location</th>
                                                    </tr>
                                                    </thead>
                                            </form>
                                            <form action="{{ route('download.company.data') }}" enctype="multipart/form-data" method="get">
                                                @csrf
                                                <tbody>
                                                @foreach ($allData as $data)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="{{$data->id}}" >
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('user', ['id' => $data->id, 'name'=>$data->person_first_name_unanalyzed."-".$data->person_last_name_unanalyzed ]) }}" class="company-name">
                                                                @if(!empty($data->organization_name))
                                                                    {{ $data->organization_name}}
                                                                @else
                                                                    -
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td class="position-relative">
                                                            <button
                                                                    type="button"
                                                                    class="btn btn-access btn-access--phone"
                                                                    id="{{ $data->id }}"
                                                                    onclick="accessPhoneNumber({{ $data->id }})"
                                                            >
                                                                Access Email
                                                            </button>
                                                            <div class="message-box hide-text">
                                                                Verified number costs one credit.
                                                            </div>

                                                            <div class="button-group hide" id="buttonGroup{{ $data->id }}">
                                                                <a
                                                                        class="btn btn-access btn-access--phone"
                                                                        href=""
                                                                >
                                                                    <i class="bi bi-phone"></i>
                                                                    <i class="bi bi-caret-down-fill"></i>
                                                                </a>
                                                                <div
                                                                        class="message-box message-box--phone hide-text"
                                                                        id="messageCompanyPhone{{ $data->id }}"
                                                                >
                                                                </div>

                                                                <a
                                                                        class="btn btn-access btn-access--email"
                                                                        href=""
                                                                >
                                                                    <i class="bi bi-envelope"></i>
                                                                    <i class="bi bi-caret-down-fill"></i>
                                                                </a>

                                                                <div
                                                                        class="message-box message-box--email hide-text"
                                                                        id="messageCompanyEmail{{ $data->id }}"
                                                                >
                                                                    <!-- Email not available -->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if(!empty($data->organization_num_current_employees))
                                                                {{ $data->organization_num_current_employees}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($data->organization_industries))
                                                                {{ $data->organization_industries}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($data->organization_hq_location_city))
                                                                {{ $data->organization_hq_location_city .', '.$data->organization_hq_location_state.','.$data->organization_hq_location_country}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if(isset($message))
                                                <span>{{ $message }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TABLE -->

                        <!-- Download CSV Button -->
                        <div class="container">
                            <div class="row py-4">
                                <div class="col-md-4 text-secondary ps-5">
                                    Filtered records: {{ $count }}
                                </div>
                                <input type="number" hidden name="userId" value="{{ Auth::user()->id }}">
                                <div class="col-md-8 ms-auto d-flex justify-content-end">
                                    <button
                                            type="submit"
                                            id="customCSV"
                                            class="btn btn-download border-3"
                                            disabled="disabled"
                                    >
                                        <i class="bi bi-download"></i>
                                        &nbsp; Download Data CSV
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- START PAGINATION -->
                        <div class="row pb-2">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    @if(isset($company) != null || isset($city) != null || isset($state) != null 
                                        || isset($countries) != null || isset($industry) != null)
                                        <li class="page-item">
                                            <div class="d-sm-inline-flex justify-content-center">
                                                {!! $allData->links() !!}
                                            </div>
                                        </li>                        
                                    @else
                                        <li class="page-item disabled">
                                            <div class="d-sm-inline-flex justify-content-center">
                                                {!! $allData->links() !!}
                                            </div>
                                        </li>                        
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <!-- END PAGINATION -->
                        
                    </section>
                </form>
                <!-- END MAIN DASHBOARD -->
            </section>
        </main>
    </section>

<!-- Bootstrap JS -->
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
></script>

<!-- jQuery -->
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
></script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '#checkAll', function() {

            if ($(this).val() == 'Select All') {
                //$('.button input').prop('checked', true);
                var ele=document.getElementsByName('chk[]');
                for(var i=0; i<ele.length; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=true;
                    }
                    $(this).val('Deselect All');
                    $('.btn-download').prop(
                        'disabled',
                        $('input.form-check-input:checked').length == 0
                    );
            } 
            else {
                //$('.button input').prop('checked', false);
                var ele=document.getElementsByName('chk[]');
                for(var i=0; i<ele.length; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=false;
                    $('.btn-download').prop(
                        'disabled',
                        $('input.form-check-input:checked').length == 0
                    );

                }
                $(this).val('Select All');

            }
        });

    });
</script>
{{--/* Access Phone Number */--}}

<script type="text/javascript">
    let collection,  buttonGroup, messageBox, buttonId;

    messageBox = document.getElementById('message');

    function accessPhoneNumber(id)
    {
        $.ajax({
            url:"{{ route('companyDataHistory') }}",
            method:"POST",
            data:{id:id, _token:"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                collection = document.getElementById(id);
                buttonGroup = document.getElementById('buttonGroup'+id);
                buttonId = document.getElementById(id).value;
                collection.classList.add('hide');
                buttonGroup.classList.remove('hide');
                for (var count = 0; count < data.length; count++) {
                    if (data[count].organization_phone != null)
                        $("#messageCompanyPhone" + id).text(data[count].organization_phone);
                    else
                        $("#messageCompanyPhone" + id).text("N/A");
                    if (data[count].organization_domain != null)
                        $("#messageCompanyEmail" + id).text(data[count].organization_domain);
                    else
                        $("#messageCompanyEmail" + id).text("N/A");
                }
            },
            error: function () {
                window.location.href = "settings/upgrade";
            }
        })

    }

</script>
<script type="text/javascript">
    function getCountryName(id)
    {
        let countryInput = document.getElementById('countryInput');
        countryInput.value = document.querySelector('#countryBtn'+id).value;
    }

</script>
<script>
    $(function () {
        $('.form-check-input').click(function () {
            $('.btn-download').prop(
                'disabled',
                $('input.form-check-input:checked').length == 0
            );
        });
    });
</script>

<!-- Custom JS -->
<script defer src="{{ asset('/') }}adminAsset/assets/js/navbar.min.js"></script>
<script defer src="{{ asset('/') }}adminAsset/assets/js/people.min.js"></script>
<script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

<script>
    function handle(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
</script>


<script>
    $(document).ready(function () {
        $('#countryDropdown').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('.dropdown-menu li').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

<script>
    window.onload = function(){
    //hide the preloader
        document.querySelector(".section-preloader").style.display = "none";
        document.querySelector(".section-content").classList.remove("d-none");
    }
</script>
<script>
    $(document).ready(function () {
        
        $('.submitBtn').on('click', function () {
            document.querySelector(".section-preloader").style.display = "block";
            document.querySelector(".section-content").classList.add("d-none");
        });
    });
</script>

</body>
</html>