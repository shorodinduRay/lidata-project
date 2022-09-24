@extends('user.userMaster')


@section('bodyRight')
    <section class="section-signup--right d-flex flex-column">
        <!-- START SIGNUP FORM -->
        <div class="signup-form">
            <div class="card border-0 u-box-shadow-1 rounded-3">
                <div class="card-body p-5 pb-3">
                    <div class="col-12 company-logo">

                        <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name-dark.svg" alt="logo" />
                    </div>
                    <div class="card-title">

                        <div>
                            <h1>Let's Get Started</h1>
                        </div>
                        <div>
                            <a
                                    type="button"
                                    class="btn btn-google-login u-box-shadow-2"
                                    href="{{ route('/auth/google') }}"
                            >
                                <img
                                        src="{{ asset('/') }}adminAsset/assets/images/icons/google.svg"
                                        alt="google logo"
                                        class="me-2"
                                />
                                Sign up with google
                            </a>
                            <a
                                    type="button"
                                    class="btn btn-facebook-login u-box-shadow-2 mt-4"
                                    href="{{ url('auth/facebook') }}"
                            >
                                <i class="bi bi-facebook me-2"></i>
                                Sign up with facebook
                            </a>
                        </div>
                    </div>

                    <div class="divider mt-4 mb-3">
                        <div class="divider--line me-5"></div>
                        <div>OR</div>
                        <div class="divider--line ms-5"></div>
                    </div>
                    @if($message1 = Session::get('message1'))
                        <div id="error-text">
                            <p class="text-danger">
                                {{ $message1 }}
                            </p>
                        </div>
                    @endif
                    <form action="{{ route('add.new.user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <input
                                    type="text"
                                    hidden
                                    class="form-control u-box-shadow-2"
                                    id="fb_id"
                                    placeholder="Enter Your Email"
                                    required
                                    name="fb_id"
                                    value="{{ $newUserData->id }}"
                            />
                        </div>
                        @if(isset($newUserData->email) != null)
                            <div class="mb-4">
                                <input
                                        type="email"
                                        hidden
                                        class="form-control u-box-shadow-2"
                                        id="email"
                                        placeholder="Enter Your Email"
                                        required
                                        name="email"
                                        value="{{ $newUserData->email }}"
                                />
                            </div>
                        @else
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input
                                        type="email"
                                        class="form-control u-box-shadow-2"
                                        id="email"
                                        placeholder="Enter Your Email"
                                        required
                                        name="email"
                                />
                            </div>
                        @endif
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

                            <input
                                    type="text"
                                    hidden
                                    class="form-control u-box-shadow-2"
                                    id="fname"
                                    placeholder="Enter Your First Name"
                                    required
                                    name="firstName"
                                    value="{{ $firstName }}"
                            />
                        </div>
                        <div class="mb-4">

                            <input
                                    type="text"
                                    hidden
                                    class="form-control u-box-shadow-2"
                                    id="lname"
                                    placeholder="Enter Your Last Name"
                                    required
                                    name="lastName"
                                    value="{{ $lastName }}"
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
@endsection



