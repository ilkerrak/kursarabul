<?php
debug_backtrace() || die ('Direct access not permitted');


$max_adults_search = 30;
$max_children_search = 10;

if(!isset($_SESSION['destination_id'])) $_SESSION['destination_id'] = 0;
if(!isset($destination_name)) $destination_name = '';

if(!isset($_SESSION['schoollevel_id'])) $_SESSION['schoollevel_id'] = 0;
if(!isset($schoollevel_name)) $schoollevel_name = '';
    
if(!isset($_SESSION['num_adults']))
    $_SESSION['num_adults'] = (isset($_SESSION['book']['adults'])) ? $_SESSION['book']['adults'] : 1;
if(!isset($_SESSION['num_children']))
    $_SESSION['num_children'] = (isset($_SESSION['book']['children'])) ? $_SESSION['book']['children'] : 0;
    
$from_date = (isset($_SESSION['from_date'])) ? $_SESSION['from_date'] : '';
$to_date = (isset($_SESSION['to_date'])) ? $_SESSION['to_date'] : ''; ?>
    
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

    <script>
        $(function(){

            var $search = $('#autocompleteid3');

            $search.autocomplete({
                source: '/templates/default/common/api.php',
                /*focus: function(event, ui){
                    $search.val(ui.item.title);
                },*/
                select: function(event, ui){
                    window.location.href = '/tr/kurs-merkezleri/' + ui.item.alias;
                }
            });

            $search.data('ui-autocomplete')._renderItem = function( ul, item ){

                var $li = $('<li>');

                $li.html('<a href="#">' +
                '<span class="icon"><i class="fal fa-school"></i></span>' +      
                '<span class="city">' + item.city+ ' / </span>' + 
                '<span class="state">' + item.state+ ' - </span>' + 
                '<span class="username">' + item.value + '</span>'+
                       
                        '</a>');

                return $li.appendTo(ul);

            };

        });
    </script>
    <style>
                
                .ui-autocomplete li a span{
                    
                    cursor:pointer;
                    background-color:#fff;
                    font-size:13px;
                    float:left;
                    
                }
                .ui-autocomplete li a span.city{
                   
                    margin-left:20px;
                }
                .ui-autocomplete li a span.username{
                    font-size:15px;
                    float:left;
                    
                }
                
                .ui-autocomplete li a span.icon{
                    font-size:15px;
                    float:left;
                    color:orange;
                                   }
                @media screen and (max-width: 600px) {
                
                .ui-autocomplete li a span.username{
                    font-size:10px;
                    float:left;
                    
                }
                .ui-autocomplete li a span.icon{
                    font-size:10px;
                    float:left;
                    color:orange;
                }
                .ui-autocomplete li a span.state{
                    font-size:10px;

               }
               .ui-autocomplete li a span.city{
                    font-size:10px;

                  
               }
                }
            
            </style>
        
             




<form action="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>" method="post" class="booking-search">
    <?php
    if(isset($hotel_id)){ ?>
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
        <?php
    } ?>
    <div class="row">
       
                              
                                  <div class="main-search-input fl-wrap">
                                     <?php
                                        $nb_search_destinations = 0;
                                        $result_search_destination = $db->query('SELECT * FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID);
                                        if($result_search_destination !== false){
                                            $nb_search_destinations = $db->last_row_count();
                                            if($nb_search_destinations > 0){ ?>
                                        <div class="main-search-input-item location" >
                                            <span class="inpt_dec"><i class="fas fa-map-marker"></i></span>
                                            <?php
                                            $result_search_destination = $result_search_destination->fetchAll(PDO::FETCH_ASSOC);
                                            if(count($result_search_destination) > 10){ ?>
                                            <input type="text" name="destination_name"  class="autocomplete-input" data-wrapper="result-destinations" data-target="destination_id" data-url="<?php echo getFromTemplate('common/search_destinations.php'); ?>" value="<?php echo $destination_name; ?>" placeholder="<?php echo $texts['DESTINATION']; ?>"  value=""/>
                                            <input type="hidden" name="destination_id" id="destination_id" value="<?php echo $_SESSION['destination_id']; ?>">
                                                <?php
                                            }else{
                                                ?>
                                                <div class="listsearch-input-item ">
                                                    <select name="destination_id" data-placeholder="City" name="destination_id" class="chosen-select">
                                                        <option value="0"><?php echo 'Şehirler'; ?></option>
                                                        <?php
                                                        foreach($result_search_destination as $row){
                                                            $selected = (isset($_SESSION['destination_id']) && $_SESSION['destination_id'] == $row['id']) ? ' selected="selected"' : '';
                                                            echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                        } ?>
                                                    </select>
                                                </div>  
                                                    <?php
                                                } ?>
                                            
                                        </div>
                                        
                                                <?php 
                                                }
                                            }?>
                                        
                                        

                                        <div class="main-search-input-item main-date-parent main-search-input-item_small">
                                            <span class="inpt_dec"><i class="fas fa-calendar-check"></i></span> <input style="background:#f7f9fb !important;" type="text" placeholder="Aradığınız Kurs Merkezini Yazın"  id="autocompleteid3"   value=""/>
                                        </div>
                                        
                                        <?php
                                            $nb_search_schoollevels = 0;
                                            $result_search_schoollevel = $db->query('SELECT * FROM pm_schoollevel WHERE checked = 1 AND lang = '.LANG_ID);
                                            if($result_search_schoollevel !== false){
                                                $nb_search_schoollevels = $db->last_row_count();
                                                if($nb_search_schoollevels > 0){ ?>
                                        <div class="main-search-input-item location" >
                                        <span class="inpt_dec"><i class="fas fa-map-marker"></i></span></i>
                                                <?php
                                                         $result_search_schoollevel = $result_search_schoollevel->fetchAll(PDO::FETCH_ASSOC);
                                                                if(count($result_search_schoollevel) > 10){ ?>
                                                                                <input type="text" name="schoollevel_name" class="form-control" data-wrapper="result-schoollevels" data-target="schoollevel_id" data-url="<?php echo getFromTemplate('common/search_schoollevels.php'); ?>" value="<?php echo $schoollevel_name; ?>" placeholder="<?php echo $texts['schoollevel']; ?>">
                                                                                <input type="hidden" name="schoollevel_id" id="schoollevel_id" value="<?php echo $_SESSION['schoollevel_id']; ?>">
                                                                                <?php
                                                                            }else{ ?>
                                                                             <div class="listsearch-input-item ">
                                                                                <select  data-placeholder="City" name="destination_id" name="schoollevel_id" class="chosen-select no-search-select">
                                                                                    <option value="0"><?php echo 'Kurs Türleri'; ?></option>
                                                                                    <?php
                                                                                    foreach($result_search_schoollevel as $row){
                                                                                        $selected = (isset($_SESSION['schoollevel_id']) && $_SESSION['schoollevel_id'] == $row['id']) ? ' selected="selected"' : '';
                                                                                        echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                                                    } ?>
                                                                                </select>
                                                                                </div>
                                                                                <?php
                                                                            } ?>
                                                                        </div> 
                                                                        <button class="main-search-button color2-bg" onclick="window.location.href='listing.html'" name="check_availabilities">Kurs Merkezi Ara <i class="fas fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                    }
                                                } ?>
                                        </div>
                                    
                                </div>
    </div>
    <?php
    if($page['page_model'] == 'booking'){ ?>
        <div class="row mb5 mt10">
            <?php
            $result_rate = $db->query('SELECT MAX(price) as max_price FROM pm_rate');
            if($result_rate !== false && $db->last_row_count() > 0){
                $row = $result_rate->fetch();
                $max_price = $row['max_price']*($_SESSION['num_children']+$_SESSION['num_adults']);
                if($max_price > 0){
                    if(!isset($price_min) || is_null($price_min)) $price_min = 0;
                    if(!isset($price_max) || is_null($price_max)) $price_max = $max_price; ?>
                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label" for="hotel_class"><?php echo $texts['YOUR_BUDGET']; ?></label>
                        <div class="col-sm-9">
                            <div class="nouislider-wrapper">
                                <div class="nouislider" data-min="0" data-max="<?php echo number_format(ceil($max_price)*CURRENCY_RATE, 0, '.', ''); ?>" data-start="<?php echo '['.number_format(floor($price_min)*CURRENCY_RATE, 0, '.', '').','.number_format(ceil($price_max)*CURRENCY_RATE, 0, '.', '').']'; ?>" data-step="10" data-direction="<?php echo RTL_DIR; ?>" data-input="price_range"></div>
                                <?php echo $texts['PRICE'].' / '.$texts['NIGHT']; ?> : <?php echo CURRENCY_SIGN; ?> <input type="text" name="price_range" class="slider-target" id="price_range" value="" readonly="readonly" size="15">
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            if(!isset($class_min) || is_null($class_min)) $class_min = 0;
            if(!isset($class_max) || is_null($class_max)) $class_max = 5; ?>
            <!--<div class="col-sm-6">
                <label class="col-sm-3 control-label" for="hotel_class"><?php echo $texts['HOTEL_CLASS']; ?></label>
                <div class="col-sm-9">
                    <div class="nouislider-wrapper">
                        <div class="nouislider" data-min="0" data-max="5" data-start="<?php echo '['.$class_min.','.$class_max.']'; ?>" data-step="1" data-direction="<?php echo RTL_DIR; ?>" data-input="class_range"></div>
                        <?php echo $texts['STARS']; ?> : <input type="text" name="class_range" class="slider-target" id="class_range" value="" readonly="readonly" size="5">
                    </div>
                </div>
            </div>-->
        </div>
        <?php
    } ?>
</form>
