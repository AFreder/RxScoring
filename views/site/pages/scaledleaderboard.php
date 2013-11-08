<br>
<h1 style='text-align:center'>LEADERBOARD (Scaled)</h1>
<br>
<br>
<p>
	<table class="table table-striped" style="border:1px solid #999999">

		<?php	

		function sortEvent ($array, $att, $sortOrder)
		{
				$tmpArr = $array;
				$order = $sortOrder;
				foreach ($tmpArr as $key => $row) 
				{
	    			$att1[$key]  = $row['comp_id'];
    				$att2[$key] = $row[$att];
				}		
				if($order == 'ASC')	
				{
					array_multisort($att2, SORT_ASC, $att1, SORT_ASC, $tmpArr);
				}
				else 
				{
					array_multisort($att2, SORT_DESC, $att1, SORT_ASC, $tmpArr);
				}
							
				return $tmpArr;			
		}
		
		function createScore($array, $event)
		{
			$tmpCreate = $array;
			$i = 0;
			$score = 0;
			$offset = 0;
			$prevResult = '';
			$zeroFlag = '';
			
        	foreach ($tmpCreate as $create)
			{
				if($event == 'comp_event1') {
					if($create->$event == 0) { $zeroFlag = 'Y'; }
					else { $zeroFlag = 'N'; }
				}
				else { 
					if($create->$event == '00:00:00') { $zeroFlag = 'Y'; }
					else { $zeroFlag = 'N'; }
				}				
								
				$createdArr[$i][0] = $create->comp_id;
				
				if($zeroFlag == 'N')
				{
					if($i != 0 && $create->$event == $prevResult)
					{
						$createdArr[$i][1] = $score + 1 + $offset;
					}
					else 
					{						
						$score=$i;
						$createdArr[$i][1] = $score + 1 + $offset;						
					}
				}
				else
				{
					
					$createdArr[$i][1] = 0;
					$offset--;
				}
				$prevResult = $create->$event;
				$i++;				
			}
			
			return $createdArr;
		
		}
		
        function sortRank ($array)
		{
				$tmpArr = $array;
				foreach ($tmpArr as $key => $row) 
				{
	    			$att1[$key] = $row[0];
    				$att2[$key] = $row[1];
				}			
				array_multisort($att1, SORT_ASC, $att2, SORT_ASC, $tmpArr);
			
				return $tmpArr;			
		}
		
		function sortFinal ($array)
		{
				$tmpArr = $array;
				foreach ($tmpArr as $key => $row) 
				{
	    			$att1[$key] = $row[0];
    				$att2[$key] = $row[1];
    				$att3[$key] = $row[2];
    				$att4[$key] = $row[3];
    				$att5[$key] = $row[4];
    				$att6[$key] = $row[5];
    				$att7[$key] = $row[6];
    				$att8[$key] = $row[7];
    				$att9[$key] = $row[8];
    				$att10[$key] = $row[9];
    				$att11[$key] = $row[10];
				}			
				array_multisort($att1, SORT_ASC, $att3, SORT_ASC, $att5, SORT_ASC, $att7, SORT_ASC, $att9, SORT_ASC, $tmpArr);
			
				return $tmpArr;			
		}
		if(count($compName) > 0)
		{
			echo '<thead><tr>
			<td></td>
			<td></td>
			<td style="font-weight:900;text-align:left">Competitor</td>			
			<td style="font-weight:900;text-align:center">Event 1</td>
			<td style="font-weight:900;text-align:center">Event 2</td>
			<td style="font-weight:900;text-align:center">Event 3</td>	 
			<td style="font-weight:900;text-align:center">Event 4</td>
		</tr></thead>';
			
			$event1sorted = sortEvent($compName, 'comp_event1', 'DESC');
			$event1score = createScore($event1sorted, 'comp_event1');
			$event2sorted = sortEvent($compName, 'comp_event2', 'ASC');
			$event2score = createScore($event2sorted, 'comp_event2');
			$event3sorted = sortEvent($compName, 'comp_event3', 'ASC');
			$event3score = createScore($event3sorted, 'comp_event3');
			$event4sorted = sortEvent($compName, 'comp_event4', 'ASC');
			$event4score = createScore($event4sorted, 'comp_event4');           
									
			$event1byID = sortRank($event1score);
			$event2byID = sortRank($event2score);
			$event3byID = sortRank($event3score);
			$event4byID = sortRank($event4score);
			$event1comp = sortEvent($compName, 'comp_id', 'ASC');
			$event2comp = sortEvent($compName, 'comp_id', 'ASC');
			$event3comp = sortEvent($compName, 'comp_id', 'ASC');
			$event4comp = sortEvent($compName, 'comp_id', 'ASC');		
			
			$i=0;
			foreach ($event1comp as $competitor)
			{
				$compFinal[$i][0] = $event1byID[$i][1] + $event2byID[$i][1] + $event3byID[$i][1] + $event4byID[$i][1];
				if($compFinal[$i][0] == 0)
				{
					$compFinal[$i][0] = 1000000;
				}
				$compFinal[$i][1] = $competitor->comp_id;
				$compFinal[$i][2] = $competitor->comp_name;
				$compFinal[$i][3] = $event1byID[$i][1];
				$compFinal[$i][4] = $competitor->comp_event1;
				$compFinal[$i][5] = $event2byID[$i][1];
				$compFinal[$i][6] = $competitor->comp_event2;
				$compFinal[$i][7] = $event3byID[$i][1];
				$compFinal[$i][8] = $competitor->comp_event3;
				$compFinal[$i][9] = $event4byID[$i][1];
				$compFinal[$i][10] = $competitor->comp_event4;
				$i++;								
			}
						
			$scoreboard = sortFinal($compFinal);
			$i=1;					
			foreach ($scoreboard as $leaderboard)
			{
				$display = '';
				if($leaderboard[0] == 1000000){$display = '-';} else{$display = $leaderboard[0];}
				echo '<tr><td style="text-align:right; border-right:none; padding-right:0px">' . $i . 
				'</td><td style="text-align:left;padding-right:0px"> (' . $display . ')</td><td> ' . 
				$leaderboard[2] . '</td><td style="text-align:center">' .   
				$leaderboard[3] . ' (' . $leaderboard[4] . ')</td><td style="text-align:center"> ' . 
				$leaderboard[5] . ' (' . $leaderboard[6] . ')</td><td style="text-align:center"> ' .
				$leaderboard[7] . ' (' . $leaderboard[8] . ')</td><td style="text-align:center"> ' .
				$leaderboard[9] . ' (' . $leaderboard[10] . ')</td></tr>';
				$i++;   
			}
		}
		else 
		{
			echo "<tr><td style='text-align:center' colspan=5><h5>NO RESULLTS</h5></td></tr>";
		}	
			
			
			
		?>
	</table>
</p>
