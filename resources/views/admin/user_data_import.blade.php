@extends('admin.master')


@section('title')
    Dashboard
@endsection

@section('active')
    active
@endsection
@section('body')
    <section class="section-dashboard--main section-dashboard--userDetails custom-scrollbar">
        <div class="container">

            <div class="row">
                <div class="col-md-4 offset-8 pop-up-message--box me-0">
                    <div class="card ">
                        @if($message = Session::get('message'))
                            <div class="card-body">
                                🎉
                                <span>{{ $message }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4 me-auto">
                  <h2 class="fw-light fs-3">Total Entries: <span>101</span> </h3>
                </div>
      
                <!-- START PEOPLE SEARCHBAR -->
                <div class="col-md-3 d-flex justify-content-end">
                  <input type="text" name="search" id="searchPeople" class="searchBar w-100" onkeyup="searchPeople()"
                    placeholder="Search People..." />
                </div>
                <!-- END PEOPLE SEARCHBAR -->
      
                <!-- START COMPANY SEARCHBAR -->
                <div class="col-md-3 d-flex justify-content-end">
                  <input type="text" name="search" id="searchCompany" class="searchBar w-100" onkeyup="searchCompany()"
                    placeholder="Search Company..." />
                </div>
                <!-- END COMPANY SEARCHBAR -->
              </div>
      
              <!-- START PEOPLE TABLE -->
              <section class="section-people-table" style="max-height: 50vh;">
                <div class="row pt-2 pb-4">
                  <div class="col-md-12 table-scrollable">
                    <table class="table table-hover table-bordered table-responsive" id="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Company</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="table-row">
                          <td scope="row" class="name">
                            <a href="user01.html"> Maliha Mustafa </a>
                          </td>
                          <td>Web Developer</td>
                          <td>SEO Exparte Bangladesh</td>
                          <td>
                            shamontihaque@seoexpartebd.com
                          </td>
                          <td>+880 111111111</td>
                          <td>
                            <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                              data-bs-target="#editModal">Edit</button>
                          </td>
                          <td>
                            <a type="button" class="btn btn-delete bg-danger" href="#">Delete</a>
                          </td>
                        </tr>
                        <tr class="table-row">
                          <td scope="row" class="name">
                            <a href="user01.html"> Rowja Mehjabeen </a>
                          </td>
                          <td>Web Developer</td>
                          <td>Google</td>
                          <td>
                            shamontihaque@seoexpartebd.com
                          </td>
                          <td>+880 111111111</td>
                          <td>
                            <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                              data-bs-target="#editModal">Edit</button>
                          </td>
                          <td>
                            <a type="button" class="btn btn-delete bg-danger" href="#">Delete</a>
                          </td>
                        </tr>
                        <tr class="table-row">
                          <td scope="row" class="name">
                            <a href="user01.html"> Rowja Mehjabeen </a>
                          </td>
                          <td>Web Developer</td>
                          <td>Google</td>
                          <td>
                            shamontihaque@seoexpartebd.com
                          </td>
                          <td>+880 111111111</td>
                          <td>
                            <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                              data-bs-target="#editModal">Edit</button>
                          </td>
                          <td>
                            <a type="button" class="btn btn-delete bg-danger" href="#">Delete</a>
                          </td>
                        </tr>
                        <tr class="table-row">
                          <td scope="row" class="name">
                            <a href="user01.html"> Rowja Mehjabeen </a>
                          </td>
                          <td>Web Developer</td>
                          <td>Google</td>
                          <td>
                            shamontihaque@seoexpartebd.com
                          </td>
                          <td>+880 111111111</td>
                          <td>
                            <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                              data-bs-target="#editModal">Edit</button>
                          </td>
                          <td>
                            <a type="button" class="btn btn-delete bg-danger" href="#">Delete</a>
                          </td>
                        </tr>
                        <tr class="table-row">
                          <td scope="row" class="name">
                            <a href="user01.html"> Rowja Mehjabeen </a>
                          </td>
                          <td>Web Developer</td>
                          <td>Google</td>
                          <td>
                            shamontihaque@seoexpartebd.com
                          </td>
                          <td>+880 111111111</td>
                          <td>
                            <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                              data-bs-target="#editModal">Edit</button>
                          </td>
                          <td>
                            <a type="button" class="btn btn-delete bg-danger" href="#">Delete</a>
                          </td>
                        </tr>
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
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name">
                            </div>
      
                            <div class="mb-3">
                              <label for="title" class="form-label">Title</label>
                              <input type="text" class="form-control" id="title">
                            </div>
      
                            <div class="mb-3">
                              <label for="company" class="form-label">Company</label>
                              <input type="text" class="form-control" id="company">
                            </div>
      
                            <div class="mb-3">
                              <label for="email" class="form-label">Email address</label>
                              <input type="email" class="form-control" id="email">
                            </div>
      
                            <div class="mb-3">
                              <label for="number" class="form-label">Phone number</label>
                              <input type="tel" class="form-control" id="number">
                            </div>
      
                            <div class="mb-3">
                              <label for="per_func" class="form-label">Person functions</label>
                              <input type="text" class="form-control" id="per_func">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_detailed_function" class="form-label">Person detailed function</label>
                              <input type="text" class="form-control" id="person_detailed_function">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_seniority" class="form-label">Person seniority</label>
                              <input type="text" class="form-control" id="person_seniority">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_location_city" class="form-label">City</label>
                              <input type="text" class="form-control" id="person_location_city">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_location_state" class="form-label">State</label>
                              <input type="text" class="form-control" id="person_location_state">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_location_country" class="form-label">Country</label>
                              <input type="text" class="form-control" id="person_location_country">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_location_postal_code" class="form-label">Postal Code</label>
                              <input type="text" class="form-control" id="person_location_postal_code">
                            </div>
      
                            <div class="mb-3">
                              <label for="person_linkedin_url" class="form-label">LinkedIn URL</label>
                              <input type="url" class="form-control" id="person_linkedin_url">
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
              </section>
              <!-- END PEOPLE TABLE -->
      
              <!-- START COMPANY TABLE -->
              <section class="section-company-table" style="max-height: 50vh;">
              <div class="row pt-2 pb-4">
                <div class="col-md-12 table-scrollable">
                  <table class="table table-hover table-bordered table-responsive" id="table">
                    <thead>
                      <tr>
                        <th>Company</th>
                        <th>URL</th>
                        <th>Phone Number</th>
                        <th>Employees</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-row">
                        <td scope="row" class="name">
                          <a href="company01.html">SEO Exparte Bangladesh</a>
                        </td>
                        <td>http://www.seoexpartebd.com</td>
                        <td>+880 2222222222</td>
                        <td>
                          140
                        </td>
      
                        <td>
                          <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                        </td>
                        <td>
                          <a type="button" class="btn btn-delete bg-danger ms-4" href="#">Delete</a>
                        </td>
                      </tr>
                      <tr class="table-row">
                        <td scope="row" class="name">
                          <a href="company01.html">Google</a>
                        </td>
                        <td>http://www.google.com</td>
                        <td>+880 2222222222</td>
                        <td>
                          240000
                        </td>
      
                        <td>
                          <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                        </td>
                        <td>
                          <a type="button" class="btn btn-delete bg-danger ms-4" href="#">Delete</a>
                        </td>
                      </tr>
                      <tr class="table-row">
                        <td scope="row" class="name">
                          <a href="company01.html">SEO Exparte Bangladesh</a>
                        </td>
                        <td>http://www.seoexpartebd.com</td>
                        <td>+880 2222222222</td>
                        <td>
                          140
                        </td>
      
                        <td>
                          <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                        </td>
                        <td>
                          <a type="button" class="btn btn-delete bg-danger ms-4" href="#">Delete</a>
                        </td>
                      </tr>
                      <tr class="table-row">
                        <td scope="row" class="name">
                          <a href="company01.html">SEO Exparte Bangladesh</a>
                        </td>
                        <td>http://www.seoexpartebd.com</td>
                        <td>+880 2222222222</td>
                        <td>
                          140
                        </td>
      
                        <td>
                          <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                        </td>
                        <td>
                          <a type="button" class="btn btn-delete bg-danger ms-4" href="#">Delete</a>
                        </td>
                      </tr>
                      <tr class="table-row">
                        <td scope="row" class="name">
                          <a href="company01.html">SEO Exparte Bangladesh</a>
                        </td>
                        <td>http://www.seoexpartebd.com</td>
                        <td>+880 2222222222</td>
                        <td>
                          140
                        </td>
      
                        <td>
                          <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                        </td>
                        <td>
                          <a type="button" class="btn btn-delete bg-danger ms-4" href="#">Delete</a>
                        </td>
                      </tr>
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
              </section>
              <!-- END COMPANY TABLE -->
      
              <!-- START PAGINATION -->
              <div class="row pb-2 pt-3">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- END PAGINATION -->
      
            </div>
    </section>

@endsection
