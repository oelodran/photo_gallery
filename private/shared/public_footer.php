
<footer class="bg-dark text-white text-center footer">
    <p>Copyright <?php echo date('Y'); ?>, Shared Gallery</p>
</footer>
<!-- ajax request -->
<script>
    function count_photos() {
        var target = document.getElementById("main");
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'user/photo/count_photos.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 2) {
                target.innerHTML = 'Loading...';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {
                target.innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    }

    var button = document.getElementById("ajax-button");
    button.addEventListener("click", count_photos);
</script>
<script type="text/javascript" src="<?php echo url_for('/javascript/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo url_for('/javascript/jquery.slim.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo url_for('/javascript/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo url_for('/javascript/tether.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo url_for('/javascript/scripts.js'); ?>"></script>
</html>
</body>

<?php db_disconnect($database); ?>