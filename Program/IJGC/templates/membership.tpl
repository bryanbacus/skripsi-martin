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
<tr><td>
	{if $dShow}
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td></td>
		<td colspan=2>
			<span class="pesan">{$pesan}</span>
		</td></tr>
	</table>
	{else}
	<form name="membership" method="post" action="index.php?page=member" enctype="multipart/form-data">
	<table width="100%" border="0" cellspacing="5" cellpadding="2">
	  <tr>
		<td colspan="3" style="headCentre" class="bergaris">&nbsp;<img src="./images/join.png"></td>
	  </tr>
	  <tr>
		<td colspan="3" style="headCentre">&nbsp;</td>
	  </tr>
	  <tr>
		<td class="">&nbsp;</td>
		<td class="bergaris">Name <span class="pesan">*</span></td>
		<td width="60%" class="bergaris">: <input type="text" name="nama"></td>
	  </tr>
	  <tr>
		<td class="">&nbsp;</td>
		<td class="bergaris">Email <span class="pesan">*</span></td>
		<td class="bergaris">: <input type="text" name="email"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Birth Date <span class="pesan">*</span></td>
		<td class="bergaris">: <script>DateInput('tglLahir', true, 'YYYY-MM-DD','{$tanggal}')</script></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Birth Place</td>
		<td class="bergaris">: <input type="text" name="tmpLahir"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Home Address <span class="pesan">*</span></td>
		<td class="bergaris">: <input type="text" name="alamat" size="45"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Kebangsaan</td>
		<td class="bergaris">: <select name="negara">
				{section name=neg loop=$listNegara}
					<option value="{$listNegara[neg].id}">{$listNegara[neg].negara}</option>
				{/section}	
			  </select>
		</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Home Phone <span class="pesan">*</span></td>
		<td class="bergaris">: <input type="text" name="noRumah"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Hand Phone No. <span class="pesan">*</span></td>
		<td class="bergaris">: <input type="text" name="noHp"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Othersports/Hobbies</td>
		<td class="bergaris">: <input type="text" name="hobby"><span class="note"> separate by ,</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Parents Name <span class="pesan">*</span></td>
		<td class="bergaris">: <input type="text" name="ortu"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Hand Phone No.</td>
		<td class="bergaris">: <input type="text" name="noHportu"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Handicap/Confirmed By</td>
		<td class="bergaris">: <input type="text" name="handicap"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Golf Club/Phone No.</td>
		<td class="bergaris">: <input type="text" name="golfClub"></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">5 Best Tournament Result(Year/Location)</td>
		<td class="bergaris">: <input type="text" name="besT1"><span class="note"> loc.</span> / <input type="text" name="year1" size="10"><span class="note"> year</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td></td>
		<td class="bergaris">: <input type="text" name="besT2"><span class="note"> loc.</span> / <input type="text" name="year2" size="10"><span class="note"> year</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td></td>
		<td class="bergaris">: <input type="text" name="besT3"><span class="note"> loc.</span> / <input type="text" name="year3" size="10"><span class="note"> year</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td></td>
		<td class="bergaris">: <input type="text" name="besT4"><span class="note"> loc.</span> / <input type="text" name="year4" size="10"><span class="note"> year</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td></td>
		<td class="bergaris">: <input type="text" name="besT5"><span class="note"> loc.</span> / <input type="text" name="year5" size="10"><span class="note"> year</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Recommendation Letter from Golf Club/Golf Academies</td>
		<td class="bergaris">: <input type="checkbox" name="recomendation" value="1"> Yes/No(leave blank)</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Group Type</td>
		<td class="bergaris">: <select name="jenisGroup">
				{section name=jenis loop=$listMembership}
					<option value="{$listMembership[jenis].id}">{$listMembership[jenis].group}({$listMembership[jenis].description})</option>
				{/section}	
			  </select>
		</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="bergaris">Package</td>
		<td class="bergaris">: <select name="package">
				{section name=pack loop=$listPackage}
					<option value="{$listPackage[pack].id}">{$listPackage[pack].type}({$listPackage[pack].description})</option>
				{/section}	
			  </select>
		</td>
	  </tr>
	  <tr>
	  	<td></td>
		<td colspan="2" style="headCentre" class="bergaris"><span class="note">*) mandatory fields</span></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td colspan="2" align="center"><input type="submit" name="submit" value="submit"><input type="reset" value="Reset"></td>
	  </tr>
	</table>
	</form>
	{literal}
	<script language="JavaScript" type="text/javascript">
		//You should create the validator only after the definition of the HTML form
		  var frmvalidator  = new Validator("membership");
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
</tr></td>
