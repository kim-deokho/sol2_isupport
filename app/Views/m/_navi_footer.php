<footer>
        <ul class="foot_<?=count($bottom_navi)?>">
<?
        foreach($bottom_navi as $k=>$b_info) {
            $active=false;
            if($b_info['link']==$active_uri) $active=true;

            echo '<li id="'.$k.'" '.($active?'class="active"':'').'><a href="'.$default_uri.'/'.$b_info['link'].'">'.$b_info['label'].'</a></li>';
        }
?>
        </ul> <!-- foot_4 -->
    </footer>