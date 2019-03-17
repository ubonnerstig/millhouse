<div class="modal fade bd-example-modal-lg" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose and image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <!-- Form for choosing image for blogpost -->
                    <?php if(isset($post_id) && isset($post_slug)){?> 
                        <!-- If you're editing a post this makes sure you return to the correct post id-->
                        <form action="?<?=$post_id;?>=<?=$post_slug;?>" method="post" id="choose_image">
                    <?php }else{?>
                        <form action="?" method="post" id="choose_image">
                    <?php } ?>
                    </form>	
                    <div class="row justify-content-left">	
                        <!--Looping out pictures form database -->	
                        <?php if(count($images) > 1){
                            /*Starting with $i on 1 because index 0 is a fallback picture in case the user removes
                            a picture that belongs to a blogpost, so the removed picture will then be 
                            replaced with the fallback picture. So we dont want the fallback picture to be shown
                            so the user wont accidentally remove it*/
                            for($i=1;$i<count($images);$i++){ ?>										
                                <label class="col-md-3 mr-auto">
                                    <input type="radio" class="choose_image" name="image" value="<?=$images[$i]["image"]?>" form="choose_image">
                                    <div class="image_container">
                                    <?php if(isset($post_id) && isset($post_slug)){?> 
                                        <!-- If you're editing a post this sends the post id with a $_GET so you return to the correct page-->
                                        <a class="close" href="?remove_image=<?=$images[$i]['id'];?>&post_id=<?=$post_id;?>&slug=<?=$post_slug;?>"><i class="far fa-times-circle"></i></a>
                                    <?php }else{?>
                                        <a class="close" href="?remove_image=<?=$images[$i]['id'];?>"><i class="far fa-times-circle"></i></a>
                                    <?php } ?>
                                        <img src="../<?=$images[$i]["image"]?>">
                                    </div>
                                </label>									
                            <?php }
                        }else{ ?>
                            <div class="col-md-3 mr-auto"><p>No images uploaded</p></div>
                        <?php } ?>		
                    </div>	
                </div>	
                <!--Upload new image form -->
                <?php if(isset($post_id) && isset($post_slug)){?> 
                    <!-- If you're editing a post this sends the post id with a $_GET so you return to the correct page-->
                    <form action="?<?=$post_id;?>=<?=$post_slug;?>" method="post" enctype="multipart/form-data" id="upload_image">
                        <?php }else{?>
                            <form action="?" method="post" enctype="multipart/form-data" id="upload_image">
                        <?php } ?>
                    
                        Select image to upload (max 500kB):
                        <?php if(isset($post_id) && isset($post_slug)){?> 
                            <input type="hidden" name="post_id" value="<?= $post_id;?>">
                            <input type="hidden" name="post_slug" value="<?= $post_slug;?>">
                        <?php } ?>
                        <input type="file" name="image" id="image">
                        <button type="submit" class="btn btn-primary" form="upload_image">Upload image</button><br>
                        <br>   
                    </form> 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="choose_image">Choose image</button>
            </div>
        </div>
    </div>
</div>
