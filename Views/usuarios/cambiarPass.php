<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card mt-2">
                <div class="card-header">
                    <h5 class="text-center">Cambiar Contraseña</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <form method="post" action="<?php echo base_url();?>usuarios/cambiar">
                                <div class="form-group">
                                    <label for="actual">Contraseña actual</label>
                                    <input id="actual" class="form-control" type="password" name="actual" placeholder="Contraseña Actual">
                                </div>
                                <div class="form-group">
                                    <label for="nueva">Nueva Contraseña</label>
                                    <input id="nueva" class="form-control" type="password" name="nueva" placeholder="Contraseña Nueva">
                                </div>
                                <button class="btn btn-primary" type="submit">Cambiar</button>
                                <a href="<?php echo base_url(); ?>usuarios/listar" class="btn btn-danger">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php pie() ?>