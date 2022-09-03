<?php 
include '../../Controller/postC.php';

include  "../Back/head.php";
require_once '../../model/post.php';


$postC = new postC();
if (isset($_GET['id'])) {
  $eventToEdit = $postC->getpostbyID($_GET['id']);
}
require_once '../../Controller/postC.php';
$listeEvents =$postC->afficherpost();


if (isset($_REQUEST['add']) || isset($_REQUEST['edit'])) {
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
      // echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      // echo "File is not an image.";
     // $uploadOk = 0;
  }


  // Check if file already exists
  if (file_exists($target_file)) {
      //  echo "Sorry, file already exists.";
     // $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      //  echo "Sorry, your file is too large.";
     // $uploadOk = 0;
  }

  // Allow certain file formats
  if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
  ) {
      //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //  $uploadOk = 0;
  }
  if ($uploadOk == 0) {
      header('Location:blank_post.php?error=1');
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo 'aaaaaa';
          $postC = new postC();
          if (isset($_REQUEST['add'])) {
            $post = new post(1, $_POST['titre'], $_POST['content'], $target_file, $_POST['categ'], $_POST['auteur'] );
            $postC->ajouterpost($post);
            
          } else if (isset($_REQUEST['edit'])) {
          $post = new post($_POST['post_id'], $_POST['titre'], $_POST['content'], $target_file, $_POST['categ'], $_POST['auteur']);
          $postC->modifierpost($post);
          }
          header('Location:postB.php');
      } else {
          echo 'chyyyyyyyy2';
          header('Location:blank_post.php');
      }
  }
}

?>
<body>
 <?php
include "nav-bar.php";
?>   
<div class="container-scroller">


<div class="container-fluid page-body-wrapper">
<?php
include "side-bar.php";
?>  
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Formulaire post</h4>
                  
                  <form class="forms-sample" action="" enctype="multipart/form-data" method="POST">
                    <?php if (isset($eventToEdit)) {?>
                         <div class="form-group">
                      <label for="id">id</label>
                      <input type="text" class="form-control" id="id" name="id" value="<?php echo $eventToEdit['id'] ?>">
                    </div>
                      <?php  }
                    ?>
                    <div class="form-group">
                      <label for="nom">title</label>
                      <input type="text" class="form-control" id="nom" name="titre" placeholder="title" name="titre" value="<?php if (isset($eventToEdit)) echo $eventToEdit['titre']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="contents">content</label>
                      <input type="textarea" class="form-control" id="content" name="content" placeholder="content" value="<?php if (isset($eventToEdit)) echo $eventToEdit['content'] ?>"  >
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select name="categ" id="categ" value="<?php if (isset($eventToEdit)) echo $eventToEdit['categ'] ?>">
                        <option>travel</option>
                        <option>anime</option>
                        <option>entertainment</option>
                        <option>sport</option>
                        <option>health</option>
                        <option>gaming</option>
                      </select>
                    </div>
                   
                    
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" class="form-control" id="fileToUpload"  name="fileToUpload" value="<?php if (isset($eventToEdit)) echo $eventToEdit['img'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="author">author</label>
                      <input type="text" class="form-control" id="auteur" placeholder="author" name="auteur"   value="<?php if (isset($eventToEdit)) echo $eventToEdit['auteur'] ?>">
                    </div>
                    <button type="submit" name="add" class="btn btn-primary me-2">Submit</button>
                    <button type="submit" name="edit" class="btn btn-dark btn-icon-text">
                                Edit
                                  <i class="ti-file btn-icon-append"></i>                          
                            </button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">posts</h4>
                  <li class="nav-item dropdown d-none d-lg-block">
                                       <form method="POST" action="triertitle.php">
                                    
                                                  <input type="submit" name="trier" value="trier" class="btn btn-success">
                                       </form>
          </li>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            ID
                          </th>
                          <th>
                            title
                          </th>
                          <th>
                            content
                          </th>
                          <th>
                            author
                          </th>
                          <th>
                            Category
                          </th>
                          
                          <th>
                            image
                          </th>
                          <th>
                            Edit
                          </th>
                          <th>
                            Delete
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listeEvents as $postC) {
                        ?>
                        <tr>
                          <td>
                            <?php if(isset($postC['post_id'])): ?>
                            <?php echo $postC["post_id"]; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(isset($postC['title'])): ?>
                            <?php echo $postC["title"]; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                          <?php if(isset($postC['contents'])): ?>
                            <?php echo $postC['contents']; ?>
                            <?php endif; ?> 
                          </td>
                          <td>
                          <?php if(isset($postC['author'])): ?>
                            <?php echo $postC['author']; ?>
                            <?php endif; ?> 
                          </td>
                          <td>
                          <?php if(isset($postC['category'])): ?>
                            <?php echo $postC['category']; ?>
                            <?php endif; ?>
                          </td>
                        
                          <td class="py-1">
                            <img src="<?php echo $postC['img']; ?>" alt="image"/>
                          </td>
                          <td>
                            <form method="POST" action="edit2.php">
            <button type="submit" name="add" class="btn btn-primary me-2">edit</button>
            <input type="hidden" value=<?PHP echo $postC['post_id']; ?> name="id">
            </form>
                                                           
                            </a>
                            </a>

                          </td>
                          <td>
                          <form method="POST" action="supprimer.php">
            <input type="submit" class="btn btn-danger btn-fw" name="supprimer" value="supprimer">
            <input type="hidden" value=<?PHP echo $postC['post_id']; ?> name="id">
            </form>
                          </td>
                          <td>
                          <form method="POST" action="createFILE.php">
            <input type="submit" class="btn btn-danger btn-fw" name="open" value="open">
            <input type="hidden" value=<?PHP echo $postC['post_id']; ?> name="id">
            <input type="hidden" value=<?PHP echo $postC['contents']; ?> name="content">
            <input type="hidden" value=<?PHP echo $postC['title']; ?> name="titre">
            <input type="hidden" value=<?PHP echo $postC['author']; ?> name="auteur">
            </form>
                          </td>
                        </a>

                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>