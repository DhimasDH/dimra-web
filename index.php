<?php 
//koneksi ke database
include './assets/func.php';
$air=new kelas_air;
$koneksi=$air->koneksi();
//masuk database
// $pass=password_hash("warga7", PASSWORD_DEFAULT);
// mysqli_query($koneksi, "INSERT INTO user(username,password,nama,alamat,kota,telepon,level,tipe,status) VALUES ('warga7','$pass','warga7','Tembalang','Semarang','024123','warga','Kos','AKTIF')");
// if(mysqli_affected_rows($koneksi) > 0) echo "data berhasil masuk";
// else echo "data gagal";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - DIMRA</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-image: url('assets/img/logobg.jpg'); background-size: cover; background-repeat: no-repeat; backgorund-position: center;">
        <div id="layoutAuthentication"> <img class="img-fluid rounded-circle ms-3 my-1" src="./assets/img/logokita.jpg" style="width:50px;height:50px;"/>
            <div id="layoutAuthentication_content"> 
                <main>
                    <div class="container"> 
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style="background-color: rgba(255,255,255,0); backdrop-filter: blur(5px);">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-white">Login</h3></div>
                                    <div class="card-body">
                                        <?php 
                                        if (isset($_POST['tombol'])) {
                                            $username=$_POST['user'];
                                            $password=$_POST['password'];
                                            // echo "user: $username & pass: $password";

                                            // cek user
                                            $qc=mysqli_query($koneksi, "SELECT username,password FROM user WHERE username='$username'");
                                            $dc=mysqli_fetch_row($qc);

                                            if(!empty($dc[0])) $user_cek=$dc[0];
                                            

                                            if(!empty($user_cek)) {
                                                //cek password
                                                $pass_cek=$dc[1];
                                                
                                                // verifikasi password
                                                if(password_verify($password,$pass_cek)) {
                                                    // daftarkan session
                                                    session_start();
                                                    $_SESSION['user']=$username;
                                                    $_SESSION['pass']=$password;

                                                    //redirect ke dashboard page
                                                    echo "<script>window.location.replace('./login/index.php')</script>";
                                                } else{
                                                    echo"<div class=\"alert alert-danger alert-dismissible fade show\">
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Login</strong> Salah.
                                                </div>";
                                                }
                                            }
                                            else {
                                                echo"<div class=\"alert alert-danger alert-dismissible fade show\">
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Username</strong> tidak ketemu.
                                                </div>";
                                            }
                                        }
                                        ?>
                                        <form method="post" class="needs-validation">
                                            <div class="form-floating mb-3">
                                                <input class="form-control text-white" id="inputauser" type="text" placeholder="Username" name="user" style="background-color: rgba(255,255,255,0);" required />
                                                <label for="inputUser" class="text-white">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control text-white" id="inputPassword" type="password" placeholder="Password" name="password" style="background-color: rgba(255,255,255,0);" required />
                                                <label for="inputPassword" class="text-white">Password</label>
                                            </div>
                                            <div class="form-check mb-3 d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" style="background-color: rgba(255,255,255,0); border: solid white;"/>
                                                <label class="form-check-label text-white" for="inputRememberPassword" style="margin-right: 130px;">Remember Password</label>
                                                <a class="small text-white" href="password.html">Forgot Password?</a>
                                            </div>
                                            <div class="d-flex align-items-center mt-4 mb-0">
                                                <input type="submit" name="tombol" value="Login" class="btn btn-primary" style="width: 100%;">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html" class="text-white">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; DIMRA <?php echo date("Y")?></div>
                            <div>
                                <a href="./profile/index.html"><b>Our Profile</b></a>
                                &middot;
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
