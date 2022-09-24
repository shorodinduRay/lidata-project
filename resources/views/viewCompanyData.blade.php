
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
  <meta name="description" content="Displaying All Companies Data from Li Data's Database" />
  <meta name="keywords" content="li data," />

  <title>Total Entries | Li Data</title>

  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet">

  <!-- BOOTSTRAP ICONS     -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- Favicon -->
  <link rel="stylesheet" href="assets/images/icons/favicon.ico">

</head>

<body>

  <section class="section-dashboard">
    <!-- START SIDEBAR -->
    <section class="section-dashboard--sidebar">
      <!-- START MENU -->
      <nav class="menubar">
        <ul class="menu d-flex flex-column">
          <li class="">
            <a href="admin.html" class="navbar-brand">
              <img src="assets/images/logo--company-name.png" alt="logo" />
            </a>
          </li>
          <li class="menu-item ">
            <a href="{{ url('/admin-dashboard') }}">
              <i class="bi bi-collection menu-item--icon "></i>
              <span class="menu-item--text ">
                Dashboard
              </span>
            </a>
          </li>
          <li class="menu-item ">
            <a href="{{ url('lidata') }}">
              <i class="bi bi-people menu-item--icon "></i>
              <span class="menu-item--text ">
                View All People Data
              </span>
            </a>
          </li>
          <li class="menu-item active">
            <a href="{{ url('/') }}">
              <i class="bi bi-briefcase menu-item--icon "></i>
              <span class="menu-item--text ">
                View All Company Data
              </span>
            </a>
          </li>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-person-badge menu-item--icon "></i>
              <span class="menu-item--text ">
                User Details
              </span>
            </a>
          </li>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-box-arrow-in-down menu-item--icon "></i>
              <span class="menu-item--text ">
                User Data Import
              </span>
            </a>
          </li>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-bar-chart menu-item--icon"></i>
              <span class="menu-item--text">
                Order History
              </span>
            </a>
          </li>
          </a>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-currency-bitcoin menu-item--icon"></i>
              <span class="menu-item--text">
                Credit History
              </span>
            </a>
          </li>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-arrow-left-right menu-item--icon"></i>
              <span class="menu-item--text">
                Credit Transfer
              </span>
            </a>
          </li>
          <li class="menu-item">
            <a href="">
              <i class="bi bi-wallet2 menu-item--icon"></i>
              <span class="menu-item--text">
                Payment Settings
              </span>
            </a>
          </li>
          <li class="menu-item menu-item-footer">
            <a href="home.html">
              <i class="bi bi-power menu-item--icon"></i>
              <span class="menu-item--text">
                Logout
              </span>
            </a>
          </li>
          </a>
        </ul>
      </nav>
      <!-- END MENU -->
    </section>
    <!-- END SIDEBAR -->

    <!-- START MAIN BODY -->
    <section class="section-dashboard--main section-viewalldata">
      <div class="container">

        <div class="row mb-4">
          <div class="col-md-4 m-auto">
            <h2 class="fw-light fs-3">Total Entries: <span>202</span> </h3>
          </div>

          <!-- START PEOPLE SEARCHBAR -->
          <div class="offset-md-5 col-md-3 d-flex justify-content-end">
            <input type="text" name="search" id="searchCompany" class="searchBar w-100" onkeyup="searchCompany()"
              placeholder="Search Company..." />
          </div>
          <!-- END PEOPLE SEARCHBAR -->
        </div>

        <!-- START TABLE -->
        <div class="row pt-2 pb-4">

          <!-- TODO Add table-scrollable to col-md-12 -->
          <div class="col-md-12 table-scrollable">
          @if(Session::has('post_deleted'))
          <div class="alert alert-success" role="alert">
          {{Session::get('post_deleted')}}
                        
          </div>
          @endif
            <table class="table table-hover table-bordered table-responsive" id="table">
              <thead>
                <tr>
                    <th>ID</th>
                  <th>Company</th>
                  <th>URL</th>
                  <th>Phone Number</th>
                  <th>Employees</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach ($company_employes as $datain)
                <tr class="table-row">
                <td>{{$datain->id}}</td>
                  <td scope="row" class="name">
                    <a href="companyDetails.html">{{$datain->organization_name}}</a>
                  </td>
                  <td>{{$datain->organization_website_url}}</td>
                  <td>{{$datain->organization_phone}}</td>
                  <td>
                  {{$datain->organization_num_current_employees}}
                  </td>

                  <td>
                    <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                      data-bs-target="#editModal">Edit</button>
                  </td>
                  <td>
                    <a type="button" class="btn btn-delete bg-danger ms-4" href="/delete_lidata/{{$datain->id}}">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
          <!-- START MODAL FOR EDIT  -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                  <form>
                    <div class="mb-3">
                      <label for="company" class="form-label">Company</label>
                      <input type="text" class="form-control" id="company">
                    </div>

                    <div class="mb-3">
                      <label for="url" class="form-label">URL</label>
                      <input type="url" class="form-control" id="url">
                    </div>

                    <div class="mb-3">
                      <label for="number" class="form-label">Phone number</label>
                      <input type="tel" class="form-control" id="number">
                    </div>

                    <div class="mb-3">
                      <label for="employees" class="form-label">Employees</label>
                      <input type="number" class="form-control" id="employees">
                    </div>

                    <div class="mb-3">
                      <label for="facebook_url" class="form-label">Facebook URL</label>
                      <input type="url" class="form-control" id="facebook_url">
                    </div>

                    <div class="mb-3">
                      <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                      <input type="url" class="form-control" id="linkedin_url">
                    </div>

                    <div class="mb-3">
                      <label for="twitter_url" class="form-label">Twitter URL</label>
                      <input type="url" class="form-control" id="twitter_url">
                    </div>

                    <div class="mb-3">
                      <label for="agelist_url" class="form-label">Agelist URL</label>
                      <input type="url" class="form-control" id="agelist_url">
                    </div>

                    <div class="mb-3">
                      <label for="foundation" class="form-label">Foundation Year</label>
                      <input type="number" class="form-control" id="foundation">
                    </div>

                    <div class="mb-3">
                      <label for="hq_city" class="form-label">HQ City</label>
                      <input type="text" class="form-control" id="hq_city">
                    </div>

                    <div class="mb-3">
                      <label for="hq_state" class="form-label">HQ State</label>
                      <input type="text" class="form-control" id="hq_state">
                    </div>

                    <div class="mb-3">
                      <label for="hq_country" class="form-label">HQ Country</label>
                      <input type="text" class="form-control" id="hq_country">
                    </div>

                    <div class="mb-3">
                      <label for="hq_postal_code" class="form-label">HQ Postal Code</label>
                      <input type="number" class="form-control" id="hq_postal_code">
                    </div>

                    <div class="mb-3">
                      <label for="lang" class="form-label">Languages</label>
                      <input type="text" class="form-control" id="lang">
                    </div>

                    <div class="mb-3">
                      <label for="industry" class="form-label">Industries</label>
                      <input type="text" class="form-control" id="industry">
                    </div>


                  </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODAL FOR EDIT  -->

        </div>
        <!-- END TABLE -->

                <!-- START PAGINATION -->
                <div  class="row py-5">
        {{-- Pagination --}}
      <div class="d-flex justify-content-end">
        {!! $company_employes->links() !!}
      </div>
      </div>
                <!-- END PAGINATION -->
      </div>
    </section>
    <!-- END MAIN BODY -->
  </section>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <!-- Chart JS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>