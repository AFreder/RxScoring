		<div style="background-color:black; color:white;" >
			<div id="myCarousel" class="carousel slide">
  				<!-- Carousel items -->  				
  				<div style="width:95%" class="carousel-inner">  				
    				<div style="margin-top:2%;margin-bottom:2%;margin-left:8%;margin-right:2%" class="active item">    				
    				<img style="width:99%;" src="/img/leaderboard.jpg">
    					<div class="carousel-caption">    					    						
    						<h2>Live Leaderboard</h2>
    						<p>Provide all of your competitors and spectators with a leaderboard that is updated in real time as scores are entered for your event!</p><br /><br />
    						<a class="btn btn-primary" data-toggle="modal" href="#dia-register" id="btn_register">Register Now!</a>
    						<a class="btn" href="/index.php/leaderboard/index/4">Demo Leaderboard</a><br /><br />    						    				
    					</div>    					
    				</div> 
    				<div style="margin-top:2%;margin-bottom:2%;margin-left:8%;margin-right:2%" class="item">    				
    				<img style="width:99%;" src="/img/login.jpg">
    					<div class="carousel-caption">    					    						
    						<h2>Try it out now!</h2>
    						<p>Login in with the username and password below!  Feel free to create test events and play around with all the features we have to offer!<br>
    						   Username: <strong>demo@rxscoring.com</strong><br>password: <strong>demo</strong></p><br /><br />
    						<a class="btn btn-primary" href="/index.php/user/login">Sign In Here!</a>
    						<br /><br />    						    				
    					</div>    					
    				</div>  			
  				</div>
  				<!-- Carousel nav -->
  				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
	<?php 
		$pastReg = Registration::model()->findAll('reg_evt_end_dt < CURRENT_DATE and user_id not in (54,46) order by reg_evt_end_dt DESC');
		$currReg = Registration::model()->findAll('CURRENT_DATE between reg_evt_bgn_dt and  reg_evt_end_dt and user_id not in (54,46) order by reg_evt_nm ASC');
		$futReg = Registration::model()->findAll('reg_evt_bgn_dt > CURRENT_DATE and user_id not in (54,46) order by reg_evt_bgn_dt, reg_evt_nm ASC');
	?>

<div class="container-fluid">
<legend><br /></legend>
<br />
	<div class="row-fluid">
		<div class="span12">
			<div class="span4">
				<div class="well">					
					<?php 
						echo '<h3>Previous Events</h3>';
						if(sizeof($pastReg) > 0)
						{	
							echo '<table class="table">';								
							foreach($pastReg as $reg)
							{
								echo '<tr>';
								echo '<td style="width:55%; vertical-align:middle"><h5>'.$reg->reg_evt_nm.'</h5></td>';
								echo '<td style="width:45%; vertical-align:middle"><a class="btn btn-primary btn-small" href="/index.php/leaderboard/index/'.$reg->reg_id.'">Leaderboard</a></td>';
								echo '</tr>';
							}
							echo '</table>';
						}
						else
							echo '<table class="table"><tr><td><h5>No Events Found</h5></td><tr></table>';
					?>						
					</table>			
				</div>
			</div>
			<div class="span4">
				<div class="well">
					<?php 
						echo '<h3>Current Events</h3>';
						if(sizeof($currReg) > 0)
						{	
							echo '<table class="table">';								
							foreach($currReg as $reg)
							{
								echo '<tr>';
								echo '<td style="width:55%; vertical-align:middle"><h5>'.$reg->reg_evt_nm.'</h5></td>';
								echo '<td style="width:45%; vertical-align:middle"><a class="btn btn-primary btn-small" href="/index.php/leaderboard/index/'.$reg->reg_id.'">Leaderboard</a></td>';
								echo '</tr>';
							}
							echo '</table>';
						}
						else
							echo '<table class="table"><tr><td><h5>No Events Found</h5></td><tr></table>';
					?>		
				</div>
			</div>
			<div class="span4">
				<div class="well">
					<?php 
						echo '<h3>Upcoming Events</h3>';
						if(sizeof($futReg) > 0)
						{								
							echo '<table class="table">';								
							foreach($futReg as $reg)
							{
								$format = Yii::app()->dateFormatter->format('MM/dd/yy', $reg->reg_evt_bgn_dt);
								echo '<tr>';
								echo '<td style="width:50%; vertical-align:middle"><h5>'.$reg->reg_evt_nm.'</h5></td>';								
								echo '<td style="width:50%; vertical-align:middle"><h6 style="display:inline">Start-Date: </h6>'.$format.'</td>';
								echo '</tr>';
							}
						}
						else
							echo '<table class="table"><tr><td><h5>No Events Found</h5></td><tr></table>';
					?>				
				</div>
			</div>
		</div>
	</div>
<script src="/js/bootstrap-carousel.js"></script>
<script type="text/javascript">
	$('.carousel').carousel({interval: 5000});
</script>
<div style="display:none" class="modal fade" id="dia-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <h3>User Registration</h3>
    
  </div>
  
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>false,
	//'action' => Yii::app()->createUrl('/user/register')
    //'enableClientValidation'=>true,
)); ?>
  <div class="modal-body">    
     
<?php 
	if($model->hasErrors())
	{
		echo '<div class="alert-error">
  			  <button class="close" data-dismiss="alert">x</button>' 
				. $form->errorSummary($model) .   
			  '</div><br>';
	}
?>
<div class="height" style="padding-left: 50px">
<div class="row">
    <?php echo $form->labelEx($model,'user_email')?>
    <?php $form->error($model,'user_email')?>
    <?php echo $form->textField($model,'user_email'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'user_password')?>
    <?php $form->error($model,'user_password')?>
    <?php echo $form->passwordField($model,'user_password'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'user_verify_password')?>
    <?php $form->error($model,'user_verify_password')?>
    <?php echo $form->passwordField($model,'user_verify_password'); ?>
</div>
<div class="row">    
    <?php echo $form->labelEx($model,'verifyCode'); ?>
  <div>
   <?php echo $form->textField($model,'verifyCode'); ?>
   <?php $this->widget('CCaptcha', array('buttonLabel'=>' refresh')); ?>      
  </div>
  <input class="btn btn-primary" type="submit" value="Submit"> <a href="/index.php" class="btn">Cancel</a>
</div>
    
    <?php $this->endWidget(); ?>
 </div>
  <script src="/js/bootstrap-modal.js"></script>
<?php 
	if($err=='Y')
	{
		echo '<script type="text/javascript">
				 $(document).ready(function(){
				 $(\'#dia-register\').modal(\'show\');
				 });
		</script>';
	}

?>