<?php
include FCPATH . '/Menu.php';
?>
<!-- Navigation-->
<style>
    #result {
        position: absolute;
        width: 100%;
        max-height: 200px;
        /*overflow: auto;*/
        margin-top: 2px;
    }

    .bg_black {
        background: lightblue;
    }

    #result li a {
        width: 100%;
        display: block;
    }

    #exampleAccordion {
        overflow-y: auto;
    }

    #tips {
        position: absolute;
        left: 250px;
        color: #ffbf00;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Stocks / Sixer - Saga</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="overflow: auto;">
            <?php
            // $this->session->get_userdata()['access_pages']
            $accessPage = [];
            $fileName = FCPATH . "Access.json";
            if (file_exists($fileName)) {
                $accessJSON = json_decode(file_get_contents($fileName), true);
                if (isset($accessJSON[$this->session->get_userdata()['admin_type']]))
                    $accessPage = $accessJSON[$this->session->get_userdata()['admin_type']];
            }
            foreach ($menu as $key => $nav) {

                if (@$nav['show'] == false)
                    continue;

                if (CURRENCY_TYPE == "REAL_MONEY") {
                    
                    if (@$nav['real_cash'] == false)
                        continue;
                }

                if (CURRENCY_TYPE == "FREE_COIN") {
                    if (@$nav['free_coin'] == false)
                        continue;
                }

                $showMenu = false;
                if (isset($nav['subMenu']))
                    foreach ($nav['subMenu'] as $subItem) {
                        if (in_array($subItem['link'], $accessPage) || $this->session->get_userdata()['admin_type'] == 0) {
                            $showMenu = true;
                        }
                    }
                else {
                    if (in_array($nav['link'], $accessPage) || $this->session->get_userdata()['admin_type'] == 0) {
                        $showMenu = true;
                    }
                }
                if (!$showMenu) {
                    continue;
                }
                if (!isset($nav['subMenu'])) {
            ?>
                    <li class="nav-item  <?= ($nav['link'] == $this->uri->uri_string ? "active" : ""); ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link py-2" href="<?php echo base_url($nav['link']); ?>">
                            <!-- <i class="fa fa-fw fa-dashboard"></i> -->
                            <img src="<?= base_url() . $nav['icon']; ?>" width="20" />
                            <span class="nav-link-text"><?= $nav['label']; ?></span>
                        </a>
                    </li>
                <?php
                } else {
                    $pages = array_column($nav['subMenu'], "link");
                    $class = "collapsed";
                    $class1 = "";
                    if (in_array($this->uri->uri_string, $pages)) {
                        $class = "";
                        $class1 = "show";
                    }
                ?>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right">
                        <a class="nav-link py-2 nav-link-collapse <?= $class; ?>" data-toggle="collapse" href="#collapse<?= $key; ?>">
                            <!-- <i class="fa fa-fw fa-newspaper-o"></i> -->
                            <img src="<?= base_url() . $nav['icon']; ?>" width="20" />
                            <span class="nav-link-text"><?= $nav['label']; ?></span>
                        </a>
                        <ul class="sidenav-second-level collapse <?= $class1; ?>" id="collapse<?= $key; ?>">
                            <?php
                            foreach ($nav['subMenu'] as $subItem) {
                                if ($subItem['show'] == false)
                                    continue;

                                if (CURRENCY_TYPE == "REAL_MONEY") {
                                    if (@$subItem['real_cash'] == false)
                                        continue;
                                }

                                if (CURRENCY_TYPE == "FREE_COIN") {
                                    if (@$subItem['free_coin'] == false)
                                        continue;
                                }

                                if (!in_array($subItem['link'], $accessPage) && $this->session->get_userdata()['admin_type'] != 0) {
                                    continue;
                                }
                            ?>
                                <li class="nav-item <?= ($subItem['link'] == $this->uri->uri_string ? "active" : ""); ?>" data-toggle="tooltip" data-placement="right">
                                    <a class="nav-link  py-1" href="<?php echo base_url($subItem['link']); ?>">
                                        <span class="nav-link-text"><?= ucwords(strtolower($subItem['label'])); ?></span>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>

            <?php
                }
            }
            ?>


        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="nav-link" id="tips">
                    * Press 'Ctrl+Shift+F' for search in menu
                </span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('login/changePasswordView') ?>" data-toggle="tooltip" data-placement="top" data-html="true" title="Change Password Click Here">
                    <i class="fa fa-fw fa-user"></i><?php echo $this->session->userdata('username'); ?>
                </a>
            </li>
            <li class="nav-item" style="position:relative">
                <div class="input-group">
                    <input class="form-control" name="search" id="search" type="text" accesskey="f" placeholder="Search for..." autocomplete="off">
                    <span class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>

                <ul class="list-group" id="result">

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>

    </div>
</nav>
<script>
    function checkAccess(url) {
        var admin_type = "<?= $this->session->get_userdata()['admin_type']; ?>";
        if (admin_type == "0")
            return true;
        accessJSON = [];

        accessJSON = JSON.parse('<?= (file_exists(FCPATH . "Access.json") ? json_encode(json_decode(file_get_contents(FCPATH . "Access.json"), true)) : "[]"); ?>');;
        if (accessJSON[admin_type])
            accessJSON = JSON.stringify(accessJSON[admin_type]);

        if (accessJSON.search(url) >= 0)
            return true;
        else
            return false;
    }
</script>