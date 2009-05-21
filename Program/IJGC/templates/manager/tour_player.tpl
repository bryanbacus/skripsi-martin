<script type="text/javascript" src="./js/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<script type="text/javascript" src="./js/area.js">
</script>
{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}

{if $showList}
<div id="bdr">
  <form method="post">
		<table border="0" cellspacing="0" cellpadding="0" width="80%">
			<tr>
				<td>
					<strong>Search By :</strong>
					<select name="search_col">
						<option value="player_members_id">Membership ID</option>
						<option value="player_name">Player Name</option>
						<option value="player_parents_name">Parent Name</option>
					</select>
					<input type="text" name="search_val" value="" size="25" maxlength="45" /> 
					<input type="submit" name="cariplayerbtn" value="Search"/>
					<input name="reloadplayerbtn" type="submit" id="reloadplayerbtn" value="Reload"/>
				</td>
			</tr>
		</table>		
		<br>
		<table border="0" width="100%">
		<tr>
			<td width="50%">
				<input type="submit" name="createplayerbtn" value="Add non-member"/>
				<input type="submit" name="createplayerbtn" value="Add member"/>
			  <input name="cancelbtn" type="submit" id="cancelbtn" value="Cancel / Back To List" />
			</td>
			{if $datalist}
			<td width="50%" align="right"><div align="right">paging here</div></td>
			{/if}
		</tr>
		</table>		
	{if $datalist}
    <table class="adminlist" border="1" width="100%">
      <tr>
				<th>PLAYER MEMBER ID</th>
				<th>PLAYER NAME</th>
				<th>GROUP</th>
				<th>PARENTS NAME</th>
				<th>PLAYER CONTACT NO</th>
				<th>CONFIRMED TO PLAY</th>
				<th>ACTION</th>
      </tr>
      {section name=data loop=$datalist}
      <tr>
				<td valign="top">{$datalist[data].player_members_id}</td>
				<td valign="top">{$datalist[data].player_name}</td>
				<td valign="top">{$datalist[data].player_group}</td>
        <td valign="top">{$datalist[data].player_parents_name}</td>
				<td valign="top">{$datalist[data].player_contactno}</td>
				<td valign="top">{$datalist[data].player_confirmed}</td>
				<td valign="top" align="left">
					<li><a href="{$this_page}?aksi=tour_admin&aksi2=editplayer&id={$datalist[data].tour_id}&sid={$datalist[data].player_id}">Edit Profile</a></li>
					<li><a href="{$this_page}?aksi=tour_admin&aksi2=delplayer&id={$datalist[data].tour_id}&sid={$datalist[data].player_id}">Remove Profile</a></li>
					<li><a href="{$this_page}?aksi=tour_admin&aksi2=confirmplayer&id={$datalist[data].tour_id}&sid={$datalist[data].player_id}">Confirmed To Play</a></li>
					{if ($datalist[data].player_confirmed eq 'Confirmed')}
					<li><a href="{$this_page}?aksi=tour_admin&aksi2=scoreplayer&id={$datalist[data].tour_id}&sid={$datalist[data].player_id}">Edit Score</a></li>
					{/if}
				</td>
      </tr>
      {/section}
    </table>
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

{if $showDetail}
  <form method="post">
		<input type="hidden" name="tour_id" value="{$tour_id}" />
		<input type="hidden" name="player_id" value="{$player_id}" />
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td>Player Member ID</td>
				<td>:</td>
				<td><input type="text" name="player_member" value="{$player_member}" size="40" maxlength="45"></td>
			</tr>
			<tr>
				<td>Player Name</td>
				<td>:</td>
				<td><input type="text" name="player_name" value="{$player_name}" size="40" maxlength="45"></td>
			</tr>
			<tr>
				<td>Group</td>
				<td>:</td>
				<td>
					<select name="player_group">
						<option value="value">- Please select one -</option>
						<option value="A" {$g1}>A -- 15th s/d 17th</option>
						<option value="B" {$g2}>B -- 13th s/d 14th</option>
						<option value="C" {$g3}>C -- 11th s/d 12th</option>
						<option value="D" {$g4}>D -- 9th s/d 10th</option>
						<option value="E" {$g5}>E -- under 9th</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Age</td>
				<td>:</td>
				<td><input type="text" name="player_age" value="{$player_age}" size="5" maxlength="2"></td>
			</tr>								
			<tr>
				<td align="left">Birth Date</td>
				<td>:</td>
				<td><script>DateInput('birth_date', true, 'YYYY/MM/DD','{$birth_date}')</script></td>
			</tr>
			<tr>	
				<td align="left">Parents Name</td>
				<td>:</td>
				<td><input type="text" name="player_parents" value="{$player_parents}" size="40" maxlength="45"></td>				
			</tr>	
			<tr>
				<td>Contact No</td>
				<td>:</td>
				<td><input type="text" name="player_contactno" value="{$player_contactno}" size="40" maxlength="45"></td>
			</tr>	
			<tr>
				<td>E-mail Address</td>
				<td>:</td>
				<td><input type="text" name="player_email" value="{$player_email}" size="40" maxlength="45"></td>
			</tr>				
			<tr>
				<td>Home Adress</td>
				<td>:</td>
				<td><textarea name="player_home_address" rows="3" cols="40">{$player_home_address}</textarea></td>
			</tr>				
			<tr>
				<td colspan="3">
					<input name="addbtn" type="submit" id="addbtn" value="{$addbtn}">
					<input name="cancelplayerbtn" type="submit" id="cancelplayerbtn" value="Cancel & Back To List">
				</td>
			</tr>			
		</table>
		</div>
	</form>
{/if}

{if $showPlayer}
<div id="bdr">
  <form method="post">
		<table border="0" width="100%">
		<tr>
			<td width="50%">
				<input type="submit" name="addbtn" value="Add Selected"/>
			  <input name="cancelbtn2" type="submit" value="Cancel / Back To List" />
			</td>
			{if $datalist}
			<td width="50%" align="right"><div align="right">paging here</div></td>
			{/if}
		</tr>
		</table>		

    <table class="adminlist" border="1" width="100%">
      <tr>
				<th>&nbsp;</th>
				<th>PLAYER MEMBER ID</th>
				<th>PLAYER NAME</th>
				<th>GROUP</th>
				<th>PARENTS NAME</th>
				<th>PLAYER CONTACT NO</th>
      </tr>
      {section name=data loop=$datalist}
      <tr>
				<td><input type="checkbox" name="member_id[]" value="{$datalist[data].player_members_id}"  /></td>
				<td valign="top">{$datalist[data].player_members_id}</td>
				<td valign="top">{$datalist[data].player_name}</td>
				<td valign="top">{$datalist[data].player_group}</td>
        <td valign="top">{$datalist[data].player_parents_name}</td>
				<td valign="top">{$datalist[data].player_contactno}</td>
      </tr>
      {/section}
    </table>
  </form>	
</div>	
{/if}

{if $editDetail}	
	<form method="post" name="score">
		<input type="hidden" name="games_id" value="{$games_id}" />
		<input type="hidden" name="aksi2" value="" />
		<div id="bdr">			
			<p><strong>Round Score </strong></p>
			<br>
			<table width="75%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="1%"></td><td width="99%"><p style="color:#FF0000">{$msg}</p></td></tr><tr><td></td><td>
			<table border="0" width="60%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left">Round No:
							<select name="id_round" onchange="change_round();">
								<option value="value">- Please select one -</option>
								{section name=data loop=$list}
									<option value="{$list[data].value}" {$list[data].selected}>{$list[data].param}</option>
								{/section}							
							</select>						
					</td>
				</tr>
			</table>				
			</td></tr><tr><td></td><td>
			<table width="100%" border="1" cellspacing="0" cellpadding="0" class="biasa">
				<tr>
					<th>Hole</th>
					<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
					<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th>
				</tr>
				<tr>
					<th>Par</th>
					<td width="2%"><input type="text" name="hole1_par" value="{$hole1_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole2_par" value="{$hole2_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole3_par" value="{$hole3_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole4_par" value="{$hole4_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole5_par" value="{$hole5_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole6_par" value="{$hole6_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole7_par" value="{$hole7_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole8_par" value="{$hole8_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole9_par" value="{$hole9_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole10_par" value="{$hole10_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole11_par" value="{$hole11_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole12_par" value="{$hole12_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole13_par" value="{$hole13_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole14_par" value="{$hole14_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole15_par" value="{$hole15_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole16_par" value="{$hole16_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole17_par" value="{$hole17_par}" size="2" maxlength="2" readonly="true"/></td>
					<td width="2%"><input type="text" name="hole18_par" value="{$hole18_par}" size="2" maxlength="2" readonly="true"/></td>
				</tr>
				<tr>
					<th>Score</th>
					<td><input type="text" name="hole1_score" value="{$hole1_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole2_score" value="{$hole2_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole3_score" value="{$hole3_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole4_score" value="{$hole4_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole5_score" value="{$hole5_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole6_score" value="{$hole6_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole7_score" value="{$hole7_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole8_score" value="{$hole8_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole9_score" value="{$hole9_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole10_score" value="{$hole10_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole11_score" value="{$hole11_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole12_score" value="{$hole12_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole13_score" value="{$hole13_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole14_score" value="{$hole14_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole15_score" value="{$hole15_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole16_score" value="{$hole16_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole17_score" value="{$hole17_score}" size="2" maxlength="2"/></td>
					<td><input type="text" name="hole18_score" value="{$hole18_score}" size="2" maxlength="2"/></td>
				</tr>			
				<tr>
					<td colspan="19">
						<input type="submit" name="saveparbtn" value="Save Score"/>
						<input type="submit" name="cancelparbtn" value="Close"/>				
					</td>
				</tr>
			</table>
			</td></tr></table>		
		</div>
  </form>	
{/if}

