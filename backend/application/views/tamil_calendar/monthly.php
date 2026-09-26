<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <title>தமிழ் தினசரி நாட்காட்டி</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Latha', 'Noto Sans Tamil', sans-serif;
    }

    .header {
      text-align: center;
      padding: 12px;
      background: #152032;
      color: #fff;
      font-size: 20px;
      font-weight: bold;
    }

    iframe {
      width: 100%;
      height: calc(100vh - 50px); /* full viewport minus header */
      border: none;
      display: block;
    }

    @media (max-width: 480px) {
      .header {
        font-size: 16px;
        padding: 10px;
      }
      iframe {
        height: calc(100vh - 40px);
      }
    }
  </style>
</head>
<body>

  <div class="header">தமிழ் தினசரி நாட்காட்டி</div>

  <iframe src="https://www.tamildailycalendar.com/tamil_daily_calendar.php"
          title="Tamil Daily Calendar" loading="lazy"></iframe>

</body>
</html>
