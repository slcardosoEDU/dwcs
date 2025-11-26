# Ejercicios de la Unidad 2
> Aquí se irán publicando las soluciones a los ejercicios del aula virtual resueltos en clase. Normalmente un ejercicio tiene múltiples soluciones, si tu solución es diferente a la planteada en esta sección no tiene porque estar mal.
## [Actividad 2.2: Juego del número secreto](2_2)
1. Vamos a escribir una aplicación web en PHP para jugar al juego del número secreto.
Es un juego clásico que consiste en lo siguiente: el ordenador elegirá un número al azar entre 1 y 1000 y el jugador tendrá que averiguarlo. Cada vez que el jugador haga un intento, la aplicación le indicará si el número secreto es mayor o menor que el número introducido. Cuando el jugador por fin acierte, la aplicación le dará la enhorabuena y le indicará cuántos intentos ha necesitado para averiguar el número secreto y cuanto tiempo ha tardado en acertarlo.

2. Amplia el juego para que el número máximo de intentos sea 10. Una vez alcanzado este número el programa le indicará al usuario que ha perdido y le mostrará la solución.

3. Amplia el juego para que, antes de empezar a jugar, el usuario pueda introducir un nombre de usuario. Debe almacenarse en una base de datos, las victorias de cada usuario, registrando el número a acertar, los intentos empleados y el tiempo que ha tardado en acertarlo. Estos resultados podrán consultarse en una página ranking.

## [Actividad 2.3](2_3)
* Ejercicio 1: formato de presentación
Realiza las modificaciones necesarias en el código del ejercicio1.zip para cumplir con las siguientes especificaciones:
Por defecto se aplican los estilos default.css.
Mediante el combo estilo el usuario puede cambiar entre los estilos: default, oscuro, claro o matrix. Este estilo debe recordarse durante una semana para este cliente.
Al presionar en el enlace limpiar se borrarán las preferencias del usuario (volviendo a aplicar el estilo default).
* Ejercicio 2: control de acceso
Implementa el control de acceso a una web con una zona restringida a la que solo puedan acceder usuarios previamente autenticados. Los usuarios no autenticados deben poder acceder a las páginas de login y de registro, pero no a la sección restringida. Si un usuario no autenticado intenta acceder a la sección restringida será redireccionado al login. Además, los usuarios podrán cerrar sesión pulsando logout desde la sección restringida.

En cuanto se registre un usuario será redireccionado a la sección restringida.

Si lo deseas puedes utilizar redirecciones cambiando los parámetros de cabecera http con el método header(). Por ejemplo, para realizar una redirección a la página login.php puedes hacer header("Location: login.php");

Utiliza los ficheros base contenidos en ejercicio2.zip

* Ejercicio 3: Manejo conjunto de cookies y sesiones
Modifica el ejercicio anterior para incluir una casilla de verificación "Recuérdame".

Si el usuario marca esta casilla al iniciar sesión, guarda el nombre de usuario en una cookie que dure 30 días.

Al visitar la página nuevamente:

Si existe una sesión activa, el usuario será redirigido automáticamente a la página protegida.
Si no hay sesión activa pero la cookie existe, completa automáticamente el campo de nombre de usuario en el formulario de inicio de sesión.
Si no hay sesión ni cookie, muestra el formulario vacío.
* Ejercicio 4: Seguridad ante el robo de sesiones.
Modifica el ejercicio anterior para mitigar el riesgo de robo de la cookie de sesión. Para ello impide que se pueda acceder a la cookie de sesión mediante javascript y fuerza a que se renueve la cookie de sesión cada 10 minutos.

* Ejercicio 5: Implementar un carrito de compras
Crea un sistema de carrito de compras sencillo:
Usa una sesión para guardar una lista de productos seleccionados por el usuario.
El carrito debe permitir añadir, eliminar y mostrar productos.
Implementa cookies para recordar al usuario:
Guarda una cookie con un identificador único del carrito de compras que dure 2 días.
Si el usuario vuelve a la página antes de que la cookie expire, la sesión debe restablecerse con los productos previamente agregados.
Asegúrate de que el carrito se reinicie correctamente si la cookie o la sesión expiran.

## [Actividad 2.4](2_4)
Implementa una aplicación completa (BD, vistas y lógica de negocio) que respete las especificaciones del publicado en el aula virtual.
