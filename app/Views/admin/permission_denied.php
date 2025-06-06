<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Permission Denied</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .container {
      background: #fff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 90%;
    }

    .icon {
      font-size: 50px;
      color: #dc3545;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 24px;
      color: #333;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
    }

    a.button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s;
    }

    a.button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="icon">🔐</div>
  <h1>Oops! It looks like you don’t have permission to access this feature.</h1>
  <p>Please contact the administrator if you believe this is an error.</p>
  <a href="<?= base_url('admin/') ?>" class="button">Go Back</a>
</div>

</body>
</html>
