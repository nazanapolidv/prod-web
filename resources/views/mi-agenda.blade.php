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
    <x-header />
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
    <x-footer />
</body>

</html>