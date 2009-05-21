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
						<option value="members_id">Member's ID</option>
						<option value="members_name">Member's Name</option>
					</select>
					<input type="text" name="search_val" value="" size="25" maxlength="45" /> 
					<input type="submit" name="caribtn" value="Search"/>
				</td>
			</tr>
		</table>		
		<br>
		<table border="0" width="100%">
		<tr>
			<td width="20%"><input type="submit" name="createbtn" value="Create a Practice Course"/></td>
			{if $gameslist}
			<td width="80%" align="right"><div align="right">paging here</div></td>
			{/if}
		</tr>
		</table>		
	{if $gameslist}
    <table class="adminlist" border="1" width="100%">
      <tr>
				<th>DATE</th>
				<th>MEMBER ID</th>
				<th>MEMBER NAME</th>
				<th>COURSE</th>
				<th>PLAY RULE</th>
				<th>PAR</th>
				<th>SCORE</th>
        <th colspan="2">ACTION</th>
      </tr>
      {section name=game loop=$gameslist}
      <tr>
				<td valign="top">{$gameslist[game].games_date}</td>
				<td valign="top">{$gameslist[game].games_memberid}</td>
				<td valign="top">{$gameslist[game].games_membername}</td>
        <td valign="top">{$gameslist[game].games_course}</td>
				<td valign="top">{$gameslist[game].games_holeplay}</td>
				<td valign="top">{$gameslist[game].games_total_par}</td>
				<td valign="top">{$gameslist[game].games_total_score}</td>
        <td valign="top" align="center" width="5%"><a href="{$this_page}?aksi=gamelist&aksi2=edit&id={$gameslist[game].games_id}">edit</a></td>
				<td valign="top" align="center" width="5%"><a href="{$this_page}?aksi=gamelist&aksi2=delete&id={$gameslist[game].games_id}">delete</a></td>
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
		<input type="hidden" name="games_id" value="{$games_id}" />
		<input type="hidden" name="aksi2" value="" />
		<input type="hidden" name="valid" value="{$valid}" />
		<input type="hidden" name="desc" value="{$desc}" />
		<div id="bdr">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="50%" valign="top">
		<table border="0" width="30%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3">
					<div align="left">Member's ID : </div>
					<div align="left">
						<input type="text" name="memberid" value="{$memberid}">
						<input type="submit" name="validatebtn" value="Check ID"/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div align="left">
						{$members_desc}
					</div>
				</td>
			</tr>
			<tr>
				<td width="30%"></td>
				<td width="28%"></td>
				<td width="42%"></td>
			</tr>
			<tr>
				<td align="left">
					<div align="left">Date : </div>
					<div align="left">
					<script>DateInput('tanggal', true, 'YYYY/MM/DD','{$tanggal}')</script>
					</div>
				</td>
				<td>
					<div align="left">Time : </div>
					<div align="left">
						<input type="text" name="time1" value="{$jam}" size="2" maxlength="2"> :
						<input type="text" name="time2" value="{$menit}" size="2" maxlength="2">
					</div>	
				</td>
					<td>
					<div align="left">Weather : </div>
					<div align="left">
						<select name="weather">
							<option value="Sunny" {$s1}>Sunny</option>
							<option value="Cloudy" {$s2}>Cloudy</option>
							<option value="Dry" {$s3}>Dry</option>
							<option value="Rainy" {$s4}>Rainy</option>
							<option value="Misty" {$s5}>Misty</option>
							<option value="Wet" {$s6}>Wet</option>
							<option value="Windy" {$s7}>Windy</option>
							<option value="Others" {$s8}>Others</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>			
			<tr>
				<td>
					<div align="left">Course* : </div>
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
					<div align="left">Tee Mark* : </div>
					<div align="left">
						<select name="tee">
							<option value="value">- Please select one -</option>
							{section name=tipe loop=$typelist}
							<option value="{$typelist[tipe].course_sub_id}" {$typelist[tipe].selected}>{$typelist[tipe].type_name}</option>
							{/section}							
						</select>
					</div>				
				</td>
				<td>
					<div align="left">Play Rule* : </div>
					<div align="left">
						<select name="playrule">
							<option value="1" {$h1}>18 Holes</option>
							<option value="2" {$h2}> 9-OUT</option>
							<option value="3" {$h3}> 9-IN </option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>			
			<tr>
				<td colspan="3">
					<div align="left">Note : </div>
					<div align="left"><input type="text" name="notes" value="{$note}" size="78" maxlength="128"></div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
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
					{if $games_id}
					<font color="#FF0000">
					*This mark indicates that system will erase all old value of golf detail, and will create a new set game base your selection of Course ID / Tee Mark / Play Rule.
					</font>
					{/if}
				</td>
			</tr>							
		</table>
		</td>
		<td width="49%">
			<div align="left"><strong>Performance Summary</strong></div>
			<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
			<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="20%" style="border-bottom:solid; border-bottom:1px">Score</td>
					<td width="1%" style="border-bottom:solid; border-bottom:1px">:</td>
					<td width="20%" style="border-bottom:solid; border-bottom:1px">{$sum_score}</td>
					<td width="18%">&nbsp;</td>
					<td width="20%" style="border-bottom:solid; border-bottom:1px">Hole In One</td>
					<td width="1%" style="border-bottom:solid; border-bottom:1px">:</td>
					<td width="20%" style="border-bottom:solid; border-bottom:1px">{$sum_hio}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">Putts</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_putts}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Condor</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_condor}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">FIR</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_fir}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Albatros</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_albatros}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">FIR-Ratio</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_firr}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Eagles</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_eagles}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">GIR</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_gir}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Birdies</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_birdies}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">GIR-Ratio</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_girr}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Pars</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_pars}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">Saves</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_saves}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Bogeys</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_bogeys}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">Fairway</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_fairways}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">D. Bogeys </td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_dbogeys}</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">T. Bogeys </td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_tbogeys}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">RR</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_rr}</td>
					<td></td>
					<td style="border-bottom:solid; border-bottom:1px">Others</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_others}</td>
				</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">LR</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_lr}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">Bunkers</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_bunkers}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					</tr>
				<tr>
					<td style="border-bottom:solid; border-bottom:1px">Penalties</td>
					<td style="border-bottom:solid; border-bottom:1px">:</td>
					<td style="border-bottom:solid; border-bottom:1px">{$sum_penalties}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table></td></tr></table>
		</td>
		</tr></table>		
		</div>
		
		{if $editDetail}	
		<hr/>
		<br/>
		<div id="bdr">			
			<p><strong>Golf Detail</strong></p>
			<table width="100%" border="1" cellspacing="0" cellpadding="0" class="biasa">
        <tr>
          <th width="15%">Hole <a href="{$this_page}?aksi=gamelist&aksi2=editscore&id={$games_id}">[edit score]</a></th>
          <th width="4%"><div align="center">1</div></th>
          <th width="4%"><div align="center">2</div></th>
          <th width="4%"><div align="center">3</div></th>
          <th width="4%"><div align="center">4</div></th>
          <th width="4%"><div align="center">5</div></th>
          <th width="4%"><div align="center">6</div></th>
          <th width="4%"><div align="center">7</div></th>
          <th width="4%"><div align="center">8</div></th>
          <th width="4%"><div align="center">9</div></th>
          <th width="4%"><div align="center">OUT</div></th>
          <th width="4%"><div align="center">10</div></th>
          <th width="4%"><div align="center">11</div></th>
          <th width="4%"><div align="center">12</div></th>
          <th width="4%"><div align="center">13</div></th>
          <th width="4%"><div align="center">14</div></th>
          <th width="4%"><div align="center">15</div></th>
          <th width="4%"><div align="center">16</div></th>
          <th width="4%"><div align="center">17</div></th>
          <th width="4%"><div align="center">18</div></th>
          <th width="4%"><div align="center">IN</div></th>
          <th width="5%"><div align="center">TOTAL</div></th>
        </tr>
        <tr>
          <td>Measure</td>
          <td><div align="center">{$hole1_length}</div></td>
          <td><div align="center">{$hole2_length}</div></td>
          <td><div align="center">{$hole3_length}</div></td>
          <td><div align="center">{$hole4_length}</div></td>
          <td><div align="center">{$hole5_length}</div></td>
          <td><div align="center">{$hole6_length}</div></td>
          <td><div align="center">{$hole7_length}</div></td>
          <td><div align="center">{$hole8_length}</div></td>
          <td><div align="center">{$hole9_length}</div></td>
          <td><div align="center">{$holeout_length}</div></td>
          <td><div align="center">{$hole10_length}</div></td>
          <td><div align="center">{$hole11_length}</div></td>
          <td><div align="center">{$hole12_length}</div></td>
          <td><div align="center">{$hole13_length}</div></td>
          <td><div align="center">{$hole14_length}</div></td>
          <td><div align="center">{$hole15_length}</div></td>
          <td><div align="center">{$hole16_length}</div></td>
          <td><div align="center">{$hole17_length}</div></td>
          <td><div align="center">{$hole18_length}</div></td>
          <td><div align="center">{$holein_length}</div></td>
          <td><div align="center">{$holetotal_length}</div></td>
        </tr>
        <tr>
          <td>PAR</td>
          <td><div align="center">{$hole1_par}</div></td>
          <td><div align="center">{$hole2_par}</div></td>
          <td><div align="center">{$hole3_par}</div></td>
          <td><div align="center">{$hole4_par}</div></td>
          <td><div align="center">{$hole5_par}</div></td>
          <td><div align="center">{$hole6_par}</div></td>
          <td><div align="center">{$hole7_par}</div></td>
          <td><div align="center">{$hole8_par}</div></td>
          <td><div align="center">{$hole9_par}</div></td>
          <td><div align="center">{$holeout_par}</div></td>
          <td><div align="center">{$hole10_par}</div></td>
          <td><div align="center">{$hole11_par}</div></td>
          <td><div align="center">{$hole12_par}</div></td>
          <td><div align="center">{$hole13_par}</div></td>
          <td><div align="center">{$hole14_par}</div></td>
          <td><div align="center">{$hole15_par}</div></td>
          <td><div align="center">{$hole16_par}</div></td>
          <td><div align="center">{$hole17_par}</div></td>
          <td><div align="center">{$hole18_par}</div></td>
          <td><div align="center">{$holein_par}</div></td>
          <td><div align="center">{$holetotal_par}</div></td>
        </tr>
        <tr>
          <td>Handicap </td>
          <td><div align="center">{$hole1_hcp}</div></td>
          <td><div align="center">{$hole2_hcp}</div></td>
          <td><div align="center">{$hole3_hcp}</div></td>
          <td><div align="center">{$hole4_hcp}</div></td>
          <td><div align="center">{$hole5_hcp}</div></td>
          <td><div align="center">{$hole6_hcp}</div></td>
          <td><div align="center">{$hole7_hcp}</div></td>
          <td><div align="center">{$hole8_hcp}</div></td>
          <td><div align="center">{$hole9_hcp}</div></td>
          <td bgcolor="#CCCCCC"><div align="center"></div></td>
          <td><div align="center">{$hole10_hcp}</div></td>
          <td><div align="center">{$hole11_hcp}</div></td>
          <td><div align="center">{$hole12_hcp}</div></td>
          <td><div align="center">{$hole13_hcp}</div></td>
          <td><div align="center">{$hole14_hcp}</div></td>
          <td><div align="center">{$hole15_hcp}</div></td>
          <td><div align="center">{$hole16_hcp}</div></td>
          <td><div align="center">{$hole17_hcp}</div></td>
          <td><div align="center">{$hole18_hcp}</div></td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="center"></div></td>
        </tr>
        <tr>
          <td>Score</td>
          <td><div align="center">{$hole1_score}</div></td>
          <td><div align="center">{$hole2_score}</div></td>
          <td><div align="center">{$hole3_score}</div></td>
          <td><div align="center">{$hole4_score}</div></td>
          <td><div align="center">{$hole5_score}</div></td>
          <td><div align="center">{$hole6_score}</div></td>
          <td><div align="center">{$hole7_score}</div></td>
          <td><div align="center">{$hole8_score}</div></td>
          <td><div align="center">{$hole9_score}</div></td>
          <td><div align="center">{$holeout_score}</div></td>
          <td><div align="center">{$hole10_score}</div></td>
          <td><div align="center">{$hole11_score}</div></td>
          <td><div align="center">{$hole12_score}</div></td>
          <td><div align="center">{$hole13_score}</div></td>
          <td><div align="center">{$hole14_score}</div></td>
          <td><div align="center">{$hole15_score}</div></td>
          <td><div align="center">{$hole16_score}</div></td>
          <td><div align="center">{$hole17_score}</div></td>
          <td><div align="center">{$hole18_score}</div></td>
          <td><div align="center">{$holein_score}</div></td>
          <td><div align="center">{$holetotal_score}</div></td>
        </tr>
        
        <tr>
          <th colspan="22">Tee Off <a href="{$this_page}?aksi=gamelist&amp;aksi2=firststroke&amp;id={$games_id}">[edit tee off]</a></th>
        </tr>
        <tr>
          <td>FIR</td>
          <td><div align="center">{$hole1_fir}</div></td>
          <td><div align="center">{$hole2_fir}</div></td>
          <td><div align="center">{$hole3_fir}</div></td>
          <td><div align="center">{$hole4_fir}</div></td>
          <td><div align="center">{$hole5_fir}</div></td>
          <td><div align="center">{$hole6_fir}</div></td>
          <td><div align="center">{$hole7_fir}</div></td>
          <td><div align="center">{$hole8_fir}</div></td>
          <td><div align="center">{$hole9_fir}</div></td>
          <td rowspan="5" bgcolor="#CCCCCC"><div align="center"></div></td>
          <td><div align="center">{$hole10_fir}</div></td>
          <td><div align="center">{$hole11_fir}</div></td>
          <td><div align="center">{$hole12_fir}</div></td>
          <td><div align="center">{$hole13_fir}</div></td>
          <td><div align="center">{$hole14_fir}</div></td>
          <td><div align="center">{$hole15_fir}</div></td>
          <td><div align="center">{$hole16_fir}</div></td>
          <td><div align="center">{$hole17_fir}</div></td>
          <td><div align="center">{$hole18_fir}</div></td>
          <td rowspan="5" bgcolor="#CCCCCC"><div align="center"></div></td>
          <td><div align="center">{$holetotal_fir}</div></td>
        </tr>
        <tr>
          <td>RR</td>
          <td><div align="center">{$hole1_rr1}</div></td>
          <td><div align="center">{$hole2_rr1}</div></td>
          <td><div align="center">{$hole3_rr1}</div></td>
          <td><div align="center">{$hole4_rr1}</div></td>
          <td><div align="center">{$hole5_rr1}</div></td>
          <td><div align="center">{$hole6_rr1}</div></td>
          <td><div align="center">{$hole7_rr1}</div></td>
          <td><div align="center">{$hole8_rr1}</div></td>
          <td><div align="center">{$hole9_rr1}</div></td>
          <td><div align="center">{$hole10_rr1}</div></td>
          <td><div align="center">{$hole11_rr1}</div></td>
          <td><div align="center">{$hole12_rr1}</div></td>
          <td><div align="center">{$hole13_rr1}</div></td>
          <td><div align="center">{$hole14_rr1}</div></td>
          <td><div align="center">{$hole15_rr1}</div></td>
          <td><div align="center">{$hole16_rr1}</div></td>
          <td><div align="center">{$hole17_rr1}</div></td>
          <td><div align="center">{$hole18_rr1}</div></td>
          <td><div align="center">{$holetotal_rr1}</div></td>
        </tr>
        <tr>
          <td>LR</td>
          <td><div align="center">{$hole1_lr1}</div></td>
          <td><div align="center">{$hole2_lr1}</div></td>
          <td><div align="center">{$hole3_lr1}</div></td>
          <td><div align="center">{$hole4_lr1}</div></td>
          <td><div align="center">{$hole5_lr1}</div></td>
          <td><div align="center">{$hole6_lr1}</div></td>
          <td><div align="center">{$hole7_lr1}</div></td>
          <td><div align="center">{$hole8_lr1}</div></td>
          <td><div align="center">{$hole9_lr1}</div></td>
          <td><div align="center">{$hole10_lr1}</div></td>
          <td><div align="center">{$hole11_lr1}</div></td>
          <td><div align="center">{$hole12_lr1}</div></td>
          <td><div align="center">{$hole13_lr1}</div></td>
          <td><div align="center">{$hole14_lr1}</div></td>
          <td><div align="center">{$hole15_lr1}</div></td>
          <td><div align="center">{$hole16_lr1}</div></td>
          <td><div align="center">{$hole17_lr1}</div></td>
          <td><div align="center">{$hole18_lr1}</div></td>
          <td><div align="center">{$holetotal_lr1}</div></td>
        </tr>
        <tr>
          <td>Bunker</td>
          <td><div align="center">{$hole1_bunker1}</div></td>
          <td><div align="center">{$hole2_bunker1}</div></td>
          <td><div align="center">{$hole3_bunker1}</div></td>
          <td><div align="center">{$hole4_bunker1}</div></td>
          <td><div align="center">{$hole5_bunker1}</div></td>
          <td><div align="center">{$hole6_bunker1}</div></td>
          <td><div align="center">{$hole7_bunker1}</div></td>
          <td><div align="center">{$hole8_bunker1}</div></td>
          <td><div align="center">{$hole9_bunker1}</div></td>
          <td><div align="center">{$hole10_bunker1}</div></td>
          <td><div align="center">{$hole11_bunker1}</div></td>
          <td><div align="center">{$hole12_bunker1}</div></td>
          <td><div align="center">{$hole13_bunker1}</div></td>
          <td><div align="center">{$hole14_bunker1}</div></td>
          <td><div align="center">{$hole15_bunker1}</div></td>
          <td><div align="center">{$hole16_bunker1}</div></td>
          <td><div align="center">{$hole17_bunker1}</div></td>
          <td><div align="center">{$hole18_bunker1}</div></td>
          <td><div align="center">{$holetotal_bunker1}</div></td>
        </tr>
        <tr>
          <td>Penalty</td>
          <td><div align="center">{$hole1_penalty1}</div></td>
          <td><div align="center">{$hole2_penalty1}</div></td>
          <td><div align="center">{$hole3_penalty1}</div></td>
          <td><div align="center">{$hole4_penalty1}</div></td>
          <td><div align="center">{$hole5_penalty1}</div></td>
          <td><div align="center">{$hole6_penalty1}</div></td>
          <td><div align="center">{$hole7_penalty1}</div></td>
          <td><div align="center">{$hole8_penalty1}</div></td>
          <td><div align="center">{$hole9_penalty1}</div></td>
          <td><div align="center">{$hole10_penalty1}</div></td>
          <td><div align="center">{$hole11_penalty1}</div></td>
          <td><div align="center">{$hole12_penalty1}</div></td>
          <td><div align="center">{$hole13_penalty1}</div></td>
          <td><div align="center">{$hole14_penalty1}</div></td>
          <td><div align="center">{$hole15_penalty1}</div></td>
          <td><div align="center">{$hole16_penalty1}</div></td>
          <td><div align="center">{$hole17_penalty1}</div></td>
          <td><div align="center">{$hole18_penalty1}</div></td>
          <td><div align="center">{$holetotal_penalty1}</div></td>
        </tr>
        <tr>
          <th colspan="22">Rest Of Shoots <a href="{$this_page}?aksi=gamelist&aksi2=second_stroke&id={$games_id}">[edit shoot]</a></th>
        </tr>
        <tr>
          <td>GIR</td>
          <td><div align="center">{$hole1_gir}</div></td>
          <td><div align="center">{$hole2_gir}</div></td>
          <td><div align="center">{$hole3_gir}</div></td>
          <td><div align="center">{$hole4_gir}</div></td>
          <td><div align="center">{$hole5_gir}</div></td>
          <td><div align="center">{$hole6_gir}</div></td>
          <td><div align="center">{$hole7_gir}</div></td>
          <td><div align="center">{$hole8_gir}</div></td>
          <td><div align="center">{$hole9_gir}</div></td>
          <td rowspan="10" bgcolor="#CCCCCC"><div align="center"></div></td>
          <td><div align="center">{$hole10_gir}</div></td>
          <td><div align="center">{$hole11_gir}</div></td>
          <td><div align="center">{$hole12_gir}</div></td>
          <td><div align="center">{$hole13_gir}</div></td>
          <td><div align="center">{$hole14_gir}</div></td>
          <td><div align="center">{$hole15_gir}</div></td>
          <td><div align="center">{$hole16_gir}</div></td>
          <td><div align="center">{$hole17_gir}</div></td>
          <td><div align="center">{$hole18_gir}</div></td>
          <td rowspan="10" bgcolor="#CCCCCC"><div align="center"></div></td>
          <td><div align="center">{$holetotal_gir}</div></td>
        </tr>
        <tr>
          <td>Fairway</td>
          <td><div align="center">{$hole1_fairway}</div></td>
          <td><div align="center">{$hole2_fairway}</div></td>
          <td><div align="center">{$hole3_fairway}</div></td>
          <td><div align="center">{$hole4_fairway}</div></td>
          <td><div align="center">{$hole5_fairway}</div></td>
          <td><div align="center">{$hole6_fairway}</div></td>
          <td><div align="center">{$hole7_fairway}</div></td>
          <td><div align="center">{$hole8_fairway}</div></td>
          <td><div align="center">{$hole9_fairway}</div></td>
          <td><div align="center">{$hole10_fairway}</div></td>
          <td><div align="center">{$hole11_fairway}</div></td>
          <td><div align="center">{$hole12_fairway}</div></td>
          <td><div align="center">{$hole13_fairway}</div></td>
          <td><div align="center">{$hole14_fairway}</div></td>
          <td><div align="center">{$hole15_fairway}</div></td>
          <td><div align="center">{$hole16_fairway}</div></td>
          <td><div align="center">{$hole17_fairway}</div></td>
          <td><div align="center">{$hole18_fairway}</div></td>
          <td><div align="center">{$holetotal_fairway}</div></td>
        </tr>
        <tr>
          <td>RR</td>
          <td><div align="center">{$hole1_rr2}</div></td>
          <td><div align="center">{$hole2_rr2}</div></td>
          <td><div align="center">{$hole3_rr2}</div></td>
          <td><div align="center">{$hole4_rr2}</div></td>
          <td><div align="center">{$hole5_rr2}</div></td>
          <td><div align="center">{$hole6_rr2}</div></td>
          <td><div align="center">{$hole7_rr2}</div></td>
          <td><div align="center">{$hole8_rr2}</div></td>
          <td><div align="center">{$hole9_rr2}</div></td>
          <td><div align="center">{$hole10_rr2}</div></td>
          <td><div align="center">{$hole11_rr2}</div></td>
          <td><div align="center">{$hole12_rr2}</div></td>
          <td><div align="center">{$hole13_rr2}</div></td>
          <td><div align="center">{$hole14_rr2}</div></td>
          <td><div align="center">{$hole15_rr2}</div></td>
          <td><div align="center">{$hole16_rr2}</div></td>
          <td><div align="center">{$hole17_rr2}</div></td>
          <td><div align="center">{$hole18_rr2}</div></td>
          <td><div align="center">{$holetotal_rr2}</div></td>
				</tr>
        <tr>
          <td>LR</td>
          <td><div align="center">{$hole1_lr2}</div></td>
          <td><div align="center">{$hole2_lr2}</div></td>
          <td><div align="center">{$hole3_lr2}</div></td>
          <td><div align="center">{$hole4_lr2}</div></td>
          <td><div align="center">{$hole5_lr2}</div></td>
          <td><div align="center">{$hole6_lr2}</div></td>
          <td><div align="center">{$hole7_lr2}</div></td>
          <td><div align="center">{$hole8_lr2}</div></td>
          <td><div align="center">{$hole9_lr2}</div></td>
          <td><div align="center">{$hole10_lr2}</div></td>
          <td><div align="center">{$hole11_lr2}</div></td>
          <td><div align="center">{$hole12_lr2}</div></td>
          <td><div align="center">{$hole13_lr2}</div></td>
          <td><div align="center">{$hole14_lr2}</div></td>
          <td><div align="center">{$hole15_lr2}</div></td>
          <td><div align="center">{$hole16_lr2}</div></td>
          <td><div align="center">{$hole17_lr2}</div></td>
          <td><div align="center">{$hole18_lr2}</div></td>
          <td><div align="center">{$holetotal_lr2}</div></td>
				</tr>
        <tr>
          <td>ON</td>
          <td><div align="center">{$hole1_on}</div></td>
          <td><div align="center">{$hole2_on}</div></td>
          <td><div align="center">{$hole3_on}</div></td>
          <td><div align="center">{$hole4_on}</div></td>
          <td><div align="center">{$hole5_on}</div></td>
          <td><div align="center">{$hole6_on}</div></td>
          <td><div align="center">{$hole7_on}</div></td>
          <td><div align="center">{$hole8_on}</div></td>
          <td><div align="center">{$hole9_on}</div></td>
          <td><div align="center">{$hole10_on}</div></td>
          <td><div align="center">{$hole11_on}</div></td>
          <td><div align="center">{$hole12_on}</div></td>
          <td><div align="center">{$hole13_on}</div></td>
          <td><div align="center">{$hole14_on}</div></td>
          <td><div align="center">{$hole15_on}</div></td>
          <td><div align="center">{$hole16_on}</div></td>
          <td><div align="center">{$hole17_on}</div></td>
          <td><div align="center">{$hole18_on}</div></td>
          <td><div align="center">{$holetotal_on}</div></td>
				</tr>
        <tr>
          <td>Bunker</td>
          <td><div align="center">{$hole1_bunker2}</div></td>
          <td><div align="center">{$hole2_bunker2}</div></td>
          <td><div align="center">{$hole3_bunker2}</div></td>
          <td><div align="center">{$hole4_bunker2}</div></td>
          <td><div align="center">{$hole5_bunker2}</div></td>
          <td><div align="center">{$hole6_bunker2}</div></td>
          <td><div align="center">{$hole7_bunker2}</div></td>
          <td><div align="center">{$hole8_bunker2}</div></td>
          <td><div align="center">{$hole9_bunker2}</div></td>
          <td><div align="center">{$hole10_bunker2}</div></td>
          <td><div align="center">{$hole11_bunker2}</div></td>
          <td><div align="center">{$hole12_bunker2}</div></td>
          <td><div align="center">{$hole13_bunker2}</div></td>
          <td><div align="center">{$hole14_bunker2}</div></td>
          <td><div align="center">{$hole15_bunker2}</div></td>
          <td><div align="center">{$hole16_bunker2}</div></td>
          <td><div align="center">{$hole17_bunker2}</div></td>
          <td><div align="center">{$hole18_bunker2}</div></td>
          <td><div align="center">{$holetotal_bunker2}</div></td>
				</tr>
        <tr>
          <td>Penalty</td>
          <td><div align="center">{$hole1_penalty2}</div></td>
          <td><div align="center">{$hole2_penalty2}</div></td>
          <td><div align="center">{$hole3_penalty2}</div></td>
          <td><div align="center">{$hole4_penalty2}</div></td>
          <td><div align="center">{$hole5_penalty2}</div></td>
          <td><div align="center">{$hole6_penalty2}</div></td>
          <td><div align="center">{$hole7_penalty2}</div></td>
          <td><div align="center">{$hole8_penalty2}</div></td>
          <td><div align="center">{$hole9_penalty2}</div></td>
          <td><div align="center">{$hole10_penalty2}</div></td>
          <td><div align="center">{$hole11_penalty2}</div></td>
          <td><div align="center">{$hole12_penalty2}</div></td>
          <td><div align="center">{$hole13_penalty2}</div></td>
          <td><div align="center">{$hole14_penalty2}</div></td>
          <td><div align="center">{$hole15_penalty2}</div></td>
          <td><div align="center">{$hole16_penalty2}</div></td>
          <td><div align="center">{$hole17_penalty2}</div></td>
          <td><div align="center">{$hole18_penalty2}</div></td>
          <td><div align="center">{$holetotal_penalty2}</div></td>
				</tr>
        <tr>
          <td>Putts</td>
          <td><div align="center">{$hole1_putts}</div></td>
          <td><div align="center">{$hole2_putts}</div></td>
          <td><div align="center">{$hole3_putts}</div></td>
          <td><div align="center">{$hole4_putts}</div></td>
          <td><div align="center">{$hole5_putts}</div></td>
          <td><div align="center">{$hole6_putts}</div></td>
          <td><div align="center">{$hole7_putts}</div></td>
          <td><div align="center">{$hole8_putts}</div></td>
          <td><div align="center">{$hole9_putts}</div></td>
          <td><div align="center">{$hole10_putts}</div></td>
          <td><div align="center">{$hole11_putts}</div></td>
          <td><div align="center">{$hole12_putts}</div></td>
          <td><div align="center">{$hole13_putts}</div></td>
          <td><div align="center">{$hole14_putts}</div></td>
          <td><div align="center">{$hole15_putts}</div></td>
          <td><div align="center">{$hole16_putts}</div></td>
          <td><div align="center">{$hole17_putts}</div></td>
          <td><div align="center">{$hole18_putts}</div></td>
          <td><div align="center">{$holetotal_putts}</div></td>
        </tr>
        <tr>
          <td>Control</td>
          <td><div align="center">{$hole1_control}</div></td>
          <td><div align="center">{$hole2_control}</div></td>
          <td><div align="center">{$hole3_control}</div></td>
          <td><div align="center">{$hole4_control}</div></td>
          <td><div align="center">{$hole5_control}</div></td>
          <td><div align="center">{$hole6_control}</div></td>
          <td><div align="center">{$hole7_control}</div></td>
          <td><div align="center">{$hole8_control}</div></td>
          <td><div align="center">{$hole9_control}</div></td>
          <td><div align="center">{$hole10_control}</div></td>
          <td><div align="center">{$hole11_control}</div></td>
          <td><div align="center">{$hole12_control}</div></td>
          <td><div align="center">{$hole13_control}</div></td>
          <td><div align="center">{$hole14_control}</div></td>
          <td><div align="center">{$hole15_control}</div></td>
          <td><div align="center">{$hole16_control}</div></td>
          <td><div align="center">{$hole17_control}</div></td>
          <td><div align="center">{$hole18_control}</div></td>
          <td><div align="center">{$holetotal_control}</div></td>
        </tr>
        <tr>
          <td>Saves</td>
          <td><div align="center">{$hole1_saves}</div></td>
          <td><div align="center">{$hole2_saves}</div></td>
          <td><div align="center">{$hole3_saves}</div></td>
          <td><div align="center">{$hole4_saves}</div></td>
          <td><div align="center">{$hole5_saves}</div></td>
          <td><div align="center">{$hole6_saves}</div></td>
          <td><div align="center">{$hole7_saves}</div></td>
          <td><div align="center">{$hole8_saves}</div></td>
          <td><div align="center">{$hole9_saves}</div></td>
          <td><div align="center">{$hole10_saves}</div></td>
          <td><div align="center">{$hole11_saves}</div></td>
          <td><div align="center">{$hole12_saves}</div></td>
          <td><div align="center">{$hole13_saves}</div></td>
          <td><div align="center">{$hole14_saves}</div></td>
          <td><div align="center">{$hole15_saves}</div></td>
          <td><div align="center">{$hole16_saves}</div></td>
          <td><div align="center">{$hole17_saves}</div></td>
          <td><div align="center">{$hole18_saves}</div></td>
          <td><div align="center">{$holetotal_saves}</div></td>
				</tr>
      </table>
		</div>
		{/if}	
  </form>	
{/if}

{if $showScore}
  <form method="post">
		<input type="hidden" name="games_id" value="{$games_id}" />
		<div id="bdr">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="99%">
		<table width="97%" border="1" cellspacing="0" cellpadding="0" class="biasa">
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
				<th>Hcp</th>
				<td><input type="text" name="hole1_hcp" value="{$hole1_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole2_hcp" value="{$hole2_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole3_hcp" value="{$hole3_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole4_hcp" value="{$hole4_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole5_hcp" value="{$hole5_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole6_hcp" value="{$hole6_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole7_hcp" value="{$hole7_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole8_hcp" value="{$hole8_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole9_hcp" value="{$hole9_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole10_hcp" value="{$hole10_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole11_hcp" value="{$hole11_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole12_hcp" value="{$hole12_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole13_hcp" value="{$hole13_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole14_hcp" value="{$hole14_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole15_hcp" value="{$hole15_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole16_hcp" value="{$hole16_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole17_hcp" value="{$hole17_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
				<td><input type="text" name="hole18_hcp" value="{$hole18_hcp}" size="2" maxlength="2" readonly="true" disabled="disabled"/></td>
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
					<input type="submit" name="saveparbtn" value="Save"/>
					<input type="submit" name="cancelparbtn" value="Cancel"/>				
				</td>
			</tr>
		</table>
		</td></tr></table>		
		</div>		
  </form>	
{/if}

{if $showFirst}
  <form method="post">
		<input type="hidden" name="games_id" value="{$games_id}" />
		<input type="hidden" name="hole1_par" value="{$hole1_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole2_par" value="{$hole2_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole3_par" value="{$hole3_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole4_par" value="{$hole4_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole5_par" value="{$hole5_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole6_par" value="{$hole6_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole7_par" value="{$hole7_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole8_par" value="{$hole8_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole9_par" value="{$hole9_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole10_par" value="{$hole10_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole11_par" value="{$hole11_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole12_par" value="{$hole12_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole13_par" value="{$hole13_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole14_par" value="{$hole14_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole15_par" value="{$hole15_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole16_par" value="{$hole16_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole17_par" value="{$hole17_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole18_par" value="{$hole18_par}" size="2" maxlength="2" readonly="true"/>		
		<div id="bdr">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="99%">
		<table width="97%" border="1" cellspacing="0" cellpadding="0" class="biasa">
			<tr>
				<th>Hole</th>
				<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
				<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th>
			</tr>
			<tr>
				<th>FIR</th>
				<td><input type="text" name="hole1_fir" value="{$hole1_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_fir" value="{$hole2_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_fir" value="{$hole3_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_fir" value="{$hole4_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_fir" value="{$hole5_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_fir" value="{$hole6_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_fir" value="{$hole7_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_fir" value="{$hole8_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_fir" value="{$hole9_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_fir" value="{$hole10_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_fir" value="{$hole11_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_fir" value="{$hole12_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_fir" value="{$hole13_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_fir" value="{$hole14_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_fir" value="{$hole15_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_fir" value="{$hole16_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_fir" value="{$hole17_fir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_fir" value="{$hole18_fir}" size="2" maxlength="2"/></td>
			</tr>
			<tr>
				<th>RR</th>
				<td><input type="text" name="hole1_rr1" value="{$hole1_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_rr1" value="{$hole2_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_rr1" value="{$hole3_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_rr1" value="{$hole4_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_rr1" value="{$hole5_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_rr1" value="{$hole6_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_rr1" value="{$hole7_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_rr1" value="{$hole8_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_rr1" value="{$hole9_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_rr1" value="{$hole10_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_rr1" value="{$hole11_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_rr1" value="{$hole12_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_rr1" value="{$hole13_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_rr1" value="{$hole14_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_rr1" value="{$hole15_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_rr1" value="{$hole16_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_rr1" value="{$hole17_rr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_rr1" value="{$hole18_rr1}" size="2" maxlength="2"/></td>
			</tr>		
			<tr>
				<th>LR</th>
				<td><input type="text" name="hole1_lr1" value="{$hole1_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_lr1" value="{$hole2_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_lr1" value="{$hole3_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_lr1" value="{$hole4_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_lr1" value="{$hole5_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_lr1" value="{$hole6_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_lr1" value="{$hole7_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_lr1" value="{$hole8_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_lr1" value="{$hole9_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_lr1" value="{$hole10_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_lr1" value="{$hole11_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_lr1" value="{$hole12_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_lr1" value="{$hole13_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_lr1" value="{$hole14_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_lr1" value="{$hole15_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_lr1" value="{$hole16_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_lr1" value="{$hole17_lr1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_lr1" value="{$hole18_lr1}" size="2" maxlength="2"/></td>
			</tr>		
			<tr>
				<th>Bunker</th>
				<td><input type="text" name="hole1_bunker1" value="{$hole1_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_bunker1" value="{$hole2_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_bunker1" value="{$hole3_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_bunker1" value="{$hole4_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_bunker1" value="{$hole5_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_bunker1" value="{$hole6_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_bunker1" value="{$hole7_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_bunker1" value="{$hole8_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_bunker1" value="{$hole9_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_bunker1" value="{$hole10_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_bunker1" value="{$hole11_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_bunker1" value="{$hole12_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_bunker1" value="{$hole13_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_bunker1" value="{$hole14_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_bunker1" value="{$hole15_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_bunker1" value="{$hole16_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_bunker1" value="{$hole17_bunker1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_bunker1" value="{$hole18_bunker1}" size="2" maxlength="2"/></td>
			</tr>				
			<tr>
				<th>Penalty</th>
				<td><input type="text" name="hole1_penalty1" value="{$hole1_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_penalty1" value="{$hole2_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_penalty1" value="{$hole3_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_penalty1" value="{$hole4_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_penalty1" value="{$hole5_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_penalty1" value="{$hole6_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_penalty1" value="{$hole7_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_penalty1" value="{$hole8_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_penalty1" value="{$hole9_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_penalty1" value="{$hole10_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_penalty1" value="{$hole11_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_penalty1" value="{$hole12_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_penalty1" value="{$hole13_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_penalty1" value="{$hole14_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_penalty1" value="{$hole15_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_penalty1" value="{$hole16_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_penalty1" value="{$hole17_penalty1}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_penalty1" value="{$hole18_penalty1}" size="2" maxlength="2"/></td>
			</tr>							
			<tr>
				<td colspan="19">
					<input name="savefirstbtn" type="submit" id="savefirstbtn" value="Save"/>
					<input type="submit" name="cancelparbtn" value="Cancel"/>				
				</td>
			</tr>
		</table>
		</td></tr></table>		
		</div>		
  </form>	
{/if}

{if $showSecond}
  <form method="post">
		<input type="hidden" name="games_id" value="{$games_id}" />
		<input type="hidden" name="games_id" value="{$games_id}" />
		<input type="hidden" name="hole1_par" value="{$hole1_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole2_par" value="{$hole2_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole3_par" value="{$hole3_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole4_par" value="{$hole4_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole5_par" value="{$hole5_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole6_par" value="{$hole6_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole7_par" value="{$hole7_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole8_par" value="{$hole8_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole9_par" value="{$hole9_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole10_par" value="{$hole10_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole11_par" value="{$hole11_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole12_par" value="{$hole12_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole13_par" value="{$hole13_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole14_par" value="{$hole14_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole15_par" value="{$hole15_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole16_par" value="{$hole16_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole17_par" value="{$hole17_par}" size="2" maxlength="2" readonly="true"/>
		<input type="hidden" name="hole18_par" value="{$hole18_par}" size="2" maxlength="2" readonly="true"/>				
		<div id="bdr">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="99%">
		<table width="97%" border="1" cellspacing="0" cellpadding="0" class="biasa">
			<tr>
				<th>Hole</th>
				<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
				<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th>
			</tr>
			<tr>
				<th>GIR</th>
				<td><input type="text" name="hole1_gir" value="{$hole1_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_gir" value="{$hole2_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_gir" value="{$hole3_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_gir" value="{$hole4_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_gir" value="{$hole5_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_gir" value="{$hole6_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_gir" value="{$hole7_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_gir" value="{$hole8_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_gir" value="{$hole9_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_gir" value="{$hole10_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_gir" value="{$hole11_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_gir" value="{$hole12_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_gir" value="{$hole13_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_gir" value="{$hole14_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_gir" value="{$hole15_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_gir" value="{$hole16_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_gir" value="{$hole17_gir}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_gir" value="{$hole18_gir}" size="2" maxlength="2"/></td>
			</tr>
			<tr>
				<th>Fairway</th>
				<td><input type="text" name="hole1_fairway" value="{$hole1_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_fairway" value="{$hole2_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_fairway" value="{$hole3_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_fairway" value="{$hole4_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_fairway" value="{$hole5_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_fairway" value="{$hole6_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_fairway" value="{$hole7_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_fairway" value="{$hole8_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_fairway" value="{$hole9_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_fairway" value="{$hole10_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_fairway" value="{$hole11_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_fairway" value="{$hole12_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_fairway" value="{$hole13_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_fairway" value="{$hole14_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_fairway" value="{$hole15_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_fairway" value="{$hole16_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_fairway" value="{$hole17_fairway}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_fairway" value="{$hole18_fairway}" size="2" maxlength="2"/></td>
			</tr>		
			<tr>
				<th>RR</th>
				<td><input type="text" name="hole1_rr2" value="{$hole1_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_rr2" value="{$hole2_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_rr2" value="{$hole3_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_rr2" value="{$hole4_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_rr2" value="{$hole5_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_rr2" value="{$hole6_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_rr2" value="{$hole7_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_rr2" value="{$hole8_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_rr2" value="{$hole9_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_rr2" value="{$hole10_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_rr2" value="{$hole11_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_rr2" value="{$hole12_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_rr2" value="{$hole13_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_rr2" value="{$hole14_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_rr2" value="{$hole15_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_rr2" value="{$hole16_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_rr2" value="{$hole17_rr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_rr2" value="{$hole18_rr2}" size="2" maxlength="2"/></td>
			</tr>		
			<tr>
				<th>LR</th>
				<td><input type="text" name="hole1_lr2" value="{$hole1_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_lr2" value="{$hole2_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_lr2" value="{$hole3_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_lr2" value="{$hole4_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_lr2" value="{$hole5_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_lr2" value="{$hole6_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_lr2" value="{$hole7_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_lr2" value="{$hole8_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_lr2" value="{$hole9_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_lr2" value="{$hole10_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_lr2" value="{$hole11_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_lr2" value="{$hole12_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_lr2" value="{$hole13_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_lr2" value="{$hole14_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_lr2" value="{$hole15_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_lr2" value="{$hole16_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_lr2" value="{$hole17_lr2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_lr2" value="{$hole18_lr2}" size="2" maxlength="2"/></td>
			</tr>				
			<tr>
				<th>ON</th>
				<td><input type="text" name="hole1_on" value="{$hole1_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_on" value="{$hole2_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_on" value="{$hole3_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_on" value="{$hole4_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_on" value="{$hole5_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_on" value="{$hole6_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_on" value="{$hole7_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_on" value="{$hole8_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_on" value="{$hole9_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_on" value="{$hole10_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_on" value="{$hole11_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_on" value="{$hole12_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_on" value="{$hole13_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_on" value="{$hole14_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_on" value="{$hole15_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_on" value="{$hole16_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_on" value="{$hole17_on}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_on" value="{$hole18_on}" size="2" maxlength="2"/></td>
			</tr>		
			<tr>
				<th>Bunker</th>
				<td><input type="text" name="hole1_bunker2" value="{$hole1_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_bunker2" value="{$hole2_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_bunker2" value="{$hole3_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_bunker2" value="{$hole4_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_bunker2" value="{$hole5_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_bunker2" value="{$hole6_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_bunker2" value="{$hole7_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_bunker2" value="{$hole8_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_bunker2" value="{$hole9_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_bunker2" value="{$hole10_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_bunker2" value="{$hole11_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_bunker2" value="{$hole12_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_bunker2" value="{$hole13_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_bunker2" value="{$hole14_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_bunker2" value="{$hole15_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_bunker2" value="{$hole16_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_bunker2" value="{$hole17_bunker2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_bunker2" value="{$hole18_bunker2}" size="2" maxlength="2"/></td>
			</tr>				
			<tr>
				<th>Penalty</th>
				<td><input type="text" name="hole1_penalty2" value="{$hole1_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_penalty2" value="{$hole2_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_penalty2" value="{$hole3_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_penalty2" value="{$hole4_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_penalty2" value="{$hole5_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_penalty2" value="{$hole6_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_penalty2" value="{$hole7_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_penalty2" value="{$hole8_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_penalty2" value="{$hole9_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_penalty2" value="{$hole10_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_penalty2" value="{$hole11_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_penalty2" value="{$hole12_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_penalty2" value="{$hole13_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_penalty2" value="{$hole14_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_penalty2" value="{$hole15_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_penalty2" value="{$hole16_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_penalty2" value="{$hole17_penalty2}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_penalty2" value="{$hole18_penalty2}" size="2" maxlength="2"/></td>
			</tr>	
			<tr>
				<th>Putts</th>
				<td><input type="text" name="hole1_putts" value="{$hole1_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_putts" value="{$hole2_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_putts" value="{$hole3_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_putts" value="{$hole4_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_putts" value="{$hole5_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_putts" value="{$hole6_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_putts" value="{$hole7_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_putts" value="{$hole8_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_putts" value="{$hole9_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_putts" value="{$hole10_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_putts" value="{$hole11_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_putts" value="{$hole12_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_putts" value="{$hole13_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_putts" value="{$hole14_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_putts" value="{$hole15_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_putts" value="{$hole16_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_putts" value="{$hole17_putts}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_putts" value="{$hole18_putts}" size="2" maxlength="2"/></td>
			</tr>								
			<tr>
				<td colspan="19">
					<input name="savesecondbtn" type="submit" id="savesecondbtn" value="Save"/>
					<input type="submit" name="cancelparbtn" value="Cancel"/>				
				</td>
			</tr>
		</table>
		</td></tr></table>		
		</div>		
  </form>
{/if}