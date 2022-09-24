   <!-- START NAVBAR FOR SMALL SCREEN -->
   <div class="d-lg-none d-flex">
    <div class="navbar__logo ms-md-5 ms-2 ps-5">
      <a class="navbar-brand d-flex" href="/">
        <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name-dark.svg" alt="logo" />
      </a>
    </div>
    <div class="navigation">
      <input type="checkbox" class="navigation__checkbox" id="navi-toggle" />

      <label for="navi-toggle" class="navigation__button">
        <span class="navigation__icon">&nbsp;</span>
      </label>

      <div class="navigation__background">&nbsp;</div>

      <nav class="navigation__nav">
        <ul class="navigation__list">
          <li class="navigation__item">
            <a href="{{route('product')}}" class="navigation__link">Product</a>
          </li>
          <li class="navigation__item">
            <a href="{{route('packages')}}" class="navigation__link">Pricing</a>
          </li>
          <li class="navigation__item">
            <a href="" class="navigation__link">Blog</a>
          </li>
          <li class="navigation__item">
            <a href="{{route('career')}}" class="navigation__link">Careers</a>
          </li>
          <li class="navigation__item d-flex justify-content-center">
            <!-- START TRANSLATOR -->
            <a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="gflag nturl"
              style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="16" width="16"
                alt="English" /></a>

            <br /> <select onchange="doGTranslate(this);">
              <option value="">Select Language</option>
              <option value="en|zh-CN">Chinese (Simplified)</option>
              <option value="en|zh-TW">Chinese (Traditional)</option>
              <option value="en|en">English</option>
              <option value="en|fr">French</option>
              <option value="en|hi">Hindi</option>
              <option value="en|ja">Japanese</option>
              <option value="en|ko">Korean</option>
              <option value="en|pt">Portuguese</option>
              <option value="en|es">Spanish</option>
            </select>
            <div id="google_translate_element2"></div>
            <!-- END TRANSLATOR -->
          </li>
          <!-- <li class="navigation__item">
            <a href="phonelistUserLogin" class="navigation__link">Account</a>
          </li> -->

          @guest
                    <li class="navigation__item">
                        <a href="{{ route('user.login') }}" class="navigation__link"> Account </a>
                    </li>
                @else
                    <li class="navigation__item">
                        <a href="{{ route('loggedInUser') }}" class="navigation__link"> Account </a>
                    </li>
                @endguest
        </ul>
      </nav>
    </div>
  </div>
  <!-- END NAVBAR FOR SMALL SCREEN -->