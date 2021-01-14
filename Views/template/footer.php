<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Vida Informatico</div>
        </div>
    </div>
</footer>
</div>
<!-- JavaScript files-->
<script src="<?php echo base_url(); ?>Assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/Funciones.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/all.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/sweetalert2@9.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay datos",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(Filtro de _MAX_ total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron coincidencias",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar orden de columna ascendente",
                    "sortDescending": ": Activar orden de columna desendente"
                }
            }
        });
    });
</script>
</body>

</html>