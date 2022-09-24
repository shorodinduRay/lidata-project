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
            <span class="navbar-toggler-icon"> </span>
          </button>



        <div
            class="collapse navbar-collapse justify-content-between"
            id="navbarSupportedContent"
          >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item pl-4">
                <a class="nav-link active" aria-current="page" href="{{ route('loggedInUser') }}">
                  <i class="bi bi-house-door"></i>
                  Dashboard
                </a>
              </li>
              <li class="nav-item d-none d-md-block" id="search">
                <a class="nav-link nav-link__search" href="{{ route('people') }}">
                  <i class="bi bi-search"></i>
                  Data Search
                </a>

                <!-- Show element on hover  -->
                <div class="search__details">
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
                <!-- End Show element on hover  -->
              </li>
              <li class="nav-item d-md-none d-lg-none">
                <a class="nav-link" href="{{ route('people') }}">
                  <i class="bi bi-send"></i>
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
                  <i class="bi bi-box-seam"></i>
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
