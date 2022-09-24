
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="description" content="" />
    <meta
        name="keywords"
        content="phone number list, mobile number list, sales leads, mobile leads, data prospect, sales crm, contact database, contact details"
    />

    <title>Sign Up | Phone List</title>

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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}adminAsset/assets/css/style.css" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />
</head>

<body>
<header></header>
<main class="d-flex">
    <!-- START SIGNUP LEFT SIDE -->
    <section class="section-signup--left">
        <div class="signup-text-box row">
            <a class="col-12 company-logo" href="index.html">
                <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name.svg" alt="logo" />
            </a>
            <div class="col-12">
                <a type="button" class="btn btn-home pt-3" href="index.html">
                    Back to the homepage
                </a>
            </div>
        </div>

        <!-- START BACKGROUND ANIMATION -->
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
        <!-- END BACKGROUND ANIMATION -->
    </section>
    <!-- END SIGNUP LEFT SIDE -->

    <!-- START SIGNUP RIGHT SIDE -->
    <section class="section-signup--right d-flex flex-column">


        <!-- START SIGNUP FORM -->
        <div class="signup-form">
            <div class="card border-0 u-box-shadow-1 rounded-3">
                <div class="card-body p-5 pb-3">
                    <div class="card-title">
                        <div class="col-12 company-logo">
                            <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name.svg" alt="logo" />
                        </div>
                        <div>
                            <h1 class="pt-2 pb-3">Let's Get Started</h1>
                        </div>
                    </div>

                    <form action="{{ route('add.new.user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input
                                    hidden
                                    type="text"
                                    class="form-control u-box-shadow-2"
                                    id="fb_id"
                                    name="fb_id"
                            />
                            <label for="email" class="form-label">Email</label>
                            <input
                                   type="email"
                                   class="form-control u-box-shadow-2"
                                   id="email"
                                   placeholder="Enter Your Email"
                                   required
                                   value="{{ $newUserData }}"
                                   name="email"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="psw" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control u-box-shadow-2"
                                id="psw"
                                placeholder="Enter Your Password"
                                required
                                name="password"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                                   type="text"
                                   class="form-control u-box-shadow-2"
                                   id="fname"
                                   placeholder="Enter Your First Name"
                                   required
                                   value=""
                                   name="firstName"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input
                                   type="text"
                                   class="form-control u-box-shadow-2"
                                   id="lname"
                                   placeholder="Enter Your Last Name"
                                   required
                                   value=""
                                   name="lastName"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="number" class="form-label">Phone Number</label>
                            <input
                                type="tel"
                                class="form-control u-box-shadow-2"
                                id="number"
                                placeholder="Enter Your Phone Number"
                                required
                                name="phone"
                            />
                        </div>
                        <div class="mb-4">
                            <label for="country" class="form-label">Country</label>

                            <select
                                id="country"
                                name="country"
                                class="form-control form-control--option"
                                required
                            >
                                <option disabled selected>Select Country</option>
                                @foreach($countries as $countryName)
                                    <option value="{{ $countryName->countryname }}">{{ $countryName->countryname }} ({{ $countryName->countrycode }})</option>
                                @endforeach
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-grad rounded-3 u-box-shadow-2 mt-5 mb-4 px-5 mx-auto"
                        >
                            Try It Now
                        </button>

                        <div class="card-footer">
                            <p>
                                Already have an account?
                                <a href="{{ route('user.login') }}">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END SIGNUP FORM -->
    </section>
    <!-- END SIGNUP RIGHT SIDE -->
</main>

<!-- Custom JS -->
<script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
></script>
</body>
</html>
