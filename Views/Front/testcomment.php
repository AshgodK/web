


 
include '../../Controller/commentC.php';


require_once '../../model/comment.php';
$ref=$idc.'php';

$commentC = new commentC();
if (isset($_GET['id'])) {
  $eventToEdit = $commentC->getComById($_GET['id']);
}
require_once '../../Controller/commentC.php';
$listeEvents =$commentC->searchcom($idc);


$commentC = new commentC();
          if (isset($_REQUEST['add'])) {
            $cmnt = new cmnt(1, $_POST['content'], $idc );
            $commentC->ajouterCom($cmnt);


          }
          
?>
<body>
 
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

   
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
<script src="js/Chart.min.js"></script>
<!--//charts-->
<!-- geo chart -->
   <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
   
   <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
	<!-- Chartinator  -->
   <script src="js/chartinator.js" ></script>
   <script type="text/javascript">
	  

			  
		   
   </script>
<!--geo chart-->

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->


 <div class="container my-5">
 <div class="left-content">
	  <div class="mother-grid-inner">
		   <!--header start here-->
			   <div class="header-main">
				   <div class="header-left">
						   
						   
							   <div class="clearfix"> </div>
						</div>
						<div class="header-right">
						   
						   <!--notification menu end -->
						   
						   <div class="clearfix"> </div>				
					   </div>
					<div class="clearfix"> </div>	
			   </div>
<!--heder end here-->
<!-- script-for sticky-nav -->

	   <!-- /script-for sticky-nav -->
	   <div class="inner-block">


	  <h2>add comment</h2>
  
  <form method="POST">
  	<?php if (isset($eventToEdit)) {?>
                         <div class="form-group">
                      <label for="id">id</label>
                      <input type="text" class="form-control" id="id" name="id" value="<?php echo $eventToEdit['id'] ?>">
                    </div>
                      <?php  }
                    ?>
 <div class="form-group">
  <h6 ><label for="content" class="form-label">Comment</label></h6>
   <input type="text" class="form-control" id="content" placeholder="enter you comment" name="content" value="<?php if (isset($eventToEdit)) echo $eventToEdit['content'] ?> ">
   
 </div>

 <button type="submit" class="btn btn-primary" name="add" >Submit</button>
</form>
  </div>

  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            comment
                          </th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listeEvents as $commentC) {
                        ?>
                        <tr>
                          <td >
                            <?php if(isset($commentC['content'])): ?>
                            <?php echo $commentC["content"]; ?>
                            <?php endif; 
                          ?>

                          </td>
                        
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
  <script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->

   </body>
   