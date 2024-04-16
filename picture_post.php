<?php

session_start();
                               
include('config.php');
    
if(isset($_SESSION['username']))
{
    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {

        echo "<pre>";
        print_r($_FILES['my_image']);
        echo "</pre>";
        
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Sorry, your file is too large. Please chose another picture !";
                header("Location: picture_post.php?error=$em");
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'image/user/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $username = $_SESSION['username'];
                    $sql = "UPDATE account SET
                            avatar = '$new_img_name'
                            WHERE username = '$username'";;
                    mysqli_query($conn, $sql);
                    if($_SESSION['level']=='admin'){
                        header("Location: profile_user.php");
                    }else if ($_SESSION['level']=='head'){
                        header("Location: head_index.php");
                    }else if ($_SESSION['level']=='user'){
                        header("Location: user_index.php");
                    }
                }else {
                    $em = "You can't upload files of this type";
                    header("Location: picture_post.php?error=$em");
                }
            }
        }else {
            $em = "Unknown error occurred!";
            header("Location: picture_post.php?error=$em");
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Company Management</title>
        <link rel="icon" href="logo/web_logo.png" type="image/png"/>
        <link href="test.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    </head>
    <body>
    <section>

    </div>

    <div id="main">
 

        <!---------------------------Avatar BOX ------------------------------------------------------->
        <div class="d-flex flex-column align-items-center text-center" >

            <div class="card" style="border-radius: 40px;">
                <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
    
                <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
                </div>
                <?php endif ?>  

                <img id="ImdID" src="logo/user_default.png" alt="Image"  class="rounded-circle" width="150" />
                <h4 style="font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif; font-weight: bold;padding-top: 20px">Chose Your Picture </h4>
                </div>
                </div>
                <div class="card mb-3" style="border:0">
                <div class="card-body">
                    <form action="picture_post.php"
                    method="post"
                    enctype="multipart/form-data">
                    <input type="file" 
                            name="my_image" class="btn btn-info rounded-pill" onchange="readURL(this);">


                    <input type="submit" 
                            name="submit"
                            value="Upload" class="btn btn-info  rounded-pill">      
                    </form> 
                    <button onclick="location.href='profile_user.php'" class="btn btn-info  rounded-pill" style="margin-top:10px;">Cancel</button>
            </div>
            </div> 
            </div>
            
  
        </div> 
    
    </div>
    </section>
        

    </body>
    </html> 
<?php
}else {
    header("Location: login.php");
}
?>
<script>


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#ImdID').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>


