<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h5 class="text-center">Estudiantes</h5>
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoEstudiante"><i class="fas fa-user-plus"></i></button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Carrera</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $estudiante) {
                                    if ($estudiante['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $estudiante['id']; ?></td>
                                        <td><?php echo $estudiante['codigo']; ?></td>
                                        <td><?php echo $estudiante['nombre']; ?></td>
                                        <td><?php echo $estudiante['carrera']; ?></td>
                                        <td><?php echo $estudiante['telefono']; ?></td>
                                        <td><?php echo $estudiante['direccion']; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>estudiantes/editar?id=<?php echo $estudiante['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <?php if ($estudiante['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url() ?>estudiantes/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url() ?>estudiantes/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-audio-description"></i></button>
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
    <div id="nuevoEstudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="my-modal-title">Registro Estudiante</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(); ?>estudiantes/registrar" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input id="codigo" class="form-control" type="text" name="codigo" required placeholder="Codigo del estudiante">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni">Dni</label>
                                    <input id="dni" class="form-control" type="text" name="dni" required placeholder="Dni">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" class="form-control" type="text" name="nombre" required placeholder="Nombre completo">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="carrera">Carrera</label>
                                    <input id="carrera" class="form-control" type="text" name="carrera" required placeholder="Carrera">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="telefono">Télefono</label>
                                    <input id="telefono" class="form-control" type="text" name="telefono" required placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input id="direccion" class="form-control" type="text" name="direccion" required placeholder="Dirección">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Atras</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php pie() ?>