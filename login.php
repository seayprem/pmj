<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/signin.css">
  <link rel="stylesheet" href="css/fonts.css">
</head>
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
    <form>

      <div class="text-center">
        <img class="mb-4" src="img/pmj_logo.png" alt="" width="160" height="150">
        <h1 class="h3 mb-3 fw-normal">กรุณาเข้าสู่ระบบ</h1>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">ชื่อผู้ใช้</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">รหัสผ่าน</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">เข้าสู่ระบบ</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
  </main>



  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>