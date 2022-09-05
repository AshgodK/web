<?php 
include '../../Controller/postC.php';

include "head.php";
require_once '../../model/post.php';


$postC = new postC();
$count = $postC->countpost();
if (isset($_GET['id'])) {
  $eventToEdit = $postC->getpostbyID($_GET['id']);
}
require_once '../../Controller/postC.php';
$listeEvents =$postC->afficherpostA();


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
                    <table>
                      <thead>
                        <tr>
                         <td>
                  
                             <form method="POST" action="trierID.php">
                                   <input type="submit" name="trier" value="trier category" class="btn btn-success">
                             </form>
                              </td>
                              <td>
                             <form method="POST" action="triertitle.php">
                                   <input type="submit" name="trier" value="trier title" class="btn btn-success">
                             </form>
                              </td>
                              </tr>
                              </thead>
                              </table>
          
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            state
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
                            accept
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
                            <?php if(isset($postC['state'])): ?>
                            <?php echo $postC["state"]; ?>
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
                             <form method="POST" action="updatestate.php">
            <input type="submit" class="btn btn-danger btn-fw" name="accept" value="accept">
            <input type="hidden" value=<?PHP echo $postC['post_id']; ?> name="id">
            </form>
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
        
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Charts</h4>
                  <table>
                    <tbody>
                      <tr>
                        <canvas id="bar-chart-horizontal" width="800" height="200"></canvas>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Export</h4>
                <a href="export.php">
                  <button class="btn btn-danger">Export Excel</button>
              </div>
            </div>
          </div>
        



    </div>



    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
    <script>
      new Chart(document.getElementById("bar-chart-horizontal"), {
        type: 'horizontalBar',
        data: {
          labels: ["Posts"],
          datasets: [{
            label: "Nombre posts",
            backgroundColor: ["#3e95cd", "#8e5ea2"],
            data: [<?php echo $count; ?>]
          }]
        },
        options: {
          scales: {
            xAxes: [{
              ticks: {
                stepSize: 1
              }
            }]
          },
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Nombre des posts'
          }
        }
      });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            
</body>

</html>