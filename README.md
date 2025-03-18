# Zoo.local - Plataforma Web de Zoológico

## Descripción
Zoo.local es un proyecto dinámico desarrollado en PHP que simula una plataforma interactiva de un zoológico. La aplicación proporciona información detallada sobre las especies albergadas, noticias actualizadas sobre el zoológico y permite la interacción entre los usuarios a través de un foro comunitario. También cuenta con un sistema de adopción y una administración completa a través de un panel de control.

## Características Principales
### ✨ Funcionalidades Generales
- **Noticias:** Sección con las últimas actualizaciones y novedades del zoológico obtenidas mediante **web scraping**.
- **Lista de Animales:** Información detallada sobre las diferentes especies disponibles en el zoológico.
- **Adopción:** Opción para adoptar animales rescatados bajo ciertos requisitos y condiciones.
- **Foro Comunitario:** Espacio donde los usuarios pueden discutir temas relacionados con la fauna y conservación.
- **Autenticación Segura:** Implementación de **JWT y cookies** para gestionar sesiones de usuario de manera segura.

### 💻 Tecnologías Utilizadas
- **PHP**: Lenguaje principal del backend.
- **Twig**: Motor de plantillas para las vistas.
- **Composer**: Gestión de dependencias del proyecto.
- **JWT (JSON Web Token)**: Autenticación segura de usuarios.
- **Cookies**: Manejo de sesiones y preferencias de usuario.
- **Web Scraping**: Obtención de información sobre animales y noticias desde fuentes externas.
- **Base de Datos MySQL**: Almacenamiento de datos de usuarios, animales, adopciones y publicaciones del foro.

## 👥 Panel de Administración
El proyecto cuenta con un **panel administrativo** desde el cual se pueden gestionar diversos aspectos de la plataforma:
- **Gestión de Animales:** Agregar, editar o eliminar información de especies.
- **Gestión de Noticias:** Publicar, actualizar y eliminar noticias obtenidas o generadas manualmente.
- **Usuarios y Roles:** Administración de permisos y gestión de cuentas.
- **Foro:** Moderación de temas y mensajes de la comunidad.
- **Adopciones:** Revisión y aprobación de solicitudes de adopción.

## ⚡ Instalación y Configuración
1. Clonar el repositorio:
   ```sh
   git clone https://github.com/tu_usuario/zoo.local.git