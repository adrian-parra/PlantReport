<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Reporte</title>
</head>

<body>
    <h1>Registrar reporte</h1>
    <form id="myForm">
    <select name="planta_id">
        <option value="1">Opción 1</option>
        <option value="2">Opción 2</option>
        <option value="3">Opción 3</option>
    </select>
    <select name="linea_id">
        <option value="1">Opción A</option>
        <option value="2">Opción B</option>
        <option value="3">Opción C</option>
    </select>
    <select name="estacion_id">
        <option value="1">Opción X</option>
        <option value="2">Opción Y</option>
        <option value="3">Opción Z</option>
    </select>
    <input type="file" name="imagen">
    <textarea name="comentario" id="" cols="30" rows="10"></textarea>
    <button type="submit">Guardar</button>
</form>

    <script>
     
        document.querySelector('#myForm').addEventListener('submit', async (e) => {
            try {
                e.preventDefault();
                const formData = new FormData(e.target);
                const response = await fetch('api/report/index.php', {
                    method: 'POST',
                    // headers: {
                    //     'Content-Type': 'application/json'
                    // },
                    body: formData
                });
                if (!response.ok) {
                    throw new Error('Error al registrar el reporte');
                }

                const responseData = await response.json();
                console.log(responseData);
            } catch (error) {
                console.error('Error al enviar el reporte:', error);
            }
        })
    </script>

</body>

</html>