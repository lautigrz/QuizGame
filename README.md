# QuizGame 🎮❓  

**QuizGame** es un juego de preguntas y respuestas diseñado para entretener, educar y desafiarse asi mismo mientras permite la interacción y la personalización. Este proyecto es desarrollado como parte de una materia universitaria, buscando integrar conocimientos técnicos y fomentar la creatividad en el desarrollo de aplicaciones web interactivas.

---

## Características Principales 🚀  

### Para el Jugador  
- **Responde Preguntas**: Participa en rondas de preguntas en diversas categorías y niveles de dificultad.  
- **Reporta Preguntas**: Informa problemas en preguntas existentes.  
- **Sugiere Preguntas**: Propón nuevas preguntas para enriquecer el contenido del juego.  
- **Ranking y Estadísticas**: Consulta tu posición y el de otros jugadores en el ranking global y revisa estadísticas personales como preguntas correctas, partidas jugadas, entre otros.  

### Para el Editor  
- **Gestión de Sugerencias**: Revisa las preguntas sugeridas por los jugadores y apruébalas o recházalas.  
- **Gestión de Reportes**: Analiza los reportes de preguntas y decide si se corrigen o se eliminan.  
- **Edición de Preguntas**: Modifica, habilita o desactiva preguntas para mantener la calidad del contenido.  

### Para el Administrador  
- **Gráficos y Estadísticas del Sitio**: Consulta datos clave sobre la plataforma, como:  
  - Nuevos jugadores registrados.  
  - Estadísticas demográficas por sexo y edad.  
  - Uso de funcionalidades del sitio.  
- **Gestión de Usuarios y Roles**: Supervisa el comportamiento de los usuarios y asigna roles.  

---

## Roles de Usuario 👥  

1. **Jugador**: Participa en el juego respondiendo preguntas y colaborando mediante reportes y sugerencias.  
2. **Editor**: Encargado de gestionar las preguntas (reportadas y sugeridas) y mantener el contenido del juego.  
3. **Administrador**: Supervisión general del sistema, acceso a estadísticas globales y funciones administrativas avanzadas.  

---

## Tecnologías utilizadas 🛠️

### Frontend:
- **HTML/CSS**: Diseño y estructura del sitio.
- **Bootstrap**: Framework para un diseño responsivo y moderno.
- **Mustache.js**: Motor de plantillas para renderizar dinámicamente las vistas en el cliente.

### Backend  
- **PHP**: Manejo de la lógica del juego, gestión de usuarios y roles.  
- **MySQL**: Base de datos para almacenar preguntas, usuarios, reportes y estadísticas.  

### Librerías y Herramientas  
- **Chart.js**: Para mostrar gráficos estadísticos.  
- **PHPMailer**: Para notificaciones por correo electrónico.
- **PHPQRCODE**: Cada usuario tiene un QR en su perfil.  

---

## Instalación y Configuración ⚙️  

1. Clona el repositorio:  
   ```bash
   git clone https://github.com/lautigrz/quizgame.git
   ```  
2. Configura la base de datos:  
   - Importa el archivo `quizgame.sql`.  
   - Ajusta las credenciales de conexión en `config.ini`.  

3. Coloca el proyecto en tu servidor local (ejemplo: `htdocs` si usas XAMPP).  

4. Accede al sitio:  
   - URL principal: `http://localhost/quizgame/`.  

---

## Contexto Académico 🎓  

Este proyecto es parte de una materia universitaria, enfocado en el desarrollo de aplicaciones web con múltiples funcionalidades. A través de **QuizGame**, se busca poner en práctica conceptos como:  
- Gestión de roles y permisos.  
- Implementación de interfaces dinámicas y responsivas.  
- Manejo de bases de datos y estadísticas.  
- Mejores prácticas en desarrollo colaborativo.  

---

## Créditos 🏆  
Creado y desarrollado por [lautigrz].  
Inspirado en la búsqueda de aprendizaje continuo en el marco universitario.  

---

¡Diviértete y aprende con **QuizGame**! 🎉
