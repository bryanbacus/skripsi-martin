  <tr>
    <td width="5" colspan="3"><img src="{$jdlImages}"></td>
  </tr>
 {if !$tampil}
 {if $pesan}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100">
		<table>
		<tr>
			<td width="150" align="left" colspan="2"><p class="pesan"></pesan></td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {/if}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%">
		<table>
		<tr>
			<td width="150" align="left" valign="top"><img src="{$image}" width="150" height="150" class="boardimg"></td>
			<td align="left"><span class="judul">{$name}</span><p>{$deskripsi}</p></td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {else}
 {section name=board loop=$listBoard}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100" align="left" valign="top"><img src="{$listBoard[board].image}" width="75" height="75" class="boardimg"></td>
    <td align="left" width="100%" valign="top">
		<table width="100%">
			<tr>
				<td align="left"><span class="judul">{$listBoard[board].nama}</span><br>{$listBoard[board].deskripsi}</td>
			</tr>
			<tr>
				<td><a href="?page=board&tipeP={$tipe}&id={$listBoard[board].id}"><img src="./images/more.png" align="right" border="0"></a></td>
			</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
  <tr>
  	<td height="5"></td>
	<td class="grsBwh" colspan="2"><td>
	<td></td>
  </tr> 
{/section}  
  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2" align="right" class="paging">{$paging}</td>
    <td width="5"></td>
  </tr>
 {/if}