@extends('front.category.master')

@section('peopleTitle')
  Company Search: {{ $dataId }} | Li Data
@endsection

@section('peopleMain')

  <!-- START BREADCRUMB -->
  <hr class="mt-lg-0 mt-5 text-secondary" />
  <div class="container">
    <div class="row">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('category-company', ['id' => 'A']) }}">Company</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $dataId }}
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- END BREADCRUMB -->
  <!-- START SEARCH BARS -->
  <section class="section-searchbar pt-md-5 pb-md-4 py-2 mt-md-0 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-6 ms-md-auto">
          <div class="row">
            <form action="{{ route('userSearch') }}">
              @csrf
              <div class="col-12">
                <input  type="text" name="searchPeople" id="searchPeopleName"
                        class="searchBar bg-white border-5 text-dark fw-normal col-md-9 col-8"
                        placeholder="Search by Name..." onkeyup="searchPeople()" autocomplete="off"  />
                <button type="submit" class="btn btn-blue">Apply</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="row">
            <form action="{{ route('company.search') }}">
              @csrf
              <div class="col-12">
                <input  type="text" name="searchCompany" id="searchCompany"
                        class="searchBar bg-white border-5 text-dark fw-normal col-md-9 col-8"
                        placeholder="Search by Company..." onkeyup="searchCompany()" autocomplete="off"  />
                <button type="submit" class="btn btn-blue">Apply</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END SEARCH BARS -->

  <!-- START SECTION PEOPLE CARDS -->
  <section class="section-people-cards py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div
                  class="card u-box-shadow-1 border-0 u-border-radius h-100 bg-light"
          >
            <div class="card-body p-5">
              <h4 class="card-title">
                <div class="d-flex align-items-center pb-3 mb-4">
                  <div class="circle-element circle-element--company">
                    <i class="bi bi-briefcase-fill"></i>
                  </div>
                  <span class="sub-heading">Company Search</span>
                </div>
              </h4>
              <div>
                <a href="{{ route('category-company', ['id' => 'A'])  }}" class="dark-link @if ($dataId == 'A') active  @endif" >A</a>
                <a href="{{ route('category-company', ['id' => 'B'])  }}" class="dark-link @if ($dataId == 'B') active  @endif">B</a>
                <a href="{{ route('category-company', ['id' => 'C'])  }}" class="dark-link @if ($dataId == 'C') active  @endif">C</a>
                <a href="{{ route('category-company', ['id' => 'D'])  }}" class="dark-link @if ($dataId == 'D') active  @endif">D</a>
                <a href="{{ route('category-company', ['id' => 'E'])  }}" class="dark-link @if ($dataId == 'E') active  @endif">E</a>
                <a href="{{ route('category-company', ['id' => 'F'])  }}" class="dark-link @if ($dataId == 'F') active  @endif">F</a>
                <a href="{{ route('category-company', ['id' => 'G'])  }}" class="dark-link @if ($dataId == 'G') active  @endif">G</a>
                <a href="{{ route('category-company', ['id' => 'H'])  }}" class="dark-link @if ($dataId == 'H') active  @endif">H</a>
                <a href="{{ route('category-company', ['id' => 'I'])  }}" class="dark-link @if ($dataId == 'I') active  @endif">I</a>
                <a href="{{ route('category-company', ['id' => 'J'])  }}" class="dark-link @if ($dataId == 'J') active  @endif">J</a>
                <a href="{{ route('category-company', ['id' => 'K'])  }}" class="dark-link @if ($dataId == 'K') active  @endif">K</a>
                <a href="{{ route('category-company', ['id' => 'L'])  }}" class="dark-link @if ($dataId == 'L') active  @endif">L</a>
                <a href="{{ route('category-company', ['id' => 'M'])  }}" class="dark-link @if ($dataId == 'M') active  @endif">M</a>
                <a href="{{ route('category-company', ['id' => 'N'])  }}" class="dark-link @if ($dataId == 'N') active  @endif">N</a>
                <a href="{{ route('category-company', ['id' => 'O'])  }}" class="dark-link @if ($dataId == 'O') active  @endif">O</a>
                <a href="{{ route('category-company', ['id' => 'P'])  }}" class="dark-link @if ($dataId == 'P') active  @endif">P</a>
                <a href="{{ route('category-company', ['id' => 'Q'])  }}" class="dark-link @if ($dataId == 'Q') active  @endif">Q</a>
                <a href="{{ route('category-company', ['id' => 'R'])  }}" class="dark-link @if ($dataId == 'R') active  @endif">R</a>
                <a href="{{ route('category-company', ['id' => 'S'])  }}" class="dark-link @if ($dataId == 'S') active  @endif">S</a>
                <a href="{{ route('category-company', ['id' => 'T'])  }}" class="dark-link @if ($dataId == 'T') active  @endif">T</a>
                <a href="{{ route('category-company', ['id' => 'U'])  }}" class="dark-link @if ($dataId == 'U') active  @endif">U</a>
                <a href="{{ route('category-company', ['id' => 'V'])  }}" class="dark-link @if ($dataId == 'V') active  @endif">V</a>
                <a href="{{ route('category-company', ['id' => 'W'])  }}" class="dark-link @if ($dataId == 'W') active  @endif">W</a>
                <a href="{{ route('category-company', ['id' => 'X'])  }}" class="dark-link @if ($dataId == 'X') active  @endif">X</a>
                <a href="{{ route('category-company', ['id' => 'Y'])  }}" class="dark-link @if ($dataId == 'Y') active  @endif">Y</a>
                <a href="{{ route('category-company', ['id' => 'Z'])  }}" class="dark-link @if ($dataId == 'Z') active  @endif">Z</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-md-0 mt-5">
          <div class="card bg-transparent u-border-radius h-100">
            <div class="card-body d-flex align-items-center px-5 mx-5">
              <div class="col-md-4 px-4 mx-3">
                <img
                        src="{{ asset('/') }}adminAsset/assets/images/data.svg"
                        class="img-fluid"
                        alt="illustration"
                />
              </div>
              <div class="col-md-8">
                <h1 class="heading--sub mb-4">
                  Reach your target contacts faster with Li Data
                </h1>
                @guest
                  <a
                    href="{{ route('user.register') }}"
                    type="button"
                    class="btn btn-grad px-4"
                  >
                    Sign Up For Free
                  </a>
                @else
                  <a
                    href="{{ route('loggedInUser') }}"
                    type="button"
                    class="btn btn-grad px-4"
                  >
                  Sign Up For Free
                </a>
                @endguest
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END SECTION PEOPLE CARDS -->

  <!-- START SECTION MESSAGE -->
  <section class="section-message py-5 mb-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0">
            <div class="card-body p-5 mt-5">
                  {{-- <span class="card-text no-data d-none">
                    No Company pages found for:
                    <span class="text-secondary">A</span>
                  </span> --}}
              <h2 class="card-text text-dark fw-bold fst-normal fs-3">
                Company Directory:
                <span class="text-dark fw-bold fst-normal">{{ $dataId }}</span>
              </h2>
              <p class="card-text">
                  @forelse ($data as $allData)
                    <a href="{{ route('user-company', ['id' => $allData->id, 'name'=>$allData->organization_name]) }}" class="user-link"
                    >{{$allData->organization_name }}</a
                    >
                  @empty
                  <h2 class="card-text no-data">
                    No Company pages found for:
                    <span class="text-secondary">{{ $dataId }}</span>
                  </h2>
                @endforelse
              </p>
                <div  class="row py-5">
                  {{-- Pagination --}}
                  <div class="d-flex justify-content-end">
                    {!! $data->links() !!}
                  </div>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END SECTION MESSAGE -->

  <script type="text/javascript">
    let route = "{{ url('/autocomplete-search') }}";
    $('#searchPeopleName').typeahead({
      source: function (query, process) {
        return $.get(route, {
          query: query
        }, function (data) {
          return process(data);
        });
      }
    });
  </script>
  <script type="text/javascript">
    let route_user_company = "{{ url('/autocomplete-company-search') }}";
    $('#searchCompany').typeahead({
      source: function (term, process) {
        return $.get(route_user_company, {
          term: term
        }, function (data) {
          return process(data);
        });
      }
    });
  </script>
@endsection



