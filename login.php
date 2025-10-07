<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SAW</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <style>
        #auth {
            background-image: url("assets/images/IT-BACKGROUND.jpg");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        #overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.4); 
            z-index: 1;
        }
        #auth-left {
            background: #800000;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 2;
            width: 40%;
            text-align: center;
        }
        .form-control {
            border-radius: 25px;
            margin-bottom: 1rem;
            background-color:linear-gradient(180deg, #800000 0%, #A52A2A 40%, #F5F5DC 100%);
            font-size: 14px; 
            padding: 8px 15px; 
            height: 40px;
        }
        .btn-custom {
            border-radius: 25px;
            background-color: #F5F5DC ;
            color: black;
            width: 150px;
            border: none;
    }
  </style>
</head>
<body>

<div id="auth">
  <div id="overlay"></div> <!-- untuk efek gelap -->
  <div id="auth-left">
    <h4 class="auth-title" style="font-size:30px; color:rgb(255, 255, 255);">Login</h4>
    <form action="login-act.php" method="post">
      <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" class="form-control form-control-xl mb-3" placeholder="Username" name="username">
      </div>
      <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl mb-3" placeholder="Password" name="password">
      </div>
      <button type="submit" class="btn btn-custom mt-3">Login</button>
    </form>
  </div>
</div>

</body>

</html>
