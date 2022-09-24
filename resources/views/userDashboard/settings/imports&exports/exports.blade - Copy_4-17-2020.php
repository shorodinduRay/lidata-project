@extends('userDashboard.settings.master')

@section('main')
    <!-- START BILLING -->
    <section class="section-main">
            <!-- START SECOND NAVBAR -->
            <section class="second-navbar">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="{{ route('exports') }}" class="nav-link active">CSV Exports</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('csv-export-settings') }}" class="nav-link"
                        >CSV Export Settings</a
                        >
                    </li>
                </ul>
            </section>
            <!-- END SECOND NAVBAR -->

            <!-- START NO EXPORT -->
            <section class="pt-5 ps-3 section-no-export d-none">
                <span class="text-secondary">No CSV exports found!</span>
            </section>
            <!-- END NO EXPORT -->

            <!-- START CSV EXPORTS TABLE -->
            <section class="section-csv-exports-table m-3 border rounded table-scrollable">
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
                        <th></th>
                        <th></th>
                        <th>Total Records</th>
                        <th>Exported By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row">
                            <div>
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>3:01 pm</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
                                Export of contacts
                            </div>
                            <div class="fs-5 text-secondary">
                                Created on
                                <span>Feb 19</span>
                            </div>
                            </p>
                        </td>
                        <td colspan="8">
                            <div class="progress my-auto">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 100%"
                                    aria-valuenow="100"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>
                            <button
                                type="button"
                                class="user user-btn circle-element mx-3"
                            >
                                <p class="user-name">SH</p>
                                <div class="user-details bg-dark py-2 px-5">
                                    <p>
                                        Export started by Shamonti Haque
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
        </section>
    <!-- END MAIN -->
@endsection
