<?php include 'inc/config.php'; ?>
<?php include 'inc/template_start.php'; ?>
<?php include 'inc/page_head.php'; ?>

<head>
<style>
button.c8_btn_green {
    background-color:#44c767;
    -moz-border-radius:11px;
    -webkit-border-radius:11px;
    border-radius:11px;
    border:1px solid #18ab29;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:Arial;
    font-size:11px;
    padding:4px 11px;
    text-decoration:none;
    text-shadow:0px 1px 0px #2f6627;
} 
button.c8_btn_green:hover {
    background-color:#5cbf2a;
}
button.c8_btn_green:active {
    position:relative;
    top:1px;
}

button.c8_btn_red {
    background-color:#c62d1f;
    -moz-border-radius:11px;
    -webkit-border-radius:11px;
    border-radius:11px;
    border:1px solid #d02718;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:Arial;
    font-size:11px;
    padding:4px 11px;
    text-decoration:none;
    text-shadow:0px 1px 0px #810e05;
} 
button.c8_btn_red:hover {
    background-color:#f24437;
}
button.c8_btn_red:active {
    position:relative;
    top:1px;
}
</style>
</head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
function onClickGreen(_id)
{
    console.log(_id);
}

function onClickRed(_id)
{
    var mongoID_removing = _id;
    window.location = "?mongoID_removing=" + mongoID_removing;
}

function imgStr(arr) {
    var imgstr = "";
    $.each(arr, function(){
        // imgstr += '<a href="'+ this +'" data-toggle="lightbox-image"><img src="'+ this +'" width=50 alt="image"></a>';
        imgstr += '<div class="col-xs-6 col-sm-5"> <a href="'+ this +'" class="gallery-link" title="Info"><img src="'+ this +'" alt="image"></a></div>';
    });
    return imgstr;
}

function loadData() {
        $.ajax({
            url: "http://192.168.16.41/androidapp/app_process.php",
            dataType: "json",
        }).done(function(response){
            $.each(response, function(idx, val) {
                $('<tr>').append(
                    $('<td>').text(val._id),
                    $('<td>').text(val._loan_type),
                    $('<td>').text(val._tenure),
                    $('<td>').text(val._loan_purpose), 
                    $('<td>').text(val._industry),
                    // $('<td>').append(imgStr(val._url)),
                    $('<td style="width: 250px">').append(
                        `<div class="gallery gallery-widget" data-toggle="lightbox-gallery" >
                            <div class="row">
                                ` + imgStr(val._url) + `
                            </div>
                        </div>`),
                    $('<td>').text(val._location),
                    $('<td>').append(`<div class="btn-group btn-group-xs">
                                <button class="c8_btn_green" onClick="onClickGreen('`+ val._id +`')">Import</button>
                                <button class="c8_btn_red" onClick="onClickRed('`+ val._id +`')">Delete</button>
                            </div>`)
                    ).appendTo('#general_table');
            });
            $('[data-toggle="lightbox-gallery"]').each(function(){
            $(this).magnificPopup({
                delegate: 'a.gallery-link',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    arrowMarkup: '<button type="button" class="mfp-arrow mfp-arrow-%dir%" title="%title%"></button>',
                    tPrev: 'Previous',
                    tNext: 'Next',
                    tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
                },
                image: {titleSrc: 'title'}
            });
        });
        }).fail(function (data)
        {
            console.log(data);
        });
    }
    loadData();
</script>

<div id="page-content">
	<div class="content-header">
        <div class="header-section">
            <h1>
                Records<b><i>tezt</i></b>
            </h1>
        </div>
    </div>
    
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="">Tables</a></li>
    </ul>

    <div class="block full">
    	<div class="block-title">
    		<h2><strong>Datatables</strong> integration</h2>
    	</div>

	    <div class="table-responsive">
	    	<table id="general_table" class="table table-striped table-vcenter">
	    		<!-- <thead> -->
                    <tr>
                    	<th>ID</th>
                        <!-- <th class="text-center">Loan Type</th> -->
                        <th>Loan Type</th>
                        <th>Tenure</th>
                        <th>Loan Purpose</th>
                        <th>Industry</th>
                        <th>Image</th>
                        <th>Location</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                <!-- </thead> -->                
	    	</table>
	    </div>
    </div>
</div>

<?php include 'inc/page_footer.php'; ?>
<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->

<script src="js/pages/tablesDatatables.js"></script>
<script type="text/javascript">
// $('.c8_btn_red').click(function()
// {
//     var mongoID_removing = $(this).attr("data-id");
//     window.location = "?mongoID_removing=" + mongoID_removing;

//     // var xhr;
//     // if(window.XMLHttpRequest)
//     //     xhr = new XMLHttpRequest();
//     // else
//     //     xhr = new ActiveXObject("Microsoft.XMLHTTP");
//     // var url = 'app_process.php?mongoID_removing=' + mongoID_removing;
//     // xhr.open('GET', url, false);
//     // xhr.send();
//     // return false;
    
// });

// $('.c8_btn_green').click(function()
// {
//     console.log($(this).attr("class"));    
// });

<?php
    include 'uploads/tezt.php';
    $img_location = "/chauvu/final/uploads/";
    $m = new MongoClient();
    $db = $m->dbbank;
    $collection = new MongoCollection($db, "main");
    if (isset($_GET['mongoID_removing'])) 
    {
        $php_var = $_GET['mongoID_removing'];
        $cursor = $collection -> find(array('_id' => new MongoID($php_var)));
        foreach($cursor as $row)
        {   
            // while (list(, $value) = each($row["_url"])) {
            //         delete_img(basename($value).PHP_EOL);
            // }
            foreach(array($row['_url']) as $add)
            {
                foreach($add as $ad)
                {
                    delete_img(dirname(basename($ad).PHP_EOL));
                    // unlink($ad);
                }
            }
        }
        $collection->remove(array("_id" => new MongoID($php_var))); 
    }
?>

</script>
<script>$(function(){ TablesDatatables.init(); });
</script>

<?php include 'inc/template_end.php'; ?>