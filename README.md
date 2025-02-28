
# Portal de APIs - Proyecto ITLA

Este es un portal web dinámico desarrollado en PHP que integra 10 APIs públicas para mostrar información variada de manera interactiva. El proyecto es parte de la asignatura de Desarrollo de Software en el ITLA.

## Requisitos

- PHP 8.0 o superior.
- Servidor web (se recomienda XAMPP, WAMP o similar).
- Acceso a Internet (para consultar las APIs).

## Estructura del Proyecto

```
PORTAL-WEB/
│
├── apis/                  # Contiene los archivos PHP para consultar cada API
├── css/                    # Archivos de estilos (Bootstrap y estilos personalizados)
├── img/                    # Imágenes usadas en el portal
├── includes/               # Encabezado y pie de página reutilizables
├── index.php                # Página principal (home)
└── README.md                # Este archivo con las instrucciones
```

## Instalación

1. Clona o copia el repositorio en tu servidor local (XAMPP, WAMP, etc.).
2. Asegúrate de colocar el proyecto en la carpeta correcta, por ejemplo:
   ```
   C:\xampp\htdocs\portal-web\
   ```
3. Arranca el servidor Apache desde el panel de control de XAMPP o WAMP.

## Ejecución

- Abre tu navegador y accede a:
    ```
    http://localhost/portal-web/
    ```

## APIs Incluidas

- Predicción de género
- Predicción de edad
- Universidades por país
- Clima
- Pokémon
- Noticias WordPress
- Conversor de monedas
- Generador de imágenes
- Información de países
- Generador de chistes

## Nota

- El portal consume datos de APIs externas, por lo que requiere conexión a Internet.
- Si alguna API no responde, revisa la URL en el archivo correspondiente dentro de `/apis`.
