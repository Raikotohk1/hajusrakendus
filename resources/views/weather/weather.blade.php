<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather in {{ $weatherData['name'] }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Weather in {{ $weatherData['name'] }}</h1>
        <div class="weather-info">
            <p><strong>Temperature:</strong> {{ $weatherData['main']['temp'] }} °C</p>
            <p><strong>Feels Like:</strong> {{ $weatherData['main']['feels_like'] }} °C</p>
            <p><strong>Wind:</strong> {{ $weatherData['wind']['speed'] }} m/s</p>
            <p><strong>Cloudiness:</strong> {{ $weatherData['clouds']['all'] }}%</p>
            <p><strong>Visibility:</strong> {{ $weatherData['visibility'] }} meters</p>
            <p><strong>Humidity:</strong> {{ $weatherData['main']['humidity'] }}%</p>
            
            @if (isset($weatherData['weather']) && count($weatherData['weather']) > 0)
                <p><strong>Weather:</strong> {{ $weatherData['weather'][0]['main'] }}</p>
                <p><strong>Description:</strong> {{ $weatherData['weather'][0]['description'] }}</p>
                <p>
                    <img src="http://openweathermap.org/img/w/{{ $weatherData['weather'][0]['icon'] }}.png" alt="Weather Icon">
                </p>
            @endif
        </div>
    </div>
</body>
</html>
