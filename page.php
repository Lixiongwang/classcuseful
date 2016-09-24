<?php   
	$perpagenum = 10;//定义每页显示几条   
	$total = mysql_fetch_array(mysql_query("select count(*) from a"));//查询数据库中一共有多少条数据   
	$Total = $total[0];                          //   
	$Totalpage = ceil($Total/$perpagenum);//上舍，取整   
	if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$Totalpage)//page可能的四种状态   
	{   
		$page=1;   
	}   
	else   
	{   
		$page=$_GET['page'];//如果不满足以上四种情况，则page的值为$_GET['page']   
	}   
	$startnum     = ($page-1)*$perpagenum;//开始条数   
	$sql = "select * from a order by id limit $startnum,$perpagenum";//查询出所需要的条数   
	echo $sql."   
	";   
	$rs = mysql_query($sql);   
	$contents = mysql_fetch_array($rs);   
	if($total)如果$total不为空则执行以下语句	
	{   
    do   
    {   
    $id = $contents['id'];   
    $name = $contents['name'];   
    ?>   
    <table border="0" align="center">   
    <tr>   
    <td>id:   
    <?php echo $id;?>   
    </td>   
    </tr>   
    <tr>   
    <td>name:   
    <?php echo $name;?>   
    </td>   
    </tr>   
    </table>   
    <?php   
    }   
	while($contents = mysql_fetch_array($rs));//do....while   
	$per = $page - 1;//上一页   
	$next = $page + 1;//下一页   
	echo "<center>共有".$Total."条记录,每页".$perpagenum."条,共".$Totalpage."页 ";   
	if($page != 1)   
	{   
	echo "<a href='".$_SERVER['PHP_SELF']."'>首页</a>";   
	echo "<a href='".$_SERVER['PHP_SELF'].'?page='.$per."'> 上一页</a>";   
	}   
	if($page != $Totalpage)   
	{   
	echo "<a href='".$_SERVER['PHP_SELF'].'?page='.$next."'> 下一页</a>";   
	echo "<a href='".$_SERVER['PHP_SELF'].'?page='.$Totalpage."'> 尾页</a></center>";   
	}   
	}   
	else如果$total为空则输出No message   
	{   
	echo "<center>No message</center>";   
	}   
?>