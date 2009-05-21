{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
<div id="addRanks">
	{if !$dshowMe}
	<form method="post" name="addMember">
		<table border="0">
			<tr>
				<td class="label">UNIQUE ID</td>
				<td class="texton">:</td>
				<td class="texton">{$dataUser.id}<input type="hidden" name="idUnik" value="{$dataUser.id}" /></td>
			</tr>
			<tr>
				<td class="label">NAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="nama" value="{$dataUser.name}" size="50"/> </td>
			</tr>
			<tr>
				<td class="label">EMAIL</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="email" value="{$dataUser.email}" size="50"/> </td>
			</tr>
			<tr>
				<td class="label">BIRTH DATE</td>
				<td class="texton">:</td>
				<td class="texton"><script>DateInput('tglLahir', true, 'YYYY-MM-DD','{$dataUser.tgl}')</script></td>
			</tr>
			<tr>
				<td class="label">BIRTH PLACE</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="tmpLahir" value="{$dataUser.tmpLahir}" size="50" maxlength="255" /></td>
			</tr>
			<tr>
				<td class="label">HOME ADDRESS</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="alamat" value="{$dataUser.alamat}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">NATIONALITY</td>
				<td class="texton">:</td>
				<td class="texton">
				<select name="negara">
					{section name=negara loop=$listNegara}
						<option value="{$listNegara[negara].id}">{$listNegara[negara].negara}</option>
					{/section}
				</select>
				</td>
			</tr>
			<tr>
				<td class="label">HOME PHONE</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="noRumah" value="{$dataUser.noRumah}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HAND PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="noHp" value="{$dataUser.noHp}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">OTHERSPORTS/HOBBIES</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="hobby" value="{$dataUser.hobby}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">PARENTS NAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="ortu" value="{$dataUser.ortu}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HAND PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="noHportu" value="{$dataUser.noHportu}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HANDICAP/CONFIRMED BY</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="handicap" value="{$dataUser.handicap}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">GOLF CLUB/PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="golfClub" value="{$dataUser.golfClub}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">5 BEST TOURNAMENT RESULT(LOCATION/YEAR)</td>
				<td class="texton">:</td>
				<td class="texton"><input type="hidden" name="idb1" value="{$dataB[1].id1}"><input type="text" name="best1" value="{$dataB[1].location1}" size="20" maxlength="100" /> / <input type="text" name="year1" value="{$dataB[1].year1}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="hidden" name="idb2" value="{$dataB[2].id2}"><input type="text" name="best2" value="{$dataB[2].location2}" size="20" maxlength="100" /> / <input type="text" name="year2" value="{$dataB[2].year2}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="hidden" name="idb3" value="{$dataB[3].id3}"><input type="text" name="best3" value="{$dataB[3].location3}" size="20" maxlength="100" /> / <input type="text" name="year3" value="{$dataB[3].year3}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="hidden" name="idb4" value="{$dataB[4].id4}"><input type="text" name="best4" value="{$dataB[4].location4}" size="20" maxlength="100" /> / <input type="text" name="year4" value="{$dataB[4].year4}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="hidden" name="idb5" value="{$dataB[5].id5}"><input type="text" name="best5" value="{$dataB[5].location5}" size="20" maxlength="100" /> / <input type="text" name="year5" value="{$dataB[5].year5}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">RECOMENDATION LETTER FROM GOLF CLUB/GOLF ACADEMIES</td>
				<td class="texton">:</td>
				<td class="texton"><input type="checkbox" name="recomendation" value="1" {$check}></td>
			</tr>
			<tr>
				<td class="label">LEVEL</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="level">
					{section name=level loop=$listLevel}
						<option value="{$listLevel[level].id}" {$listLevel[level].select}>{$listLevel[level].level}</option>
					{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">GROUP TYPE</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="group">
					{section name=group loop=$listGroup}
						<option value="{$listGroup[group].id}" {$listGroup[group].select}>{$listGroup[group].group}({$listGroup[group].description})</option>
					{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">PACKAGE</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="package">
					{section name=package loop=$listPackage}
						<option value="{$listPackage[package].id}" {$listPackage[package].select}>{$listPackage[package].type}({$listPackage[package].description})</option>
					{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="tombol" colspan="3">
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>
		{literal}
	<script language="JavaScript" type="text/javascript">
		//You should create the validator only after the definition of the HTML form
		  var frmvalidator  = new Validator("addMember");
		  frmvalidator.addValidation("nama","req","Masukkan nama Anda");
		  frmvalidator.addValidation("nama","Masukkan kode alpanumeric");

		  frmvalidator.addValidation("email","maxlen=100");
		  frmvalidator.addValidation("email","req");
		  frmvalidator.addValidation("email","email");

		  frmvalidator.addValidation("alamat","req","Masukkan Alamat");
		  frmvalidator.addValidation("alamat","Masukkan kode aplhanumeric");

		  frmvalidator.addValidation("noRumah","req","Masukkan Telepon Rumah");
		  frmvalidator.addValidation("noRumah","Masukkan kode aplhanumeric");

		  frmvalidator.addValidation("noHp","req","Masukkan Nomor Hand Phone");
		  frmvalidator.addValidation("noHp","Masukkan kode aplhanumeric");

		  frmvalidator.addValidation("ortu","req","Masukkan nama Orangtua");
		  frmvalidator.addValidation("ortu","Masukkan kode aplhanumeric");
		  		  		  
		  /*
		  frmvalidator.addValidation("Phone","maxlen=50");
		  frmvalidator.addValidation("Phone","numeric");
		  
		  frmvalidator.addValidation("Address","maxlen=50");
		  frmvalidator.addValidation("Country","dontselect=0");
		*/
	</script>
	{/literal}
	{/if}
</div>
