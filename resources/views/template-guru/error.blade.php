<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        text-align: center;
        padding: 50px;
    }

    h1 {
        font-size: 50px;
        margin: 0;
    }

    h2 {
        margin: 10px 0;
    }

    p {
        font-size: 18px;
        margin: 20px 0;
    }

    a {
        color: #007BFF;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    img {
        max-width: 20%;
        height: auto;
        margin: 20px 0;
    }
    </style>
</head>

<body>
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <img src="{{ asset('assets/images/404-error.png') }}" alt="404 Error">
    <p>Sorry, the page you are looking for does not exist.</p>
    <p>
        <button onclick="window.history.back();"
            style="background-color: #007BFF; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
            Go to Previous Page
        </button>
    </p>
</body>

</html>
<meta charset="UTF-8">