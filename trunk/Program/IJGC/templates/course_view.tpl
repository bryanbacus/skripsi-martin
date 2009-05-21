<tr><td>
{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if $showList}
  <form method="post">
		<table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#FBC98E">
			<tr>
				<td height="5"></td>
				<td height="5"></td>
			</tr>
			<tr>
				<td width="5">&nbsp;</td>
				<td>
					<strong>Search By :</strong><br/>
					Course Name :
					<input type="text" name="search_val" value="" size="20" maxlength="45" /> 
					<input type="submit" name="caribtn" value="Search"/>
					<input type="submit" name="refreshbtn" value="Reload"/>
				</td>
			</tr>
			<tr>
				<td height="5"></td>
				<td height="5"></td>
			</tr>
		</table>
		<br>
	{if $courselist}
    <table border="0" width="100%" class="adminlist" cellspacing="1">
      <tr>
				<th width="20%">LOGO</th>
				<th width="80%" align="left">COURSE</th>
      </tr>
      {section name=course loop=$courselist}
      <tr>
				<td valign="top"><img src="{$courselist[course].course_logopath}" class="boardimg"></td>
				<td valign="top">
					<div align="left"><h3><a href="{$this_page}?page=crview&aksi2=edit&id={$courselist[course].course_id}">{$courselist[course].course_name}</a></h3></div>
					<div align="left">{$courselist[course].course_addr}</div>
					<div align="left">phone: {$courselist[course].course_phone}</div>				
				</td>
      </tr>
      {/section}
    </table>
  {else}
		<table border="1">
			<tr>
				<td>{$course_msg}</td>
			</tr>
		</table>
  {/if}
  </form>	
{/if}

{if $showDetail}
  <form method="post">
		<input type="hidden" name="course_id" value="{$course_id}" />
		<div id="bdr">
		<table align="center" width="70%" border="0" cellspacing="0" cellpadding="0" class="adminlist">
		<tr><td width="3%"></td><td width="97%">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			  <td align="center" valign="top" width="25%">
					<p align="center"><img src="{$pathimage}" width="100" height="100" /></p>
				</td>
				<td width="75%" align="left" valign="top">
					<div align="left"><h2>{$course_name}</h2></div>
					<div align="left"><h4>{$course_addr}</h4></div>
					<div align="left"><h4>phone: {$course_phone}</h4></div>
					<br/>
					<div align="left">{$course_desc}</div>
				</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td align="left" valign="top">
				<input type="submit" name="cancelbtn" value="Close & Back To List" />
				</td>
			</tr>						
		</table>
		<br>
		</td></tr></table>		
		</div>		
		<hr/>
		<div id="bdr">
			<br/>
			<p><strong>Course Spesification</strong></p>		
			<table width="80%" border="1" cellspacing="0" cellpadding="0" class="coba" >
				<tr>
					<th width="25%">Hole</th>
					<th width="3%"><div align="center">1</div></th>
					<th width="3%"><div align="center">2</div></th>
					<th width="3%"><div align="center">3</div></th>
					<th width="3%"><div align="center">4</div></th>
					<th width="3%"><div align="center">5</div></th>
					<th width="3%"><div align="center">6</div></th>
					<th width="3%"><div align="center">7</div></th>
					<th width="3%"><div align="center">8</div></th>
					<th width="3%"><div align="center">9</div></th>
					<th width="3%"><div align="center">OUT</div></th>
					<th width="3%"><div align="center">10</div></th>
					<th width="3%"><div align="center">11</div></th>
					<th width="3%"><div align="center">12</div></th>
					<th width="3%"><div align="center">13</div></th>
					<th width="3%"><div align="center">14</div></th>
					<th width="3%"><div align="center">15</div></th>
					<th width="3%"><div align="center">16</div></th>
					<th width="3%"><div align="center">17</div></th>
					<th width="3%"><div align="center">18</div></th>
				  <th width="3%"><div align="center">IN</div></th>
				  <th width="3%"><div align="center">TOTAL</div></th>
				</tr>
				<tr>
					<th>Par</th>
					<td><div align="center">{$hole1_par}</div></td>
					<td><div align="center">{$hole2_par}</div></td>
					<td><div align="center">{$hole3_par}</div></td>
					<td><div align="center">{$hole4_par}</div></td>
					<td><div align="center">{$hole5_par}</div></td>
					<td><div align="center">{$hole6_par}</div></td>
					<td><div align="center">{$hole7_par}</div></td>
					<td><div align="center">{$hole8_par}</div></td>
					<td><div align="center">{$hole9_par}</div></td>
					<td><div align="center">{$out_par}</div></td>
					<td><div align="center">{$hole10_par}</div></td>
					<td><div align="center">{$hole11_par}</div></td>
					<td><div align="center">{$hole12_par}</div></td>
					<td><div align="center">{$hole13_par}</div></td>
					<td><div align="center">{$hole14_par}</div></td>
					<td><div align="center">{$hole15_par}</div></td>
					<td><div align="center">{$hole16_par}</div></td>
					<td><div align="center">{$hole17_par}</div></td>
					<td><div align="center">{$hole18_par}</div></td>
				  <td><div align="center">{$in_par}</div></td>
				  <td><div align="center">{$total_par}</div></td>
				</tr>
				<tr>
					<th>Handicap</th>
					<td><div align="center">{$hole1_hcp}</div></td>
					<td><div align="center">{$hole2_hcp}</div></td>
					<td><div align="center">{$hole3_hcp}</div></td>
					<td><div align="center">{$hole4_hcp}</div></td>
					<td><div align="center">{$hole5_hcp}</div></td>
					<td><div align="center">{$hole6_hcp}</div></td>
					<td><div align="center">{$hole7_hcp}</div></td>
					<td><div align="center">{$hole8_hcp}</div></td>
					<td><div align="center">{$hole9_hcp}</div></td>
					<td>&nbsp;</td>
					<td><div align="center">{$hole10_hcp}</div></td>
					<td><div align="center">{$hole11_hcp}</div></td>
					<td><div align="center">{$hole12_hcp}</div></td>
					<td><div align="center">{$hole13_hcp}</div></td>
					<td><div align="center">{$hole14_hcp}</div></td>
					<td><div align="center">{$hole15_hcp}</div></td>
					<td><div align="center">{$hole16_hcp}</div></td>
					<td><div align="center">{$hole17_hcp}</div></td>
					<td><div align="center">{$hole18_hcp}</div></td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				</tr>
				{if $teelist}
				{section name=tee loop=$teelist}
								
				<tr bgcolor="{$teelist[tee].type_color}">
					<td class>
					<div align="left"><strong>{$teelist[tee].type_name}</strong></div>
					<table border="0" cellpadding="0" cellspacing="0" class="resik">
					<tr><td width="45%">
						<div align="left">Measure</div>
						<div align="left">Course/Slope</div>
					</td>
					<td width="55%">
						<div align="right">{$teelist[tee].course_measure}</div>
						<div align="right">{$teelist[tee].course_rating}/{$teelist[tee].slope_rating}</div>
						<div align="right"></div>
					</td>
					</tr>			
					</table>
					</td>
					<td><div align="center">{$teelist[tee].hole0_length}</div></td>
					<td><div align="center">{$teelist[tee].hole1_length}</div></td>
					<td><div align="center">{$teelist[tee].hole2_length}</div></td>
					<td><div align="center">{$teelist[tee].hole3_length}</div></td>
					<td><div align="center">{$teelist[tee].hole4_length}</div></td>
					<td><div align="center">{$teelist[tee].hole5_length}</div></td>
					<td><div align="center">{$teelist[tee].hole6_length}</div></td>
					<td><div align="center">{$teelist[tee].hole7_length}</div></td>
					<td><div align="center">{$teelist[tee].hole8_length}</div></td>
					<td><div align="center">{$teelist[tee].out_length}</td>
					<td><div align="center">{$teelist[tee].hole9_length}</div></td>
					<td><div align="center">{$teelist[tee].hole10_length}</div></td>
					<td><div align="center">{$teelist[tee].hole11_length}</div></td>
					<td><div align="center">{$teelist[tee].hole12_length}</div></td>
					<td><div align="center">{$teelist[tee].hole13_length}</div></td>
					<td><div align="center">{$teelist[tee].hole14_length}</div></td>
					<td><div align="center">{$teelist[tee].hole15_length}</div></td>
					<td><div align="center">{$teelist[tee].hole16_length}</div></td>
					<td><div align="center">{$teelist[tee].hole17_length}</div></td>
				  <td><div align="center">{$teelist[tee].in_length}</td>
				  <td><div align="center">{$teelist[tee].total_length}</td>
				</tr>				
				{/section}
				{else}
				<tr>
					<td colspan="27">There are currently no tee course. Please create one.</td>
				</tr>				
				{/if}
			</table>
		</div>			
  </form>	
{/if}
</td></tr>