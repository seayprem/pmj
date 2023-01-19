<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/signin.css">
  <link rel="stylesheet" href="css/fonts.css">
</head>
<body>
  <style>
    .btn-primary {
      background: #EC1B89 !important;
    }

    .btn-primary:hover {
      opacity: 0.8 !important;
    }

  </style>
<body>
  <main class="form-signin">
    <div class="text-center">
      <img class="mb-4" src="img/pmj_logo.png" alt="" width="160" height="150">
    </div>
    
    <h1 class="h3 mb-3 fw-normal text-center">เข้าสู่ระบบ</h1>
    <div class="form-floating">
        <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">ชื่อผู้ใช้</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">รหัสผ่าน</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" name="login" type="submit" id="login">เข้าสู่ระบบ</button>
      <p class="mt-3 text-muted">&copy; 2023 - สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</p>
  </main>


  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/sweetalert2@11.js"></script>


  <script>
    $(document).ready(function() {
      

      $('#login').on('click', function(e) {

        // form input
        let username = $('#floatingInput').val();
        let password = $('#floatingPassword').val();

        e.preventDefault();

        // Check Validation
        if(!username || !password) {
          Swal.fire({
            icon: 'error',
            title: 'โปรดใส่ชื่อผู้ใช้และรหัสผ่าน',
            showConfirmButton: true,
            confirmButtonColor: '#EC1B89',
            color: '#000'
          })
        } else {
          $.ajax({
            url: 'checkLogin.php',
            method: 'POST',
            data: {
              username: username,
              password: password,
              login: 'login'
            },
            success: function(response) {
              // console.log(response);
              if(response === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'เข้าสู่ระบบสำเร็จ',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  window.location = "offices.php";
                })
              } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'เข้าสู่ระบบไม่สำเร็จ โปรดตรวจสอบชื่อผู้ใช้และรหัสผ่าน',
                    showConfirmButton: true,
                    confirmButtonColor: '#EC1B89',
                    color: '#000'
                }).then((result) => {
                  window.location = "login.php";
                  
                })
              }
            }
          })
        }

      })
    })
  </script>

</body>
</html>