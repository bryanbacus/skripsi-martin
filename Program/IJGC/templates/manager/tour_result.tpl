<script type="text/javascript" src="./js/area.js">
</script>
{if $pesan}
<div id="pesan"> {$pesan} </div>
{/if}

{if $showList}
<div id="bdr">
  <form method="post" name="score">
    <br>
    <table border="0" width="100%">
      <tr><td width="1%"></td><td width="99%">
        <input name="cancelbtn" type="submit" id="cancelbtn2" value="Cancel / Back To List" />
				{if $admin}<input name="calculatebtn" type="submit" id="calculatebtn" value="Calculate Result Tournaments"/>{/if}
				<input name="aksi2" type="hidden" value="" />
			</td></tr>
    </table>
    {if $datalist}
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="99%">			
    <table class="adminlist" border="1" width="60%">
      <tr>
        <th>POSITION NO </th>
        <th>PLAYER NAME</th>
        <th>GROUP</th>
				<th>SCORE</th>
        <th>RANKING POINTS </th>
        <th>TRIAL POINTS </th>
        <th>TOTAL REWARD</th>
      </tr>
      {section name=data loop=$datalist}
      <tr>
        <td valign="top">{$datalist[data].position_no}</td>
        <td valign="top">{$datalist[data].player_name}</td>
        <td valign="top">{$datalist[data].player_group}</td>
				<td valign="top">{$datalist[data].player_score}</td>
        <td valign="top">{$datalist[data].player_ranking}</td>
        <td valign="top">{$datalist[data].player_trial}</td>
        <td valign="top">{$datalist[data].player_reward}</td>
      </tr>
      {/section}
    </table>
		
		</td><tr><td>&nbsp;</td><td></td></tr>
		<tr><td></td><td>
			Round No:
			<select name="id_round" onchange="change_result();">
				{section name=data loop=$list}
				<option value="{$list[data].value}" {$list[data].selected}>{$list[data].param}</option>
				{/section}							
			</select>		
		</td></tr>
		<tr><td></td><td>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="biasa">
			<tr>
				<th width="10%">Hole</th>
				<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>OUT</th>
				<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>IN</th><th>TOTAL</th>
			</tr>
			<tr>
				<th>Par</th>
				<td width="2%">{$hole1_par}</td>
				<td width="2%">{$hole2_par}</td>
				<td width="2%">{$hole3_par}</td>
				<td width="2%">{$hole4_par}</td>
				<td width="2%">{$hole5_par}</td>
				<td width="2%">{$hole6_par}</td>
				<td width="2%">{$hole7_par}</td>
				<td width="2%">{$hole8_par}</td>
				<td width="2%">{$hole9_par}</td>
				<td width="2%">{$out_par}</td>
				<td width="2%">{$hole10_par}</td>
				<td width="2%">{$hole11_par}</td>
				<td width="2%">{$hole12_par}</td>
				<td width="2%">{$hole13_par}</td>
				<td width="2%">{$hole14_par}</td>
				<td width="2%">{$hole15_par}</td>
				<td width="2%">{$hole16_par}</td>
				<td width="2%">{$hole17_par}</td>
				<td width="2%">{$hole18_par}</td>
				<td width="2%">{$in_par}</td>
				<td width="2%">{$total_par}</td>
			</tr>		
			{section name=data loop=$playerlist}
			<tr>
				<td>{$playerlist[data].name}</td>
				<td>{$playerlist[data].hole1_score}</td>
				<td>{$playerlist[data].hole2_score}</td>
				<td>{$playerlist[data].hole3_score}</td>
				<td>{$playerlist[data].hole4_score}</td>
				<td>{$playerlist[data].hole5_score}</td>
				<td>{$playerlist[data].hole6_score}</td>
				<td>{$playerlist[data].hole7_score}</td>
				<td>{$playerlist[data].hole8_score}</td>
				<td>{$playerlist[data].hole9_score}</td>
				<td>{$playerlist[data].holeout_score}</td>
				<td>{$playerlist[data].hole10_score}</td>
				<td>{$playerlist[data].hole11_score}</td>
				<td>{$playerlist[data].hole12_score}</td>
				<td>{$playerlist[data].hole13_score}</td>
				<td>{$playerlist[data].hole14_score}</td>
				<td>{$playerlist[data].hole15_score}</td>
				<td>{$playerlist[data].hole16_score}</td>
				<td>{$playerlist[data].hole17_score}</td>
				<td>{$playerlist[data].hole18_score}</td>
				<td>{$playerlist[data].holein_score}</td>
				<td>{$playerlist[data].holetotal_score}</td>
			</tr>
			{/section}
		</table>
		</td></tr></table>		
    {else}
    <table border="0">
      <tr>
        <td>{$course_msg}</td>
      </tr>
    </table>
    {/if}
	</form>
</div>

{/if}