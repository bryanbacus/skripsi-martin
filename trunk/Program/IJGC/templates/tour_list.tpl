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
					<li><a href="{$this_page}?page=tourlist&aksi2=edit&id={$datalist[data].tour_id}">View Detail</a></li>
					{if $datalist[data].tour_status eq 'Open'}
					<li><a href="{$this_page}?page=tourlist&aksi2=register&id={$datalist[data].tour_id}">Register</a></li>
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
		<input type="hidden" name="round_id" value="{$round_id}" />
		<input type="hidden" name="aksi2" value="" />
		<div id="bdr">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr><td></td><td></td><td></td><td width="40%"></td></tr>		
			<tr>
				<td align="left">
					<div align="left">Tournaments Name : </div>
					<div align="left">{$tour_name}</div>
				</td>
				<td>
					<div align="left">Place : </div>
					<div align="left">{$tour_place}</div>				
				</td>
				<td>
					<div align="left">Level : </div>
					<div align="left">{$s1}</div>
				</td>				
				<td align="left">
					<div align="left">Type : </div>
					<div align="left">{$t1}</div>					
				</td>
			</tr>
			<tr>
				<td align="left">
					<div align="left">Event Date : </div>
					<div align="left">{$evt_date}</div>
				</td>
				<td align="left">
					<div align="left">Registration Due Date : </div>
					<div align="left">{$reg_date}</div>
				</td>				
				<td>
					<div align="left">Course : </div>
					<div align="left">{$courselist}</div>
				</td>
				<td>
					<div align="left">Tee Mark : </div>
					<div align="left">
							{section name=tipe loop=$typelist}
							{if $typelist[tipe].selected eq 'selected'}{$typelist[tipe].type_name}{/if}
							{/section}							
					</div>				
				</td>
			</tr>
			<tr>
				<td>
					<div align="left">Max.Player : </div>
					<div align="left">{$max_player}</div>						
				</td>			
				<td>
					<div align="left">Reward : </div>
					<div align="left">{$reward}</div>				
				</td>
				<td>
					<div align="left">Trial Points : </div>
					<div align="left">{$points}
					</div>						
				</td>
				<td>
					<div align="left">Status : </div>
					<div align="left">{$u1}</div>
				</td>
			</tr>			
			<tr>
				<td colspan="4">
					<div align="left">Description : </div>
					<div align="left">{$descr}</div>
				</td>
			</tr>
			<tr>
				<td colspan="4">
				<input type="submit" name="cancelbtn" value="Close & Back To List">
				</td>
			</tr>	
		</table>
		</div>
		{if $datalist}
		<hr/><br/>
		<div id="bdr">			
			<p><strong>Tournaments Round</strong></p>
			
			<table class="adminlist" border="1" width="100%">
				<tr>
					<th>ROUND NO</th>
					<th>ROUND DATE</th>
					<th>WEATHER</th>
					<th>PLAY RULE</th>
				</tr>
				{section name=data loop=$datalist}
				<tr>
					<td valign="top">{$datalist[data].round_no}</td>
					<td valign="top">{$datalist[data].round_date}</td>
					<td valign="top">{$datalist[data].round_weather}</td>
					<td valign="top">{$datalist[data].round_rule}</td>
				</tr>
				{/section}
			</table>
		</div>
		{/if}
  </form>	
{/if}
</td>