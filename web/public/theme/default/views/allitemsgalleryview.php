<?php if($page_data['custom_view'] == 'gallery'):
    $edit_id = 0;
    if($id > 0) {
        $edit_id = $id;
    }
    ?>
<?php
if(isset($arrOnedataGallery) && count($arrOnedataGallery) > 0):
    ?><br /><div id="lightgallery" class="row lightGallery"><?php
    foreach($arrOnedataGallery as $gallery):
        ?>        
            <a class="image-tile" target="_blank" href="<?php echo ITEMS_URL;?><?php echo $gallery['meta_value'];?>" title="<?php echo $arrOnedata['item_title'];?>"><img src="<?php echo ITEMS_URL;?><?php echo $gallery['meta_value'];?>" alt="image small"></a>
            <span onclick="fnDeleteClick('<?php echo $gallery['item_meta_id'];?>','<?php echo $gallery['meta_value'];?>')"><i class="mdi mdi-delete"></i></span>
            <?php /*?><a class="image-tile" target="_blank" href="<?php echo ITEMS_URL;?><?php echo $gallery['meta_value'];?>" title="<?php echo $arrOnedata['item_title'];?>">View Gallery</a><?php */?>
        <?php
    endforeach;
    ?></div><br /><?php
endif;
?>
<div class="row">
    <div class="col-md-3">
        <input type="file" name="meta_name[]" />
    </div>
    <div class="col-md-3">
        <input type="file" name="meta_name[]" />
    </div>
    <div class="col-md-3">
        <input type="file" name="meta_name[]" />
    </div>
    <div class="col-md-3">
        <input type="file" name="meta_name[]" />
    </div>
</div>
<?php endif;?>
<br />
<script type="text/javascript">
function fnDeleteClick(id,image_name) {
    reload_url = '<?php echo $url;?>allgalleries/form/?id=<?php echo $edit_id;?>';
    var url = '<?php echo $url;?>allgalleries/deleteMeta/?id='+id+'&image='+image_name;
    $.ajax({
        type: 'POST',
        url: url,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (response) {
            showSwal('success');
            setTimeout(function(){ window.location.href = reload_url; }, 1000);
        }
    });
}
</script>