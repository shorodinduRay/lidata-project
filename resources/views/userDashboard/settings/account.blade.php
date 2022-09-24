@extends('userDashboard.settings.master')

@section('title.title')
  You | Li Data
@endsection

@section('main')
  <section class="section-main">
    <div class="card u-box-shadow-2 m-4 border rounded-3">
      <div class="card-title d-flex align-items-center justify-content-between">
        <h1 class="p-4 text-capitalize">Account Info</h1>
        <button type="button" class="btn btn-blue me-3" onclick="saveFunction()">Save</button>
      </div>
      <div class="card-body p-4">
        <div class="row">
          <div class="col-md-4">
            <input hidden type="text" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}"/>
            <form action="{{ route('updateUserFirstName', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ Auth::user()->firstName }}" onkeypress="handleFirstName" />
              </div>
            </form>
          </div>
          <div class="col-md-4">
            <form action="{{ route('updateUserLastName', ['id' => Auth::user()->id]) }}"  method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ Auth::user()->lastName }}" onkeypress="handleLastName"/>
              </div>
            </form>
          </div>
          <div class="col-md-4">
            <form action="{{ route('updateUserTitle') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" @if(Auth::user()->title ) value="{{ Auth::user()->title }}"  @endif onkeypress="handleAddress"/>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <form action="{{ route('updateUserPhone', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="number" class="form-label"
                >Phone Number</label
                >
                <input type="number" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" onkeypress="handlePhone"/>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <form action="{{ route('updateUserAddress') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" @if(Auth::user()->address ) value="{{ Auth::user()->address }}"  @endif onkeypress="handleAddress"/>
              </div>
            </form>
          </div>
          <div class="col-md-2">
            <form action="{{ route('updateUserCountry', ['id' => Auth::user()->id]) }}" id="personalInfo" method="get" enctype="multipart/form-data">
              @csrf
              <label for="country" class="form-label">Country</label>
              <div class="dropdown" id="country">
                <input
                        class="searchBar bg-white text-dark fw-normal col-12"
                        id="countryInput"
                        type="text"
                        placeholder="{{ Auth::user()->country }}"
                        data-toggle="dropdown"
                        data-bs-toggle="dropdown"
                        name="country"
                />

                <span class="caret"></span>

                <ul
                        class="dropdown-menu bg-white text-dark fw-bold p-3"
                        aria-labelledby="countryDropdown"
                >
                  @foreach($countries as $country)
                    <button class="dropdown-item" id="countryBtn{{ $country->id }}"
                            type="submit" onclick="getCountryName({{ $country->id }})"
                            value="{{ $country->countryname }}" >{{ $country->countryname }}
                      ({{ $country->countrycode }})
                  @endforeach

                </ul>
              </div>
            </form>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <span class="form-span d-block" id="email"
                >{{ Auth::user()->email }}</span
                >
              </div>
            </div>
            <div class="col-md-4 d-flex align-items-center">
              <button
                      type="button"
                      class="btn btn-change mt-3"
                      data-bs-toggle="modal"
                      data-bs-target="#changeEmail"
              >
                <i class="bi bi-shield-lock"></i>
                Change Email
              </button>

              <!-- Modal -->
              <div
                      class="modal fade"
                      id="changeEmail"
                      tabindex="-1"
                      aria-labelledby="changeEmail"
                      aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="changeEmail">
                        Change Email
                      </h3>
                      <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                      ></button>
                    </div>
                    <form action="{{ route('updateUserEmail', ['id' => Auth::user()->id]) }}" id="personalInfo" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="" class="form-label"
                          >New Email:</label
                          >
                          <input type="email" class="form-control" name="email" required autofocus />
                          @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          Change Email
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @if($message = Session::get('message'))
            <div class="row mb-4">
              <div class="col-md-12">
                  <span class="text-danger">
                      <i class="bi bi-hourglass"></i>
                      {{ $message }}
                  </span>
              </div>
            </div>
          @elseif(isset($messages))
            <div class="row mb-4">
              <div class="col-md-12">
                  <span class="text-danger">
                      <i class="bi bi-hourglass"></i>
                      {{ $messages }}
                  </span>
              </div>
            </div>
          @endif

          <div class="row">
            <div class="col-md-12">
              <label for="password" class="form-label">Password</label>
            </div>
            <div class="col-md-4 d-flex align-items-center">
              <form action="{{ route('forget.password.post') }}" method="POST">
                @csrf
                <button
                  type="submit"
                  class="btn btn-change"
                >
                  <i class="bi bi-shield-lock"></i>
                  Change Password
                </button>
                <div class="mb-5">
                  <input
                      hidden
                      type="email"
                      value="{{ Auth::user()->email }}"
                      name="email"
                  />
                </div>
              </form>

              <!-- Modal -->
              <div
                      class="modal fade"
                      id="changePassword"
                      tabindex="-1"
                      aria-labelledby="changePassword"
                      aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="changePassword">
                        Change Password
                      </h3>
                      <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                      ></button>
                    </div>
                    <form action="{{ route('updateUserPassword', ['id' => Auth::user()->id]) }}"  method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="" class="form-label"
                          >New Password:</label
                          >
                          <input type="password" class="form-control" name="password" />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          Change Password
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--</form>--}}

    </div>
    </div>
  </section>


  <script>

    function handleFirstName(e){
      if(e.key === "Enter"){
        alert("Enter was just pressed.");
      }

      return false;
    }
    function handleLastName(e){
      if(e.key === "Enter"){
        alert("Enter was just pressed.");
      }

      return false;
    }
    function handlePhone(e){
      if(e.key === "Enter"){
        alert("Enter was just pressed.");
      }

      return false;
    }
    function handleCountry(e){
      if(e.key === "Enter"){
        alert("Enter was just pressed.");
      }

      return false;
    }
    function saveFunction(){
      var arr = new Array();
      arr ['id'] = document.getElementById("id").value;
      arr [1] = document.getElementById("firstName").value;
      arr [2] = document.getElementById("lastName").value;
      arr [3] = document.getElementById("title").value;
      arr [4] = document.getElementById("phone").value;
      arr [5] = document.getElementById("address").value;
      //alert(arr);
      let url = "{{ route('updateUserInfo', ':arr') }}";
      url = url.replace(':arr', arr);
      document.location.href=url;
    }



  </script>


  <script type="text/javascript">

    function getCountryName(id)
    {
      let countryInput = document.getElementById('countryInput');
      countryInput.value = document.querySelector('#countryBtn'+id).value;
    }

  </script>

@endsection
