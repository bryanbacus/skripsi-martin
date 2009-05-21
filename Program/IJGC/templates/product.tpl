  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2"><img src="./images/{$icon}" border=0></td>
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
			<td width="150" align="left" valign="top"><a href="{$link}" target="_blank"><img src="{$image}" width="150" height="150" class="boardimg" border="0"></a></td>
			<td align="left"><p>{$isi}</p></td>
		</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
 {else}
 {section name=product loop=$listProduct}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100" align="left" valign="top"><a href="{$listProduct[product].link}" target="_blank"><img src="{$listProduct[product].image}" width="75" height="75" class="boardimg" border="0"></a></td>
    <td width="100%" align="left" valign="top">
		<table width="100%">
			<tr>
				<td align="left"><p>{$listProduct[product].isi}</p></td>
			</tr>
			<tr>
				<td><a href="?page=product&tipeP={$tipe}&id={$listProduct[product].id}"><img src="./images/more.png" align="right" border="0"></a></td>
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