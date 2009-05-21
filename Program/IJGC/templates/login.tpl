	<tr>
        <td width="100%" height="173" valign="middle">
		<form name="Login" action="./index.php" method="post">
         <table border="0" cellspacing="1" style="border-collapse: collapse" width="101%" id="AutoNumber23">
            <tr>
              <td align="right">
              <img border="0" src="images/mLogin.gif" width="82" height="13"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="bottom">
              <font face="Verdana" size="1" color="#FFFFFF">username</font></td>
              <td align="left" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana" size="1" color="#FFFFFF">
              <input type="text" name="usn" size="14"></font></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="bottom">
              <font face="Verdana" size="1" color="#FFFFFF">password</font></td>
              <td align="left" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana" size="1" color="#FFFFFF">
              <input type="password" name="pass" size="14"></font></td>
              <td>
              <input type="image" src="images/sign.gif" name="Submit" border="0" value="submit">
			  </td>
            </tr>
			{if $pesan}
            <tr>
              <td align="centre" colspan="2">
			  	{$pesan}
			  </td>
            </tr>
		    {/if}
		  </table>
			</form>
		</td>
    </tr>