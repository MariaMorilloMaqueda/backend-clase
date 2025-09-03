<!DOCTYPE html>
<!-- María Morillo Maqueda -->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <form action="datos.php" method="post">
            <div>
                <label>Distancia al sol mínima (en millones km): <input name="distancia_sol" type="text" value=""/></label>
            </div>
            <br>
            <div>
                Tipo de cuerpo celeste (marque uno o más):<br><br>
                <input type="checkbox" name="tipo[]" value="planeta">Planeta<br>
                <input type="checkbox" name="tipo[]" value="satélite">Satélite<br>
                <input type="checkbox" name="tipo[]" value="planeta enano">Planeta enano<br>
                <input type="checkbox" name="tipo[]" value="asteroide">Asteroide<br>
                <input type="checkbox" name="tipo[]" value="prueba">PRUEBA<br>
            </div>
            <br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
