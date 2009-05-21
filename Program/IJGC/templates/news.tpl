  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2"><img src="{$icon}" border=0></td>
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
			<td width="100%" align="left" colspan="2">
				<img src="{$image}" width="150" class="boardimg" class="boardimg" align="left">
				<span class="judul">{$judul}</span><br><i class="time">{$tanggal}</i></br>
				<span class="tulisan">{$isi}</span>
			</td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {else}
 {section name=news loop=$listNews}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="75" align="left" valign="top"><img src="{$listNews[news].image}" width="75" height="75" class="boardimg" border="0"></td>
    <td>
		<table width="100%">
			<tr>
				<td align="left">
					<span class="judul">{$listNews[news].judul}</span><br><i class="time">{$listNews[news].tanggal}</i></br>
					<span class="tulisan">{$listNews[news].isi}</span>
				</td>
			</tr>
			<tr>
				<td><a href="?page=news&tipeP={$tipe}&id={$listNews[news].id}"><img src="./images/more.png" align="right" border="0"></a></td>
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