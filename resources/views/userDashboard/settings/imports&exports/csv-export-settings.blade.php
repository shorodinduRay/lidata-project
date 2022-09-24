@extends('userDashboard.settings.master')

@section('main')
    <section class="section-main">
        <!-- START SECOND NAVBAR -->
        <section class="second-navbar">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="{{ route('contacts') }}" class="nav-link {{  request()->routeIs('contacts') ? 'active' : '' }}">Contact Import</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('accounts') }}" class="nav-link {{  request()->routeIs('accounts') ? 'active' : '' }}">Account Import</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('exports') }}" class="nav-link {{  request()->routeIs('exports') ? 'active' : '' }}">CSV Exports</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('csv-export-settings') }}" class="nav-link {{  request()->routeIs('csv-export-settings') ? 'active' : '' }}" class="nav-link">CSV Export Settings</a>
            </li>
          </ul>
        </section>
        <!-- END SECOND NAVBAR -->

       <!-- START CSV EXPORT SETTINGS -->
       <section
            class="section-csv-export-settings u-padding-lg d-flex flex-column align-items-center"
          >
            <h3 class="fw-bold text-dark">CSV Export Settings</h3>
            <div class="card border-0 u-box-shadow-1">
              <div class="card-body p-4">
                <h4 class="card-title border-0">
                  What is the CSV Export settings for?
                </h4>
                <p class="card-text text-secondary">
                  You can customize the default fields you want to download
                  every time you export a CSV file.
                </p>
                <div class="csv-export-box d-flex justify-content-between">
                  <div class="csv-export-icon-box d-flex align-items-center">
                    <i class="bi bi-people-fill px-3"></i>
                    <div class="csv-export-title">Contact CSV Export</div>
                  </div>

                  <!-- BUTTON TRIGGER MODAL -->
                  <button
                    type="button"
                    class="csv-export-button btn btn-access fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#contactCSVExport"
                  >
                    <i class="bi bi-gear pe-1"></i>
                    Edit Settings
                  </button>

                  <!-- Modal -->
                  <div
                    class="modal fade"
                    id="contactCSVExport"
                    tabindex="-1"
                    aria-labelledby="contactCSVExportLabel"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog modal-dialog-centered">
                      <form action="{{ route('custom.csv.settings') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4
                              class="modal-title fw-bold text-dark"
                              id="contactCSVExportLabel"
                            >
                              Contact CSV Export
                            </h4>
                            <div>
                              <button
                                type="button"
                                class="btn btn-access text-dark"
                                data-bs-dismiss="modal"
                              >
                                Cancel
                              </button>
                              <button type="submit" class="btn btn-blue">
                                Save settings
                              </button>
                            </div>
                          </div>
                          <div class="modal-body">
                            <div
                              class="modal-body--header border-bottom py-3 d-flex align-items-center justify-content-between"
                            >
                              <h4 class="text-dark fw-bold">Standard Fields</h4>
                              <input id="checkAll" type="button" class="selectAll fs-4" value="Select All" onclick="myFunction()"/>
                            </div>
                            <div class="modal-body--content py-4">
                              <div class="container">
                                <div class="row">
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>First Name</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_first_name_unanalyzed') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_first_name_unanalyzed"
                                            name="person_first_name_unanalyzed"
                                            value="person_first_name_unanalyzed"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_first_name_unanalyzed"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_first_name_unanalyzed"
                                            name="person_first_name_unanalyzed"
                                            value="person_first_name_unanalyzed"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_first_name_unanalyzed"
                                          >
                                          </label>
                                        @endif                                 
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Last Name</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_last_name_unanalyzed') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_last_name_unanalyzed"
                                            name="person_last_name_unanalyzed"
                                            value="person_last_name_unanalyzed"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_last_name_unanalyzed"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_last_name_unanalyzed"
                                            name="person_last_name_unanalyzed"
                                            value="person_last_name_unanalyzed"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_last_name_unanalyzed"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Title</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_title') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_title"
                                            name="person_title"
                                            value="person_title"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_title"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_title"
                                            name="person_title"
                                            value="person_title"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_title"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_name') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_name"
                                            name="organization_name"
                                            value="organization_name"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_name"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_name"
                                            name="organization_name"
                                            value="organization_name"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_name"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Email</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_email') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_email"
                                            name="person_email"
                                            value="person_email"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_email"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_email"
                                            name="person_email"
                                            value="person_email"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_email"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Phone Number</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_sanitized_phone') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_sanitized_phone"
                                            name="person_sanitized_phone"
                                            value="person_sanitized_phone"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_sanitized_phone"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_sanitized_phone"
                                            name="person_sanitized_phone"
                                            value="person_sanitized_phone"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_sanitized_phone"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>City</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_location_city') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_city"
                                            name="person_location_city"
                                            value="person_location_city"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_city"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_city"
                                            name="person_location_city"
                                            value="person_location_city"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_city"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>State</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_location_state') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_state"
                                            name="person_location_state"
                                            value="person_location_state"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_state"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_state"
                                            name="person_location_state"
                                            value="person_location_state"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_state"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Country</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'person_location_country') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_country"
                                            name="person_location_country"
                                            value="person_location_country"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_country"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="person_location_country"
                                            name="person_location_country"
                                            value="person_location_country"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="person_location_country"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Employees</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_num_current_employees') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_num_current_employees"
                                            name="organization_num_current_employees"
                                            value="organization_num_current_employees"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_num_current_employees"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_num_current_employees"
                                            name="organization_num_current_employees"
                                            value="organization_num_current_employees"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_num_current_employees"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Industry</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_industries') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_industries"
                                            name="organization_industries"
                                            value="organization_industries"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_industries"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_industries"
                                            name="organization_industries"
                                            value="organization_industries"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_industries"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company City</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_hq_location_city') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_city"
                                            name="organization_hq_location_city"
                                            value="organization_hq_location_city"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_city"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_city"
                                            name="organization_hq_location_city"
                                            value="organization_hq_location_city"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_city"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company State</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_hq_location_state') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_state"
                                            name="organization_hq_location_state"
                                            value="organization_hq_location_state"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_state"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_state"
                                            name="organization_hq_location_state"
                                            value="organization_hq_location_state"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_state"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company Country</h5>
                                      <div class="form-check">
                                        @if (strpos($csvSettings, 'organization_hq_location_country') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_country"
                                            name="organization_hq_location_country"
                                            value="organization_hq_location_country"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_country"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_country"
                                            name="organization_hq_location_country"
                                            value="organization_hq_location_country"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_country"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="csv-export-box d-flex justify-content-between mt-4">
                  <div class="csv-export-icon-box d-flex align-items-center">
                    <i class="bi bi-building px-3"></i>
                    <div class="csv-export-title">Account CSV Export</div>
                  </div>

                  <!-- BUTTON TRIGGER MODAL -->
                  <button
                    type="button"
                    class="csv-export-button btn btn-access fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#accountCSVExport"
                  >
                    <i class="bi bi-gear pe-1"></i>
                    Edit Settings
                  </button>

                  <!-- Modal -->
                  <div
                    class="modal fade"
                    id="accountCSVExport"
                    tabindex="-1"
                    aria-labelledby="accountCSVExportLabel"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog modal-dialog-centered">
                      <form action="{{ route('custom.account.csv.settings') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4
                              class="modal-title fw-bold text-dark"
                              id="accountCSVExportLabel"
                            >
                              Account CSV Export
                            </h4>
                            <div>
                              <button
                                type="button"
                                class="btn btn-access text-dark"
                                data-bs-dismiss="modal"
                              >
                                Cancel
                              </button>
                              <button type="submit" class="btn btn-blue">
                                Save settings
                              </button>
                            </div>
                          </div>
                          <div class="modal-body">
                            <div
                              class="modal-body--header border-bottom py-3 d-flex align-items-center justify-content-between"
                            >
                              <h4 class="text-dark fw-bold">Standard Fields</h4>
                              <input id="checkAll" type="button" class="selectAll fs-4" value="Select All" onclick="myFunctionAccount()"/>
                            </div>
                            <div class="modal-body--content py-4">
                              <div class="container">
                                <div class="row">
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_name') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_name2"
                                            name="organization_name"
                                            value="organization_name"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_name2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_name2"
                                            name="organization_name"
                                            value="organization_name"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_name2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company Email</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_domain') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_domain"
                                            name="organization_domain"
                                            value="organization_domain"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_domain"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_domain"
                                            name="organization_domain"
                                            value="organization_domain"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_domain"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company Phone Number</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_phone') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_phone"
                                            name="organization_phone"
                                            value="organization_phone"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_phone"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_phone"
                                            name="organization_phone"
                                            value="organization_phone"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_phone"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Employees</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_num_current_employees') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_num_current_employees2"
                                            name="organization_num_current_employees"
                                            value="organization_num_current_employees"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_num_current_employees2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_num_current_employees2"
                                            name="organization_num_current_employees"
                                            value="organization_num_current_employees"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_num_current_employees2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Industry</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_industries') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_industries2"
                                            name="organization_industries"
                                            value="organization_industries"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_industries2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_industries2"
                                            name="organization_industries"
                                            value="organization_industries"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_industries2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company City</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_hq_location_city') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_city2"
                                            name="organization_hq_location_city"
                                            value="organization_hq_location_city"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_city2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_city2"
                                            name="organization_hq_location_city"
                                            value="organization_hq_location_city"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_city2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company State</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_hq_location_state') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_state2"
                                            name="organization_hq_location_state"
                                            value="organization_hq_location_state"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_state2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_state2"
                                            name="organization_hq_location_state"
                                            value="organization_hq_location_state"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_state2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 p-2">
                                    <div class="field-name-box">
                                      <h5>Company Country</h5>
                                      <div class="form-check">
                                        @if (strpos($accountsCSVSettings, 'organization_hq_location_country') !== false)
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_country2"
                                            name="organization_hq_location_country"
                                            value="organization_hq_location_country"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_country2"
                                          >
                                          </label>
                                        @else
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="organization_hq_location_country2"
                                            name="organization_hq_location_country"
                                            value="organization_hq_location_country"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="organization_hq_location_country2"
                                          >
                                          </label>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- END CSV EXPORT SETTINGS -->
    </section>

    <script type="text/javascript">
      function myFunction() {
              let checkBox1 = document.getElementById("person_first_name_unanalyzed");
              checkBox1.checked = true;
              let checkBox2 = document.getElementById("person_last_name_unanalyzed");
              checkBox2.checked = true;
              let checkBox3 = document.getElementById("person_title");
              checkBox3.checked = true;
              let checkBox4 = document.getElementById("organization_name");
              checkBox4.checked = true;
              let checkBox5 = document.getElementById("person_email");
              checkBox5.checked = true;
              let checkBox6 = document.getElementById("person_sanitized_phone");
              checkBox6.checked = true;
              let checkBox7 = document.getElementById("person_location_city");
              checkBox7.checked = true;
              let checkBox8 = document.getElementById("person_location_state");
              checkBox8.checked = true;
              let checkBox9 = document.getElementById("person_location_country");
              checkBox9.checked = true;
              let checkBox10 = document.getElementById("organization_num_current_employees");
              checkBox10.checked = true;
              let checkBox11 = document.getElementById("organization_industries");
              checkBox11.checked = true;
              let checkBox12 = document.getElementById("organization_hq_location_city");
              checkBox12.checked = true;
              let checkBox13 = document.getElementById("organization_hq_location_state");
              checkBox13.checked = true;
              let checkBox14 = document.getElementById("organization_hq_location_country");
              checkBox14.checked = true;

      }
      function myFunctionAccount() {
              let checkBox1 = document.getElementById("organization_name2");
              checkBox1.checked = true;
              let checkBox2 = document.getElementById("organization_domain");
              checkBox2.checked = true;
              let checkBox3 = document.getElementById("organization_phone");
              checkBox3.checked = true;
              let checkBox4 = document.getElementById("organization_num_current_employees2");
              checkBox4.checked = true;
              let checkBox5 = document.getElementById("organization_industries2");
              checkBox5.checked = true;
              let checkBox6 = document.getElementById("organization_hq_location_city2");
              checkBox6.checked = true;
              let checkBox7 = document.getElementById("organization_hq_location_state2");
              checkBox7.checked = true;
              let checkBox8 = document.getElementById("organization_hq_location_country2");
              checkBox8.checked = true;

      }
  </script>
  
@endsection
