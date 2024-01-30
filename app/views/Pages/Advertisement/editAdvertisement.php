<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/addAdvertisement.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edit advertisement</title>
   </head>
<body>
      <!-- Sidebar -->
      <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">
        <div class="container">
          <div class="title">Edit Advertisement</div>
          <div class="content">
            <form action="<?php echo URLROOT; ?>/Advertisement/editAdvertisement/<?php echo $data['advertisement_id'] ?>" method="POST" enctype="multipart/form-data">
              <div class="user-details">
                <div class="input-box">
                  <span class="details">Coach Name</span>
                  <input type="text" name="name" placeholder="Enter your name" value="<?php echo $data['name']; ?>">
                  <!-- <span class="form-invalid"><?php echo $data['name_err']; ?></span> -->
                </div>
                <div class="input-box">
                  <span class="details">Advertisement Title</span>
                  <input type="text" name="title" placeholder="Title" value="<?php echo $data['title']; ?>">
                  <!-- <span class="form-invalid"><?php echo $data['title_err']; ?></span> -->
                </div>   
                <div class="input-box">
                  <span class="details">Date</span> 
                  <input type="date" name="date" placeholder="Date" value="<?php echo $data['date']; ?>">
                  <!-- <span class="form-invalid"><?php echo $data['date_err']; ?></span> -->
                </div>
                <div class="input-box " id="content">
                  <span class="details">Content</span>
                  <input type="text" name="content" placeholder="Description" value="<?php echo $data['content']; ?>">
                  <!-- <span class="form-invalid"><?php echo $data['content_err']; ?></span> -->
                </div>
                <div class="textbox">
                  <label for="img">Post:</label><br>
                  <input type="file" name="file" id="file" value="<?php echo $data['filename']; ?>" required>
                  <!-- <span class="form-invalid"><?php echo $data['filename_err']; ?></span> -->
                </div>
                <div class="input-box">
                  <!-- <span class="details"></span> -->
                  <input type="text" hidden name="email" value="<?php echo $data['email']; ?>">
                  <!-- <span class="form-invalid"><?php echo $data['email_err']; ?></span> -->
                </div> 
              </div>
        
              <div class="button">
                <input type="submit" value="Update" >
              </div>
            </form>
          </div>
        </div>
      </section>
</body>
</html>