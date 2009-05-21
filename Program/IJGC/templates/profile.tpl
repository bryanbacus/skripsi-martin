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
 {if !$edit}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%">
		<table>
		<tr>
			<td width="100" align="left" valign="top">
				<img src="{$listProfile.gambar}" width="100" height="100" class="boardimg" align="left">
			</td>
			<td width="100%">	
				<table class="adminlist" width="75%">
					<tr><th colspan="3"><span class="judul">{$listProfile.id}</span><br></br></th></tr>
					<tr><td><b>Name</b></td><td>:</td><td><span class="tulisan">{$listProfile.name}</span><br></td></tr>
					<tr><td><b>Email</b></td><td>:</td><td><span class="tulisan">{$listProfile.email}</span><br></td></tr>
					<tr><td><b>Place, Date Birth</b></td><td>:</td><td><span class="tulisan">{$listProfile.tmpLahir}, {$listProfile.waktu}</span><br></td></tr>
					<tr><td><strong>Address</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.alamat}</span><br></td></tr>
					<tr><td><strong>Country</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.negara}</span><br></td></tr>
					<tr><td><strong>Home Phone</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.noRumah}</span><br></td></tr>
					<tr><td><strong>Handphone Number</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.noHp}</span><br></td></tr>
					<tr><td><strong>Hobby</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.hobby}</span><br></td></tr>
					<tr><td><strong>Parents Name</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.ortu}</span><br></td></tr>
					<tr><td><strong>Parents Contact</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.noHportu}</span><br></td></tr>
					<tr><td><strong>Handicap</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.handicap}</span><br></td></tr>
					<tr><td><strong>Golf Club</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.golfClub}</span><br></td></tr>
					<tr><td valign="top"><strong>Best Tournament</strong></td>
					<td></td><td>
						<table border="0" class="adminlist" width="100%">
							<tr bgcolor="#CCCCCC"><td>No.</td><td>Location</td><td>Year</td></tr>
							{section name=best loop=$listBest}
								<tr><td>{$listBest[best].no}</td><td>{$listBest[best].best}</td><td>{$listBest[best].year}</td></tr>
							{/section}
						</table>
					</td></tr>
					<tr><td><strong>Recomendation</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.recomen}</span><br></td></tr>
					<tr><td><strong>Level</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.level}</span><br></td></tr>
					<tr><td><strong>Group Membership</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.group}</span></td></tr>
					<tr><td><strong>Package</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.package}</span></td></tr>
					<tr><td><strong>Reward Earned</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.reward_earned}</span></td></tr>
					<tr><td><strong>Ranking Point</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.ranking_point}</span></td></tr>
					<tr><td><strong>Trial Point</strong></td>
					<td>:</td><td><span class="tulisan">{$listProfile.trial_point}</span></td></tr>
					{if $listProfile.editProfile != 1}
						<tr><td></td><td></td><td>
							<form method="post">
								<input type="submit" name="edit" value="Edit your profile">
							</form>
						</td></tr>
					{else}
						{php}
							if($_SESSION['levelUser']==2){
						{/php}		
							<tr><td colspan="3"><span class="pesan">Your Profile waiting approval from your parent.</pesan></td></tr>
						{php}
							} else {
						{/php}	
							<tr><td colspan="3"><span class="pesan"><a href="?page=approval">View edited profile</a></pesan></td></tr>
						{php}
							}
						{/php}
					{/if}
				</table>	
			</td>
		</tr>
		</table>
	</td>
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
							{section name=best loop=$listBest}
								<tr><td>{$listBest[best].no}</td><td><input type="hidden" name="idb{$listBest[best].no}" value="{$listBest[best].id}"><input type="text" name="best{$listBest[best].no}" value="{$listBest[best].best}"></td><td><input type="text" name="year{$listBest[best].no}" value="{$listBest[best].year}"></td></tr>
							{/section}
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
					<td></td><td><input type="submit" name="submit" value="Simpan"></td></tr>
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
 {/if}