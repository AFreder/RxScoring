<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />	

    <!-- Le styles -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .navbar-fixed-top {
		margin-left: -20px;
		margin-right: -20px;
		}
    </style>   

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->	    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<script type="text/javascript">	
  	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-33856071-1']);
  	_gaq.push(['_trackPageview']);
	
	(function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();
</script>	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>					      	 
	<script type="text/javascript" src="/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="/js/bootstrap-alert.js"></script>			
</head>

<body>
<div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>          
          <?php echo '<a class="brand" href="/index.php">'.Yii::app()->name; ?></a>          
            <?php if(!Yii::app()->user->isGuest)
            	{
                  echo '<div class="nav-collapse">
            		<ul class="nav pull-right">
            		<li id="fat-menu" class="dropdown">                                        
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	'.Yii::app()->user->name.'
                    	<b class="caret"></b></a>                    
                    <ul class="dropdown-menu">
					<li><a href="/index.php/user/logout">Logout</a></li>
					</ul>
                	</li>';                  	
                 }
                 else 
                 	echo '<ul class="nav pull-right">
                 			<li><a href="/index.php/user/login">Sign In</a>
                 			</li>
                 			</ul>';
                  ?>                      
                
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>
<div class="container" >

	<?php echo $content; ?>

	<div class="clear"></div>


</div><!-- page -->


</body>
</html>
