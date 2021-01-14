<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            Datos
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>configuracion/actualizar" method="post">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input id="id" type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>" required placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo $data['telefono']; ?>" required placeholder="Teléfono">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input id="direccion" class="form-control" type="text" name="direccion" value="<?php echo $data['direccion']; ?>" required placeholder="Dirección">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php pie() ?>