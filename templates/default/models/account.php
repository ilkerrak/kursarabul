<style>
 td, th {
  border: 1px solid #ddd !important ;
  padding: 8px !important;
}

 tr{
     background-color: #f2f2f2;
     
 }

 tr:hover {background-color: #ddd;}

 th {
  padding-top: 12px !important;
  padding-bottom: 12px !important;
  text-align: left;
  background-color: #3aaced;
  color: white;
}
</style>
<?php
$msg_error = "";
$msg_success = "";
$field_notice = array();

if(isset($_GET['view'])) $view = $_GET['view'];
else $view = "account";

$user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

$result_user = $db->query("SELECT * FROM pm_user WHERE id = ".$db->quote($user_id)." AND checked = 1");
if($result_user !== false && $db->last_row_count() > 0){
    $row = $result_user->fetch();
    
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $login = $row['login'];
    $email = $row['email'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $company = $row['company'];
    $country = $row['country'];
    $mobile = $row['mobile'];
    $phone = $row['phone'];
}else{
    $firstname = "";
    $lastname = "";
    $login = "";
    $email = "";
    $address = "";
    $postcode = "";
    $city = "";
    $company = "";
    $country = "";
    $mobile = "";
    $phone = ""; 
}

require(getFromTemplate("common/header.php", false)); ?>

<section id="page">
    
    <?php include(getFromTemplate("common/page_header.php", false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">
            
            <?php
            if($user_id > 0){ ?>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="pagination pull-right">
                            <?php if($view == "account"); ?><a style="width:150px; margin-bottom:30px;" href="?view=account"><?php echo $texts['MY_ACCOUNT']; ?></a>
                            <?php if($view == "booking-history"); ?><a style="width:150px; margin-bottom:30px;" href="?view=booking-history"><?php echo $texts['BOOKING_HISTORY']; ?></a>
                        </ul>
                    </div>
                </div>
                <?php
            }
            
            $hotel_id = 0;
            $result_hotel = $db->prepare("SELECT title FROM pm_hotel WHERE id = :hotel_id AND lang = ".LANG_ID);
            $result_hotel->bindParam(':hotel_id', $hotel_id);
            
            if($view == "booking-history" && $user_id > 0){ ?>
                <fieldset>
                    <legend style="margin:35px; font-size:20px; font-weight:bold;"><?php echo $texts['BOOKING_HISTORY']; ?></legend>
                    <?php
                    $result_booking = $db->query("SELECT * FROM pm_booking WHERE id_user = ".$db->quote($user_id)." ORDER BY add_date DESC");
                    if($result_booking !== false && $db->last_row_count() > 0){ ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $texts['BOOKING_DATE']; ?></th>
                                        <th class="text-center"><?php echo $texts['HOTEL']; ?></th>
                                        <th class="text-center"><?php echo $texts['NIGHTS']; ?></th>
                                        <th class="text-center"><?php echo $texts['ADULTS']; ?></th>
                                        <th class="text-center"><?php echo $texts['CHILDREN']; ?></th>
                                        <th class="text-center"><?php echo $texts['TOTAL']; ?></th>
                                        <th class="text-center"><?php echo $texts['PAYMENT']; ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($result_booking as $i => $row){
                                        
                                        $hotel_id = $row['id_hotel'];
                                        $hotel = '';
                                        if($result_hotel->execute() !== false && $db->last_row_count() > 0)
                                            $hotel = $result_hotel->fetchColumn(0); ?>
                                            
                                        <tr>
                                            <td><?php echo gmstrftime(DATE_FORMAT." ".TIME_FORMAT, $row['add_date']); ?></td>
                                            <td><?php echo $hotel; ?></td>
                                            <td class="text-center"><?php echo $row['nights']; ?></td>
                                            <td class="text-center"><?php echo $row['adults']; ?></td>
                                            <td class="text-center"><?php echo $row['children']; ?></td>
                                            <td class="text-right"><?php echo formatPrice($row['total']*CURRENCY_RATE); ?></td>
                                            <td class="text-left">
                                                <?php
                                                switch($row['status']){
                                                    case 1: echo $texts['AWAITING']; break;
                                                    case 2: echo $texts['CANCELLED']; break;
                                                    case 3: echo $texts['REJECTED_PAYMENT']; break;
                                                    case 4: echo $texts['PAYED']; break;
                                                    default: echo $texts['AWAITING']; break;
                                                }
                                                if(!empty($row['down_payment']) && $row['down_payment'] < $row['total']) echo " (".formatPrice($row['down_payment']*CURRENCY_RATE).")" ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo getFromTemplate("common/booking-popup.php"); ?>" data-params="id=<?php echo $row['id']; ?>" class="ajax-popup-link"><i class="fa fa-search"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }else{ ?>
                        <p class="lead text-center text-muted"><?php echo $texts['NO_BOOKING_YET']; ?></p>
                        <?php
                    } ?>
                </fieldset>
                <?php
            }else{
                if($user_id == 0){ ?>
                    <?php
                } ?>
                <fieldset>
                   
                    <div class="custom-form">
                    <div class="row">
                        <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" role="form" class="ajax-form">
                            <div class="alert alert-success" style="display:none;"></div>
                            <div class="alert alert-danger" style="display:none;"></div>
                            <input type="hidden" name="signup_type" value="complete">
                            <div class="col-sm-6">
								
                                 <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['FIRSTNAME']; ?> <i style="margin-top:15px;" class="fal fa-user"></i></label>
                                        <input type="text" class="form-control" name="firstname"  value="<?php echo $firstname; ?>"/>  
                                        <div class="field-notice" rel="firstname"></div>     
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['LASTNAME']; ?> <i style="margin-top:15px;" class="fal fa-user"></i></label>
                                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>"/>
                                        <div class="field-notice" rel="lastname"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['USERNAME']; ?> <i style="margin-top:15px;" class="fal fa-user"></i></label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $login; ?>"/>
                                        <div class="field-notice" rel="username"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['EMAIL']; ?> <i style="margin-top:15px;" class="fal fa-envelope"></i></label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"/>
                                        <div class="field-notice" rel="email"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['PASSWORD']; ?> <i style="margin-top:15px;" class="fal fa-lock"></i></label>
                                        <input type="password" class="form-control" name="password" value=""/>
                                        <div class="field-notice" rel="password"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['PASSWORD_CONFIRM']; ?> <i style="margin-top:15px;" class="fal fa-lock"></i></label>
                                        <input type="password" class="form-control" name="password_confirm" value=""/>
                                        <div class="field-notice" rel="password_confirm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['ADDRESS']; ?> <i style="margin-top:15px;" class="fal fa-map-marker-alt"></i></label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"/>
                                        <div class="field-notice" rel="address"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['POSTCODE']; ?> <i style="margin-top:15px;" class="fal fa-mailbox"></i></label>
                                        <input type="text" class="form-control" name="postcode" value="<?php echo $postcode; ?>"/>
                                        <div class="field-notice" rel="postcode"></div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['CITY']; ?> <i style="margin-top:15px;" class="fal fa-map"></i></label>
                                        <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
                                        <div class="field-notice" rel="city"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['COUNTRY']; ?> <i class="fal fa-envelope"></i></label>
                                            <div class="listsearch-input-item "> 
                                            <select class="chosen-select no-search-select" name="country" data-placeholder="Your Country"> 
                                            <option value="0">-</option>
                                            <?php
                                            $result_country = $db->query('SELECT * FROM pm_country');
                                            if($result_country !== false){
                                                foreach($result_country as $i => $row){
                                                    $id_country = $row['id'];
                                                    $country_name = $row['name'];
                                                    $selected = ($country == $country_name) ? ' selected="selected"' : '';
                                                    
                                                    echo '<option value="'.$country_name.'"'.$selected.'>'.$country_name.'</option>';
                                                }
                                            } ?>
                                        </select>
                                        </div>
                                        <div class="field-notice" rel="country"></div>                                      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['PHONE']; ?> <i style="margin-top:15px;" class="fal fa-phone"></i></label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>"/>
                                        <div class="field-notice" rel="phone"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['MOBILE']; ?> <i style="margin-top:15px;" class="fal fa-phone"></i></label>
                                        <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>"/>
                                        <div class="field-notice" rel="mobile"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label><?php echo $texts['COMPANY']; ?> <i style="margin-top:15px;" class="fal fa-building"></i></label>
                                        <input type="text" class="form-control" name="company" value="<?php echo $company; ?>"/>
                                        <div class="field-notice" rel="company"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                         <label class="col-lg-3 control-label"></label>
                                        <input type="checkbox" name="privacy_agreement" value="1"> <?php echo $texts['PRIVACY_POLICY_AGREEMENT']; ?>
                                        <div class="field-notice" rel="privacy_agreement"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    
                                        <i class="text-muted"> * <?php echo $texts['REQUIRED_FIELD']; ?> </i><br>
                                        <a href="#" style="padding:15px; margin:15px; margin-right:170px; margin-top:25px;" class="main-search-button color2-bg" data-action="<?php echo getFromTemplate("common/register/signup.php"); ?>"<?php if($user_id == 0) echo " data-clear=\"true\""; ?>><i class="fa fa-power-off"></i> <?php echo ($user_id > 0) ? $texts['EDIT'] : $texts['SIGN_UP']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                    </fieldset>
                </div>
                <?php
            } ?>
        </div>
    </div>
</section>
