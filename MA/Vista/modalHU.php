<?php
$queryUsuarios1 = "SELECT Usuario FROM usuarios";
$resultadoUsuarios1 = $conexion->query($queryUsuarios1) or die($conexion->error);
?>

<!-- Modal para modificar HU -->
<div class="modal fade" id="modalModificar<?php echo $mostrar['numeroHU']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar HU: <?php echo $mostrar['numeroHU']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../Controlador/Backlog/modificarHU.php?hu=<?php echo $mostrar['numeroHU']; ?>" method="POST">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                        </div>
                        <input REQUIRED type="text" class="form-control" name="NombreHU" value="<?php echo $mostrar['Nombre']; ?>">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">PH</span>
                        </div>
                        <select REQUIRED class="form-control" name="PH">
                            <optgroup label="PH Actual">
                                <option selected value="<?php echo $mostrar["PH"]; ?>"><?php echo $mostrar["PH"]; ?></option>
                            </optgroup>
                            <optgroup label="PH">
                                <?php
                                $opciones = ["2", "3", "5", "8", "13", "20", "40", "100"];
                                $valorPH = $mostrar["PH"];
                                foreach ($opciones as $opcion) {
                                    if ($opcion != $valorPH) {
                                        echo '<option value="' . $opcion . '">' . $opcion . '</option>';
                                    }
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Responsable</span>
                        </div>
                        <select REQUIRED class="form-control" name="ResponsableHU">
                            <optgroup label="Responsable Actual">
                                <option selected value="<?php echo $mostrar["Responsable"]; ?>"><?php echo $mostrar["Responsable"]; ?></option>
                            </optgroup>
                            <optgroup label="Desarrolladores">
                                <?php
                                while ($filaUsuario1 = $resultadoUsuarios1->fetch_assoc()) {
                                    if ($filaUsuario1['Usuario'] !== $mostrar["Responsable"]) { ?>
                                        <option value="<?php echo $filaUsuario1['Usuario'] ?>"><?php echo $filaUsuario1['Usuario'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" id="insertarHU" class="btn">Modificar datos</button>
                        </div>
                        <div class="col-6">
                            <a href="../Controlador/Backlog/eliminarHU.php?id=<?php echo $mostrar['numeroHU'] ?>" type="button" class="btn btn-danger">Eliminar HU</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para filtrar por Sprint -->
<div class="modal fade" id="modalFiltrarSprint" tabindex="-1" aria-labelledby="modalFiltrarSprintLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFiltrarSprintLabel">Filtrar por Sprint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php for ($i = 1; $i <= $totalSprints; $i++) { ?>
                    <button type="button" class="btn btn-sm btn-dark filter-btn" data-filter="<?php echo $i ?>">Sprint <?php echo $i ?></button>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>