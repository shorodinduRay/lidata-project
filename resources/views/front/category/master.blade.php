@extends('front.master')

@section('title')
    @yield('peopleTitle')
@endsection


@section('main')
   @yield('peopleMain')

@endsection



<!-- jQuery -->
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
></script>

<!-- Search js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Custom JS -->
<script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

<script type="text/javascript">
    let route_people = "{{ url('/autocomplete-search') }}";
    $('#searchPeople').typeahead({
        source: function (query, process) {
            return $.get(route_people, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>

<script type="text/javascript">
    let route_company = "{{ url('/autocomplete-company-search') }}";
    $('#searchCompany').typeahead({
        source: function (term, process) {
            return $.get(route_company, {
                term: term
            }, function (data) {
                return process(data);
            });
        }
    });
</script>


