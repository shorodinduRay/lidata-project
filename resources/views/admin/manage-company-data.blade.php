@extends('admin.master')


@section('title')
    Dashboard
@endsection

@section('active')
    active
@endsection
@section('body')
    <section class="section-dashboard--main section-viewalldata">
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
                        @if($message = Session::get('nullMessage'))
                        <div class="card-body">
                            🎉
                            <span>{{ $message }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(isset($allDataName))
                <div class="row mb-4">
                    <div class="col-md-4 m-auto">
                        <h3 class="fw-light">Total Entries: <span>{{ $rowcount }}</span> </h3>
                    </div>

                    <!-- START PEOPLE SEARCHBAR -->
                    <div class="offset-md-5 col-md-3 d-flex justify-content-end">
                        <form id="search" action="{{ route('people.search.by.admin') }}" enctype="multipart/form-data" method="get">
                            
                            @if(isset($res))
                                <input type="text"
                                    name="search"
                                    id="searchPeopleByAdmin"
                                    class="searchBar w-100"
                                    onkeyup="searchPeople()"
                                    autocomplete="off"
                                    placeholder="Search People..."
                                    value="{{ $res }}"/>
                            @else
                                <input type="text"
                                    name="search"
                                    id="searchPeopleByAdmin"
                                    class="searchBar w-100"
                                    onkeyup="searchPeople()"
                                    autocomplete="off"
                                    placeholder="Search People..."/>
                            @endif
                            {{--<button type="submit" class="btn btn-purple rounded-1 w-100">
                                Apply
                            </button>--}}
                        </form>
                    </div>
                    <!-- END PEOPLE SEARCHBAR -->
                </div>

                <!-- START TABLE -->
                <div class="row pt-2 pb-4">

                    <!-- TODO Add table-scrollable to col-md-12 -->
                    <div class="col-md-12 table-scrollable">
                        <table class="table table-hover table-bordered table-responsive edit" id="table">
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
                            @foreach($allDataName as $data)
                                <tr class="table-row">
                                    <td scope="row" class="name">
                                        <a href="{{ route('user', ['id' => $data->id, 'name'=>$data->person_name]) }}"> {{ $data->person_name }} </a>
                                    </td>
                                    <td> {{ $data->person_title }} </td>
                                    <td> {{ $data->organization_name }} </td>
                                    <td> {{ $data->person_email }} </td>
                                    <td> {{ $data->person_sanitizd_phone }} </td>

                                    <td>
                                        <input type="button" name="view" value="Edit" id="{{ $data->id }}" class="btn btn-edit bg-primary view_data" data-bs-toggle="modal" data-bs-target="#dataModal{{ $data->id }}" />
                                    </td>

                                    <td>
                                        <a href="{{ route('delete.company.data', ['id' => $data->id]) }}" onclick="return confirm('Are you sure?')">
                                            <button type="button" class="btn btn-delete bg-danger">Delete</button>
                                        </a>


                                    </td>

                                </tr>
                                <!-- START MODAL FOR EDIT  -->
                                <div class="modal editModal fade" id="dataModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body" >
                                                <form action="{{ route('edit.lidata.data') }}" enctype="multipart/form-data" method="post">
                                                    @csrf

                                                    <input hidden type="text" class="form-control" name="liDataUserid" value="{{$data->id }}">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="person_name" value="{{ $data->person_name }}" />
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="title" name="person_title" value="{{ $data->person_title }}" />
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="company" class="form-label">Company</label>
                                                        <input type="text" class="form-control" id="company" name="organization_name" value="{{ $data->organization_name }}" />
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="person_email" value="{{ $data->person_email }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="number" class="form-label">Phone number</label>
                                                        <input type="tel" class="form-control" id="number" name="person_sanitizd_phone" value="{{ $data->person_sanitizd_phone }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="per_func" class="form-label">Person functions</label>
                                                        <input type="text" class="form-control" id="per_func" name="person_functions" value="{{ $data->person_functions }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_detailed_function" class="form-label">Person detailed function</label>
                                                        <input type="text" class="form-control" id="person_detailed_function" name="person_detailed_function" value="{{ $data->person_detailed_function }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_seniority" class="form-label">Person seniority</label>
                                                        <input type="text" class="form-control" id="person_seniority" name="person_seniority" value="{{ $data->person_seniority }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_location_city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="person_location_city" name="person_location_city" value="{{ $data->person_location_city }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_location_state" class="form-label">State</label>
                                                        <input type="text" class="form-control" id="person_location_state" name="person_location_state" value="{{ $data->person_location_state }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_location_country" class="form-label">Country</label>
                                                        <input type="text" class="form-control" id="person_location_country" name="person_location_country" value="{{ $data->person_location_country }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_location_postal_code" class="form-label">Postal Code</label>
                                                        <input type="text" class="form-control" id="person_location_postal_code" name="person_location_postal_code" value="{{ $data->person_location_postal_code }}">
                                                    </div>
                                
                                                    <div class="mb-3">
                                                        <label for="person_linkedin_url" class="form-label">LinkedIn URL</label>
                                                        <input type="url" class="form-control" id="person_linkedin_url" name="person_linkedin_url" value="{{ $data->person_linkedin_url }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- END MODAL FOR EDIT  -->
                            @endforeach
                        </table>
                        @if(isset($notFound)) 
                            <span>{{ $notFound }}</span>
                        @endif
                    </tbody>
                    </div>
                    <!-- START PAGINATION -->
                    <div class="row pt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <div class="d-sm-inline-flex justify-content-center">
                                        {!! $allDataName->links() !!}
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- END PAGINATION -->
                </div>
                <!-- END TABLE -->
            @else
                <div class="row mb-4">
                    <div class="col-md-4 m-auto">
                        <h3 class="fw-light">Total Entries: <span>{{ $rowcount }}</span> </h3>
                    </div>

                    <!-- START PEOPLE SEARCHBAR -->
                    <div class="offset-md-5 col-md-3 d-flex justify-content-end">
                        <form id="search" action="{{ route('people.search.by.admin') }}" enctype="multipart/form-data" method="get">
                           
                            <input type="text"
                                   name="search"
                                   id="searchPeopleByAdmin"
                                   class="searchBar w-100"
                                   onkeyup="searchPeople()"
                                   autocomplete="off"
                                   placeholder="Search People..." />
                            {{--value="{{ $res }}"--}}
                            {{--<button type="submit" class="btn btn-purple rounded-1 w-100">
                                Apply
                            </button>--}}
                        </form>
                    </div>
                    <!-- END PEOPLE SEARCHBAR -->
                </div>

                <!-- START TABLE -->
                <div class="row pt-2 pb-4">

                    <!-- TODO Add table-scrollable to col-md-12 -->
                    <div class="col-md-12 table-scrollable">
                        <table class="table table-hover table-bordered table-responsive edit" id="table">
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
                            @foreach($allData as $data)
                                <tr class="table-row">
                                    <td scope="row" class="name">
                                        <a href="{{ route('user', ['id' => $data->id, 'name'=>$data->person_name]) }}"> {{ $data->organization_name }} </a>
                                    </td>
                                    <td> {{ $data->organization_website_url }} </td>
                                    <td> {{ $data->organization_phone }} </td>
                                    <td> {{ $data->person_num_current_employees }} </td>

                                    <td>
                                        <input type="button" name="view" value="Edit" id="{{ $data->id }}" class="btn btn-edit bg-primary view_data" data-bs-toggle="modal" data-bs-target="#dataModal{{ $data->id }}" />
                                    </td>

                                    <td>
                                        <a href="{{ route('delete.company.data', ['id' => $data->id]) }}" onclick="return confirm('Are you sure?')">
                                            <button type="button" class="btn btn-delete bg-danger">Delete</button>
                                        </a>


                                    </td>

                                </tr>
                                <!-- START MODAL FOR EDIT  -->
                                <div class="modal editModal fade" id="dataModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body" >
                                                <form action="{{ route('edit.lidata.data') }}" enctype="multipart/form-data" method="post">
                                                    @csrf

                                                    <input hidden type="text" class="form-control" name="liDataUserid" value="{{$data->id }}">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="person_name" value="{{ $data->person_name }}" />
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="title" name="person_title" value="{{ $data->person_title }}" />
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="company" class="form-label">Company</label>
                                                        <input type="text" class="form-control" id="company" name="organization_name" value="{{ $data->organization_name }}" />
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="email" class="form-label">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="person_email" value="{{ $data->person_email }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="number" class="form-label">Phone number</label>
                                                        <input type="tel" class="form-control" id="number" name="person_sanitizd_phone" value="{{ $data->person_sanitizd_phone }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="per_func" class="form-label">Person functions</label>
                                                        <input type="text" class="form-control" id="per_func" name="person_functions" value="{{ $data->person_functions }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_detailed_function" class="form-label">Person detailed function</label>
                                                        <input type="text" class="form-control" id="person_detailed_function" name="person_detailed_function" value="{{ $data->person_detailed_function }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_seniority" class="form-label">Person seniority</label>
                                                        <input type="text" class="form-control" id="person_seniority" name="person_seniority" value="{{ $data->person_seniority }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_location_city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="person_location_city" name="person_location_city" value="{{ $data->person_location_city }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_location_state" class="form-label">State</label>
                                                        <input type="text" class="form-control" id="person_location_state" name="person_location_state" value="{{ $data->person_location_state }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_location_country" class="form-label">Country</label>
                                                        <input type="text" class="form-control" id="person_location_country" name="person_location_country" value="{{ $data->person_location_country }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_location_postal_code" class="form-label">Postal Code</label>
                                                        <input type="text" class="form-control" id="person_location_postal_code" name="person_location_postal_code" value="{{ $data->person_location_postal_code }}">
                                                      </div>
                                  
                                                      <div class="mb-3">
                                                        <label for="person_linkedin_url" class="form-label">LinkedIn URL</label>
                                                        <input type="url" class="form-control" id="person_linkedin_url" name="person_linkedin_url" value="{{ $data->person_linkedin_url }}">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- END MODAL FOR EDIT  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- START PAGINATION -->
                    <div class="row pt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <div class="d-sm-inline-flex justify-content-center">
                                        {!! $allData->links() !!}
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- END PAGINATION -->
                </div>
                <!-- END TABLE -->
            @endif

        </div>
    </section>
    <!-- END MAIN BODY -->
@endsection




