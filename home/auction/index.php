<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta del Clima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Consulta el Clima</h1>
    
    <!-- Formulario para ingresar ciudad o usar geolocalización -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Ingrese una ciudad o use su ubicación actual</h5>
            <form id="weatherForm" class="mb-3">
                <div class="mb-3">
                    <label for="cityInput" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="cityInput" placeholder="Ingresa una ciudad">
                </div>
                <button type="button" class="btn btn-primary" id="getWeatherByCity">Consultar por Ciudad</button>
                <button type="button" class="btn btn-secondary" id="getWeatherByLocation">Usar mi Ubicación</button>
            </form>
        </div>
        <a href="../ladingpage/logout.php" onclick="borrarTodo()"  class="dropdown-item" for="language" data-translate-key="textsignoff">Cerrar Sesión</a>
    </div>

    <!-- Resultado del clima actual -->
    <div id="weatherResult" class="card mt-4" style="display:none;">
        <div class="card-body">
            <h5 id="cityName" class="card-title"></h5>
            <p id="weatherDescription" class="card-text"></p>
            <p id="temperature" class="card-text"></p>
            <p id="dateTime" class="card-text"></p>
        </div>
    </div>

    <!-- Historial de consultas -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Historial de Consultas</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>Temperatura</th>
                        <th>Descripción</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody id="weatherHistory">
                    <!-- Aquí se agregará el historial con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const apiKey = '0673ada8f3f6dad65c95b9f4871815e5';

    // Función para obtener el clima por ciudad
    $('#getWeatherByCity').on('click', function() {
        const city = $('#cityInput').val();
        if (city !== '') {
            getWeatherByCity(city);
        } else {
            alert('Por favor ingresa una ciudad.');
        }
    });

    // Función para obtener el clima por geolocalización
    $('#getWeatherByLocation').on('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                getWeatherByCoords(lat, lon);
            });
        } else {
            alert('La geolocalización no es soportada por este navegador.');
        }
    });

    // Obtener clima usando el nombre de la ciudad
    function getWeatherByCity(city) {
        $.get(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=es`, function(data) {
            displayWeather(data);
            saveWeatherToDB(data);
        }).fail(function() {
            alert('No se pudo obtener el clima para esa ciudad.');
        });
    }

    // Obtener clima usando coordenadas
    function getWeatherByCoords(lat, lon) {
        $.get(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=es`, function(data) {
            displayWeather(data);
            saveWeatherToDB(data);
        }).fail(function() {
            alert('No se pudo obtener el clima para esa ubicación.');
        });
    }

    // Mostrar el clima en el componente
    function displayWeather(data) {
        $('#cityName').text(data.name);
        $('#weatherDescription').text(`Clima: ${data.weather[0].description}`);
        $('#temperature').text(`Temperatura: ${data.main.temp} °C`);
        const dateTime = new Date().toLocaleString();
        $('#dateTime').text(`Fecha y Hora: ${dateTime}`);

        $('#weatherResult').show();
    }

    // Guardar el clima en la base de datos (simulación)
    function saveWeatherToDB(data) {
        const weatherData = {
            city: data.name,
            temperature: data.main.temp,
            description: data.weather[0].description,
            dateTime: new Date().toLocaleString()
        };

        // Simular almacenamiento en la base de datos
        // En producción, aquí realizarías una solicitud AJAX para guardar en la base de datos.
        // Ejemplo: $.post('/guardar-clima', weatherData);

        // Añadir al historial de consultas (simulación)
        addToHistory(weatherData);
    }

    // Agregar al historial
    function addToHistory(weatherData) {
        const row = `<tr>
                        <td>${weatherData.city}</td>
                        <td>${weatherData.temperature} °C</td>
                        <td>${weatherData.description}</td>
                        <td>${weatherData.dateTime}</td>
                    </tr>`;
        $('#weatherHistory').append(row);
    }
</script>
</body>
</html>
