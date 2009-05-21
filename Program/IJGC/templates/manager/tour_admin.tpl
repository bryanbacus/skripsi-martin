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
				<td width="8%">
					<strong>Filter By</strong><br/>
				</td>
				<td width="20%"><script>DateInput('awal', true, 'YYYY/MM/DD','{$awal}')</script></td>
				<td width="5%">until</td>
				<td width="20%"><script>DateInput('akhir', true, 'YYYY/MM/DD','{$akhir}')</script></td>
				<td>
				<input name="filterbtn" type="submit" id="filterbtn" value="Filter &amp; Reload"/></td>
			</tr>
		</table>
		<br>		
		<table border="0" cellspacing="0" cellpadding="0" width="80%">
			<tr>
				<td>
					<strong>Search By :</strong>
					<select name="search_col">
						<option value="tour_name">Tournaments Name</option>
						<option value="tour_place">Tournaments Place</option>
						<option value="course_name">Course Name</option>
					</select>
					<input type="text" name="search_val" value="" size="25" maxlength="45" /> 
					<input type="submit" name="caribtn" value="Search"/>
				</td>
			</tr>
		</table>		
		<br>
		<table border="0" width="100%">
		<tr>
			<td width="20%"><input type="submit" name="createbtn" value="Create new tournaments"/></td>
			{if $datalist}
			<td width="80%" align="right"><div align="right">paging here</div></td>
			{/if}
		</tr>
		</table>		
	{if $datalist}
    <table class="adminlist" border="1" width="100%">
      <tr>
				<th>EVENT DATE</th>
				<th>TOURNAMENTS NAME </th>
				<th>PLACE</th>
				<th>COURSE</th>
				<th>TOURNAMENTS LEVEL </th>
				<th>STATUS</th>
				<th>ACTION</th>
      </tr>
      {section name=data loop=$datalist}
      <tr>
				<td valign="top">{$datalist[data].tour_evt_date}</td>
				<td valign="top">{$datalist[data].tour_name}</td>
				<td valign="top">{$datalist[data].tour_place}</td>
        <td valign="top">{$datalist[data].tour_course}</td>
				<td valign="top">{$datalist[data].tour_levels}</td>
				<td valign="top">{$datalist[data].tour_status}</td>
				<td valign="top" align="left">
					<li><a href="{$this_page}?aksi=touradmin&aksi2=edit&id={$datalist[data].tour_id}">Edit Tournaments</a></li>
					<li><a href="{$this_page}?aksi=touradmin&aksi2=delete&id={$datalist[data].tour_id}">Remove Tournaments</a></li>
					<li><a href="{$this_page}?aksi=touradmin&aksi2=register&id={$datalist[data].tour_id}">View Register List</a></li>
					<li><a href="{$this_page}?aksi=touradmin&aksi2=player&id={$datalist[data].tour_id}">View Player List</a></li>
					<li><a href="{$this_page}?aksi=touradmin&aksi2=result&id={$datalist[data].tour_id}">View Result</a></li>
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
		<input type="hidden" name="round_id" value="{$round_id}" />
		<input type="hidden" name="aksi2" value="" />
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr><td></td><td></td><td></td><td width="40%"></td></tr>		
			<tr>
				<td align="left">
					<div align="left">Tournaments Name : </div>
					<div align="left">
						<input type="text" name="tour_name" value="{$tour_name}" size="40" maxlength="45">
					</div>
				</td>
				<td>
					<div align="left">Place : </div>
					<div align="left">
						<input type="text" name="tour_place" value="{$tour_place}" size="40" maxlength="45">
					</div>				
				</td>
				<td>
					<div align="left">Level : </div>
					<div align="left">
						<select name="tour_level">
							<option value="value">- Please select one -</option>
							<option value="1" {$s1}>International</option>
							<option value="2" {$s2}>National</option>
							<option value="3" {$s3}>Regional</option>
							<option value="4" {$s4}>Open</option>
							<option value="5" {$s5}>Others</option>
						</select>
					</div>				
				</td>				
				<td align="left">
					<div align="left">Type : </div>
					<div align="left">
						<select name="tour_type">
							<option value="value">- Please select one -</option>
							<option value="1" {$t1}>Open</option>
							<option value="2" {$t2}>Invitational</option>
							<option value="3" {$t3}>Closed / Internal Only</option>
							<option value="4" {$t4}>Others</option>
						</select>
					</div>					
				</td>
			</tr>
			<tr>
				<td align="left">
					<div align="left">Event Date : </div>
					<div align="left">
					<script>DateInput('evt_date', true, 'YYYY/MM/DD','{$evt_date}')</script>
					</div>
				</td>
				<td align="left">
					<div align="left">Registration Due Date : </div>
					<div align="left">
					<script>DateInput('reg_date', true, 'YYYY/MM/DD','{$reg_date}')</script>
					</div>
				</td>				
				<td>
					<div align="left">Course : </div>
					<div align="left">
						<select name="course" onchange="change_area();">
							<option value="value">- Please select one -</option>
							{section name=course loop=$courselist}
							<option value="{$courselist[course].course_id}" {$courselist[course].selected}>{$courselist[course].course_name}</option>
							{/section}						
						</select>
					</div>
				</td>
				<td>
					<div align="left">Tee Mark : </div>
					<div align="left">
						<select name="tee">
							<option value="value">- Please select one -</option>
							{section name=tipe loop=$typelist}
							<option value="{$typelist[tipe].course_sub_id}" {$typelist[tipe].selected}>{$typelist[tipe].type_name}</option>
							{/section}							
						</select>
					</div>				
				</td>
			</tr>
			<tr>
				<td>
					<div align="left">Max.Player : </div>
					<div align="left">
						<input type="text" name="max_player" value="{$max_player}" size="20" maxlength="3">
					</div>						
				</td>			
				<td>
					<div align="left">Reward : </div>
					<div align="left">
						<input type="text" name="reward" value="{$reward}" size="20" maxlength="20">
					</div>				
				</td>
				<td>
					<div align="left">Trial Points : </div>
					<div align="left">
						<input type="text" name="points" value="{$points}" size="20" maxlength="5">
					</div>						
				</td>
				<td>
					<div align="left">Status : </div>
					<div align="left">
						<select name="tour_status">
							<option value="1" {$u1}>Open / Incoming</option>
							<option value="2" {$u2}>Close / Match Play</option>
						</select>
					</div>						
				</td>
			</tr>			
			<tr>
				<td colspan="4">
					<div align="left">Description : </div>
					<div align="left"><input type="text" name="notes" value="{$descr}" size="78" maxlength="128"></div>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<input name="addbtn" type="submit" id="addbtn" value="{$addbtn}">
					<input name="cancelbtn" type="submit" id="cancelbtn" value="Cancel / Back To List">
				</td>
			</tr>			
			<tr>
				<td colspan="3">
				</td>
			</tr>	
			<tr>
				<td colspan="3">
					{if $tour_id}
					<font color="#FF0000">
					*This mark indicates that system will erase all old value of golf detail, and will create a new set game base your selection of Course ID / Tee Mark / Play Rule.
					</font>
					{/if}
				</td>
			</tr>							
		</table>
		</div>
		
		{if $editDetail}	
		<hr/>
		<br/>
		<div id="bdr">			
			<p><strong>Tournaments Round</strong></p>
			<table border="0" width="60%" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="bottom"><div align="left">Round No: </div></td>
					<td valign="bottom"><div align="left">Round Date : </div></td>
					<td valign="bottom"><div align="left">Time : </div></td>
					<td valign="bottom"><div align="left">Weather : </div></td>
					<td valign="bottom"><div align="left">Play Rule : </div></td>
				</tr>		
				<tr>
					<td align="left">
						<div align="left">
							<select name="round_no">
								<option value="value">- Please select one -</option>
								<option value="1" {$a1}>First</option>
								<option value="2" {$a2}>Second</option>
								<option value="3" {$a3}>Third</option>
								<option value="4" {$a4}>Fourth</option>
								<option value="5" {$a5}>Fifth</option>
							</select>						
						</div>
					</td>
					<td align="left">
						<div align="left">
							<script>DateInput('round_date', true, 'YYYY/MM/DD','{$round_date}')</script>
						</div>				
					</td>
					<td align="left">
						<div align="left">
							<input type="text" name="time1" value="{$jam}" size="2" maxlength="2"> :
							<input type="text" name="time2" value="{$menit}" size="2" maxlength="2">
						</div>	
					</td>					
					<td align="left">
						<div align="left">
						<select name="round_weather">
							<option value="Sunny" {$b1}>Sunny</option>
							<option value="Cloudy" {$b2}>Cloudy</option>
							<option value="Dry" {$b3}>Dry</option>
							<option value="Rainy" {$b4}>Rainy</option>
							<option value="Misty" {$b5}>Misty</option>
							<option value="Wet" {$b6}>Wet</option>
							<option value="Windy" {$b7}>Windy</option>
							<option value="Others" {$b8}>Others</option>
						</select>
						</div>				
					</td>				
					<td align="left">
						<div align="left">
						<select name="round_playrule">
							<option value="1" {$h1}>18 Holes</option>
							<option value="2" {$h2}> 9-OUT</option>
							<option value="3" {$h3}> 9-IN </option>
						</select>
						</div>					
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div align="left">Description : </div>
						<div align="left"><input type="text" name="notes" value="{$round_note}" size="78" maxlength="128"></div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<input name="addbtn" type="submit" id="addbtn" value="Add / Save Round">
					</td>
				</tr>			
			</table>	
			
			{if $datalist}
			<table class="adminlist" border="1" width="100%">
				<tr>
					<th>ROUND NO</th>
					<th>ROUND DATE</th>
					<th>WEATHER</th>
					<th>PLAY RULE</th>
					<th colspan="2">ACTION</th>
				</tr>
				{section name=data loop=$datalist}
				<tr>
					<td valign="top">{$datalist[data].round_no}</td>
					<td valign="top">{$datalist[data].round_date}</td>
					<td valign="top">{$datalist[data].round_weather}</td>
					<td valign="top">{$datalist[data].round_rule}</td>
					<td valign="top"><a href="{$this_page}?aksi=touradmin&aksi2=editround&id={$datalist[data].tour_id}&sid={$datalist[data].round_id}">Edit</a></td>
					<td valign="top"><a href="{$this_page}?aksi=touradmin&aksi2=delround&id={$datalist[data].tour_id}&sid={$datalist[data].round_id}">Remove</a></td>
				</tr>
				{/section}
			</table>
			{/if}
		</div>
		{/if}	
  </form>	
{/if}

