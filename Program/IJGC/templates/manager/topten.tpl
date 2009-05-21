{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if $showList}
<div id="bdr">
  <form method="post">
		<br>
	{if $courselist}
    <table class="adminlist" border="1" width="55%">
      <tr>
				<th width="20%">LOGO</th>
				<th width="80%">COURSE</th>
      </tr>
      {section name=course loop=$courselist}
      <tr>
				<td valign="top"><img src="../images/upload/noPict.gif" /></td>
				<td valign="top">
					<div align="left"><h3>{$courselist[course].pos}.<a href="#">{$courselist[course].member_name}</a></h3></div>
					<div align="left">{$courselist[course].member_id}</div>
					<div align="left">Reward Earned: {$courselist[course].reward_earned}</div>
					<div align="left">Ranking Point: {$courselist[course].ranking_point}</div>
					<div align="left">Trial Point: {$courselist[course].trial_point}</div>				
				</td>
      </tr>
      {/section}
    </table>
  {else}
		<table border="0">
			<tr>
				<td>{$course_msg}</td>
			</tr>
		</table>
  {/if}
  </form>	
</div>	
{/if}

