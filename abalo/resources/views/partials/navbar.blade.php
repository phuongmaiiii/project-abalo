<nav id="navbar">
    <img src="{{asset('/images/abalo.png')}}" alt="logo" class="logo">
</nav>
<script>
    window.articleCategories = @json($categories ?? []);
</script>
@vite('resources/js/homepage.js')
@vite('resources/js/cookiecheck.js')

