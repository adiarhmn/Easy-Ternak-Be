<!DOCTYPE html>
<html lang="en">
<head>
    <title>Glassmorphism Login Form</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style>
      * {
          padding: 0;
          margin: 0;
          box-sizing: border-box;
      }
      body {
          background-color: #f5f5f5;
          font-family: 'Poppins', sans-serif;
      }
      .background {
          width: 430px;
          height: 600px;
          position: absolute;
          transform: translate(-50%,-50%);
          left: 50%;
          top: 50%;
      }
      .background .shape {
          height: 200px;
          width: 200px;
          position: absolute;
          border-radius: 50%;
      }
      .shape:first-child {
          background: linear-gradient(135deg, #cbb4d4, #e0c6f6);
          left: -80px;
          top: -80px;
      }
      .shape:last-child {
          background: linear-gradient(135deg, #d4a9f9, #e9d8fd);
          right: -30px;
          bottom: -80px;
      }
      form {
          width: 400px;
          background-color: rgba(255, 255, 255, 0.8);
          position: absolute;
          transform: translate(-50%,-50%);
          top: 60%;
          left: 50%;
          border-radius: 15px;
          backdrop-filter: blur(10px);
          border: 2px solid rgba(255, 255, 255, 0.2);
          box-shadow: 0 0 40px rgba(0,0,0,0.1);
          padding: 20px 35px 40px 35px;
      }
      .logo-container {
          text-align: center;
          margin-bottom: 20px;
          margin-top: 20px;
      }
      .logo-container img {
          width: 120px;
          height: auto;
          border-radius: 50%;
      }
      form h3 {
          font-size: 32px;
          font-weight: 600;
          line-height: 42px;
          text-align: center;
          color: #6b4c9a;
      }

      label {
          display: block;
          margin-top: 20px;
          font-size: 16px;
          font-weight: 500;
          color: #6b4c9a;
      }
      input {
          display: block;
          height: 50px;
          width: 100%;
          background-color: rgba(255, 255, 255, 0.6);
          border-radius: 5px;
          padding: 0 10px;
          margin-top: 8px;
          font-size: 14px;
          font-weight: 300;
          color: #333;
          border: 1px solid #ccc;
      }
      ::placeholder {
          color: #9c9c9c;
      }
      button {
          margin-top: 30px;
          width: 100%;
          background-color: #6b4c9a;
          color: #fff;
          padding: 15px 0;
          font-size: 18px;
          font-weight: 600;
          border-radius: 5px;
          cursor: pointer;
          border: none;
      }
      button:hover {
          background-color: #855cb3;
      }

      /* Media Query for Mobile Devices */
      @media (max-width: 768px) {
          .background {
              width: 100%;
              height: auto;
              top: 40%;
          }
          form {
              width: 80%;
              padding: 25px;
          }
          .logo-container img {
              width: 100px;
          }
          form h3 {
              font-size: 28px;
          }
          input, button {
              font-size: 16px;
          }
      }

      /* Media Query for smaller Mobile Devices */
      @media (max-width: 480px) {
          .background {
              width: 50%;
              height: auto;
              display: none;
            }
            form {
                width: 90% !important;
                padding: 20px;
                padding-bottom: 30px;
                top: 53%;
            }
            .logo-container img {
                width: 150px;
            }
          form h3 {
              font-size: 24px;
          }
          input {
              height: 45px;
              font-size: 14px;
          }
          button {
              padding: 12px 0;
              font-size: 16px;
          }
      }

      .custom-alert {
    padding: 15px;
    margin-bottom: 10px;
    margin-top: 10px;
    border: 1px solid #f5c6cb;
    background-color: #eb6974;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    font-family: Arial, sans-serif;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.custom-alert:hover {
    background-color: #f5c2c7;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="logo-container">
        <img src="/images/logo.jpg" alt="Logo">
    </div>
    <form action="/post-login" method="POST">
        @csrf
        <h3>Easy Ternak</h3>

  <!-- Pesan error jika login gagal -->
  <?php if (isset($errors) && $errors->has('login_error')): ?>
  <div class="custom-alert">
      <?= $errors->first('login_error'); ?>
  </div>
<?php endif; ?>

        <label for="username">Username</label>
        <input type="text" placeholder="Username or Email" name="username" id="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" id="password">

   
        <button>Log In</button>
    </form>
</body>
</html>
