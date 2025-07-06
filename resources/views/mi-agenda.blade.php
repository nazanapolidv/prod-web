<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi salud</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/mi-agenda.css" />

    @vite(['resources/css/mi-agenda.css', 'resources/css/app.css'])
</head>

<body>
    <header>
        <div class="container_header">
            <div class="logo">
                <a href="../index.html">
                    <img src="{{asset('logo-removebg-preview.png')}}" alt="Hospital Polaco">
                </a>

            </div>
            <nav class="menu">
                <ul class="menu_list">
                    <li><a href="{{'home'}}">Inicio</a></li>
                    <li><a href="{{'mi-salud'}}">Mi Salud</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </nav>
            <div class="session">
                <a href="inicio-sesion.html">
                    <img src="{{asset('profile.png')}}" alt="iniciar sesion o registrarse">

                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="miagenda-container">
            <h2 class="title">Mi Agenda</h2>
            <h3 class="heading">Citas del día</h3>
            <table>
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>09:00</td>
                        <td>Ana Martínez</td>
                        <td>Clínica General</td>
                        <td>
                            <select>
                                <option value="pendiente">Pendiente</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>10:30</td>
                        <td>Lucas Ramírez</td>
                        <td>Dermatología</td>
                        <td>
                            <select>
                                <option value="pendiente">Pendiente</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>13:00</td>
                        <td>Valentina López</td>
                        <td>Clínica General</td>
                        <td>
                            <select>
                                <option value="pendiente">Pendiente</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>15:00</td>
                        <td>Diego Fernández</td>
                        <td>Clínica General</td>
                        <td>
                            <select>
                                <option value="pendiente">Pendiente</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <div class="container_footer">
            <div class="logo">
                <a href="../index.html"><img src="{{asset('logo-removebg-preview.png')}}" alt="Hospital Polaco"></a>
            </div>
            <div class="contact_info">
                <p><b>Hospital Polaco</b></p>
                <p>hola@hospitalpolaco.com</p>
                <p>0800 888 9090</p>
            </div>
            <div class="footer_content">
                <div class="social_media">
                    <a href="#"><img src="{{asset('fb.png')}}" alt="Facebook"></a>
                    <a href="#"><img src="{{asset('x.png')}}" alt="X"></a>
                    <a href="#"><img src="{{asset('instagram.png')}}" alt="Instagram"></a>
                </div>

                <div class="legal">
                    <p>©2025 Todos los derechos reservados</p>
                    <p>Política de privacidad</p>
                    <p>Términos y condiciones</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>