<tr><td>
{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if $showList}
	<div align="left"><h3>INBOX</h3></div>
  <form method="post">
		<table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#FBC98E">
			<tr>
				<td>
					<input type="submit" name="delbtn" value="Delete Message"/>
					<input type="submit" name="sendbtn" value="Write Message"/>
				</td>
			</tr>
		</table>
		<br>
	
	  <table border="0" width="100%" class="adminlist" cellspacing="1">
      <tr>
				<th width="5%"></th>
				<th width="40%">From</th>
				<th width="55%" align="left">Subject</th>
      </tr>
			{if $message_list}
      {section name=data loop=$message_list}
      <tr>
				<td valign="middle">
					<input type="checkbox" name="id[]" value="{$message_list[data].message_id}">
				</td>
				<td valign="middle">
					<img src="{$message_list[data].gambar_from}" class="boardimg">&nbsp;<a href="#">{$message_list[data].name_from}</a>
				</td>
				<td valign="middle">
					<div align="left"><a href="{$this_page}?page=message&aksi2=read&id={$message_list[data].message_id}">{$message_list[data].subject}</a></div>
				</td>
      </tr>
      {/section}
			{else}
			<tr>
				<td colspan="3">{$msg}</td>
			</tr>			
			{/if}
    </table>
  </form>	
{/if}

{if $showRead}
  <form method="post">
		<div id="bdr">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="1%"></td>
				<td width="20%">From</td>
				<td width="1%">:</td>
				<td width="78%">{$from}</td>
			</tr>
			<tr>
				<td></td>
				<td>Date</td>
				<td>:</td>
				<td>{$date}</td>
			</tr>			
			<tr>
				<td></td>
				<td>Subject</td>
				<td>:</td>
				<td>{$subject}</td>
			</tr>			
			<tr>
				<td></td>
				<td>Message</td>
				<td>:</td>
				<td>{$message}</td>
			</tr>			
			<tr>	
				<td></td>
				<td colspan="3">&nbsp;
				</td>
			</tr>			
			<tr>	
				<td></td>
				<td colspan="3">
					<input type="hidden" name="msg_id" value="{$msg_id}">
					<input type="submit" name="replybtn" value="Reply Message">
					<input type="submit" name="cancelbtn" value="Cancel & Back to Inbox">
				</td>
			</tr>					
		</table>	
		</div>		
  </form>	
{/if}

{if $showCompose}
  <form method="post">
		<div id="bdr">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="1%"></td>
				<td width="15%">To</td>
				<td width="1%">:</td>
				<td width="83%"><input type="text" name="id_to" value="{$send_to}" size="50"></td>
			</tr>
			<tr>
				<td></td>
				<td>Subject</td>
				<td>:</td>
				<td><input type="text" name="subject" value="{$rep_subject}" size="50"></td>
			</tr>			
			<tr>
				<td></td>
				<td>Message</td>
				<td>:</td>
				<td><textarea name="message" cols="50" rows="10">{$rep_message}</textarea></td>
			</tr>		
			<tr>	
				<td></td>
				<td colspan="3">
					<input type="submit" name="sendbtn" value="Send Message">
					<input type="submit" name="cancelbtn" value="Cancel & Back to Inbox">
				</td>
			</tr>
		</table>	
		</div>		
  </form>	
{/if}
</td></tr>