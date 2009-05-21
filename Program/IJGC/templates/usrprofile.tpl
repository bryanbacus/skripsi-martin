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
 {/if}
 {if !$tampil}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%">
		<table>
		<tr>
			<td width="100" align="left" valign="top">
				<img src="{$listDetail.image}" width="100" height="100" class="boardimg" align="left">
			</td>
			<td width="100%">	
				<table class="adminlist">
					<tr><td colspan="3"><span class="judul">{$listDetail.id}</span><br></br></td></tr>
					<tr><td><b>Nama</b></td><td>:</td><td><span class="tulisan">{$listDetail.name}</span><br></td></tr>
					<tr><td><b>Tempat, Tgl lahir</b></td><td>:</td><td><span class="tulisan">{$listDetail.tmpLahir}, {$listDetail.waktu}</span><br></td></tr>
					<tr><td><strong>Alamat</strong></td>
					<td>:</td><td><span class="tulisan">{$listDetail.alamat}</span><br></td></tr>
					<tr><td><strong>Negara</strong></td>
					<td>:</td><td><span class="tulisan">{$negara}</span><br></td></tr>
					<tr><td><strong>Hobby</strong></td>
					<td>:</td><td><span class="tulisan">{$listDetail.hobby}</span><br></td></tr>
					<tr><td><strong>Orang tua</strong></td>
					<td>:</td><td><span class="tulisan">{$listDetail.ortu}</span><br></td></tr>
					<tr><td><strong>Handicap</strong></td>
					<td>:</td><td><span class="tulisan">{$listDetail.handicap}</span><br></td></tr>
					<tr><td><strong>Golf Club</strong></td>
					<td>:</td><td><span class="tulisan">{$listDetail.golfClub}</span><br></td></tr>
					<tr><td><strong>Group Mmbership</strong></td>
					<td>:</td><td><span class="tulisan">{$group}</span></td></tr>
				</table>	
			</td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {else}
 {section name=usr loop=$listUsr}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="75" align="left" valign="top"><img src="{$listUsr[usr].gambar}" width="75" height="75" class="boardimg" border="0"></td>
    <td width="100%">
		<table width="100%">
			<tr>
				<td align="left">
					<span class="judul">{$listUsr[usr].id}</span><br></br>
					<span class="tulisan">{$listUsr[usr].name}</span><br>
					<span class="tulisan">{$listUsr[usr].ortu}</span><br>
				</td>
			</tr>
			<tr>
				<td><a href="?page=listm&id={$listUsr[usr].id}"><img src="./images/more.png" align="right" border="0"></a></td>
			</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
  <tr>
  	<td height="5px"></td>
	<td class="grsBwh" colspan="2"><td>
	<td></td>
  </tr> 
{/section}  
  <tr>
    <td width="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="5"></td>
  </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2" align="right" class="page">{$paging}</td>
    <td width="5"></td>
  </tr>
 {/if}