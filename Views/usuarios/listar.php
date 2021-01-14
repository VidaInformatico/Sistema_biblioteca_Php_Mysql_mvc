<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <?php if (isset($_GET['error'])) { ?>
                <div class="toast ml-auto bg-danger text-white" id="errorCambioPass" role="alert" data-delay="3000" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="<?php echo base_url(); ?>Assets/img/error.png" class="rounded mr-2" width="25">
                        <strong class="mr-auto">Alerta</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Contraseña actual incorrecta
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nuevo_user">Nuevo</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>usuario</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $us) {
                                    if ($us['rol'] == 1) {
                                        $rol = '<span class="badge-success p-1 rounded">Administrador</span>';
                                    } else {
                                        $rol = '<span class="badge-secondary p-1 rounded">Supervisor</span>';
                                    }
                                    if ($us['estado'] == 1) {
                                        $estado = '<span class="badge-primary p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $us['id']; ?></td>
                                        <td><?php echo $us['nombre']; ?></td>
                                        <td><?php echo $us['usuario']; ?></td>
                                        <td><?php echo $rol; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>Usuarios/editar?id=<?php echo $us['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <?php if ($us['estado'] == 1) { ?>
                                                <form action="<?php echo base_url() ?>Usuarios/eliminar" method="post" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $us['id']; ?>">
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form action="<?php echo base_url() ?>Usuarios/reingresar" method="post" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $us['id']; ?>">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-audio-description"></i></button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="nuevo_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="my-modal-title">Nuevo Usuario</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo base_url(); ?>Usuarios/insertar" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="clave">Contraseña</label>
                                    <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="rol">Rol</label>
                                <select id="rol" class="form-control" name="rol">
                                    <option value="1">Administrador</option>
                                    <option value="2">Supervisor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php pie() ?>