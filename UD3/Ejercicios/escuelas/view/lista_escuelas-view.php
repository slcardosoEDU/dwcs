<?php
$escuelas = $data['escuelas'] ?? [];
$municipios = $data['municipios'] ?? [];
$provincias = $data['provincias'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Escuelas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        fieldset {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #aaa;
        }

        legend {
            font-weight: bold;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 4px;
        }

        select {
            padding: 4px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Listado de Escuelas</h1>

    <form action='?controller=EscuelaController&action=listarEscuelas' method="POST">
        <fieldset>
            <legend>Filtros</legend>

            <label for="f_nombre">Nombre:</label>
            <input type="text" name="nombre" id="f_nombre" value="<?=isset($_REQUEST['nombre'])?$_REQUEST['nombre']:'' ?>">
            <label for="f_provincia">Provincia:</label>
            <select name="cod_provincia" id="f_provincia">
                <option value="">-- Todas --</option>
                <?php foreach ($provincias as $p): ?>
                    <option value="<?= $p->getCodProvincia(); ?>"
                        <?= (isset($_REQUEST['cod_provincia']) && $_REQUEST['cod_provincia'] == $p->getCodProvincia()) ? 'selected' : '' ?>>

                        <?= htmlspecialchars($p->getNombre()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="f_municipio">Municipio:</label>
            <select name="cod_municipio" id="f_municipio">
                <option value="">-- Todos --</option>

                <?php foreach ($municipios as $m): ?>
                    <option value="<?= $m->getCodMunicipio(); ?>"
                        <?= (isset($_REQUEST['cod_municipio']) && $_REQUEST['cod_municipio'] == $m->getCodMunicipio()) ? 'selected' : '' ?>>

                        <?= htmlspecialchars($m->getNombre()); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filtrar</button>
        </fieldset>
    </form>

    <!-- ==============================
     TABLA DE ESCUELAS
================================= -->
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Municipio</th>
                <th>Comedor</th>
                <th>Hora Apertura</th>
                <th>Hora Cierre</th>
            </tr>
        </thead>

        <tbody>
            <?php if (count($escuelas) === 0): ?>
                <tr>
                    <td colspan="5">No hay escuelas que coincidan con los filtros.</td>
                </tr>
            <?php else: ?>

                <?php
                // Preparamos un mapa cod_municipio → nombre para no iterar dentro de la tabla
                $mapMunicipios = [];
                foreach ($municipios as $m) {
                    $mapMunicipios[$m->getCodMunicipio()] = $m->getNombre();
                }
                ?>

                <?php foreach ($escuelas as $e): ?>
                    <tr>
                        <td><?= htmlspecialchars($e->getNombre()); ?></td>

                        <td>
                            <?= htmlspecialchars(
                                $mapMunicipios[$e->getCodMunicipio()] ?? "Desconocido"
                            ); ?>
                        </td>

                        <td><?= $e->getComedor() ? 'Sí' : 'No'; ?></td>

                        <td><?= $e->getHoraApertura()?->format("H:i") ?? ""; ?></td>
                        <td><?= $e->getHoraCierre()?->format("H:i") ?? ""; ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
        </tbody>
    </table>

    <!-- ==============================
     SCRIPT AJAX
================================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const provinciaSelect = document.getElementById('f_provincia');
            const municipioSelect = document.getElementById('f_municipio');

            provinciaSelect.addEventListener('change', function () {
                const codProvincia = this.value;

                // Limpiar municipios
                municipioSelect.innerHTML = '<option value="">-- Todos --</option>';



                // Petición AJAX
                fetch(`?controller=MunicipioController&action=getMunicipiosProvinciaJSON&cod_provincia=${codProvincia}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(m => {
                            const option = document.createElement('option');
                            option.value = m.cod_municipio;
                            option.textContent = m.nombre;
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error("Error cargando municipios: ", err));
            });
        });
    </script>

</body>

</html>