<?php
    /*
     * Used for settign tags for a post.
     */
?>
<script>
    $(document).ready(function() {
        if ($('#mbti-dialogtag').is(':checked')) {
            $("#txt-mbtitag").val(1);
        }
        if ($('#big5-dialogtag').is(':checked')) {
            $("#txt-big5tag").val(1);
        }
        if ($('#enneagram-dialogtag').is(':checked')) {
            $("#txt-enneagramtag").val(1);
        }
        if ($('#socionics-dialogtag').is(':checked')) {
            $("#txt-socionicstag").val(1);
        }
        if ($('#cogfunc-dialogtag').is(':checked')) {
            $("#txt-cogfunctag").val(1);
        }
        if ($('#character-dialogtag').is(':checked')) {
            $("#txt-charactertag").val(1);
        }
        $("#mbti-dialogtag").click(function() {
            if ($('#mbti-dialogtag').is(':checked')) {
                $("#txt-mbtitag").val(1);
            } else {
                $("#txt-mbtitag").val(0);
            }
        });
        $("#big5-dialogtag").click(function() {
            if ($('#big5-dialogtag').is(':checked')) {
                $("#txt-big5tag").val(1);
            } else {
                $("#txt-big5tag").val(0);
            }
        });
        $("#enneagram-dialogtag").click(function() {
            if ($('#enneagram-dialogtag').is(':checked')) {
                $("#txt-enneagramtag").val(1);
            } else {
                $("#txt-enneagramtag").val(0);
            }
        });
        $("#socionics-dialogtag").click(function() {
            if ($('#socionics-dialogtag').is(':checked')) {
                $("#txt-socionicstag").val(1);
            } else {
                $("#txt-socionicstag").val(0);
            }
        });
        $("#cogfunc-dialogtag").click(function() {
            if ($('#cogfunc-dialogtag').is(':checked')) {
                $("#txt-cogfunctag").val(1);
            } else {
                $("#txt-cogfunctag").val(0);
            }
        });
        $("#character-dialogtag").click(function() {
            if ($('#character-dialogtag').is(':checked')) {
                $("#txt-charactertag").val(1);
            } else {
                $("#txt-charactertag").val(0);
            }
        });
    });
</script>

<table>
    <tr>
        <th>Tags:</th>
    </tr>
    <tr>
        <td>
            <?php 
                if ($mbti == 1) {
            ?>
                    <input type="checkbox" id="mbti-dialogtag" name="mbti-dialogtag" checked="checked"/>
                    <label for="mbti-dialogtag">MBTI</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="mbti-dialogtag" name="mbti-dialogtag"/>
                    <label for="mbti-dialogtag">MBTI</label>
            <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if ($big5 == 1) {
            ?>
                    <input type="checkbox" id="big5-dialogtag" name="big5-dialogtag" checked="checked"/>
                    <label for="big5-dialogtag">Big 5</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="big5-dialogtag" name="big5-dialogtag"/>
                    <label for="big5-dialogtag">Big 5</label>
            <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if ($enneagram == 1) {
            ?>
                    <input type="checkbox" id="enneagram-dialogtag" name="enneagram-dialogtag" checked="checked"/>
                    <label for="enneagram-dialogtag">Enneagram</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="enneagram-dialogtag" name="enneagram-dialogtag"/>
                    <label for="enneagram-dialogtag">Enneagram</label>
            <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if ($socionics == 1) {
            ?>
                    <input type="checkbox" id="socionics-dialogtag" name="socionics-dialogtag" checked="checked"/>
                    <label for="socionics-dialogtag">Socionics</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="socionics-dialogtag" name="socionics-dialogtag"/>
                    <label for="socionics-dialogtag">Socionics</label>
            <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if ($cogfunc == 1) {
            ?>
                    <input type="checkbox" id="cogfunc-dialogtag" name="cogfunc-dialogtag" checked="checked"/>
                    <label for="cogfunc-dialogtag">Cognitive Functions</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="cogfunc-dialogtag" name="cogfunc-dialogtag"/>
                    <label for="cogfunc-dialogtag">Cognitive Functions</label>
            <?php
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php 
                if ($character == 1) {
            ?>
                    <input type="checkbox" id="character-dialogtag" name="character-dialogtag" checked="checked"/>
                    <label for="character-dialogtag">Character Analysis</label>
            <?php
                } else {
            ?>
                    <input type="checkbox" id="character-dialogtag" name="character-dialogtag"/>
                    <label for="character-dialogtag">Character Analysis</label>
            <?php
                }
            ?>
        </td>
    </tr>
</table>