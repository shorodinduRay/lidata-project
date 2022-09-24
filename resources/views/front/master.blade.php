<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="description" content="" />
  <meta name="keywords" content="li data," />

    <title>@yield('title')</title>

@include('front.includes.css')
</head>

<body id="home">
<header>
    @include('front.includes.header')
</header>

<!-- START NAVBAR FOR SMALL SCREEN -->
@include('front.includes.smallScreen')
<!-- END NAVBAR FOR SMALL SCREEN -->
<main>
  
    @yield('main')

  <!-- START CATAGORIES -->
  <section class="section-categories bg-light u-padding-lg">
      <div class="container">
        <div class="row mb-3">
          <div class="col-md-12 border-bottom">
            <h5 class="sub-heading">Browse Lidata's Directories</h5>
          </div>
        </div>
        <div class="row py-5 px-3">
          <div class="col-md-6 pe-4">
            <div class="d-flex align-items-center border-bottom pb-3 mb-4">
              <div class="circle-element circle-element--person">
                <i class="bi bi-people-fill"></i>
              </div>
              <span class="sub-heading">Person Search</span>
            </div>
            <div>
              <a href="{{ route('category', ['id' => 'A'])  }}" class="blue-link">A</a>
              <a href="{{ route('category', ['id' => 'B'])  }}" class="blue-link">B</a>
              <a href="{{ route('category', ['id' => 'C'])  }}" class="blue-link">C</a>
              <a href="{{ route('category', ['id' => 'D'])  }}" class="blue-link">D</a>
              <a href="{{ route('category', ['id' => 'E'])  }}" class="blue-link">E</a>
              <a href="{{ route('category', ['id' => 'F'])  }}" class="blue-link">F</a>
              <a href="{{ route('category', ['id' => 'G'])  }}" class="blue-link">G</a>
              <a href="{{ route('category', ['id' => 'H'])  }}" class="blue-link">H</a>
              <a href="{{ route('category', ['id' => 'I'])  }}" class="blue-link">I</a>
              <a href="{{ route('category', ['id' => 'J'])  }}" class="blue-link">J</a>
              <a href="{{ route('category', ['id' => 'K'])  }}" class="blue-link">K</a>
              <a href="{{ route('category', ['id' => 'L'])  }}" class="blue-link">L</a>
              <a href="{{ route('category', ['id' => 'M'])  }}" class="blue-link">M</a>
              <a href="{{ route('category', ['id' => 'N'])  }}" class="blue-link">N</a>
              <a href="{{ route('category', ['id' => 'O'])  }}" class="blue-link">O</a>
              <a href="{{ route('category', ['id' => 'P'])  }}" class="blue-link">P</a>
              <a href="{{ route('category', ['id' => 'Q'])  }}" class="blue-link">Q</a>
              <a href="{{ route('category', ['id' => 'R'])  }}" class="blue-link">R</a>
              <a href="{{ route('category', ['id' => 'S'])  }}" class="blue-link">S</a>
              <a href="{{ route('category', ['id' => 'T'])  }}" class="blue-link">T</a>
              <a href="{{ route('category', ['id' => 'U'])  }}" class="blue-link">U</a>
              <a href="{{ route('category', ['id' => 'V'])  }}" class="blue-link">V</a>
              <a href="{{ route('category', ['id' => 'W'])  }}" class="blue-link">W</a>
              <a href="{{ route('category', ['id' => 'X'])  }}" class="blue-link">X</a>
              <a href="{{ route('category', ['id' => 'Y'])  }}" class="blue-link">Y</a>
              <a href="{{ route('category', ['id' => 'Z'])  }}" class="blue-link">Z</a>
            </div>
          </div>
          <div class="col-md-6 ps-4">
            <div class="d-flex align-items-center border-bottom pb-3 mb-4">
              <div class="circle-element circle-element--company">
                <i class="bi bi-briefcase-fill"></i>
              </div>
              <span class="sub-heading">Company Search</span>
            </div>
            <div>
            <a href="{{ route('category-company', ['id' => 'A'])  }}" class="blue-link ">A</a>
            <a href="{{ route('category-company', ['id' => 'B'])  }}" class="blue-link  ">B</a>
            <a href="{{ route('category-company', ['id' => 'C'])  }}" class="blue-link  ">C</a>
            <a href="{{ route('category-company', ['id' => 'D'])  }}" class="blue-link  ">D</a>
            <a href="{{ route('category-company', ['id' => 'E'])  }}" class="blue-link  ">E</a>
            <a href="{{ route('category-company', ['id' => 'F'])  }}" class="blue-link  ">F</a>
            <a href="{{ route('category-company', ['id' => 'G'])  }}" class="blue-link  ">G</a>
            <a href="{{ route('category-company', ['id' => 'H'])  }}" class="blue-link  ">H</a>
            <a href="{{ route('category-company', ['id' => 'I'])  }}" class="blue-link  ">I</a>
            <a href="{{ route('category-company', ['id' => 'J'])  }}" class="blue-link  ">J</a>
            <a href="{{ route('category-company', ['id' => 'K'])  }}" class="blue-link  ">K</a>
            <a href="{{ route('category-company', ['id' => 'L'])  }}" class="blue-link  ">L</a>
            <a href="{{ route('category-company', ['id' => 'M'])  }}" class="blue-link  ">M</a>
            <a href="{{ route('category-company', ['id' => 'N'])  }}" class="blue-link  ">N</a>
            <a href="{{ route('category-company', ['id' => 'O'])  }}" class="blue-link  ">O</a>
            <a href="{{ route('category-company', ['id' => 'P'])  }}" class="blue-link  ">P</a>
            <a href="{{ route('category-company', ['id' => 'Q'])  }}" class="blue-link  ">Q</a>
            <a href="{{ route('category-company', ['id' => 'R'])  }}" class="blue-link  ">R</a>
            <a href="{{ route('category-company', ['id' => 'S'])  }}" class="blue-link  ">S</a>
            <a href="{{ route('category-company', ['id' => 'T'])  }}" class="blue-link  ">T</a>
            <a href="{{ route('category-company', ['id' => 'U'])  }}" class="blue-link  ">U</a>
            <a href="{{ route('category-company', ['id' => 'V'])  }}" class="blue-link  ">V</a>
            <a href="{{ route('category-company', ['id' => 'W'])  }}" class="blue-link  ">W</a>
            <a href="{{ route('category-company', ['id' => 'X'])  }}" class="blue-link  ">X</a>
            <a href="{{ route('category-company', ['id' => 'Y'])  }}" class="blue-link  ">Y</a>
            <a href="{{ route('category-company', ['id' => 'Z'])  }}" class="blue-link  ">Z</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END CATAGORIES -->
</main>

<!-- START FOOTER -->
@include('front.includes.footer')
<!-- END FOOTER -->

@include('front.includes.js')

<!-- TYPEWRITER JS -->
<script>
    let bannerText = document.getElementById('bannerText');

    let typewriter = new Typewriter(bannerText, {
        loop: false,
        delay: 50,
        cursor: ' ',
    });

    typewriter
        .typeString('Crush your sales numbers every quarter')
        .pauseFor(1500)
        // .deleteAll()
        .start();
</script>

<!-- ANIMATION JS -->
<script>
    AOS.init({
        once: true,
    });
</script>


</body>
</html>
