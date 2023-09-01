<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Admin - No Pulp</title>

        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="/css/auth.css">
        @yield('css')
    </head>
    <body class="text-center">
        <main>
            {{-- @include('admin.layouts.sidebar') --}}
            <article style="width:100%; overflow-y: scroll;" class="text-start">
                {{-- @include('admin.layouts.top')
                @include('admin.layouts.alerts') --}}
                <div class="container py-3">
                    @yield('content')
                </div>
                {{-- @include('admin.layouts.footer') --}}
            </article>
        </main>
        <script type="text/javascript" src="/js/app.js"></script>
        <script src="https://cdn.tiny.cloud/1/03xc5vammwoyka8022s0e8q1x8qb454jueaaja5b7cm44u8s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        @yield('js')
        <script>
            tinymce.init({
                selector: 'textarea.tinymce',
                plugins: "link lists link table hr wordcount code",
                toolbar: "undo redo | code styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link hr paste wordcount",
                paste_data_images: true,
                setup : function(editor) {
                    editor.on("change keyup", function(e){
                        tinyMCE.triggerSave();
                        editor.save();
                        window.$(editor.getElement()).trigger('change');
                    });
                }
            });
        </script>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>