<!doctype html>
<html lang="tr">
{{-- head --}}
@extends('article.template.head')
<body>
    @include('article.template.navbar')
    <div class="container">
        @yield('content')
    </div>
    {{-- JavaScript --}}
    @extends('article.template.javascript')
</body>

</html>
