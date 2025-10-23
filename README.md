🖨️ PrintHub

## 📘 Descripción general del proyecto
**PrintHub** es una plataforma web enfocada en la venta de **impresoras, tintas, cartuchos y productos relacionados con la impresión**.  
El proyecto busca digitalizar la experiencia de compra tradicional de insumos de impresión mediante un sistema dinámico, seguro y modular.  
El objetivo principal es facilitar tanto la experiencia del **usuario cliente** (búsqueda y compra de productos) como del **administrador** (gestión de inventario, pedidos, usuarios y abonos).

---

## 💻 Tecnologías empleadas
- **Lenguaje Backend:** PHP (con arquitectura MVC)
- **Frontend:** HTML, CSS, JavaScript
- **Frameworks y librerías:** Bootstrap 5.3, SweetAlert2, Boxicons, FontAwesome
- **Base de datos:** MySQL
- **Servidor local:** XAMPP
- **Generación de reportes PDF:** DomPDF
- **Control de versiones:** Git / GitHub

---

## 🏗️ Arquitectura y estructura de carpetas

La aplicación sigue el **patrón MVC (Modelo-Vista-Controlador)** para mantener un código limpio, reutilizable y modular.

### 📁 Estructura general del proyecto
```
/PrintHub
│
├── controlador/                 
│  
├── IMAGENES/ 
│
├── img/                         
│   ├── abonos/                  
│   └── productos/               
│
├── libs/                        
│   ├── bootstrap-5.3.3-dist/
│   ├── bootstrap-icons-1.11.3/
│   ├── boxicons-2.1.4/
│   ├── flag-icons-main/
│   ├── fontawesome-free-6.7.2-web/
│   └── SweetAlert2/
│
├── modelo/                      
│   
├── vendor/   
│   ├── composer/                   
│   ├── dompdf/                  
│   ├── masterminds/
│   ├── sabberworm/
│   └── autoload.php
│
├── vista/                       
│   ├── admin/                   
│   │   ├── css/
│   │
│   │
│   ├── alertas/                 
│   │   └── funcionesalert.js
│   │
│   └── general/                 
│     └── resumenes/
├── bd_print_hub.sql             
├── conexion.php                                                             
├── .htaccess                    
├── composer.json 
├── composer.lock 
├── README.md               

```

---

## 🔄 Flujo del pedido

1. **El usuario accede al sistema** e inicia sesión (o se registra si no tiene cuenta).  
2. **Explora los productos** disponibles en la tienda.  
3. **Agrega los artículos al carrito** y revisa el total.  
4. **Confirma el pedido** y se almacena en la base de datos.  
5. **El administrador revisa el pedido**, actualiza su estado y gestiona el envío o abono correspondiente.  
6. **El usuario puede consultar el estado de su compra** en su perfil o en la sección de pedidos.

---

## ⚙️ Instrucciones de instalación

1. **Clonar el repositorio:**
   git clone https://github.com/usuario/PrintHub.git

2. **Mover la carpeta al servidor local:**
   C:\xampp\htdocs\PrintHub

3. **Crear la base de datos:**
   - Abrir `phpMyAdmin`
   - Crear una base de datos llamada `bd_print_hub`
   - Importar el archivo `bd_print_hub.sql` incluido en el proyecto

4. **Configurar la conexión a la base de datos en `conexion.php`:**
  <?php
$host = 'localhost';
$dbname = 'bd_print_hub';
$username = 'root';
$password = '';
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>

5. **Ejecutar el proyecto:**
   Abrir el navegador y acceder a:
   http://localhost/PrintHub/


6. **(Opcional)**: Si se desea configurar rutas amigables, asegurarse de que el módulo `mod_rewrite` esté habilitado en Apache.

---

## 👥 Roles del sistema

- **Administrador:**
  - Gestiona productos, categorías y usuarios.
  - Supervisa pedidos, abonos y reportes.
  - Accede al panel de control y a estadísticas generales.

- **Cliente:**
  - Se registra e inicia sesión.
  - Visualiza productos, agrega al carrito y realiza pedidos.
  - Puede consultar y abonar sus compras.

---

## 📊 Base de datos
La base de datos **`bd_print_hub`** contiene las siguientes tablas principales:

usuarios → Registro de clientes y administradores del sistema.
Almacena los datos de autenticación, roles (cliente o admin) y la información básica de cada usuario.

productos → Catálogo de artículos disponibles.
Contiene el nombre, descripción, precio, stock y categoría de cada producto.

categorias → Clasificación de productos.
Define los grupos o tipos de productos (por ejemplo: impresoras, tintas, cartuchos, papel, etc.), permitiendo una mejor organización del catálogo.

clientes → Información detallada de los clientes.
Guarda los datos personales, dirección, teléfono y otros campos necesarios para la gestión de pedidos y atención al cliente.

abonos → Pagos parciales o totales realizados por los clientes.
Permite registrar los abonos asociados a pedidos o ventas, facilitando el control financiero.

atencion_clientes → Registro de solicitudes, reclamos o consultas.
Administra los reportes o mensajes de soporte enviados por los usuarios, con su respectivo estado y respuesta.

ventas → Historial de ventas confirmadas.
Contiene el detalle de cada transacción finalizada, incluyendo cliente, productos vendidos, totales y fecha.

---

## 🧩 Consideraciones técnicas
- El proyecto utiliza **Bootstrap 5.3** para mantener un diseño moderno y responsivo.  
- Se incluyen librerías como **SweetAlert2** para mejorar la interacción con el usuario.  
- **DomPDF** permite la exportación de reportes o comprobantes en formato PDF.  
- **Composer** gestiona las dependencias del backend.  
- Las vistas están divididas entre **administrador** y **cliente** para mantener separación de roles.

---

## 🧑‍💻 Desarrollado por
**Julio Andres Casanova Ramirez** 
**Daniel David Rojas Medina**  
Proyecto académico — 2025  
Sistema web de gestión y venta de productos de impresión.
