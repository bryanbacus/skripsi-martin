{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
<div id="addRanks">
	{if !$dshowMe}
	<form method="post" name="addMember">
		<table border="0">
			{if $aksi2 eq "edit"}
			<tr>
				<td class="label">UNIQUE ID</td>
				<td class="texton">:</td>
				<td class="texton">{$idUnique}<input type="hidden" name="unikId" value="{$unikId}" /></td>
			</tr>
			{else}
			<tr>
				<td class="label">UNIQUE ID</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="idUnik" size="20" maxlength="30" /> leave blank for automatic creation [X.xx.xx.xx.xx.xx.xx.xxxx]</td>
			</tr>
			{/if}
			<tr>
				<td class="label">NAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="nama" value="{$nama}" size="20"/> </td>
			</tr>
			<tr>
				<td class="label">EMAIL</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="email" value="{$email}" size="20"/> </td>
			</tr>
			<tr>
				<td class="label">BIRTH DATE</td>
				<td class="texton">:</td>
				<td class="texton"><script>DateInput('tglLahir', true, 'YYYY-MM-DD','{$tgl}')</script></td>
			</tr>
			<tr>
				<td class="label">BIRTH PLACE</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="tmpLahir" value="{$tmpLahir}" size="50" maxlength="255" /></td>
			</tr>
			<tr>
				<td class="label">HOME ADDRESS</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="alamat" value="{$alamat}" size="50" maxlength="100" /></td>
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
				<td class="texton"><input type="text" name="noRumah" value="{$noRumah}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HAND PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="noHp" value="{$noHp}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">OTHERSPORTS/HOBBIES</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="hobby" value="{$hobby}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">PARENTS NAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="ortu" value="{$ortu}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HAND PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="noHportu" value="{$nopHportu}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">HANDICAP/CONFIRMED BY</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="handicap" value="{$handicap}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">GOLF CLUB/PHONE NO.</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="golfClub" value="{$golfClub}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">5 BEST TOURNAMENT RESULT(LOCATION/YEAR)</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="best1" value="{$besT1}" size="20" maxlength="100" /> / <input type="text" name="year1" value="{$year1}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="best2" value="{$besT2}" size="20" maxlength="100" /> / <input type="text" name="year2" value="{$year2}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="best3" value="{$besT3}" size="20" maxlength="100" /> / <input type="text" name="year3" value="{$year3}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="best4" value="{$besT4}" size="20" maxlength="100" /> / <input type="text" name="year4" value="{$year4}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label"></td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="best5" value="{$besT5}" size="20" maxlength="100" /> / <input type="text" name="year5" value="{$year5}" size="20" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">RECOMENDATION LETTER FROM GOLF CLUB/GOLF ACADEMIES</td>
				<td class="texton">:</td>
				<td class="texton"><input type="checkbox" name="recomendation" value="1"></td>
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
						<option value="{$listGroup[group].id}" {$listLevel[level].select}>{$listGroup[group].group}({$listGroup[group].description})</option>
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
						<option value="{$listPackage[package].id}" {$listLevel[level].select}>{$listPackage[package].type}({$listPackage[package].description})</option>
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
