@extends('userDashboard.settings.master')

@section('main')

      <!-- START MAIN -->
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

        <!-- START NO IMPORT -->
        <section class="pt-5 ps-3 section-no-import">
          <div class="container">
            <div class="row">
              <div class="offset-md-3 col-md-6 text-center d-flex flex-column">
                <span class="text-secondary">Once you import a CSV of Companies, it will be listed here with its record
                  count, progress, and other details.</span>
                <input id="fileid" type="file" hidden="">
                <input id="buttonid" type="button" class="btn btn-blue w-25 mx-auto mt-3 lh-1" value="Import Accounts">
              </div>
            </div>
            <div class="row">
              <div class="mx-auto col-md-3">
                <div class="divider mt-4 mb-3">
                  <div class="divider--line me-5"></div>
                  <div>OR</div>
                  <div class="divider--line ms-5"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mx-auto text-center col-md-3">
                <a href="../../assets/sample_csv_accounts.csv" class="text-primary">Download sample template</a>
              </div>
            </div>
          </div>
        </section>
        <!-- END NO IMPORT -->

        <!-- START CSV IMPORTED -->
        <section class="d-none">
          <div class="container mt-3 pe-3">
            <div class="row">
              <div class="ms-auto col-3 d-flex justify-content-end">
                <button type="button" class="btn btn-blue lh-1">Import More Accounts</button>
              </div>
            </div>
          </div>
        </section>

        <!-- START CSV IMPORTS TABLE -->
        <section class="section-csv-imports-table m-3 border rounded table-scrollable d-none">

          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Progress</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total Records</th>
                <th>Uploaded By</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">
                  <div>
                    sample_csv_companies.csv
                  </div>
                  <div class="fs-5 text-secondary">
                    Created on
                    <span>3:01 pm</span>
                  </div>
                  </p>
                </td>
                <td colspan="6">
                  <div class="progress my-auto">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </td>
                <td>4</td>
                <td>
                  <button type="button" class="user user-btn circle-element mx-3">
                    <p class="user-name">SH</p>
                    <div class="user-details bg-dark py-2 px-5">
                      <p>
                        Uploaded by Shamonti Haque
                      </p>
                      <p>
                        &lt;shamonti.haque98@gmail.com&gt;
                      </p>
                    </div>
                  </button>
                </td>
              </tr>
              <tr>
                <td scope="row">
                  <div>
                    sample_csv_companies02.csv
                  </div>
                  <div class="fs-5 text-secondary">
                    Created on
                    <span>3:01 pm</span>
                  </div>
                  </p>
                </td>
                <td colspan="6">
                  <div class="progress my-auto">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </td>
                <td>2</td>
                <td>
                  <button type="button" class="user user-btn circle-element mx-3">
                    <p class="user-name">SH</p>
                    <div class="user-details bg-dark py-2 px-5">
                      <p>
                        Uploaded by Shamonti Haque
                      </p>
                      <p>
                        &lt;shamonti.haque98@gmail.com&gt;
                      </p>
                    </div>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="d-flex align-items-center">
                  <span class="px-4">1-2 of 2</span>

                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </td>
              </tr>
            </tfoot>
          </table>
        </section>
        <!-- END CSV EXPORTS TABLE -->
        <!-- END CSV IMPORTED -->

        <!-- START CSV ERROR TEXT -->
        <section class="section-csv-error my-5 d-none">
          <div class="container">
            <div class="row ">
              <div class="col-md-5 mx-auto text-center">
                <span class="text-danger">Please follow the sample CSV file for guidance in uploading your file in the
                  correct format.</span>
              </div>
            </div>
            <div class="row">
              <div class="offset-md-3 col-md-6 text-center d-flex flex-column">
                <input id="fileid" type="file" hidden="">
                <input id="buttonid" type="button" class="btn btn-blue w-25 mx-auto mt-3 lh-1" value="Import Accounts">
              </div>
            </div>
            <div class="row">
              <div class="mx-auto col-md-3">
                <div class="divider mt-4 mb-3">
                  <div class="divider--line me-5"></div>
                  <div>OR</div>
                  <div class="divider--line ms-5"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mx-auto text-center col-md-3">
                <a href="../../assets/sample_csv_accounts.csv" class="text-primary">Download sample template</a>
              </div>
            </div>
          </div>
        </section>
        <!-- END CSV ERROR TEXT -->
      </section>
      <!-- END MAIN -->
    </section>
    @endsection

 
