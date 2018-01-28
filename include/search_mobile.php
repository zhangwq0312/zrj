            <div>
                <?php if($locate=="education"||$locate=="marriage"||$locate=="house"||$locate=="employ"||$locate=="company"||$locate=="tel"){?>
                <?php 
                $search_msg="";
                if($locate=="house"){
                    $search_msg="住房";
                }else if($locate=="employ"){
                    $search_msg="招聘";
                }else if($locate=="marriage"){
                    $search_msg="婚恋";
                }else if($locate=="tel"){
                    $search_msg="便民电话";
                }else if($locate=="education"){
                    $search_msg="教育";
                }else if($locate=="company"){
                    $search_msg="商家";
                }else if($locate=="shop"){
                    $search_msg="网上超市";
                }
                
                ?>
                <div class="form-group" >	
                    <div class="input-group">
                        <?php $key = empty($_REQUEST['key'])?'':$_REQUEST['key'];?>
                        <input id="search_input" name="search_input" type="text" class="form-control" style="width:250px" placeholder="输入<?php echo $search_msg;?>关键词"  value="<?php if(!empty($key)){echo $key;} ?>"/>
                        <div class="input-group-btn">
                            <button id="search_button" class="btn btn-block"><span class="glyphicon glyphicon-search" style="color:#3d5c99"></span></button>
                        </div>
                    </div>	
                </div>
                <?php } ?>

            </div>