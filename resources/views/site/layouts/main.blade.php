<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog</title>

    @include("site.partials.style")

</head>

<body>

    <!-- Navigation -->
    @include("site.partials.navbar")

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url(@yield('bg-img'))">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @if (Route::currentRouteName() == 'site.post')
                    <div class="post-heading">
                        <h1>@yield('title')</h1>
                        <h2 class="subheading"></h2>
                        <span class="meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</span>
                    </div>
                    @else
                    <div class="site-heading">
                        <h1>@yield('title')</h1>
                        <hr class="small">
                        <span class="subheading">@yield('subheading')</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield("content")

    <hr>

    <!-- Footer -->
    @include("site.partials.footer")

    {{-- Javascript --}}
    @include("site.partials.script")

</body>

</html>
