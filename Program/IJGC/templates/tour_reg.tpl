<script type="text/javascript" src="./js/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<td>
{if $showDetail}
  <form method="post">
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr><td colspan="3"><span style="color: #FF0000">*</span> indicates field must be filled</td>
			<tr>
				<td width="15%">Tournaments Event</td>
				<td width="1%">:</td>
				<td>
					<select name="tour_id">
						<option value="value">- Please select one -</option>
						{section name=data loop=$list}
						<option value="{$list[data].tour_id}" >{$list[data].tour_name}</option>
						{/section}
					</select>				
				</td>
			</tr>		
			<tr>
				<td>Player Member ID</td>
				<td>:</td>
				<td><input type="text" name="player_member" value="{$player_member}" size="40" maxlength="45"></td>
			</tr>
			<tr>
				<td>Player Name <span style="color: #FF0000">*</span> </td>
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
				<td align="left">Parents Name<span style="color: #FF0000">*</span></td>
				<td>:</td>
				<td><input type="text" name="player_parents" value="{$player_parents}" size="40" maxlength="45"></td>				
			</tr>	
			<tr>
				<td>Contact No<span style="color: #FF0000">*</span></td>
				<td>:</td>
				<td><input type="text" name="player_contactno" value="{$player_contactno}" size="40" maxlength="45"></td>
			</tr>	
			<tr>
				<td>E-mail Address</td>
				<td>:</td>
				<td><input type="text" name="player_email" value="{$player_email}" size="40" maxlength="45"></td>
			</tr>				
			<tr>
				<td>Home Adress<span style="color: #FF0000">*</span></td>
				<td>:</td>
				<td><textarea name="player_home_address" rows="3" cols="40">{$player_home_address}</textarea></td>
			</tr>				
			<tr>
				<td colspan="3">
					<input name="addbtn" type="submit" id="addbtn" value="Register Me!">
					<input name="cancelbtn" type="submit" value="Close & Back To Tournaments List">
				</td>
			</tr>			
		</table>
		</div>
	</form>
{/if}

{if $showSukses}
  <form method="post">
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td>Thank you, your account / data has been registered to the tournaments player list. Our Staff will confirm to you soon.</td>
			</tr>		
			<tr>
				<td>
					<input name="cancelbtn" type="submit" id="cancelbtn" value="Close & Back To Tournaments List">
				</td>
			</tr>			
		</table>
		</div>
	</form>
{/if}
</td>