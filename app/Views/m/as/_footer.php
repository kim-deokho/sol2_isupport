    <footer>
        <ul class="foot_4">
<?
        foreach($bottom_navi as $k=>$t) {
            $active=false;
            if($k==$active_uri) $active=true;

            echo '<li id="'.$k.'" '.($active?'class="active"':'').'><a href="'.$default_uri.'/'.$k.'">'.$t.'</a></li>';
        }
?>
        </ul> <!-- foot_4 -->
    </footer>