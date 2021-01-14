<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row p-5">
                <form action="<?php echo base_url() ?>libros/modificar" method="post" id="frmLibros" class="row" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="hidden" name="id" value="<?php echo $data['libro']['id']; ?>">
                            <input id="titulo" class="form-control" type="text" name="titulo" value="<?php echo $data['libro']['titulo']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <select id="autor" class="form-control" name="autor">
                                <?php foreach ($data['autores'] as $autor) { ?>
                                    <option <?php if ($autor['id'] == $data['libro']['id_autor']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $autor['id']; ?>"><?php echo $autor['autor']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <select id="editorial" class="form-control" name="editorial">
                                <?php foreach ($data['editoriales'] as $editorial) { ?>
                                    <option <?php if ($editorial['id'] == $data['libro']['id_editorial']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $editorial['id']; ?>"><?php echo $editorial['editorial']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="materia">Materia</label>
                            <select id="materia" class="form-control" name="materia">
                                <?php foreach ($data['materias'] as $materia) { ?>
                                    <option <?php if ($materia['id'] == $data['libro']['id_materia']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $materia['id']; ?>"><?php echo $materia['materia']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $data['libro']['cantidad'] ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="num_pagina">Cantidad de página</label>
                            <input id="num_pagina" class="form-control" type="number" name="num_pagina" value="<?php echo $data['libro']['num_pagina']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="anio_edicion">Año Edición</label>
                            <input id="anio_edicion" class="form-control" type="date" name="anio_edicion" value="<?php echo $data['libro']['anio_edicion']; ?>">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" rows="2"><?php echo $data['libro']['descripcion']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="imagen">Foto</label>
                            <input id="fototemp" type="hidden" name="foto" value="<?php echo $data['libro']['imagen']; ?>">
                            <input id="imagen" class="form-control" type="file" name="imagen">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="img-thumbnail" src="<?php echo base_url() . "Assets/images/libros/" . $data['libro']['imagen']; ?>" width="250">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Modificar</button>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>libros">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php pie() ?>