# pruebaApiClima
Prueba de Validar el Clima

La **pruebaApiClima** es una aplicación web que permite a los usuarios consultar el clima actual de su ubicación o ingresar manualmente el nombre de una ciudad para obtener la información meteorológica. Utiliza la API de OpenWeather para obtener los datos y permite a los usuarios autenticados ver un historial de sus consultas.

## Funcionalidades

- **Registro e inicio de sesión de usuarios.**
- **Consulta del clima actual** mediante la API de OpenWeather, usando geolocalización o ingreso manual de la ciudad.
- **Historial de consultas:** Los usuarios autenticados pueden ver el historial de sus consultas meteorológicas, que incluye:
  - Ciudad
  - Temperatura
  - Descripción del clima (soleado, lluvioso, etc.)
  - Fecha y hora de la consulta.
- **Almacenamiento de datos:** Toda la información se asocia a un usuario autenticado y se almacena en una base de datos MySQL.

## Decisiones Técnicas

- **PHP y MySQL:** Se escogió PHP como lenguaje del servidor por su simplicidad y popularidad. MySQL se usa para almacenar usuarios y sus consultas meteorológicas. 
- **OpenWeather API:** Ofrece acceso a datos meteorológicos precisos y actualizados. Permite obtener información como temperatura, humedad, velocidad del viento y descripciones del clima.
- **Geolocalización HTML5:** Facilita la obtención de la ubicación actual del usuario para realizar consultas automáticas del clima.
- **Bootstrap 4:** Se usa para el diseño responsivo de la interfaz, lo que asegura que la aplicación se vea bien en diferentes tamaños de pantalla.

## Instalación

### Requisitos

- **PHP >= 7.0**
- **MySQL >= 5.7**
- **Servidor web (Apache o Nginx)**
- **Composer** (opcional, si se utilizan bibliotecas adicionales en PHP

   ### Ambiente Demo

   - HOME https://transauktion.com/

   - ![image](https://github.com/user-attachments/assets/7e050428-0143-4bf5-ae54-441dd8a7b08e)

    -LOGIN  https://transauktion.com/home/ladingpage/login.php

    ![image](https://github.com/user-attachments/assets/91db5e1f-08a8-47a7-91c4-90abb6a185ff)


      Puedes probar una versión funcional de la aplicación en el siguiente enlace:
      
      Demo: https://transauktion.com/
      
      Credenciales de acceso para el demo:
      -Usuario: prueba@prueba.com
      -Contraseña: 123456
      Funcionalidades del demo:
      Consulta el clima actual de cualquier ciudad.
      Consulta el clima de tu ubicación usando la geolocalización.
      Revisa el historial de consultas meteorológicas realizadas por el usuario autenticado.

![image](https://github.com/user-attachments/assets/98e13ea8-c17b-4c05-a533-4116cb96a089)

         ###  Estructura de la Base de Datos
      El archivo weather_app.sql incluye la estructura de las siguientes tablas:
      
      users: Almacena los usuarios registrados en la aplicación.
      weather_queries: Almacena las consultas del clima realizadas por los usuarios, con campos como ciudad, temperatura, descripción del clima, fecha y hora de la consulta, y una relación con el usuario autenticado.
      API Utilizada
      OpenWeather API: https://openweathermap.org/api
      La API de OpenWeather proporciona datos meteorológicos precisos y actualizados. Asegúrate de obtener una clave API antes de ejecutar la aplicación.
   
