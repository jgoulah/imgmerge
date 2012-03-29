<?

if (!isset($_REQUEST['img1']) && !isset($_REQUEST['img2'])) {

?>
<h1>Merge Graphs!</h1>
<form>
    <label for="img1">First Graph URL:</label>
    <input type="text" name="img1" id="img1" size="100">
    <br/>
    <label for="img2">Second Graph URL:</label>
    <input type="text" name="img2" id="img2" size="100">
    <br/>
    <input type="submit" name="submit" id="submit_btn" value="Merge!" />
</form>
<?


} else {

    ini_set('allow_url_fopen', true);

    $img1 = $_REQUEST['img1']; 
    $img2 = $_REQUEST['img2']; 

    // Create image instances
    $dest = imagecreatefrompng($img1);
    $src  = imagecreatefrompng($img2);

    $src_size   = getimagesize($img2);
    $src_width  = $src_size[0];
    $src_height = $src_size[1];


    imagealphablending($dest, true);
    imagesavealpha($dest, true);

    // Copy and merge
    imagecopymerge($dest, $src, 0, 0, 0, 0, $src_width, $src_height, 50);

    // Output and free from memory
    header('Content-Type: image/png');
    imagepng($dest);

    imagedestroy($dest);
    imagedestroy($src);

}
