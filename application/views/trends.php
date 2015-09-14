<?php
    /*
     * Trends View
     */
?>
<div id="topic">
    XML Trends - Energy
</div>
<div id="topicdata">
    <div class="data">
        <div class="section">
            <div class="xmlpanel" style="width: 600px;">
                {myxml} <? /*Placeholder for the XML data.*/ ?>
            </div>
            <div style="width: 600px;">
                source: http://www.statcan.gc.ca/tables-tableaux/sum-som/l01/cst01/prim71-eng.htm
            </div>
            <div style="width: 600px;">
                {validatedxml} <?/* dtd validate xml results */?>
            </div>
            
            <a href="/trends/xsl">Go to trends XSL</a>
            
            <div style="width: 600px;">
                {xmltable} <?/* dtd validate xml results */?>
            </div>

        </div>
    </div>
</div>