<?php
    /*
     * Used for updating the image section of the image dialog box
     */
?>
<table>
    <?php
    if ($imagerows != NULL) {
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
    }
    ?>
</table>

