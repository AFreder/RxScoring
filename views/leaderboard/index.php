<script type="text/javascript" src="/js/bootstrap-tab.js"></script>
<script src="/js/bootstrap-tooltip.js"></script>
<script src="/js/bootstrap-popover.js"></script>
<style>
/* tables */
table.tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 8pt;
	width: 100%;
	text-align: left;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #eeeeee;
	border: 1px solid #FFF;
	font-size: 8pt;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(/js/themes/blue/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	/*color: #3D3D3D;*/
	padding: 4px;
	background-color: #FFF;
	vertical-align: top;
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(/js/themes/blue/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(/js/themes/blue/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #DCDCDC;
}
a.newBg
{
	color: black;
	background-color: #DCDCDC;
} 
</style>


<div class="offset1">
<?php 
	echo '<br><h1>'.$registration->reg_evt_nm.' Leaderboard</h1><br /><br />';
	
	if(sizeof($division) > 0)
	{
		echo '<div class="tabbable"> 
  				<ul class="nav nav-tabs">';
		$i=0;
  		foreach($division as $div)
  		{
  			if($i==0)	
  				echo '<li class="active"><a class="newBg" href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		else 
    			echo '<li><a class="newBg" href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		$i++;		
		}
				
		echo '</ul>';
		echo '<div class="tab-content">';
		$j=0;
		$placeEnd = array('th','st','nd','rd','th','th','th','th','th','th');
		foreach($division as $div)
  		{
  			if($j==0)
				echo '<div class="tab-pane active" id="div'.$div->div_id.'">';
			else
				echo '<div class="tab-pane" id="div'.$div->div_id.'">';	
			echo '<br><table class="table table-bordered table-condensed tablesorter" id="table_'.$div->div_id.'">
					<thead><tr><th style="width:75px">Place</th><th class="sorter-numeric">Competitor Name</th>';
            foreach($event as $row)
            {
            	$desc = $row->evnt_desc;
            	$thid =  'div_'.$div->div_id.'_evnt_'.$row->evnt_order;			
				echo '<th id="'.$thid.'"'.
				' onmouseover="$(\'#div_'.$div->div_id.'_evnt_'.$row->evnt_order.'\').popover(\'show\')"'.
				' onmouseout="$(\'#div_'.$div->div_id.'_evnt_'.$row->evnt_order.'\').popover(\'hide\')"'.
				' onclick="$(\'#div_'.$div->div_id.'_evnt_'.$row->evnt_order.'\').popover(\'show\')"'.
				' data-content="'.nl2br(str_replace('"','\'',$row->evnt_desc)).'"'.
				' data-original-title="'.nl2br($row->evnt_name).'"'.
				'>'.$row->evnt_name.'</th>';
           }
           echo '</tr></thead><tbody>';
            
			$flag = 'N';
			
				
			
			
			$i=1;
			$prev_result = '';
			if($registration->reg_scre_type == 'REGIONALS')
			{	
				$competitor = Competitor::model()->findAllByAttributes(array('div_id'=>$div->div_id),array('order'=>'comp_status ASC, comp_rank ASC'));				
				foreach($competitor as $comp)
				{
					$flag='Y';
					if($comp->comp_rank > 10 && $comp->comp_rank < 14)
						$ending = 'th';
					else 
						$ending = $placeEnd[substr($comp->comp_rank,-1)];
					
					if($comp->comp_status == 'ACTIVE')
					{	
						$comp_score_total = '('.$comp->comp_score_total.')';
						$comp_rank = '<h4 style="display:inline">'.$comp->comp_rank.$ending.'</h4>';				
					}
					else 
					{	
						$comp_score_total = '<h4>'.$comp->comp_status.'</h4>';
						$comp_rank = '';
					}
												
					if($comp->comp_score_total != 0)
						echo '<tr><td>'.$comp_rank.' '.$comp_score_total.'</td><td> '.$comp->comp_name. '</td>';						
					else
						echo '<tr><td>(-)</td><td> '.$comp->comp_name. '</td>';
	
					foreach($event as $evnt)
					{
						$scre = Score::model()->findByAttributes(array('comp_id'=>$comp->comp_id, 'evnt_id'=>$evnt->evnt_id));																	
						if($scre->scre_points > 10 && $scre->scre_points < 14)
							$ending = 'th';
						else 
							$ending = $placeEnd[substr($scre->scre_points,-1)];														
						if($evnt->evnt_type == 'Time Priority (For Repititions)')
						{
							$explode = explode('.', $scre->scre_time_prty);
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
							{
								$explode = explode('.', $scre->scre_time_prty);
								echo '<td>'.$scre->scre_points.$ending.'<br> ('.$explode[0].$evnt->evnt_measure.')</td>';
							}
							else 
								echo '<td> - ('.$explode[0].$evnt->evnt_measure.')</td>';
						}
						else if($evnt->evnt_type == 'Task Priority (For Time)')
						{
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
								echo '<td>'.$scre->scre_points.$ending.'<br> ('.$scre->scre_task_prty.$evnt->evnt_measure.')</td>';
							else 
								echo '<td> - ('.$scre->scre_task_prty.$evnt->evnt_measure.')</td>';
						}
						else
						{
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
								echo '<td>'.$scre->scre_points.$ending.'<br> ('.$scre->scre_other.$evnt->evnt_measure.')</td>';
							else 
								echo '<td> - ('.$scre->scre_other.$evnt->evnt_measure.')</td>';
						}
						$i++;					
					}
					echo '</tr>';
				}
			}
			else 
			{
				$competitor = Competitor::model()->findAllByAttributes(array('div_id'=>$div->div_id),array('order'=>'comp_status ASC, comp_games_rank ASC'));
				foreach($competitor as $comp)
				{
					$flag='Y';
					if($comp->comp_games_rank > 10 && $comp->comp_games_rank < 14)
						$ending = 'th';
					else 
						$ending = $placeEnd[substr($comp->comp_games_rank,-1)];
					
					if($comp->comp_status == 'ACTIVE')
					{	
						$comp_score_total = '('.$comp->comp_games_score_total.')';
						$comp_rank = '<h4 style="display:inline">'.$comp->comp_games_rank.$ending.'</h4>';				
					}
					else 
					{	
						$comp_score_total = '<h4>'.$comp->comp_status.'</h4>';
						$comp_rank = '';
					}
												
					if($comp->comp_games_score_total != 0)
						echo '<tr><td>'.$comp_rank.' '.$comp_score_total.'</td><td> '.$comp->comp_name.'</td>';						
					else
						echo '<tr><td>(-)</td><td> '.$comp->comp_name. '</td>';
	
					foreach($event as $evnt)
					{
						$scre = Score::model()->findByAttributes(array('comp_id'=>$comp->comp_id, 'evnt_id'=>$evnt->evnt_id));						
						if($scre->scre_points > 10 && $scre->scre_points < 14)
							$ending = 'th';
						else 
							$ending = $placeEnd[substr($scre->scre_points,-1)];														
						if($evnt->evnt_type == 'Time Priority (For Repititions)')
						{
							$explode = explode('.', $scre->scre_time_prty);
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
							{
								$explode = explode('.', $scre->scre_time_prty);
								echo '<td>'.$scre->scre_points.''.$ending.' <br>'.$scre->scre_games_points.
										' pts<br> ('.$explode[0].$evnt->evnt_measure.')</td>';
							}
							else 
								echo '<td> - ('.$explode[0].$evnt->evnt_measure.')</td>';
						}
						else if($evnt->evnt_type == 'Task Priority (For Time)')
						{
							if($scre->scre_points > 10 && $scre->scre_points < 14)
								$ending = 'th';
							else 
							$ending = $placeEnd[substr($scre->scre_points,-1)];
						$place = $scre->scre_points.$ending;	
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
								echo '<td>'.$scre->scre_points.''.$ending.' <br>'.$scre->scre_games_points.' pts<br> ('.$scre->scre_task_prty.$evnt->evnt_measure.')</td>';
							else 
								echo '<td> - ('.$scre->scre_task_prty.$evnt->evnt_measure.')</td>';
						}
						else
						{
							if($scre->scre_status != 'ACTIVE')
								echo '<td>'.$scre->scre_status.'</td>';
							else if($scre->scre_entered == 'Y')
								echo '<td>'.$scre->scre_points.''.$ending.' <br>'.$scre->scre_games_points.' pts<br> ('.$scre->scre_other.$evnt->evnt_measure.')</td>';
							else 
								echo '<td> - ('.$scre->scre_other.$evnt->evnt_measure.')</td>';
						}
						$i++;					
					}
					echo '</tr>';
				}
			}		
			if($flag == 'N')
				echo '<tr><td>No Competitors Found</td></tr></table></div>';
			else
				echo '</tbody></table></div>';
			$j++;
		}		
		echo '<script src="/js/development-bundle/external/jquery.cookie.js"></script>';
		echo '<script src="/js/development-bundle/external/jquery.json-2.3.min.js"></script>';
		echo '<script src="/js/jquery.tablesorter.js"></script>';
		echo '<script src="/js/jquery.tablesorter.widgets.js"></script>';
		
		?>
		<script>
			$.tablesorter.addParser({ 
	        // 	set a unique id 
	        	id: 'place', 
	        	is: function(s) { 
	            // 	return false so this parser is not auto detected 
	            	return false; 
	        	}, 
	        	format: function(s) { 
	            // 	format your data for normalization	            	
	            	var array, place;
	            	array=jQuery.trim(s).split(" ");
	            	//if(array[0].substr(0,1) != parseInt(array[0].substr(0,1)
	            	myInt=array[0].substr(0,array[0].length-2);
	            	if (array[0].substr(0,1) != parseInt(array[0].substr(0,1)))
		            	place = 9999999;
	            	else
	            		place = parseInt(array[0].substr(0,array[0].length-2));
	            	//alert(p[0]);	            	
	            	return place; 
	        	}, 
	        // 	set type, either numeric or text 
	        	type: 'numeric' 
	    	}); 	
			
				  $.tablesorter.addWidget({
				    // give the widget an id
				    id: "sortPersist",
				    // format is called when the on init and when a
				    // sorting has finished
				    format: function(table) {
				 
				      // Cookie info
				      var cookieName = 'MY_SORT_COOKIE';				      
				      var cookie = $.cookie(cookieName);
				      var options = {path: '/'};
				 
				      var data = {};
				      var sortList = table.config.sortList;
				      var tableId = $(table).attr('id');
				      var cookieExists = (typeof(cookie) != "undefined"
				          && cookie != null);
				 
				      // If the existing sortList isn't empty, set it into the cookie
				      // and get out
				      if (sortList.length > 0) {
				        if (cookieExists) {
				          data = $.evalJSON(cookie);
				        }
				        data[tableId] = sortList;
				        $.cookie(cookieName, $.toJSON(data), options);
				      }
				 
				      // Otherwise...
				      else {
				        if (cookieExists) { 
				 
				          // Get the cookie data
				          var data = $.evalJSON($.cookie(cookieName));
				 
				          // If it exists
				          if (typeof(data[tableId]) != "undefined"
				              && data[tableId] != null) {
				 
				            // Get the list
				            sortList = data[tableId];
				 
				            // And finally, if the list is NOT empty, trigger
				            // the sort with the new list
				            if (sortList.length > 0) {
				              $(table).trigger("sorton", [sortList]);
				            }
				          }
				        }
				      }
				    }
				  });	
		</script>
	<?php 
		foreach($division as $div)
		{			  			
			echo '
			<script>
    			$(function() { 
        			$("#table_'.$div->div_id.'").tablesorter({          				            		
        				headers: {
            				0: { sorter:\'place\' },';
			$i=2;			
			foreach($event as $evnt)
			{	
				echo ' '.$i.': { sorter:\'place\' },';
				$i++; 
			}	
			 	echo' 
            			},
            			widgets: ["sortPersist"]
			        }); 
    			});
			</script>';	

			foreach($event as $evnt)
			{
				echo '<script>';			
				echo '$(\'#div_'.$div->div_id.'_evnt_'.$evnt->evnt_order.'\').popover({placement: \'left\'});';
				echo '</script>';
			}			
			
		}		
	}
	else 
		echo '<h1>Leaderboard has not been setup yet!</h1>';
	?>
</div>