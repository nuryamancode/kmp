<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

@include('layout.head')

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('layout.side')

            <div class="layout-page">

                @include('layout.nav')


                <div class="content-wrapper">

                    <div class="container-xxl grow container-p-y">
                        @yield('content')
                    </div>

                    @include('layout.foot')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

</body>

</html>
