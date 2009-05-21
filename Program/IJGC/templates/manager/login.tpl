<link href="../admin_login.css" type="text/css" rel="stylesheet">
<DIV id=wrapper>
<DIV id=header><DIV id=joomla><IMG alt="Setyoclub Logo" src="../images/logo.gif" height="38" width="270"></DIV></DIV></DIV>
<DIV id=ctr align=center>
<DIV class=login>
<DIV class=login-form><IMG alt=Login src="../images/login.gif"> 
<form method="post" id="loginForm" name="loginForm">
<DIV class=form-block>
{if $pesan}
<DIV class=inputlabel style="color:#FF0000;">{$pesan}<br /><br /></DIV>
{/if}
<DIV class=inputlabel>Username</DIV>
<DIV><input type="text" class="inputbox" name="usn" size="20" maxlength="15" /></DIV>
<DIV class=inputlabel>Password</DIV>
<DIV><input type="password" class="inputbox" name="pwd" size="20" maxlength="15" /></DIV>
<DIV class=inputlabel>Kode</DIV>
<DIV><input type="text" class="inputbox" name="kodever" size="6" maxlength="5" style="width:50px;" />
<img src="./image.php" border="0"/>
</DIV>
<DIV 
align=left><input type="submit" class="button" value="Login" name="smbAdmin" /></DIV></DIV></form></DIV>
<DIV class=login-text>
<DIV class=ctr><IMG height=64 alt=security src="../images/security.png" 
width=64></DIV>
<P>Selamat datang di Halaman management</P>
<P>Gunakan username dan password Anda sesuai dengan ketentuan!.</P></DIV>
<DIV class=clr></DIV></DIV></DIV>
<DIV id=break></DIV><NOSCRIPT>!Warning! Javascript must be enabled for proper 
operation of the Administrator</NOSCRIPT>
<DIV class=footer align=center>
<DIV align=center><A href="#"><b>Main page</b></A> Untuk kembali ke halaman utama. </DIV>
</DIV>