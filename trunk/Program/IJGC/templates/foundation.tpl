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
			<td width="150" align="left"><a href="{$link}" target="_blank"><img src="{$image}" width="100" height="100" class="boardimg" border="0"></a></td>
			<td align="left" width="100%">
				<p>{$kategori}</p>
				<p>{$isi}</p>
			</td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {else}
 {section name=found loop=$listFoundation}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100" align="left"><a href="{$listFoundation[found].link}"><img src="{$listFoundation[found].image}" width="75" height="75" class="boardimg" border="0"></a></td>
    <td width="100%">
		<table width="100%">
			<tr>
				<td align="left">
					{$listFoundation[found].kategori}{$listFoundation[found].isi}
				</td>
			</tr>
			<tr>
				<td><a href="./index.php?page=found&id={$listFoundation[found].id}"><img src="./images/more.png" align="right" border="0"></a></td>
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
    <td colspan="2" align="right" class="paging">{$paging}</td>
    <td width="5"></td>
  </tr>
 {/if}