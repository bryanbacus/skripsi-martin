<td>
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
	{if $batas}
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="13%">Year : 
				<select name="filter_thn">
					{section name=data loop=$tahun}
					<option value="{$tahun[data].value}" {$tahun[data].selected}>{$tahun[data].value}</option>
					{/section}
				</select>
			</td>
			<td width="24%">Level :
				<select name="tour_level">
					<option value="all">All Tournament's Level</option>
					<option value="1" {$s1}>International</option>
					<option value="2" {$s2}>National</option>
					<option value="3" {$s3}>Regional</option>
					<option value="4" {$s4}>Open</option>
				  <option value="5" {$s5}>Others</option>
				</select>			
			</td>
			<td width="24%">Type :
				<select name="tour_type">
					<option value="all" >All Tournament's Type</option>
					<option value="1" {$t1}>Open</option>
					<option value="2" {$t2}>Invitational</option>
					<option value="3" {$t3}>Closed / Internal Only</option>
					<option value="4" {$t4}>Others</option>
				</select>			
			</td>
			<td valign="bottom"><input type="submit" name="filterbtn" value="Filter Tournaments" /></td>
		</tr>
	</table>	
	{/if}
	{if $datalist}
    <table class="adminlist" border="1" width="100%">
      <tr>
				<th>EVENT DATE</th>
				<th>TOURNAMENTS NAME </th>
				<th>PLACE</th>
				<th>COURSE</th>
				<th>TOURNAMENTS LEVEL</th>
				<th>TYPE</th>
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
					<li><a href="{$this_page}?aksi=tourrest&aksi2=result&id={$datalist[data].tour_id}">View Result</a></li>
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
</td>