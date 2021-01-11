<nav>
	<div class="left_nav">
		<ul>
<?
            $activeMenu=array();
            foreach($setting['menu'][$active_id]['sub'] as $l_menu) {
                $lmenu_uri=gethostUri($l_menu['menu_url']);
                $active='';
                if(implode('', $setting['HostUri'])==implode('', $lmenu_uri)) {
                    $activeMenu=$l_menu;
                    $active=true;
                    $snm=$l_menu['menu_name'];
                }
                echo '<li '.($active?'class="set_bg"':'').'>';
                echo '    <a href="'.$l_menu['menu_url'].'">'.$l_menu['menu_name'].'</a>';
                echo '    <span><a href="'.$l_menu['menu_url'].'" target="_blank"><img src="'.IMG_DIR.'/w_icon.png" alt="새창" /></a></span>';
                echo '</li>';

            }
?>
		</ul>
	</div> <!-- left_nav -->
</nav>
<script>
    jsConfig.url_path.fnm="<?=$fnm?>";
    jsConfig.url_path.snm="<?=$snm?>";
    jsConfig.pagePermition=<?=json_encode($activeMenu)?>;
</script>