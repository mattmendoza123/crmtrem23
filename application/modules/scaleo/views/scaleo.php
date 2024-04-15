<link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
<link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <style type="text/css">

    html,
    body,
    #container {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }
    label{
        font-weight:bold;
    }
    h1{
        font-size:20px;
        padding-right:10px;
    }
    .rowWrap{
        padding:40px 20px 20px 62px;
    }
    .table-responsive select{
        width:50%;
    }
    button#refresh {
        height: 35px;
        margin-left: 10px;
    }
    @media only screen
    and (min-width: 200px)
    and (max-width: 768px){
        .table-responsive .col-6,
        .table-responsive .col-3{
            display:contents!important;
           
        }
        .table-responsive .col-2{
            display:none;
        }
        .table-responsive .rowWrap{
            padding:5px 20px;
            
        }
        .table-responsive .col-6 .row{
            margin:0px;
        }
    }
</style>
<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">Scaleo Campaign</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">


                        
                        
                        <div class="table-responsive" style="overflow-x:hidden">    
                            <div class="row rowWrap">
                                <div class="col-6">
                                    <div class="row"><h1>Websites</h1>                           
                                    <select id="website" class="form-control">
                                        <option>https://dating.pearcompare.com/sem/</option>
                                    </select>
                                    </div>
                                </div>                                    
                                <div class="col-6"><div class="row">
                                <h1>Date:</h1>                             
                                    <select id="dateFilter" class="form-control">
                                    <?php
                                        foreach($date_filters as $d){
                                                $selected = ($date_filter == str_replace(" ","_",$d)) ? "selected=selected" : "";
                                                echo "<option value='".str_replace(" ","_",$d)."' $selected>".$d."</option>";                                                
                                        }                                        
                                    ?>
                                    </select> 
                                  
                                    <button type="button" id="refresh" class="btn btn-primary btn-sm">Refresh</button>
                                </div >                            
                                </div>
                                <div class="col-1"></div>                          
                            </div>   
                            <div class="rowWrap">      
                                <?php if($num_offers == 0) { echo "<h1>No Offers Found</h1>"; } ;?>
                                <?php                                                                                     
                                   
                                    foreach(json_decode($tab_per_offer_data) as $i=>$data){                                                                                            
                                        echo "<div class='row' style='border-bottom:1px solid rgba(0,0,0,.1)'>";    
                                        echo "<div class='col-12'> <h1>".$data->name."</h1></div>";
                                        echo "<div class='col-12'>";
                                        echo "<div class='row'>";
                                            echo "<div class='col-6'>";
                                            echo    '<div>
                                                        
                                                    <label> QTY/Approved</label> : '.$data->cv_approved.'<br/>
                                                    <label> Total Revenue</label> : '.$data->total_revenue.'<br/>
                                                    <label> EPC</label> : '.$data->epc.'<br/>
                                                </div>';
                                            echo "</div>";
                                            echo "<div class='col-6'>";
                                            echo    '<div id="barChart'.$i.'" style="height: 300px; width: 95%;"></div>';
                                            echo "</div></div>";
                                        echo "</div>";
                                        echo "</div>";         
                                    }


                                ?>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>