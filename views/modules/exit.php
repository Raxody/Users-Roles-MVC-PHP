<?php
session_start();
session_destroy();
?>
<script>
    window.location = "index.php?action=initial";
</script>