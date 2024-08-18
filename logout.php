<?php
include ('./php/config.php');
include  ('./php/CreateDb.php');

    session_start();
    session_unset();
    session_destroy();

echo "<script> alert('Successfully Logged Out'); </script>";
echo "<script>window.location = 'index.html'</script>";



