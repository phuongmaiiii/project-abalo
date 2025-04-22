<nav id="navbar">
    <img src="{{asset('/images/abalo.png')}}" alt="logo" class="logo">
</nav>
<script>
    window.articleCategories = @json($categories ?? []);
</script>
<script src="{{ asset('/js/homepage.js') }}"></script>
<script src="{{ asset('/js/cookiecheck.js') }}"></script>
