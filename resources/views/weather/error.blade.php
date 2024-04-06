<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Occurred</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">An Error Occurred!</h4>
            <p>A problem has been encountered while attempting to fetch the weather information. Please try again later.</p>
            <hr>
            <p class="mb-0">Error Details: {{ $error }}</p>
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home</a>
    </div>
</body>
</html>
