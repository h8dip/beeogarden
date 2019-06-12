<div class="row">
                            <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                            <?php 
                            if($current_page==1){
                                $minimum = 1;
                            }else {
                                $minimum = ($current_page-1) * $items_per_page;
                            }
                            
                            if(($minimum + ($items_per_page-1)) > $count){
                                $maximum = $count;
                            }else{
                                $maximum = $minimum + $items_per_page-1;
                            }
                            echo 'Showing ' . $minimum .' to ' . $maximum . ' of ' . $count . ' entries';
                            ?>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                            <?php if($current_page != $start_page){?>
                            <li class="paginate_button page-item">
                            <a href="?page=<?php echo $start_page?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">First</a>
                            </li>
                            <?php  } ?>
                            <?php if($current_page != $end_page){?>
                            <li class="paginate_button page-item">
                            <a href="?page=<?php echo $end_page?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">Last</a>
                            </li>
                            <?php  } ?>
                            <?php if($current_page >= 2){?>
                            <li class="paginate_button page-item">
                            <a href="?page=<?php echo $previous_page?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $previous_page?></a>
                            </li>
                            <?php  } ?>
                            <li class="paginate_button page-item ">
                            <a href="?page=<?php echo $current_page?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $current_page?></a>
                            </li>
                            <?php if($current_page != $end_page){?>
                            <li class="paginate_button page-item next" id="dataTable_next">
                            <a href="?page=<?php echo $next_page ?>" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link"><?php echo $next_page ?></a></li>
                            <?php  } ?>
                            </ul>
                            </div>
                            </div>
                            </div>
                            </div>