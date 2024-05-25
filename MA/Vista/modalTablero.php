<!-- Modal informacion -->
<div class="modal fade" id="modalInformacionHU<?php echo $mostrarHistoriaUsuario['numeroHU']; ?>" tabindex="-1" aria-labelledby="modalInformacionHULabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $mostrarHistoriaUsuario['numeroHU'] ?>: <?php echo $mostrarHistoriaUsuario['Nombre'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">PH</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHistoriaUsuario['PH'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Responsable</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHistoriaUsuario['Responsable'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Estado</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['Estado'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Fecha agregada</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['FechaAgregada'] ?>" style="background-color: white;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal informacion Terminada -->
<div class="modal fade" id="modalInformacionHU<?php echo $mostrarHU['numeroHU']; ?>" tabindex="-1" aria-labelledby="modalInformacionHULabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $mostrarHU['nombre_hu']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Estado</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['Estado'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">FechaAgregada</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['FechaAgregada'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">FechaIniciada</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['FechaIniciada'] ?>" style="background-color: white;">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">FechaTerminada</span>
                    </div>
                    <input disabled class="form-control" value="<?php echo $mostrarHU['FechaTerminada'] ?>" style="background-color: white;">
                </div>
            </div>
        </div>
    </div>
</div>