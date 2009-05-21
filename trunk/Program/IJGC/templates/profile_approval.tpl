	{literal}
	<script type="text/javascript" src="./js/popup.js"></script>
	<script type="text/javascript" src="./js/calendarDateInput.js">
	
	/***********************************************
	* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
	* Script featured on and available at http://www.dynamicdrive.com
	* Keep this notice intact for use.
	***********************************************/
	
	</script>
	{/literal}
  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2"><img src="{$jdlImages}" border=0></td>
    <td width="5"></td>
  </tr>
 {if $pesan}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%" colspan="2" class="pesan">{$pesan}</td>
    <td width="5"></td>
  </tr> 
 {else}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%">
		<form name="editProfile" method="post" enctype="multipart/form-data">
		<table>
		<tr>
			<td width="100" align="left" valign="top">
				<img src="{$listProfile.gambar}" width="100" height="100" class="boardimg" align="left">
			</td>
			<td width="100%">	
				<table class="adminlist" width="75%">
					<tr><th colspan="3"><span class="judul">{$listProfile.id}</span><br></br></td></tr>
					<tr><td><b>Name</b></td><td>:</td><td><input type="text" name="nama" value="{$listProfile.name}"></td></tr>
					<tr><td><b>Email</b></td><td>:</td><td><input type="text" name="email" value="{$listProfile.email}"></td></tr>
					<tr><td><b>Birth Date</b></td><td>:</td><td><script>DateInput('tglLahir', true, 'YYYY-MM-DD','{$listProfile.tglLahir}')</script></td></tr>
					<tr><td><b>Birth Place</b></td><td>:</td><td><input type="text" name="tmpLahir" value="{$listProfile.tmpLahir}"></td></tr>
					<tr><td><strong>Address</strong></td>
					<td>:</td><td><input type="text" name="alamat" value="{$listProfile.alamat}"></td></tr>
					<tr><td><strong>Country</strong></td>
					<td>:</td><td>
						<select name="negara">
							{section name=neg loop=$negara}
								<option value="{$negara[neg].id}">{$negara[neg].negar}</option>
							{/section}
						</select>
					</td></tr>
					<tr><td><strong>Home Phone</strong></td>
					<td>:</td><td><input type="text" name="noRumah" value="{$listProfile.noRumah}"></td></tr>
					<tr><td><strong>Handphone Number</strong></td>
					<td>:</td><td><input type="text" name="noHp" value="{$listProfile.noHp}"></td></tr>
					<tr><td><strong>Hobby</strong></td>
					<td>:</td><td><input type="text" name="hobby" value="{$listProfile.hobby}"></td></tr>
					<tr><td><strong>Parents Name</strong></td>
					<td>:</td><td><input type="text" name="ortu" value="{$listProfile.ortu}"></td></tr>
					<tr><td><strong>Parents Contact</strong></td>
					<td>:</td><td><input type="text" name="noHpOrtu" value="{$listProfile.noHportu}"></td></tr>
					<tr><td><strong>Handicap</strong></td>
					<td>:</td><td><input type="text" name="handicap" value="{$listProfile.handicap}"></td></tr>
					<tr><td><strong>Golf Club</strong></td>
					<td>:</td><td><input type="text" name="golfClub" value="{$listProfile.golfClub}"></td></tr>
					<tr><td><strong>Change Image</strong></td>
					<td>:</td><td><input type="file" name="image"></td></tr>
					<tr><td valign="top"><strong>Best Tournament</strong></td>
					<td></td><td>
						<table border="0" class="adminlist" width="100%">
							<tr bgcolor="#CCCCCC"><td>No.</td><td>Location</td><td>Year</td></tr>
							{php}
								for($i=1;$i<=5;$i++){
							{/php}		
								<tr><td>{php}echo $i;{/php}</td>
								<td><input type="hidden" name="idb{php}echo $i;{/php}" value="{$listBest[$i].id}">
								<input type="text" name="best{php}echo $i;{/php}" value="{$listBest[$i].best}"></td>
								<td><input type="text" name="year{php}echo $i;{/php}" value="{$listBest[$i].year}"></td></tr>
							{php}
								}
							{/php}
						</table>
					</td></tr>					
					<tr><td><strong>Recomendation</strong></td>
					<td>:</td><td><input type="checkbox" name="recomendation" value="1" {$listProfile.rec}></td></tr>
					<tr><td><strong>Group Membership</strong></td>
					<td>:</td><td>
						<select name="group">
						{section name=grp loop=$group}
							<option value="{$group[grp].id}" {$group[grp].select}>{$group[grp].type}({$group[grp].description})</option>
						{/section}
						</select>
					</td></tr>
					<tr><td><strong>Package</strong></td>
					<td>:</td><td>
						<select name="package">
						{section name=pack loop=$package}
							<option value="{$package[pack].id}" {$package[pack].select}>{$package[pack].type}({$package[pack].description})</option>
						{/section}
						</select>
					</td></tr>
					<tr><td></td>
					<td></td><td><input type="submit" name="aksi" value="Edit">
								 <input type="submit" name="aksi" value="Approve">
								 <input type="submit" name="aksi" value="Reject"></td></tr>
					</form>
					</td></tr>
				</table>	
			</td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {/if}