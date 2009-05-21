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
					<input type="submit" name="cariregbtn" value="Search"/>
					<input name="reloadregbtn" type="submit" id="reloadregbtn" value="Reload"/>
				</td>
			</tr>
		</table>		
		<br>
		<table border="0" width="100%">
		<tr>
			<td width="20%"><input name="cancelbtn" type="submit" id="cancelbtn2" value="Cancel / Back To List" /></td>
			{if $datalist}
			<td width="80%" align="right"><div align="right">paging here</div></td>
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
				<th>APPROVED TO PLAY </th>
				<th>ACTION</th>
      </tr>
      {section name=data loop=$datalist}
      <tr>
				<td valign="top">{$datalist[data].player_members_id}</td>
				<td valign="top">{$datalist[data].player_name}</td>
				<td valign="top">{$datalist[data].player_group}</td>
        <td valign="top">{$datalist[data].player_parents_name}</td>
				<td valign="top">{$datalist[data].player_contactno}</td>
				<td valign="top">{$datalist[data].player_approved}</td>
				<td valign="top" align="left">
					<li><a href="{$this_page}?aksi=touradmin&aksi2=viewreg&id={$datalist[data].tour_id}&sid={$datalist[data].indent_id}">View Profile</a></li>
					<li><a href="{$this_page}?aksi=touradmin&aksi2=aprovereg&id={$datalist[data].tour_id}&sid={$datalist[data].indent_id}">Approve to play</a></li>
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
		<input type="hidden" name="id" value="{$tour_id}" />
		<input type="hidden" name="sid" value="{$indent_id}" />
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20%">Register Date</td>
				<td width="1%">:</td>
				<td>{$reg_date}</td>
			</tr>			
			<tr>
				<td width="20%">Player Member ID</td>
				<td width="1%">:</td>
				<td>{$player_member_id}</td>
			</tr>		
			<tr>
				<td>Player Name</td>
				<td>:</td>
				<td>{$player_name}</td>
			</tr>		
			<tr>
				<td>Group</td>
				<td>:</td>
				<td>{$group}</td>
			</tr>		
			<tr>
				<td>Age</td>
				<td>:</td>
				<td>{$age}</td>
			</tr>		
			<tr>
				<td>Birth Date</td>
				<td>:</td>
				<td>{$birth_date}</td>
			</tr>		
			<tr>
				<td>Parent Name</td>
				<td>:</td>
				<td>{$parent_name}</td>
			</tr>		
			<tr>
				<td>Contact No</td>
				<td>:</td>
				<td>{$contact_no}</td>
			</tr>	
			<tr>
				<td>Email Address</td>
				<td>:</td>
				<td>{$email}</td>
			</tr>		
			<tr>
				<td>Home Address</td>
				<td>:</td>
				<td>{$address}</td>
			</tr>							
			<tr>
				<td>Approved To Play </td>
				<td>:</td>
				<td>{$approved}</td>
			</tr>	
			<tr>
				<td colspan="3">
					<input name="cancelbtn" type="submit" id="backbtn" value="Close / Back To List">
					<input name="approveregbtn" type="submit" id="approveregbtn" value="Approved">
				</td>
			</tr>			
		</table>
		</div>
  </form>	
{/if}

