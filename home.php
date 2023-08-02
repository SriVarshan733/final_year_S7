<?php 
include 'admin/db_connect.php'; 
?>
<style>
    #cat-list li{
        cursor: pointer;
    }
       #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }
    .prod-item p{
        margin: unset;
    }
    .bid-tag {
    position: absolute;
    right: .5em;
}
</style>
<?php 
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<div class="contain-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3">
            <div class="card-header"><b><h3>Categories</h3></b></div>
                <div class="card">
                    <div class="card-body">
                        <ul class='list-group' id='cat-list'>
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM categories ORDER BY name ASC");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                                    $cat_arr[$row['id']] = $row['name'];
                             ?>
                            <li class='list-group-item' data-id='<?php echo $row['id'] ?>' data-href="index.php?page=home&category_id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php
                                $where = "";
                                if($cid > 0){
                                    $where  = " AND category_id = ?";
                                }
                                $stmt = $conn->prepare("SELECT * FROM products WHERE unix_timestamp(bid_end_datetime) >= ? $where ORDER BY name ASC");
                                $current_time = strtotime(date("Y-m-d H:i"));
                                if($cid > 0) {
                                    $stmt->bind_param("ii", $current_time, $cid);
                                } else {
                                    $stmt->bind_param("i", $current_time);
                                }
                                
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if($result->num_rows <= 0){
                                    echo "<center><h4><i>No Available Product.</i></h4></center>";
                                } 
                                while($row = $result->fetch_assoc()):
                             ?>
                             <div class="col-sm-4">
                                 <div class="card" style="height: 9.8cm; width: 3.9cm;">
                                    <div class="float-right align-top bid-tag">
                                         <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($row['start_bid']) ?></span>
                                     </div>
                                     <img class="card-img-top" src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" alt="Card image cap">
                                      <div class="float-right align-top d-flex">
                                         <span style="width: 3.9cm;" class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></span>
                                     </div>
                                     <div class="card-body prod-item">
                                         <p><?php echo $row['name'] ?></p>
                                         <p><small><?php echo $cat_arr[$row['category_id']] ?></small></p>
                                         <p class="truncate"><?php echo $row['description'] ?></p>
                                        <button class="btn btn-primary btn-sm view_prod" type="button" data-id="<?php echo $row['id'] ?>"> View</button>
                                     </div>
                                 </div>
                             </div>
                            <?php endwhile; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
<script>
    $('#cat-list li').click(function(){
        location.href = $(this).attr('data-href')
    })
     $('#cat-list li').each(function(){
        var id = '<?php echo $cid > 0 ? $cid : 'all' ?>';
        if(id == $(this).attr('data-id')){
            $(this).addClass('active')
        }
    })
     $('.view_prod').click(function(){
        uni_modal_right('View Product','view_prod.php?id='+$(this).attr('data-id'))
     })
</script>
