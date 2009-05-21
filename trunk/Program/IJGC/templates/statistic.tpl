<tr><td>
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
<br>

<div id="bdr">
<form method="post">
{if $showList}
	<input type="hidden" name="member_id" value="{$member_id}">
	<div align="left"><strong>Statistic Criteria:</strong></div>
	<table border="1" cellspacing="0" cellpadding="0" width="100%" class="adminlist">
		<tr>
			<td width="34%">Date Period</td>
			<td width="32%"><script>DateInput('awal', true, 'YYYY/MM/DD','{$awal}')</script></td>
			<td width="2%">until</td>
			<td width="32%"><script>DateInput('akhir', true, 'YYYY/MM/DD','{$akhir}')</script></td>
		</tr>
		<tr>
			<td>Type of Game</td>
			<td colspan="3">
				<select name="gametype">
					<option value="none">-- Select Type of Game --</option>
					<option value="0">All Games</option>
					<option value="1">Practice Only</option>
					<option value="2">Tournaments Only</option>
				</select>
			</td>
		</tr>			
		<tr>
			<td>&nbsp;</td>
			<td colspan="3"><input name="filterbtn" type="submit" id="filterbtn" value="Process"/></td>
		</tr>			
	</table>
{/if}	
	<br>		
{if $showStatistic}
	<div align="left"><strong>Statistic Result</strong></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
	<tr>
		<td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:solid; border:1px">
		<tr>
			<td width="20%">Members ID</td>
			<td width="1%">:</td>
			<td width="79%">{$members_id}</td>
		</tr>
		<tr>
			<td>Members Name</td>
			<td>:</td>
			<td>{$members_name}</td>
		</tr>
		<tr>
			<td>Members Club</td>
			<td>:</td>
			<td>{$members_club}</td>
		</tr>						
		<tr>
			<td>Members Age</td>
			<td>:</td>
			<td>{$members_age}</td>
		</tr>			
		</table></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="backlist" value="Close & Back to Criteria Form"></td>
	</tr>		
	<tr><td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" style="border-bottom:solid; border-bottom:1px"><strong>Performance Summary</strong></td>
		</tr>		
		<tr>
			<td width="60%" style="border-bottom:solid; border-bottom:1px">Number of Round played </td>
			<td width="1%" style="border-bottom:solid; border-bottom:1px">:</td>
			<td width="39%" style="border-bottom:solid; border-bottom:1px">{$sum_round}</td>
		 </tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Total holes played </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_hole}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Total score</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_score}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Average score </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_avgscore}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Total putts</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_putts}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Average putts </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_avgputts}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par Saves </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_saves}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">FIR</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_fir}</td>
			</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">FIR-Ratio(%)</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_firr}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">GIR</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_gir}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">GIR-Ratio(%)</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_girr}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Fairways</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_fairways}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">RR</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_rr}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">LR</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_lr}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Bunkers</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_bunkers}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Penalties</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_penalties}</td>
		</tr>
	</table>
	</td>
	<td width="50%" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" style="border-bottom:solid; border-bottom:1px"><strong>Aces</strong></td>
		</tr>
		<tr>
			<td widht="60%" style="border-bottom:solid; border-bottom:1px">Hole In One</td>
			<td width="1%" style="border-bottom:solid; border-bottom:1px">:</td>
			<td width="39%" style="border-bottom:solid; border-bottom:1px">{$sum_hio}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Condor</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_condor}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Albatros</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_albatros}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Eagles</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_eagles}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Birdies</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_birdies}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Pars</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_pars}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Bogeys</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_bogeys}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">D. Bogeys </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_dbogeys}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">T. Bogeys </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_tbogeys}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Others</td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_others}</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom:solid; border-bottom:1px"><strong>Average Score By Par</strong></td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 3. Hole </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par3hole}</td>
		</tr>		
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 3. Avg score </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par3avgscore}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 4. Hole </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par4hole}</td>
		</tr>		
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 4. Avg score </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par4avgscore}</td>
		</tr>
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 5. Hole </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par5hole}</td>
		</tr>		
		<tr>
			<td style="border-bottom:solid; border-bottom:1px">Par 5. Avg score </td>
			<td style="border-bottom:solid; border-bottom:1px">:</td>
			<td style="border-bottom:solid; border-bottom:1px">{$sum_par5avgscore}</td>
		</tr>			
	</table>		
	</td>
	</tr></table>		
{/if}
{if $showError}
	<table border="0">
		<tr>
			<td>
				There are currently no statistic has displayed by filled criteria. Please fill the  new criteria.
				<br><input type="submit" name="backlist" value="Close & Back to Criteria Form">
			</td>
		</tr>
	</table>
{/if}
</form>	
</div>
</td></tr>