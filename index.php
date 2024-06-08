<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laundry Washenjoy</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS untuk footer tetap di bawah */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #D3D3D3;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .content {
            flex: 1;
            text-align: center;
        }

        .footer {
            background-color: #6495ED;
            color: #fff;
            font: bold;
            padding: 10px 0;
            text-align: center;
        }

        .navbar-brand{
          font-size: 30px;
        }

        .background-image {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-image: url('');
          opacity: 0.3; /* Ubah opasitas sesuai kebutuhan */
          z-index: -1;
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <a class="navbar-brand" href="index.php"><em><b style="color: white; font-size: 20px;">Laundry Washenjoy</b></em></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"><b>Home</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="modal" data-target="#loginModal"><b>Login</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="modal" data-target="#myModal"><b>Registrasi</b></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="background-image"></div>
    <!-- Header -->
    <div class="container mt-5">
        <header>
            <h3 align="center"><b>Selamat Datang di Laundry Washenjoy</b></h3>
        </header>
    </div>

    <!-- Content -->
    <div class="content mt-3">
        <img src="enjoy.png" alt="Logo Makalah" style="max-width: 300px;">
        <p class="mt-3"><b style="font-size: 20px;">Sistem Informasi B 2022 Unesa</b><br> 
         
        </p>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p><b>&copy; 2024 Laundry Washenjoy</b></p>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="proses_login.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input style="text-align: center;" type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input style="text-align: center;" type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Registrasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="daftar.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama" placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Registrasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>