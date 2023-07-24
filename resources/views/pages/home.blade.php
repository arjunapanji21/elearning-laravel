<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />
        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset('img/logo.png') }}"
        />

        <title>SMK Negeri 4 Kota Jambi</title>
</head>
<body>
    <div class="w-full py-4 hover:bg-accent bg-primary text-center">
        <a href="{{route('user.login')}}" class="text-base-100 font-bold">Login kedalam Aplikasi E-learning SMK Negeri 4 Kota Jambi</a>
    </div>
    <div>
        <iframe src="https://smkn4kotajambi.sch.id/" class="min-h-screen" width="100%" height="100%" frameborder="0"></iframe>
    </div>
</body>
</html>