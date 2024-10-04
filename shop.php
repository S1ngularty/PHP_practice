<?php 
session_start();
include("structure/shopheader.html");
include("includes/config.php");

if(!empty($_SESSION['user_id'])){
echo $_SESSION['user_id'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">options</button>
        <ul class="dropdown-menu" aria-labelledby="dropdown">
            <li class="dropdown-item">school supplies</li>
            <li class="dropdown-item">cloths</li>
            <li class="dropdown-item">gadgets/devices</li>
            <li class="dropdown-item">foods</li>
            <li class="dropdown-item">other</li>
        </ul>
    </div>
<br>
<br>
    <div class="container" id="container2">
<form action=" " class="row g-0" method="get" enctype="multipart/form-data" style="display:flex;">
<div class="col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded" style="padding: 5px; margin:5px;"><?php print "<img src>" ?></div>
<div class="col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded" style="padding: 5px; margin:5px;"><img src="../user_profile/Shop Items/camera.jpg" class="img img-thumbnail  img-responsive" style="width: 200px; height:200px;"  alt=""><label for="" class="form-label">Camera</label><br><?php print "<input type='submit' class='btn btn-primary' name='item2' value='Add to Cart'>"?></div>
<div class="col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded" style="padding: 5px; margin:5px;"><img src="../user_profile/Shop Items/earphones.jpg" class="img img-thumbnail  img-responsive" style="width: 200px; height:200px;"  alt=""><label for="" class="form-label">Earphones</label><br><?php print "<input type='submit' class='btn btn-primary' name='item3' value='Add to Cart'>"?></div>
<div class="col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded" style="padding: 5px; margin:5px;"><img src="../user_profile/Shop Items/anchor.jpg" class="img img-thumbnail  img-responsive" style="width: 200px; height:200px;"  alt=""><label for="" class="form-label">Anchor</label><br><?php print "<input type='submit' class='btn btn-primary' name='item4' value='Add to Cart'>"?></div>
<div class="col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded" style="padding: 5px; margin:5px;"><img src="../user_profile/Shop Items/randomblocks.jpg" class="img img-thumbnail  img-responsive" style="width: 200px; height:200px;"  alt=""><label for="" class="form-label">Blocks</label><br><?php print "<input type='submit' class='btn btn-primary' name='item5' value='Add to Cart'>"?></div>
</form>
    </div>

  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php 





}else{
    session_destroy();
    print "Please <a href=index.php>login</a> first!";
}

?>