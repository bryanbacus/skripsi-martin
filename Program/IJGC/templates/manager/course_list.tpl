{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if $showList}
<div id="bdr">
  <form method="post">
		<table border="0" cellspacing="0" cellpadding="0" width="65%">
			<tr>
				<td>
					<strong>Search By :</strong><br/>
					Course Name :
					<input type="text" name="search_val" value="" size="45" maxlength="45" /> 
					<input type="submit" name="caribtn" value="Search"/>
					<input type="submit" name="refreshbtn" value="Reload"/>
					<input type="submit" name="createbtn" value="Create a new course"/>								
				</td>
			</tr>
		</table>
		<br>
	{if $courselist}
    <table class="adminlist" border="1" width="100%">
      <tr>
				<th width="20%">LOGO</th>
				<th width="20%">NAME</th>
				<th width="30%">ADDRESS</th>
				<th width="20%">PHONE</th>
        <th colspan="2">ACTION</th>
      </tr>
      {section name=course loop=$courselist}
      <tr>
				<td valign="top"><img src="{$courselist[course].course_logopath}" /></td>
				<td valign="top">{$courselist[course].course_name}</td>
				<td valign="top">{$courselist[course].course_addr}</td>
        <td valign="top">{$courselist[course].course_phone}</td>
        <td valign="top" align="center" width="5%"><a href="{$this_page}?aksi=crlist&aksi2=edit&id={$courselist[course].course_id}">edit</a></td>
				<td valign="top" align="center" width="5%"><a href="{$this_page}?aksi=crlist&aksi2=delete&id={$courselist[course].course_id}">delete</a></td>
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
  <form method="post" enctype="multipart/form-data">
		<input type="hidden" name="course_id" value="{$course_id}" />
		<div id="bdr">
		<table width="75%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="3%"></td><td width="97%">
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			  <td rowspan="4" align="center" valign="top" width="34%"><p align="center"><img src="{$pathimage}" width="100" height="100" /></p></td>
				<td width="30%" align="left" valign="top">Course Name</td>
				<td width="1%" align="left" valign="top">:</td>
				<td width="35%"><input type="text" name="course_name" value="{$course_name}" size="30" maxlength="45"></td>
			</tr>
			<tr>
				<td align="left" valign="top">Course Address</td>
				<td align="left" valign="top">:</td>
				<td><input type="text" name="course_addr" value="{$course_addr}" size="45" maxlength="128"></td>
			</tr>			
			<tr>
				<td align="left" valign="top">Phone Number</td>
				<td align="left" valign="top">:</td>
				<td><input type="text" name="course_phone" value="{$course_phone}" size="15" maxlength="15"></td>
			</tr>			
			<tr>
				<td align="left" valign="top">Description</td>
				<td align="left" valign="top">:</td>
				<td><textarea name="course_desc" cols="51" rows="5" wrap="soft">{$course_desc}</textarea></td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
				<td colspan="3" align="left" valign="top">
				<input type="submit" name="savebtn" value="{$savebtn}" />
				<input type="submit" name="cancelbtn" value="Cancel" />
				</td>
			</tr>						
		</table>
		<br>
		{if $editDetail}
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td colspan="3">Browse your course's logo below, to update the logo. Max file is 100 KB (200x100 pixel).</td>
				</tr>
				<tr>
					<td>Upload Logo</td>
					<td>:</td>
					<td><input type="file" name="gambar" /><input type="submit" name="upload" value="Upload" /></td>
				</tr>			
			</table>
		{/if}
		</td></tr></table>		
		</div>		
		{if $editDetail}	
			<hr/>
			<br/>
			<div id="bdr">			
			<p><strong>Course Spesification</strong></p>		
			<table width="80%" border="1" cellspacing="0" cellpadding="0" class="biasa" >
				<tr>
					<th colspan="6">Hole <a href="{$this_page}?aksi=crlist&aksi2=editpar&id={$cr_id}&sid={$par_id}">[edit]</a></th>
					<th width="4%"><div align="center">1</div></th>
					<th width="4%"><div align="center">2</div></th>
					<th width="4%"><div align="center">3</div></th>
					<th width="4%"><div align="center">4</div></th>
					<th width="4%"><div align="center">5</div></th>
					<th width="4%"><div align="center">6</div></th>
					<th width="4%"><div align="center">7</div></th>
					<th width="4%"><div align="center">8</div></th>
					<th width="4%"><div align="center">9</div></th>
					<th width="4%"><div align="center">10</div></th>
					<th width="4%"><div align="center">11</div></th>
					<th width="4%"><div align="center">12</div></th>
					<th width="4%"><div align="center">13</div></th>
					<th width="4%"><div align="center">14</div></th>
					<th width="4%"><div align="center">15</div></th>
					<th width="4%"><div align="center">16</div></th>
					<th width="4%"><div align="center">17</div></th>
					<th width="4%"><div align="center">18</div></th>
				</tr>
				<tr>
					<th colspan="6">Par</th>
					<td><div align="center">{$hole1_par}</div></td>
					<td><div align="center">{$hole2_par}</div></td>
					<td><div align="center">{$hole3_par}</div></td>
					<td><div align="center">{$hole4_par}</div></td>
					<td><div align="center">{$hole5_par}</div></td>
					<td><div align="center">{$hole6_par}</div></td>
					<td><div align="center">{$hole7_par}</div></td>
					<td><div align="center">{$hole8_par}</div></td>
					<td><div align="center">{$hole9_par}</div></td>
					<td><div align="center">{$hole10_par}</div></td>
					<td><div align="center">{$hole11_par}</div></td>
					<td><div align="center">{$hole12_par}</div></td>
					<td><div align="center">{$hole13_par}</div></td>
					<td><div align="center">{$hole14_par}</div></td>
					<td><div align="center">{$hole15_par}</div></td>
					<td><div align="center">{$hole16_par}</div></td>
					<td><div align="center">{$hole17_par}</div></td>
					<td><div align="center">{$hole18_par}</div></td>
				</tr>
				<tr>
					<th colspan="6">Handicap</th>
					<td><div align="center">{$hole1_hcp}</div></td>
					<td><div align="center">{$hole2_hcp}</div></td>
					<td><div align="center">{$hole3_hcp}</div></td>
					<td><div align="center">{$hole4_hcp}</div></td>
					<td><div align="center">{$hole5_hcp}</div></td>
					<td><div align="center">{$hole6_hcp}</div></td>
					<td><div align="center">{$hole7_hcp}</div></td>
					<td><div align="center">{$hole8_hcp}</div></td>
					<td><div align="center">{$hole9_hcp}</div></td>
					<td><div align="center">{$hole10_hcp}</div></td>
					<td><div align="center">{$hole11_hcp}</div></td>
					<td><div align="center">{$hole12_hcp}</div></td>
					<td><div align="center">{$hole13_hcp}</div></td>
					<td><div align="center">{$hole14_hcp}</div></td>
					<td><div align="center">{$hole15_hcp}</div></td>
					<td><div align="center">{$hole16_hcp}</div></td>
					<td><div align="center">{$hole17_hcp}</div></td>
					<td><div align="center">{$hole18_hcp}</div></td>
				</tr>
				<tr>
					<th colspan="6">Tee <a href="{$this_page}?aksi=crlist&aksi2=createtee&id={$cr_id}">[add]</a></th>
					<th colspan="9" rowspan="2"><div align="center">OUT</div></th>
					<th colspan="9" rowspan="2"><div align="center">IN</div></th>
				</tr>
				<tr>
					<th width="4%" colspan="2"><div align="center">Act</div></th>			
					<th width="4%"><div align="center">Type</div></th>
					<th width="4%"><div align="center">Measure</div></th>
					<th width="4%"><div align="center">Course Rating</div></th>
					<th width="4%"><div align="center">Slope Rating</div></th>
				</tr>
				{if $teelist}
				{section name=tee loop=$teelist}
				<tr bgcolor="{$teelist[tee].type_color}">
					<td width="2%" bgcolor="#FFFFFF"><div align="center"><a href="{$this_page}?aksi=crlist&aksi2=updatetee&id={$teelist[tee].course_id}&sid={$teelist[tee].course_subid}">edit</a></div></td>
					<td width="2%" bgcolor="#FFFFFF"><div align="center"><a href="{$this_page}?aksi=crlist&aksi2=removetee&id={$teelist[tee].course_id}&sid={$teelist[tee].course_subid}">del</a></div></td>
					<td><div align="center">{$teelist[tee].type_name}</div></td>
					<td><div align="center">{$teelist[tee].course_measure}</div></td>
					<td><div align="center">{$teelist[tee].course_rating}</div></td>
					<td><div align="center">{$teelist[tee].slope_rating}</div></td>
					<td><div align="center">{$teelist[tee].hole0_length}</div></td>
					<td><div align="center">{$teelist[tee].hole1_length}</div></td>
					<td><div align="center">{$teelist[tee].hole2_length}</div></td>
					<td><div align="center">{$teelist[tee].hole3_length}</div></td>
					<td><div align="center">{$teelist[tee].hole4_length}</div></td>
					<td><div align="center">{$teelist[tee].hole5_length}</div></td>
					<td><div align="center">{$teelist[tee].hole6_length}</div></td>
					<td><div align="center">{$teelist[tee].hole7_length}</div></td>
					<td><div align="center">{$teelist[tee].hole8_length}</div></td>
					<td><div align="center">{$teelist[tee].hole9_length}</div></td>
					<td><div align="center">{$teelist[tee].hole10_length}</div></td>
					<td><div align="center">{$teelist[tee].hole11_length}</div></td>
					<td><div align="center">{$teelist[tee].hole12_length}</div></td>
					<td><div align="center">{$teelist[tee].hole13_length}</div></td>
					<td><div align="center">{$teelist[tee].hole14_length}</div></td>
					<td><div align="center">{$teelist[tee].hole15_length}</div></td>
					<td><div align="center">{$teelist[tee].hole16_length}</div></td>
					<td><div align="center">{$teelist[tee].hole17_length}</div></td>
				</tr>
				{/section}
				{else}
				<tr>
					<td colspan="24">There are currently no tee course. Please create one.</td>
				</tr>				
				{/if}
			</table>
			</div>
		{/if}
  </form>	
{/if}

{if $showCourse}
<div id="bdr">
	<br/>
  <form method="post">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td width="1%"></td><td width="99%">
		<table width="97%" border="1" cellspacing="0" cellpadding="0" class="biasa">
			<tr>
				<th>Hole</th>
				<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
				<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th>
			</tr>
			<tr>
				<th>Par</th>
				<td width="2%"><input type="text" name="hole1_par" value="{$hole1_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole2_par" value="{$hole2_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole3_par" value="{$hole3_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole4_par" value="{$hole4_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole5_par" value="{$hole5_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole6_par" value="{$hole6_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole7_par" value="{$hole7_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole8_par" value="{$hole8_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole9_par" value="{$hole9_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole10_par" value="{$hole10_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole11_par" value="{$hole11_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole12_par" value="{$hole12_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole13_par" value="{$hole13_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole14_par" value="{$hole14_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole15_par" value="{$hole15_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole16_par" value="{$hole16_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole17_par" value="{$hole17_par}" size="2" maxlength="2"/></td>
				<td width="2%"><input type="text" name="hole18_par" value="{$hole18_par}" size="2" maxlength="2"/></td>			</tr>
			<tr>
				<th>Hcp</th>
				<td><input type="text" name="hole1_hcp" value="{$hole1_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole2_hcp" value="{$hole2_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole3_hcp" value="{$hole3_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole4_hcp" value="{$hole4_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole5_hcp" value="{$hole5_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole6_hcp" value="{$hole6_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole7_hcp" value="{$hole7_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole8_hcp" value="{$hole8_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole9_hcp" value="{$hole9_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole10_hcp" value="{$hole10_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole11_hcp" value="{$hole11_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole12_hcp" value="{$hole12_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole13_hcp" value="{$hole13_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole14_hcp" value="{$hole14_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole15_hcp" value="{$hole15_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole16_hcp" value="{$hole16_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole17_hcp" value="{$hole17_hcp}" size="2" maxlength="2"/></td>
				<td><input type="text" name="hole18_hcp" value="{$hole18_hcp}" size="2" maxlength="2"/></td>
			</tr>
			<tr>
				<td colspan="19">
					<input type="submit" name="saveparbtn" value="Save"/>
					<input type="submit" name="cancelparbtn" value="Cancel"/>				
				</td>
			</tr>
		</table>
		</td></tr></table>		
  </form>
</div>
{/if}
{if $showTee}
<div id="bdr">
	<br/>
  <form method="post">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="1%"></td><td width="99%">
			
		<table width="97%" border="1" cellspacing="0" cellpadding="0" class="biasa">
			<tr>
				<th colspan="2">Course Type</th>
				<td colspan="17">
					<select name="course_type">
					{section name=types loop=$typelist}
						<option value="{$typelist[types].type_id}" {$typelist[types].selected}>{$typelist[types].type_name}</option>
					{/section}					
					</select>				
				</td>
			</tr>
			<tr>
				<th colspan="2">Measure</th>
				<td colspan="17">
					<select name="course_measure">
						<option value="meters" {$s1}>Meters</option>
						<option value="yards" {$s2}>Yards</option>
					</select>				
				</td>
			</tr>	
			<tr>
				<th colspan="2">Course Rating</th>
				<td colspan="17">
					<input type="text" name="course_rating" value="{$course_rating}" maxlength="5" size="5" />				
				</td>
			</tr>							
			<tr>
				<th colspan="2">Slope Rating</th>
				<td colspan="17">
					<input type="text" name="slope_rating" value="{$slope_rating}" maxlength="5" size="5" />				
				</td>
			</tr>			
			<tr>
				<th>Hole</th>
				<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th>
				<th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th>
			</tr>
			<tr>
				<th>Length</th>
				<td width="2%"><input type="text" name="hole1" value="{$hole1}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole2" value="{$hole2}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole3" value="{$hole3}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole4" value="{$hole4}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole5" value="{$hole5}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole6" value="{$hole6}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole7" value="{$hole7}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole8" value="{$hole8}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole9" value="{$hole9}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole10" value="{$hole10}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole11" value="{$hole11}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole12" value="{$hole12}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole13" value="{$hole13}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole14" value="{$hole14}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole15" value="{$hole15}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole16" value="{$hole16}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole17" value="{$hole17}" size="2" maxlength="4"/></td>
				<td width="2%"><input type="text" name="hole18" value="{$hole18}" size="2" maxlength="4"/></td>
			</tr>
			<tr>
				<td colspan="19">
					<input type="submit" name="saveteebtn" value="{$savetee}"/>
					<input type="submit" name="cancelteebtn" value="Cancel"/>				
				</td>
			</tr>
		</table>
			

		</td>
		</tr>
		</table>
  </form>	
</div>
{/if}
