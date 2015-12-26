<?php
    function invokeMainPanel($file = null) {
       showMainPanelHeader();
        if(isset($file)) include($file);
        showMainPanelFooter();
    }
    function showMainPanelHeader() {
        echo "
                <link rel='stylesheet' href='views/css/main-panel.css'>
                <div class='panel-card'>
             ";
    }
    function showMainPanelFooter() {
        echo "</div>";
    }

