<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?= base_url('assets/js/datatable.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/datatable-bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-multiselect.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/alertsweet2.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/maskMoney.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script>
    function base_url(destino) {
        return "<?= base_url(); ?>" + destino;
    }

    const objetoStatus = [{id: 1, nome: "ATIVO"}, {id: 2, nome: "INATIVO"}]
</script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
<script src="<?= base_url($caminhoJs); ?>"></script>
</body>

</html>