<?php
if(isset($_GET['file'])){ #checking if file is uploaded or not
    $file="uploads/".$_GET['file'];
    if(file_exists($file)) {
        #downloaded header link
        header("Content-Type:application/octet-stream");
        header("Content-Disposition:attachment;filename=".basename($file));
        header("Content-Length:".filesize($file));
        readfile($file);
        exit;
    }

}
?>