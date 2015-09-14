<?php
    /*
     * Used for displaying the image dialog box.
     */
?>
<script>
    function getImageURL($imagename) {
        $("#imageurl").val("/assets/images/userimages/" + $imagename);
        $("#imageurl").focus();
    }
    $("#uploadTarget").load(function() {
        $.ajax({
            type: "POST",
            url: "/newpost/getImageRepositoryImages",
            data: { page: $("#dialog-curpage").val() },
            dataType: "html"
        }).done(function(data){ 
            if (data != null && data.length !== 0) {
                $("#dialogimages").html(data);
            } else {
                $("#dialogimage-lastpage").val("true");
            }
        });
    });
    function nextImagePage() {
        var page = parseInt($("#dialog-curpage").val());
        page += 1;
        $.ajax({
            type: "POST",
            url: "/newpost/getImageRepositoryImages",
            data: { page: page },
            dataType: "html"
        }).done(function(data){ 
            if (data != null && data.length !== 0) {
                $("#dialogimages").html(data);
                $("#dialog-curpage").val(page);
            } else {
                page -= 1;
                $("#dialog-curpage").val(page);
            }
        });
    }
    function previousImagePage() {
        var page = parseInt($("#dialog-curpage").val());
        page -= 1;
        if (page < 1) {
            page = 1;
        }
        $("#dialog-curpage").val(page);
        $.ajax({
            type: "POST",
            url: "/newpost/getImageRepositoryImages",
            data: { page: page },
            dataType: "html"
        }).done(function(data){ 
            if (data != null && data.length !== 0) {
                $("#dialogimages").html(data);
            }
        });
    }
    function parseBoolean(s) {
        if (s === "true") {
            return true;
        }
        if (s === "false") {
            return false;
        }
        return NULL;
    }
</script>
<div>
    <label for="imageurl">Image URL:</label>
    <input type="text" name="imageurl" id="imageurl" onfocus="this.select();" style="margin-top: 8px; width: 260px;"/>
</div>
<div>or</div>
<iframe id="uploadTarget" name="uploadTarget" height="0" width="0" frameborder="0" scrolling="yes"></iframe>
<form action="/newpost/submitimage" method="post" enctype="multipart/form-data"  target="uploadTarget">
    <div>
        <input name="image-file" type="file" value="Upload Image" />
    </div>
    <div>
        <br/>
        <input type="submit" value="Submit File" />
        <!--(note: refreshes page)-->
    </div>
</form>
<hr style="border-color: black;"/>
<div id="dialogimages" style="margin-top: 20px;">
    <table>
        <?php
        foreach($imagerows as $imagerow) {
        ?>
        <tr>
            <?php
            foreach($imagerow as $imagename) {
            ?>
            <td>
                <a href="#">
                    <?php
                    echo "<img src=\"/assets/images/userimages/" . $imagename . 
                            "\" style=\"width: 110px; height: 110px; border: 2px solid #111; border-radius: 5px; "
                            . "box-shadow: 3px 3px 5px #333; margin-top: 10px;\" "
                            . "onclick=\"getImageURL('" . $imagename . "')\" />";
                    ?>
                </a>
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
<div id="dialogimage-nav" style="text-align: center; margin-top: 10px;">
    <a href="javascript:void()" onclick="previousImagePage();"><< Previous</a>
    &nbsp;&nbsp;&nbsp;
    <a href="javascript:void()" onclick="nextImagePage();">Next >></a>
</div>
<input id="dialog-curpage" type="hidden" value="1" />
