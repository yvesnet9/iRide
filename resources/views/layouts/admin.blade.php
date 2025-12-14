<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin EcoRide</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    {{-- AdminLTE minimal icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        body { display: flex; min-height: 100vh; }
        .sidebar {
            width: 220px;
            background: #1e1e2f;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3>EcoRide Admin</h3>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
        <a href="#"><i class="fa fa-users"></i> Utilisateurs</a>
        <a href="#"><i class="fa fa-car"></i> Covoiturages</a>
        <a href="#"><i class="fa fa-cog"></i> Paramètres</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
