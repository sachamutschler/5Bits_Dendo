<script>

    navbar = document.getElementById('navbar');

    function afficher_navbar() {
        if(!navbar.classList.contains('ouvrir_menu')) {
            navbar.classList.add('ouvrir_menu');
        }
        else {
            navbar.classList.remove('ouvrir_menu');
        }
    }

</script>