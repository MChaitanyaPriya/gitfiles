<?php
#write in a file 
$file=fopen("filephp.txt","w");
fwrite($file,"hello chaithu");
fclose($file);
# read a file
$file=fopen("filephp.txt","r");
$content=fread($file,filesize("filephp.txt"));
echo "<h3>File content</h3>";
echo $content;
#print_r($content); it will also print the same code
fclose($file);
#displaying the content
#file_get_contents reads full data
echo "<h3>reading the entire data using file_get_contains</h3>";
echo (file_get_contents("filephp.txt"));
# file information functions
echo "<h3>File information</h3>";
echo "<h3>file exists:</h3>".file_exists("filephp.txt")."<br>";
echo "<h3>File size</h3>".filesize("filephp.txt")."<br>";
echo "<h3>File type</h3>".filetype("filephp.txt");
echo "<h3>Last Modified Date</h3>";
echo date("d-m-Y H:i:s",filemtime("filephp.txt"))."<br>";
echo "<h3>Last Accessed Date and  Time</h3>";
echo date("d-m-Y H:i:s",fileatime("filephp.txt"))."<br>";
echo "<h3>Permission: it tells who can read,write or a file  used for Security rule</h3>";
echo "<h3>we are using substr ->method and for printing sprintf </h3>";
echo substr(sprintf('%o',fileperms('filephp.txt')),-4);
echo "it give 0666 means the ower has the read and write ";
# file & folder management
copy("filephp.txt","copy.txt");#copy the file
rename("copy.txt","renamed.txt");#rename the file
mkdir("testfolder");#creating a new folder
unlink("rename.txt");#deleting the file
rmdir("textfolder");#removing the existing folder
#directory handling
echo "<h3>Directory files:</h3>";
$files=scandir(".");
foreach($files as $file){
    if($file !="." && $file!=".."){
        echo $file."<br>";
    }
}
echo "Current Directory:".getcwd()."<br>";
#File Locking Important
$file=fopen("filephp.txt","r+");
if(flock($file,LOCK_EX)){
    fwrite($file,"\nFile Locked & Updated");
    flock($file,LOCK_UN);
}
fclose($file);
?>