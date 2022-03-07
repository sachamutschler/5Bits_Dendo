<script>

    document.getElementById('input_ajout_panier').oninput = function () {
        var max = parseInt(this.max);
        if (parseInt(this.value) > max) {
            this.value = max;
        }
    }

</script>