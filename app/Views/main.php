    <?php
    include_once('layouts/header.php');
    ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 colchatlist">                
                <div class="panel panel-default panelchatlist">
                    <div class="panel-heading">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <button type="button" class="btn btn-default btnmenu">
                                        <i class="fa fa-fw fa-bars"></i>
                                    </button>
                                </div>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <input type="search" class="form-control formsearch" placeholder="Search">                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                       Basic panel example
                    </div>
                </div>    
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 text-center colchatcontent">
                <div class="panel panel-default">
                    <div class="panel-body">
                       Basic panel example
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>