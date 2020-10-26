<?php
if(!isset($_SESSION['book']) || count($_SESSION['book']) == 0){
    header('Location: '.DOCBASE.$sys_pages['booking']['alias']);
    exit();
}else
    $_SESSION['book']['step'] = 'summary';

require(getFromTemplate('common/header.php', false)); ?>

<section id="page">
    
    <?php include(getFromTemplate('common/page_header.php', false)); ?>

    <div id="content" class="pt30 pb20">
        <div class="container">
            
            <div class="row mb30" id="booking-breadcrumb">
                <div class="col-sm-2 col-sm-offset-<?php echo isset($_SESSION['book']['activities']) ? '1' : '2'; ?>">
                    <a href="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>">
                        <div class="breadcrumb-item done">
                            <i class="fas fa-fw fa-calendar"></i>
                            <span><?php echo $sys_pages['booking']['name']; ?></span>
                        </div>
                    </a>
                </div>
                <?php
                if(isset($_SESSION['book']['activities'])){ ?>
                    <div class="col-sm-2">
                        <a href="<?php echo DOCBASE.$sys_pages['booking-activities']['alias']; ?>">
                            <div class="breadcrumb-item done">
                                <i class="fas fa-fw fa-ticket-alt"></i>
                                <span><?php echo $sys_pages['booking-activities']['name']; ?></span>
                            </div>
                        </a>
                    </div>
                    <?php
                } ?>
                <ul id="progressbar" style="margin-top:20px;">
                    
                    <li><span>01.</span><a href="okul-ara"><?php echo $sys_pages['booking']['name']; ?></a></li>
                    <li class="done"><span>02.</span><i class="fas fa-fw fa-info-circle"></i><?php echo $sys_pages['details']['name']; ?></li>
                    <li class="active"><span>03.</span> <i class="fas fa-fw fa-list"></i><?php echo $sys_pages['summary']['name']; ?></li>
                    <li><span>04.</span><i class="fas fa-fw fa-credit-card"></i><?php echo $sys_pages['payment']['name']; ?></li>
                    </ul>
            </div>
            
            <?php
            if($page['text'] != ""){ ?>
                <div class="clearfix mb20"><?php echo $page['text']; ?></div>
                <?php
            } ?>
            
            <form method="post" action="<?php echo DOCBASE.$sys_pages['payment']['alias']; ?>">
            
                <?php
                echo '
                <div class="invoice-box">
            <table>
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="images/logo2.png" style="width:150px; height:auto" alt="">
                                </td>
                                <td>';
                                if(isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0){
                                    echo $texts['CHECK_IN'].' <strong>'.gmstrftime(DATE_FORMAT, $_SESSION['book']['from_date']).'</strong><br>
                                    '.$texts['CHECK_OUT'].' <strong>'.gmstrftime(DATE_FORMAT, $_SESSION['book']['to_date']).'</strong><br>
                                    <strong>'.$_SESSION['book']['nights'].'</strong> '.getAltText($texts['NIGHT'], $texts['NIGHTS'], $_SESSION['book']['nights']).'<br>
                                    <strong>'.($_SESSION['book']['adults']+$_SESSION['book']['children']).'</strong> '.getAltText($texts['PERSON'], $texts['PERSONS'], ($_SESSION['book']['adults']+$_SESSION['book']['children'])).' - 
                                    '.getAltText($texts['ADULT'], $texts['ADULTS'], $_SESSION['book']['adults']).': <strong>'.$_SESSION['book']['adults'].'</strong> / 
                                    '.getAltText($texts['CHILD'], $texts['CHILDREN'], $_SESSION['book']['children']).': <strong>'.$_SESSION['book']['children'].'</strong>';
                                }
                                echo '</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>'
                                .$_SESSION['book']['firstname'].' '.$_SESSION['book']['lastname'].'<br>';
                                if($_SESSION['book']['company'] != '') echo $texts['COMPANY'].' : '.$_SESSION['book']['company'].'<br>';
                                echo nl2br($_SESSION['book']['address']).'<br>
                                '.$_SESSION['book']['postcode'].' '.$_SESSION['book']['city'].'<br>
                                '.$texts['PHONE'].' : '.$_SESSION['book']['phone'].'<br>';
                                if($_SESSION['book']['mobile'] != '') echo $texts['MOBILE'].' : '.$_SESSION['book']['mobile'].'<br>';
                                echo $texts['EMAIL'].' : '.$_SESSION['book']['email'].'                                
                                     </td>
                                
                            </tr>
                        </table>
                    </td>
                </tr>';
                if(isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0){
                    foreach($_SESSION['book']['rooms'] as $id_room => $rooms){
                echo '<tr class="heading">
                    <td>
                        Option
                    </td>
                    <td>
                        Details
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Kurs Merkezi
                    </td>
                    <td>
                    '.$_SESSION['book']['hotel'].'
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Room Type
                    </td>
                    <td>
                    '.$room['title'].'
                    </td>
                </tr>
              
                <tr class="item ">
                    <td>
                        Persons
                    </td>
                    <td>';
                     if(isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0){
                    ($room['adults']+$room['children']).' '.getAltText($texts['PERSON'], $texts['PERSONS'], ($room['adults']+$room['children'])).': ';
                    if($room['adults'] > 0) echo $room['adults'].' '.getAltText($texts['ADULT'], $texts['ADULTS'], $room['adults']).' ';
                    if($room['children'] > 0){
                        echo $room['children'].' '.getAltText($texts['CHILD'], $texts['CHILDREN'], $room['children']).' ';
                        if(isset($room['child_age'])){
                            echo '('.implode(' '.$texts['YO'].', ', $room['child_age']).' '.$texts['YO'].')';
                        }
                    }
                     
                }'
                    </td>
                </tr>
                <tr class="item last">
                    <td>
                        Taxes
                    </td>
                    <td>
                    '.formatPrice($room['amount']*CURRENCY_RATE).'
                    </td>
                </tr>';
                    }
                }
                echo '<tr class="total">
                    <td></td>
                    <td style="padding-top:50px;"> 
                        Total: '.formatPrice($_SESSION['book']['total']*CURRENCY_RATE).'
                    </td>
                </tr>
            </table>
        </div>';
                
                if(isset($_SESSION['book']['extra_services']) && count($_SESSION['book']['extra_services']) > 0){
                    echo '
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>'.$texts['SERVICE'].'</th>
                            <th>'.$texts['QUANTITY'].'</th>
                            <th class="text-center">'.$texts['TOTAL'].'</th>
                        </tr>';
                        foreach($_SESSION['book']['extra_services'] as $id_service => $service){
                            echo
                            '<tr>
                                <td>'.$service['title'].'</td>
                                <td>'.$service['qty'].'</td>
                                <td class="text-right" width="15%">'.formatPrice($service['amount']*CURRENCY_RATE).'</td>
                            </tr>';
                        }
                        echo '
                    </table>';
                }
                
                if(isset($_SESSION['book']['activities']) && count($_SESSION['book']['activities']) > 0){
                    echo '
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>'.$texts['ACTIVITY'].'</th>
                            <th>'.$texts['DURATION'].'</th>
                            <th>'.$texts['DATE'].'</th>
                            <th>'.$texts['PERSONS'].'</th>
                            <th class="text-center">'.$texts['TOTAL'].'</th>
                        </tr>';
                        foreach($_SESSION['book']['activities'] as $id_activity => $activity){
                            echo
                            '<tr>
                                <td>'.$activity['title'].'</td>
                                <td>'.$activity['duration'].'</td>
                                <td>'.gmstrftime(DATE_FORMAT.' '.TIME_FORMAT, $activity['session_date']).'</td>
                                <td>
                                    '.($activity['adults']+$activity['children']).' '.getAltText($texts['PERSON'], $texts['PERSONS'], ($activity['adults']+$activity['children'])).': ';
                                    if($activity['adults'] > 0) echo $activity['adults'].' '.getAltText($texts['ADULT'], $texts['ADULTS'], $activity['adults']).' ';
                                    if($activity['children'] > 0) echo $activity['children'].' '.getAltText($texts['CHILD'], $texts['CHILDREN'], $activity['children']).' ';
                                    echo '
                                </td>
                                <td class="text-right" width="15%">'.formatPrice($activity['amount']*CURRENCY_RATE).'</td>
                            </tr>';
                        }
                        echo '
                    </table>';
                }
                echo '
                <table class="table table-responsive table-bordered">';
               
                    /*if(ENABLE_TOURIST_TAX == 1 && $_SESSION['book']['tourist_tax'] > 0){
                        echo '
                        <tr>
                            <th class="text-right">'.$texts['TOURIST_TAX'].'</th>
                            <td class="text-right">'.formatPrice($_SESSION['book']['tourist_tax']*CURRENCY_RATE).'</td>
                        </tr>';
                    }*/
                    
                    if(isset($_SESSION['book']['discount_amount']) && $_SESSION['book']['discount_amount'] > 0){
                        echo '
                        <tr>
                            <th class="text-right">'.$texts['DISCOUNT'].'</th>
                            <td class="text-right">- '.formatPrice($_SESSION['book']['discount_amount']*CURRENCY_RATE).'</td>
                        </tr>';
                    }
                    
                    if(isset($_SESSION['book']['taxes'])){
						$tax_id = 0;
						$result_tax = $db->prepare('SELECT * FROM pm_tax WHERE id = :tax_id AND checked = 1 AND value > 0 AND lang = '.LANG_ID.' ORDER BY rank');
						$result_tax->bindParam(':tax_id', $tax_id);
						foreach($_SESSION['book']['taxes'] as $tax_id => $taxes){
							$tax_amount = 0;
							foreach($taxes as $amount) $tax_amount += $amount;
							if($tax_amount > 0){
								if($result_tax->execute() !== false && $db->last_row_count() > 0){
									$tax = $result_tax->fetch();
									
									echo '
									<tr>
										<th class="text-right">'.$tax['name'].'</th>
										<td class="text-right">'.formatPrice($tax_amount*CURRENCY_RATE).'</td>
									</tr>';
								}
							}
						}
					}
                    
                    echo '
                    <tr>
                        <th class="text-right">'.$texts['TOTAL'].' ('.$texts['INCL_TAX'].')</th>
                        <td class="text-right" width="15%"><b>'.formatPrice($_SESSION['book']['total']*CURRENCY_RATE).'</b></td>
                    </tr>';
                    
                    if(ENABLE_DOWN_PAYMENT == 1 && $_SESSION['book']['down_payment'] > 0){
                        echo '
                        <tr>
                            <th class="text-right">'.$texts['DOWN_PAYMENT'].' ('.$texts['INCL_TAX'].')</th>
                            <td class="text-right" width="15%"><b>'.formatPrice($_SESSION['book']['down_payment']*CURRENCY_RATE).'</b></td>
                        </tr>';
                    }
                    echo '
                </table>'; ?>
                
                <a class="btn btn-default btn-lg pull-left" href="<?php echo DOCBASE.$sys_pages['details']['alias']; ?>"><i class="fas fa-fw fa-angle-left"></i> <?php echo $texts['PREVIOUS_STEP']; ?></a>
                <button type="submit" name="confirm_booking" class="btn btn-primary btn-lg pull-right"><?php echo $texts['CONFIRM_BOOKING']; ?> <i class="fas fa-fw fa-angle-right"></i></button>
            </form>
        </div>
    </div>
</section>
