<!DOCTYPE html>
<html lang="tr">
<x-admin.head-components />
<body id="page-top">
    <div id="wrapper">
        {{-- Sidebar --}}
        <x-admin.side-bar-components />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Header --}}
                 <x-admin.top-bar-components />
                 <div class="container-fluid">
                  @yield('content')
                </div>
            </div>
            {{-- Footer --}}
            <x-admin.footer-components />
        </div>
    </div>
    {{-- Başa Dön Button --}}
    <x-admin.button-top-bar-components />
    {{-- Profil Modalı --}}
    <x-admin.log-out-modal-components />
    {{-- JavaScript --}}
    <x-admin.java-script-components />
    @stack('js')
    @include('sweetalert::alert')
</body>
</html>
