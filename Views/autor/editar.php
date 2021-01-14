<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>autor/modificar" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" required>
                                            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['autor']; ?>" required placeholder="Nombre del autor">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <input id="foto" class="form-control" type="file" name="imagen">
                                            <input type="hidden" name="foto" value="<?php echo $data['imagen']; ?>">
                                            <img class="img-thumbnail" src="<?php echo base_url() . "Assets/images/autor/" . $data['imagen']; ?>" width="250">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Modificar</button>
                                            <a class="btn btn-danger" href="<?php echo base_url(); ?>autor" type="button">Atras</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php pie() ?>