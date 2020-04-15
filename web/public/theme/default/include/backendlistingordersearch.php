<div class="row searchbar">
      <div class="col-md-2 col-sm-12 col-xs-12"><input type="text" value="<?php echo $searchtext;?>" style="padding:11px 10px;" name="searchtext" id="search_text" class="form-control  w-100 mb-10" placeholder="Search By Title..." autocomplete="off" onkeyup="searchFilter(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>')" /><br /></div>
      <div class="col-md-2 col-sm-12 col-xs-12"><a href="<?php echo $reset_url;?>" class="btn btn-info">Reset</a><br /><br /></div>
      <div class="col-md-2 col-sm-12 col-xs-12">
          <select name="selectbox" id="sortBy" class="form-control" onchange="sortdata(this.value);">
              <option value="">Select Sort</option>
                <?php if(isset($sort_array) && !empty($sort_array)):?>
                    <?php foreach($sort_array as $key => $value):?>
                        <option value="<?php echo $key;?>" <?php if($sortbytext == $key){echo 'selected="selected"';}?>><?php echo $value;?></option>
                    <?php endforeach;?>
                <?php endif;?>
          </select>
      </div>
      
      <div class="col-md-2  col-sm-12 col-xs-12">
        <?php if(isset($backend_allow_action_dropdown) && $backend_allow_action_dropdown == 'Y'):?>
          <select name="selectbox" id="actionbox" class="form-control">
              <option value="">Select Action</option>
              <option value="Pending">Pending</option>
              <option value="Payment Pending">Payment Pending</option>
              <option value="Payment Pending">Payment Paid</option>
              <option value="Processing">Processing</option>
              <option value="Delivered">Delivered</option>
              <option value="Cancelled">Cancelled</option>
          </select>
        <?php endif;?>
      </div>
    

      <div class="col-md-2 col-sm-12 col-xs-12">
        <?php if(isset($backend_allow_apply_button) && $backend_allow_apply_button == 'Y'):?>
            <input type="button" name="action" class="btn btn-success" value="Apply" onclick="showSwal('confirm-delete')" /><br /><br />
        <?php endif;?>
      </div>
      <input type="hidden" id="sort_type" value="<?php echo $sort_type;?>" />
      <input type="hidden" id="sort_by" value="<?php echo $sort_by;?>" />
      <input type="hidden" id="records_per_page" value="<?php echo $records_per_page;?>" />
  </div>
  
  <script type="text/javascript">
    function sortdata(value) {
        var lastThree = value.substr(value.length - 3);
        let sorttype = 'desc';
        if(lastThree == 'asc'){
            sorttype = 'asc';
        }
        document.getElementById('sort_type').value = sorttype;
        document.getElementById('sort_by').value = value;
        searchFilter(1,'<?php echo $page_url;?>','<?php echo $item_alias;?>');
    }
  </script>