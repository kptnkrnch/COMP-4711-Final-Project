<?php
    /*
     * Used for managing images. Still under contstruction (needs pagination).
     */
?>
<script>
    function UploadImageDialog() {
        $("#imageupload-dialog").show();
        $("#imageupload-dialog").dialog({
            height: 300,
            width: 450
        });
    }
    
    function ImageOptionsDialog($id, $imgname) {
        $("#imageoptions-dialog").show();
        $("#current-image").val($id);
        $("#expanded-image").attr("src", $imgname);
        $("#expanded-image").show();
        $("#imageoptions-dialog").dialog({
            height: 550,
            width: 500,
            modal: true
        });
    }
    
    function DeleteImage() {
        var imgid = $("#current-image").val();
        $.ajax({
            type: "POST",
            url: "/management/deleteImage",
            data: { imageid: imgid }
        }).done(function(data){ 
            location.reload();
        });
    }
    
    function CloseImageOptions() {
        $("#imageoptions-dialog").dialog("close");
    }
</script>

<input type="button" value="Upload Image" onclick="UploadImageDialog()" />
<h4 style="margin-top: 20px;">Images</h4>
<div style="margin-top: 20px;">
    <table>
        <?php
        foreach($imagerows as $imagerow) {
        ?>
        <tr>
            <?php
            foreach($imagerow as $image) {
            ?>
            <td>
                <?php
                    echo "<a href=\"#\" onclick=\"ImageOptionsDialog(" . $image['imageid'] . ", '/assets/images/userimages/" . $image['imagename'] . "')\">"
                        . "<img src=\"/assets/images/userimages/" . $image['imagename'] 
                        . "\" style=\"width: 110px; height: 110px; border: 2px solid #111; border-radius: 5px; "
                        . "box-shadow: 3px 3px 5px #333; margin-top: 10px;\" /></a>";
                ?>
            </td>
            <?php
            }
            ?>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
<div id="imageupload-dialog" title="Upload Image" style="display: none;">
    <form action="/management/submitimage" method="post" enctype="multipart/form-data" >
        <input type="file" name="file" id="file" />
        <input type="submit" name="submit" value="Submit" style="float:right; margin-top: 40%;" />
    </form>
</div>

<div id="imageoptions-dialog" title="Image Options" style="display: none;">
    <img id="expanded-image" src="" style="display: none; width: 500px; height: 400px;" />
    <input type="hidden" id="current-image" />
    <div style="float:right; margin-top: 20px;">
        <input type="button" style="padding: 10px;" value="Delete" id="delete-image" onclick="DeleteImage()"/>
        <input type="button" style="padding: 10px;" value="Cancel" id="close-imageoption-dialog" onclick="CloseImageOptions()"/>
    </div>
</div>
