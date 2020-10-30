<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/User.php"; 
	
	$usr = new User();
	$fm = new Format();
?>
<?php 
    if(isset($_GET['seenId'])){
        $seenId = $_GET['seenId'];
        $movetoSeenBox = $usr->movetoSeenBox($seenId);
    }
?>
<?php 
	if(isset($_GET['delmsgid'])){
		$delMsgId = $_GET['delmsgid'];
		$deleteMsg = $usr->deleteMessage($delMsgId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">  
                <?php 
                    if(isset($movetoSeenBox)){
                        echo $movetoSeenBox;
                    }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>NO</th>
							<th>Date</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Subject</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getContractMsg = $usr->getContractMsg();
						if($getContractMsg){
                            $i=0;
							while($result = $getContractMsg->fetch_assoc()){
                                $i++;
                            ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $result['mobile']; ?></td>
							<td><?php echo $fm->textshorten($result['subject'],20); ?></td>
							<td>
                                <a href="viewcontractmsg.php?msgid=<?php echo $result['id']; ?>">view</a> ||
                                <a href="?seenId=<?php echo $result['id']; ?>">seen</a> ||
                                <a href="replymessage.php?replyId=<?php echo $result['id']; ?>">reply</a>
							</td>
							
						</tr>
					<?php  } }?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Seen Box</h2>
                <div class="block"> 
				<?php 
					if(isset($deleteMsg)){
						echo $deleteMsg;
					}
				?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>NO</th>
							<th>Date</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Subject</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getContractseenMsg = $usr->getContractseenMsg();
						if($getContractseenMsg){
                            $i=0;
							while($result = $getContractseenMsg->fetch_assoc()){
                                $i++;
                            ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo$result['mobile']; ?></td>
							<td><?php echo $fm->textshorten($result['subject'],20); ?></td>
							<td>
                                <a href="replymessage.php?replyId=<?php echo $result['id']; ?>">reply</a> ||
                                <a onclick="return confirm('Are you sure to delete?')" href="?delmsgid=<?php echo $result['id']; ?>">Delete</a>
							</td>
							
						</tr>
					<?php  } }?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
